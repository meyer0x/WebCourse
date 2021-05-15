<?php
require 'app/function.php';
require 'app/connect.php';
// PAGE myAccount.PHP //
$nav = "none";
$footer  = "none";
$title = "Espace Personnel - WebCourse"; // Titre de la page concern //
include ('app/header.php');// Le header, la navbar et le debut de la session + title //
if(!isset($_SESSION['auth']))
{
    header('location:login.php');
}
// <body> //?>


<section class="s12 container" id="s12">
    <div class="left">
        <form action="/app/myAccount_exec.php" method="POST">
            <div class="titre">
                <h1>Bonjour, <?= $_SESSION["user"]["userPrenom"]?></h1>
            </div>
            <div class="item duo">
                <div class="item">
                    <label for="">Nom</label>
                    <input type="text" name="nom" value ="<?=$_SESSION["user"]["userName"]?>">
                </div>
                <div class="item">
                    <label for="">Prenom</label>
                    <input type="text" name="prenom" value ="<?=$_SESSION["user"]["userPrenom"]?>">
                </div>
            </div>

            <div class="item">
                    <label for="">Adresse email</label>
                    <input type="text" name="email" value ="<?=$_SESSION["user"]["userEmail"]?>">
            </div>

            <div class="item">
                    <label for="">Numéro de téléphone</label>
                    <input type="tel" name="ntel" value ='<?= $_SESSION["user"]["userPhone"]?>' pattern="[0-9]{10}" maxlength="10">
            </div>

            <div class="item duo">
                <div class="item">
                    <label for="">Date de naissance</label>
                    <input type="date" name="dnaissance" value ="<?=$_SESSION["user"]["userBirthday"]?>"  min='1930-01-01' max='2000-01-01' >
                </div>
                <div class="item">
                    <label for="">Sexe</label>
                    <?php
                    $genderofUser = $_SESSION["user"]["userGender"];
                    if(!$genderofUser)
                    {
                        echo '
                        <select name="sexe" id="sexe">
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                        </select>
                        ';
                    }
                    else{
                        echo '<input type="text" id="sexe" name="sexe" value ="'.$_SESSION["user"]["userGender"].'"readonly>';
                    }
                    ?>
                </div>
            </div>

            <div class="item">
                    <label for="">Adresse postale</label>
                    <input type="text" name ="adresse" value ="<?=$_SESSION["user"]["userAdress"]?>">
            </div>
            
            <div class="item button">
                    <input type="submit" name="submit" id="submit" value="Modifier mes informations." >
                </div>
        </form>
    </div>

</section>

<section class="s13 container">
    <div class="titre">
    <h1 class="">Visualiser ses courses et son classement.</h1>
    </div>

   <div class="wrap-table100">
   <div class="table100 ver1 m-b-110">
        <div class="table100-head">
            <table>
                <thead>
                    <tr class="row100 head">
                        <th class="cell100 column1">Nom de l'épreuve</th>
                        <th class="cell100 column2">Date</th>
                        <th class="cell100 column3">Lieu de l'épreuve</th>
                        <th class="cell100 column4">Temps annoncé</th>
                        <th class="cell100 column5">Temps effectué</th>
                </tr>
                </thead>
                </table>
                </div>
                <div class="table100-body js-pscroll ps">
                    <table>
                        <tbody>
                            <?php
                            var_dump($_SESSION["user"]);
                            $epreuve = [

                                [ "nom" => "NomDe",
                                "date" => "DateDe",
                                "lieu" => "LIEUDE",
                                "TempsA" => "TempsAno",
                                "TempsE" => "TempsEffec" ],
                                [ "nom" => "NomDDDe",
                                "date" => "DateDDDe",
                                "lieu" => "LIEUDDDE",
                                "TempsA" => "TempDDsAno",
                                "TempsE" => "TempsDEffec" ]
                            ];
                            foreach ($epreuve as $e) { 
                                echo '
                            <tr class="row100 body">
                                <td class="cell100 column1">'.$e["nom"].'</td>
                                <td class="cell100 column2">'.$e["date"].'</td>
                                <td class="cell100 column3">'.$e["lieu"].'</td>
                                <td class="cell100 column4">'.$e["TempsA"].'</td>
                                <td class="cell100 column5">'.$e["TempsE"].'</td>
                            </tr>
                                ';
                            }
                            ?>
                    
                    
                    </tbody>
                    </table>
                    </div>
                    </div>
                    </div>
</section>

<section class="s14 container" id="s14" style=''>
    <div class="message" style="text-align:center;" id="messageS" style="DISPLAY: flex;flex-direction: column;justify-content: center;/* align-items: center; */">
    
    </div>
    
    <form action="/app/createInscrire.php" method="POST" id="formEventRegister">
        <div class="titre">
            <h1>S'inscrire à un évenement.</h1>
        </div>
        <div class="item trio">
            <div class="item">
                <label for="">Inscription pour un tiers ?</label>
                <input type="checkbox" name="autre" id="checkboxtier">
            </div>
            <div class="item">
                <label for="">Professionel</label>
                <input type="checkbox" name="pro" id="checkboxpro"">
            </div>
            
        </div>
        <div class="item duo petit" id="cont">
        </div>
        <div class="item duo petit">
            <div class="item">
                <label for="">Nom</label>
                <input id ="nom" type="text" name="nom" value="<?=$_SESSION["user"]["userName"]?>" >
            </div>
            <div class="item">
                <label for="">Prenom</label>
                <input id ="prenom" type="text" name="prenom" value="<?=$_SESSION["user"]["userPrenom"]?>" >
            </div>
            <div class="item">
                <label for="">Sexe</label>
                <select name="sexe" id="sexe" readonly>
                <?php if($_SESSION["user"]["userGender"] == "Homme")
                {
                    echo '<option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>';
                } else{
                    echo '<option value="Femme">Femme</option>
                    <option value="Homme">Homme</option>';
                } ?>
                </select>
            </div>
        </div>

        <div class="item duo petit">
            <div class="item">  
                <label for="">Date de naissance </label>
                <input id ="dnaissance" type="date" name="dnaissance" value="<?=$_SESSION["user"]["userBirthday"]?>">
            </div>
            <div class="item">
                <label for="nlicence">N° de licence</label>
                <input id ="nlicence" type="text" id="nlicence" name="nlicence" placeholder="Entrez n° licence." maxlength="12">
            </div>
            <div class="item ">
                <label for="">Certificat Médical</label>
                <select name="certificat" id="certificat">
                <option [ngValue]="true">Oui</option>
                <option [ngValue]="false">Non</option>
                </select>
            </div>
        </div>
        
        <div class="item duo petit">
            <div class="item">
                <label for="">Catégorie d'âge</label>
                <select name="age" id="age">
                    <option value="">Choissisez une catégorie d'âge.</option>
                    <?php
                     
                     $age = getCatAge($conn);

                     foreach ($age as $i)
                     {
                         echo "<option value='".$i['cat_id']."'>"
                         .$i['cat_nom']." ( ".$i['cat_tranchedeb']." à ".$i['cat_tranchefin']." )".
                         "</option>";
                     }
                    ?>
                </select>
            </div>
            <div class="item">
                <label for="">Epreuve</label>
                <select name="typeEpreuve" id="typeEpreuve">
                <option value="">Choissisez un type d'épreuve.</option>
                    <?php
                     $typeEpreuve = getTypeEpreuve($conn);

                     foreach ($typeEpreuve as $i)
                     {
                         echo "<option value='".$i['typeep_id']."'>"
                         .$i['typeep_nom'].
                         "</option>";
                     }
                    ?>
                </select>
                
            </div>
            
        </div>
        <div class="item duo petit">
            <div class="item">
                <label for="">Taille du maillot</label>
                <select name="tailleMaillot" id="tailleMaillot">
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="2XL">2XL</option>
                <option value="3XL">3XL</option>

                </select>
            </div>
            <div class="item">
                <label for="">Temps annoncée</label>
                <input id ="tannonce" type="time" name="time" min="00:10" max="02:00" >
            </div>
            <div class="item">
            <label for="">Nationalité</label>
            <select name="nationalite" id="nationalite">
                <option value="FR">Français</option>
                <option value="US">Américain</option>
                <option value="ES">Espagnol</option>
                <option value="AL">Allemand</option>
                <option value="NN">Autre</option>
            </select>
            </div>
        </div>
        <div class="item duo petit" id="contpro">

        </div>
        <div class="messageStatus none" id="messageStatus" >
        </div>
        <div class="item button">
            <input type="submit" name="submit" id="submit"value="Envoyez mes informations.">
        </div>
    </form>
    
</section>


<?php
// </body> //
include ('app/footer.php');
?>

<script src="/assets/js/main.js"></script>
<script>
    eventRegister();
    const checkbox = document.getElementById("checkboxtier");
    const checkboxpro = document.getElementById("checkboxpro");
    const container = document.getElementById("cont");
    const containerpro = document.getElementById("contpro");
    const check = `<div class="item">
                    <label for="">Email</label>
                    <input type="autremail" name="mail" id="tierEmail">
                </div>
                <div class="item">
                    <label for="">Adresse</label>
                    <input type="text" name="autreadresse" value="" id="tierAdresse">
                </div>
                <div class="item">
                    <label for="">Téléphone</label>
                    <input type="tel" name="autretel" value="" id="tierTel">
                </div>`;

    const checkpro = `<div class="item">
                    <label for="">Début de carrière</label>
                    <input type="date" name="deb_carriere" id="proDC">
                </div>
                <div class="item">
                    <label for="">Fin de carrière</label>
                    <input type="date" name="fin_carriere" value="" id="proFC">
                </div>
                <div class="item">
                    <label for="">Meilleur classement</label>
                    <input type="text" name="classement" value="" id="proMC">
                </div>`;

checkbox.addEventListener('change', function(){
    if (this.checked) {
            console.log("C'est check");
            container.innerHTML = check;

    } else {
        console.log("Pas check");
        container.innerHTML = "";
    }
})

checkboxpro.addEventListener('change', function(){
    if (this.checked) {
            console.log("C'est check");
            containerpro.innerHTML = checkpro;

    } else {
        console.log("Pas check");
        containerpro.innerHTML = "";
    }
})

const s12 = document.getElementById("s12");
let s12_bg_img = s12.style.backgroundImage;
const value_sexe = document.getElementById("sexe").value;

if(value_sexe == "Homme") {
    s12.style.backgroundImage = "url('/img/espace_perso.svg')";
} else {
    s12.style.backgroundImage = "url('/img/espace_perso_f.svg')";
}
</script>