<?php


function checkUserExists($conn, $username){ // Fonction qui check si le User existe ( Retourne False ou True )

    $checkUser = $conn->prepare("SELECT * FROM utilisateur WHERE userEmail = :username");
    $checkUser->bindParam(':username', $username);
    $checkUser->execute();

    return $checkUser->fetchColumn();
}

function createUser($conn,$username,$password,$nom,$prenom, $adresse, $dnaissance, $tel, $sexe, $consentement) // Fonction qui crée un utilisateur retourne le status en json
{
    header('Content-Type: application/json');
    $rep = [];
    $user = checkUserExists($conn,$username);
    if (!$user) {
        if(checkPasswordRegister($password) > 250)
        {
            addUser($conn, $username,$password,$nom,$prenom,$adresse, $dnaissance, $tel, $sexe, $consentement);
            $rep['status'] = "Compte creer";
        } else{
            $rep['status'] = "Mot de passe incorrect";
            $rep['data']['indPass'] = checkPasswordRegister($password);
        }
        
    } else {
        $rep['status'] = "Email déjà utilisée";
    }

    return json_encode($rep);
}

function checkPasswordRegister($mdp)
{
    $longueur = strlen($mdp);
    $point = 0;
    $point_maj = 0;
    $point_chiffre = 0;
    $point_caracteres = 0;
    // On fait une boucle pour lire chaque lettre
    for($i = 0; $i < $longueur; $i++) 	{
    
        // On sélectionne une à une chaque lettre
        // $i étant à 0 lors du premier passage de la boucle
        $lettre = $mdp[$i];
    
        if ($lettre>='a' && $lettre<='z'){
            // On ajoute 1 point pour une minuscule
            $point = $point + 1;
    
            // On rajoute le bonus pour une minuscule
            $point_min = 1;
        }
        else if ($lettre>='A' && $lettre <='Z'){
            // On ajoute 2 points pour une majuscule
            $point = $point + 2;
    
            // On rajoute le bonus pour une majuscule
            $point_maj = 2;
        }
        else if ($lettre>='0' && $lettre<='9'){
            // On ajoute 3 points pour un chiffre
            $point = $point + 3;
    
            // On rajoute le bonus pour un chiffre
            $point_chiffre = 3;
        }
        else {
            // On ajoute 5 points pour un caractère autre
            $point = $point + 5;
    
            // On rajoute le bonus pour un caractère autre
            $point_caracteres = 5;
        }
}
 
    // Calcul du coefficient points/longueur
    $etape1 = $point / $longueur;
    
    // Calcul du coefficient de la diversité des types de caractères...
    $etape2 = $point_min + $point_maj + $point_chiffre + $point_caracteres;
    
    // Multiplication du coefficient de diversité avec celui de la longueur
    $resultat = $etape1 * $etape2;
    
    // Multiplication du résultat par la longueur de la chaîne
    $final = $resultat * $longueur;
    
    return $final;
 
}


function addUser($conn, $username,$password,$nom,$prenom,$adresse, $dnaissance, $tel, $sexe, $consentement) // Fonction qui met un utilisateur dans la BDD retourne rien
{
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $addUser = $conn->prepare("INSERT INTO utilisateur(userEmail, userPassword,userName, userPrenom, userAdress, userBirthday, userGender, userPhone, userConsentement)  VALUES (:username,:password,:nom,:prenom, :adresse, :dnaissance, :sexe, :tel, :consentement)");
    $addUser->bindParam(':username', $username);
    $addUser->bindParam(':password', $passwordHash);
    $addUser->bindParam(':nom', $nom);
    $addUser->bindParam(':prenom', $prenom);
    $addUser->bindParam(':tel', $tel);
    $addUser->bindParam(':sexe', $sexe);
    $addUser->bindParam(':dnaissance', $dnaissance);
    $addUser->bindParam(':adresse', $adresse);
    $addUser->bindParam(':consentement', $consentement);

    $addUser->execute();
}

function loginUser($conn, $username,$password)
{
    header('Content-Type: application/json');
    $rep = [];


    //CHECK USER
    $userExist = checkUserExists($conn,$username);
    if (!$userExist){
        $rep['status']= false;
    }
    //FIN check USER

    //check password//

    $checkUserLogin = $conn->prepare('SELECT * FROM utilisateur WHERE userEmail = :username');
    $checkUserLogin->bindValue(':username',$username, PDO::PARAM_STR);
    $checkUserLogin->execute();
    $user = $checkUserLogin->fetch();
    if($user && password_verify($password, $user['userPassword'])) {
        $_SESSION['auth'] = true;
        $_SESSION['user'] = $user;
        $rep['status'] = true;
        if (isset($_SESSION['register']) == "enAttente"){
            unset($_SESSION["register"]);
        }
    }
    else{
        $rep['status'] = false;
    }
    return json_encode($rep);
    //check password fin
}

function contactFormSend($nom, $mail, $sujet, $message, $date){
    $header =
        "From ".$mail."\r\n".
            $nom."\r\n".
        "Le ".$date;
        if(mail("", $sujet , $message , $header)){
            $_SESSION["message"] =
                "Nous avons bien recu votre message ".$nom.".<br>".
                "Nous tiendrons compte de votre demande et nous vous repondrons dans les meilleurs délais !";
            header('location:/contact.php');
        }
        else{
            $_SESSION["message"] = "Désolé, une erreur s'est produite !\n".
            "Réessaye ?";
            header('location:/contact.php');
        }
}
function refreshSession($conn, $userEmail){

    $checkUserLogin = $conn->prepare('SELECT * FROM utilisateur WHERE userEmail = :username');
    $checkUserLogin->bindValue(':username',$userEmail, PDO::PARAM_STR);
    $checkUserLogin->execute();
    $user = $checkUserLogin->fetch();
    $_SESSION["user"] = $user;
}
function replaceData($conn, $dataARemplacer, $col, $id){

    $userName = $col;
    $replaceData = $conn->prepare("UPDATE utilisateur SET $userName = :dataARemplacer WHERE userID = :id");
    $replaceData->bindParam(':dataARemplacer', $dataARemplacer);
    $replaceData->bindParam(':id', $id);
    $replaceData->execute();

}

function getCatAge($conn)
{
    $age = $conn->prepare('SELECT * from categorie');
    $age->execute();

    $catAge = $age->fetchAll();
    return $catAge;
}

function getTypeEpreuve($conn)
{
    $typeEpreuve = $conn->prepare('SELECT * from type_epreuve');
    $typeEpreuve->execute();

    $epreuve = $typeEpreuve->fetchAll();
    return $epreuve;
}
function getClub($conn)
{
    $club = $conn->prepare('SELECT * from club');
    $club->execute();

    $allClub = $club->fetchAll();
    return $allClub;
}

function nouvelleInscription($conn, $certificat, $age, $typeEpreuve, $tailleMaillot, $email, $prenom)
{
    header('Content-Type: application/json');
    $rep = [];

    $Epreuve = getEpreuveFetch($conn, $typeEpreuve);
    $Coureur = getCoureur($conn, $email);
    if(!$Epreuve)
    {
            if( (!$Epreuve ))
            {
                $rep['status'] = 'epreuve';
                
            }
    }
    else
    {
        $certificat = convertToBool($certificat, "Oui", "Non");
        $IDCoureur = $Coureur["0"]["co_id"];
        $IDEpreuve = $Epreuve["0"]["ep_id"];
        $dossard = 33;
        $reg_id = 2;
        $insID = addInscrire($conn, $dossard, $tailleMaillot, $certificat, $IDEpreuve, $reg_id, $IDCoureur, $age);
        $rep['status'] = 'ok';
        $rep["data"]["userDossard"] = $dossard;
        $rep["data"]["prenom"] = $prenom;
        $rep["data"]["dossard"] = $dossard;
        $rep["data"]["epreuveDate"] = $Epreuve["0"]["ep_date"];
        $rep["data"]["epreuveLieu"] = $Epreuve["0"]["ep_lieu"];
        $rep["data"]["epreuveNom"] = $Epreuve["0"]["ep_nom"];
        $rep["data"]["insID"] = $insID;
        
    }
    
    
    return json_encode($rep);
    


    
}

function getEpreuveEmail($conn, $email)
{
    $coId = $getIDEmail($conn, email);
    if(!$co_id)
    {
        return "Pas de coureur";
    }
}
function convertToBool($value, $yes, $no)
{
    if ($value == $no)
    {
        $value = 0;
    }
    elseif ($value == $yes)
    {
        $value = 1;
    }
    return $value;
}
function getEpreuve($conn, $typeID)
{
    $getID = $conn->prepare('SELECT ep_id from epreuve WHERE typep_id = :typeID');
    $getID->bindParam(':typeID', $typeID);
    $getID->execute();
    $ID = $getID->fetchAll();
    return $ID;
}
function getEpreuveFetch($conn, $ep_id)
{
    $getEP = $conn ->prepare('SELECT * from epreuve where ep_id = :ep_id');
    $getEP ->bindParam(':ep_id', $ep_id);
    $getEP ->execute();
    $ep = $getEP->fetchAll();
    return $ep;
}
function getCoureur($conn, $email)
{
    $getCOUREUR = $conn->prepare('SELECT * from coureur WHERE co_email = :email');
    $getCOUREUR->bindParam(':email', $email);
    $getCOUREUR->execute();
    $COUREUR = $getCOUREUR->fetchAll();
    return $COUREUR;
}

function addInscrire($conn, $dossard, $tailleMaillot, $certificat, $ep_id, $reg_id, $co_id, $cat_id)
{
    $ins_date = date("Y-m-d H:i:s");
    $addInscrire = $conn->prepare('INSERT INTO inscrire(ins_date, ins_dossard, ins_taillemaillot, ins_certif, fk_ep_id, fk_reg_id, fk_co_id, fk_cat_id) VALUES (:ins_date, :ins_dossard, :ins_taillemaillot, :ins_certif, :ep_id, :reg_id, :co_id, :cat_id)');
    $addInscrire->bindParam(':ep_id', $ep_id);
    $addInscrire->bindParam(':reg_id', $reg_id);
    $addInscrire->bindParam(':co_id', $co_id);
    $addInscrire->bindParam(':cat_id', $cat_id);
    $addInscrire->bindParam(':ins_date', $ins_date);
    $addInscrire->bindParam(':ins_dossard', $dossard);
    $addInscrire->bindParam(':ins_taillemaillot', $tailleMaillot);
    $addInscrire->bindParam(':ins_certif', $certificat);
    $addInscrire->execute();

    $getIDInscrire = $conn->prepare('SELECT ins_id FROM `webcourse`.`inscrire` WHERE (fk_co_id = :co_id AND fk_ep_id = :ep_id AND fk_cat_id = :cat_id) ORDER BY `fk_co_id` ASC, `ins_id` DESC LIMIT 1000');
    $getIDInscrire->bindParam(':ep_id', $ep_id);
    $getIDInscrire->bindParam(':co_id', $co_id);
    $getIDInscrire->bindParam(':cat_id', $cat_id);
    $getIDInscrire->execute();
    $getID = $getIDInscrire->fetch();

    return $getID["0"];
 
}

function checkCoureurExists($conn, $email)
{
    $checkCoureur = $conn->prepare("SELECT * FROM coureur WHERE co_email = :username");
    $checkCoureur->bindParam(':username', $email);
    $checkCoureur->execute();

    return $checkCoureur->fetchColumn();
}

function checkLicenceExists($conn, $nlicence)
{
    $checkLicence = $conn->prepare("SELECT * FROM coureur WHERE co_numlicence = :nlicence");
    $checkLicence->bindParam(':nlicence', $nlicence);
    $checkLicence->execute();

    return $checkLicence->fetchColumn();
}

function addCoureur($conn, $email, $tel, $sexe, $datenais, $adresse, $prenom, $nom, $nationalite, $nlicence)
{
    $code = "A";
    $addCoureur = $conn->prepare("INSERT INTO coureur(co_nom, co_prenom,co_adresse, co_datenais,co_sexe, co_tel, co_email, co_nationalite, co_numlicence, code_niveau)  VALUES (:nom,:prenom,:adresse,:datenais,:sexe, :tel, :email, :nationalite, :nlicence, :code)");
    $addCoureur->bindParam(':email', $email);
    $addCoureur->bindParam(':nom', $nom);
    $addCoureur->bindParam(':prenom', $prenom);
    $addCoureur->bindParam(':adresse', $adresse);
    $addCoureur->bindParam(':datenais', $datenais);
    $addCoureur->bindParam(':sexe', $sexe);
    $addCoureur->bindParam(':tel', $tel);
    $addCoureur->bindParam(':code', $code);
    $addCoureur->bindParam(':nationalite', $nationalite);
    $addCoureur->bindParam(':nlicence', $nlicence);
    $addCoureur->execute();
}
function addCoureurPro($conn, $email, $tel, $sexe, $datenais, $adresse, $prenom, $nom, $nationalite, $deb_carriere, $fin_carriere, $classement, $nlicence)
{
    $code = "P";
    $addCoureur = $conn->prepare("INSERT INTO coureur(co_nom, co_prenom,co_adresse, co_datenais,co_sexe, co_tel, co_email, co_nationalite, co_numlicence, code_niveau, date_deb_carriere, date_fin_carriere, classement_meilleur)  VALUES (:nom,:prenom,:adresse,:datenais,:sexe, :tel, :email, :nationalite, :nlicence, :code, :deb_carriere, :fin_carriere, :classement)");
    $addCoureur->bindParam(':email', $email);
    $addCoureur->bindParam(':nom', $nom);
    $addCoureur->bindParam(':prenom', $prenom);
    $addCoureur->bindParam(':adresse', $adresse);
    $addCoureur->bindParam(':datenais', $datenais);
    $addCoureur->bindParam(':sexe', $sexe);
    $addCoureur->bindParam(':tel', $tel);
    $addCoureur->bindParam(':nationalite', $nationalite);
    $addCoureur->bindParam(':nlicence', $nlicence);
    $addCoureur->bindParam(':deb_carriere', $deb_carriere);
    $addCoureur->bindParam(':fin_carriere', $fin_carriere);
    $addCoureur->bindParam(':classement', $classement);
    $addCoureur->bindParam(':code', $code);
    $addCoureur->execute();
}





