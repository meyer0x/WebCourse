<?php

// PAGE contact.PHP //

$title = "Les clubs - WebCourse"; // Titre de la page concern //
include ('app/header.php'); // Le header, la navbar et le debut de la session + title //
require('app/function.php');
require('app/connect.php');
// <body> //?>


<section class="s15 container">
    <div class="title">
        <h1>La vie des clubs</h1>
        <p>Chaque club est unique, avec les outils à disposition trouvez le votre et commencer l'aventure !</p>
    </div>
    <div class="middle">
        <form action="app/clubAction.php" method="POST">

            <select name="listeClub" id="">
                <option value="">Merci de choisir un club</option>
                <?php 
                $club = getClub($conn);
                foreach ($club as $i)
                {
                echo '
                <option value="'.($i['cl_id']).'">'.$i['cl_nom'].'</option>
                ';
                }?>
            </select>
            <input type="submit" name="submit" value="Valider" class="buttonsubmit">
            
        </form>
       
    </div>
    <div class="sectionclub">
        <?php if( isset($_GET["club"])){
            $getIDClub = $_GET["club"]-1;

            if($getIDClub >= 0 && $getIDClub <= 30)
            {
                echo '<h1>Informations de votre club.</h1>';
                echo '<h4>'.$club[$getIDClub]["cl_nom"].'</h4>';
                echo '<p>Nombre d\'adhérents de votre club : <strong>'.$club[6]["cl_numtel"].'</strong></p>';
                echo '<p>Adresse : <strong>'.$club[1]["cl_adresse"].'</strong> </p>';
            }
            
             }?>
        
        
    </div>
</section>

<?php
// </body> //
include ('app/footer.php');
?>