<?php

// PAGE contact.PHP //
$footer = "none";

$title = "Contactez-nous - WebCourse"; // Titre de la page concern //
include ('app/header.php'); // Le header, la navbar et le debut de la session + title //

// <body> //?>

<section class="s8 container">
    <div class="left">
        <h1>Un problème ?<br>Contactez-nous.</h1>
        <?php

        if(!isset($_SESSION["auth"])){
            echo (
            '<p>Psst ! Être connecté(e) facilite la demande ^^ <br> 
            Alors <a href="login.php" style="font-weight: 500">connecte toi ! </a> Pas <a href="register.php" style="font-weight: 500">inscrit ?</a> </p>');
        }else{
            echo (
            '<p>Chez WebCourse on vous répond aussi vite qu\'on cours !<br>
                Besoin d\'une réponse par rapport à un club ? Rends toi sur la page <a href="clubs.php" style="font-weight: 600">des clubs</a> et trouve ton bonheur !</p>');
        }
        ?>
    </div>
    <div class="form">
        <?php
        $name=""; $mail ="";
        if (isset($_SESSION['auth'])){
            $name = $_SESSION["user"]["userName"].' '.$_SESSION["user"]["userPrenom"];
            $mail = $_SESSION["user"]["userEmail"];
        }
        ?>
        <form action="../app/contact_exec.php" method="POST">
            <div class="item">
                <label for="nom">Nom</label>
                <input type="text" name="nom" placeholder="Entrez votre nom" value="<?=$name?>">
            </div>
            <div class="item">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Entrez votre email" value="<?=$mail?>">
            </div>
            <div class="item">
                <label for="msg">Message</label>
                <textarea name="msg" id="msg" cols="5" rows="5" placeholder="Entrez votre message"></textarea>
            </div>
            <div class="statusMessage">
            <?php if(isset($_SESSION["message"])){
                echo $_SESSION["message"];
                unset($_SESSION['message']);
            }
            ?>
            </div>
            <div class="item button">
                <input type="submit" name="submit" id="submit" value="Envoyer" >
            </div>
        </form>
    </div>
</section>


<?php
// </body> //
include ('app/footer.php');
?>
