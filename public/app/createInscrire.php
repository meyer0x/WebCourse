<?php 

session_start();
require_once('connect.php'); // L'endroit pour se connecter à la BDD
require_once('function.php'); // Le fichier ou il y'a toute mes fonctions

    $name = $_POST["nom"];

    $prenom = $_POST["prenom"];

    $dnaissance = $_POST["dnaissance"];

    $sexe = $_POST["sexe"];

    $certificat = $_POST["certificat"];

    $age = $_POST["age"];

    $typeEpreuve = $_POST["typeEpreuve"];

    $tailleMaillot = $_POST["tailleMaillot"];

    $tempsAnnonce = $_POST["time"];

    $nlicence = $_POST["nlicence"];

    $nationalite = $_POST["nationalite"];

    $date = date("Y-m-d H:i:s");

    $id = intval($_SESSION['user']['userID']);

    $userEmail = $_SESSION["user"]["userEmail"];

    $userTel = $_SESSION["user"]["userPhone"];
    
    $userSexe = $_SESSION["user"]["userGender"];

    $userAdresse = $_SESSION["user"]["userAdress"];

    $userNaissance = $_SESSION["user"]["userBirthday"];

    $userNom = $_SESSION["user"]["userName"];

    $userPrenom = $_SESSION["user"]["userPrenom"];



    if(isset($_POST['autre']) && $_POST['autre'] == "on")
    {
        
        $autreEmail = $_POST["mail"];

        $autreAdresse = $_POST["autreadresse"];

        $autreTel = $_POST["autretel"];
        if (
            (!$name) ||
            (!$prenom ) ||
            (!$dnaissance) ||
            (!$sexe) ||
            (!$certificat) ||
            (!$age) ||
            (!$typeEpreuve) ||
            (!$tailleMaillot) ||
            (!$tempsAnnonce) ||
            (!$nationalite) ||  
            (!$nlicence) ||
            (!$autreAdresse) ||
            (!$autreTel) ||
            (!$autreEmail)
            ){
                $rep['status'] = "Empty";
                echo json_encode($rep);
            }

            else{

                if(isset($_POST['pro']) && $_POST['pro'] == "on")
                 {
            
                    $pro_deb = $_POST["deb_carriere"];
                    $pro_fin = $_POST["fin_carriere"];
                    $pro_classment = $_POST["classement"];
                    if (
                        (!$name) ||
                        (!$prenom ) ||
                        (!$dnaissance) ||
                        (!$sexe) ||
                        (!$certificat) ||
                        (!$age) ||
                        (!$typeEpreuve) ||
                        (!$tailleMaillot) ||
                        (!$tempsAnnonce) ||
                        (!$nationalite) ||  
                        (!$nlicence) ||
                        (!$autreAdresse) ||
                        (!$autreTel) ||
                        (!$autreEmail) ||
                        (!$pro_classment) ||
                        (!$pro_deb) ||
                        (!$pro_fin)
                        ){
                            $rep['status'] = "Empty";
                            echo json_encode($rep);
                        } else{
                            if (!checkCoureurExists($conn, $autreEmail))
                            {
                                if(!checkLicenceExists($conn, $nlicence))
                                {
                                    addCoureurPro($conn, $autreEmail, $autreTel, $sexe, $dnaissance, $autreAdresse, $prenom, $name, $nationalite, $pro_deb, $pro_fin, $pro_classment, $nlicence);
                                    echo nouvelleInscription($conn, $certificat, $age, $typeEpreuve, $tailleMaillot, $autreEmail, $prenom);
                                
                                } else{
                                    $rep['status'] = "licence";
                                    echo json_encode($rep);
                                }
                                
                            }
                             else{
                        
                                echo nouvelleInscription($conn, $certificat, $age, $typeEpreuve, $tailleMaillot, $autreEmail, $prenom);
                                }
                            
                }
                }
            
        
            
                else{
               
                    if (!checkCoureurExists($conn, $autreEmail))
                    {
                        if(!checkLicenceExists($conn, $nlicence))
                        {
                            addCoureur($conn, $autreEmail, $autreTel, $sexe, $dnaissance, $autreAdresse, $prenom, $name, $nationalite, $nlicence);
                            echo nouvelleInscription($conn,$certificat, $age, $typeEpreuve, $tailleMaillot, $autreEmail, $prenom);

                        } else {
                            $rep['status'] = "licence";
                            echo json_encode($rep);
                        }
                        
                        
                    }

                    else{
                        echo nouvelleInscription($conn,$certificat, $age, $typeEpreuve, $tailleMaillot, $autreEmail, $prenom);
            }   
        }

        } 
    } 
    
    else {
        if(isset($_POST['pro']) && $_POST['pro'] == "on")
        {
            $pro_deb = $_POST["deb_carriere"];
            $pro_fin = $_POST["fin_carriere"];
            $pro_classment = $_POST["classement"];
            if (
                (!$name) ||
                (!$prenom ) ||
                (!$dnaissance) ||
                (!$sexe) ||
                (!$certificat) ||
                (!$age) ||
                (!$typeEpreuve) ||
                (!$tailleMaillot) ||
                (!$tempsAnnonce) ||
                (!$nationalite) ||  
                (!$nlicence) ||
                (!$pro_deb) ||
                (!$pro_classment) ||
                (!$pro_fin)
                ){
                    $rep['status'] = "Empty";
                    echo json_encode($rep);
                }

            else {
                if (!checkCoureurExists($conn, $userEmail))
                {
                    if(!checkLicenceExists($conn, $nlicence))
                    {
                        addCoureurPro($conn, $userEmail, $userTel, $sexe, $dnaissance, $userAdresse, $prenom, $name, $nationalite, $pro_deb, $pro_fin, $pro_classment, $nlicence);
                        echo nouvelleInscription($conn,$certificat, $age, $typeEpreuve, $tailleMaillot, $userEmail, $prenom);

                    } else{
                        $rep['status'] = "licence";
                        echo json_encode($rep);
                    }
                }
                else{
                    echo nouvelleInscription($conn,$certificat, $age, $typeEpreuve, $tailleMaillot, $userEmail, $prenom);
                } 
        
            }
        }
        else{
            if (
                (!$name) ||
                (!$prenom ) ||
                (!$dnaissance) ||
                (!$sexe) ||
                (!$certificat) ||
                (!$age) ||
                (!$typeEpreuve) ||
                (!$tailleMaillot) ||
                (!$tempsAnnonce) ||
                (!$nationalite) ||  
                (!$nlicence)
                ){
                    $rep['status'] = "Empty";
                    echo json_encode($rep);
                }

            else {
                if (!checkCoureurExists($conn, $userEmail))
                {
                    if(!checkLicenceExists($conn, $nlicence))
                    {
                        addCoureur($conn, $userEmail, $userTel, $sexe, $dnaissance, $userAdresse, $prenom, $name, $nationalite,$nlicence);
                        echo nouvelleInscription($conn,$certificat, $age, $typeEpreuve, $tailleMaillot, $userEmail, $prenom);
                    } else {
                        $rep['status'] = "licence";
                        echo json_encode($rep);
                    }
                }
                else{
                        echo nouvelleInscription($conn,$certificat, $age, $typeEpreuve, $tailleMaillot, $userEmail, $prenom);
                    }
                } 
        
            }
        }
    
       
