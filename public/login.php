<?php

// PAGE LOGIN.PHP //
$nav = "none";$footer = "none";
$title = "Connexion - WebCourse"; // Titre de la page concern //
include ('app/header.php'); // Le header, la navbar et le debut de la session + title //
if (isset($_SESSION['auth']))
{
    header('location:myAccount.php');
    exit();
}
// <body> //?>
<section class="s7 container">
    <div class="form">
        <div class="forms">
            <form id="myForm" action="../app/login_exec.php">
                <div class="titre">
                    <h1>
                        Connectez-vous à votre compte
                        <?php if (isset($_SESSION['register'])){
                         echo'pour la premiere fois';
                         }
                    ?>.
                    </h1>
                </div>
                <div class="item">
                    <label for="email">Adresse Email</label>
                    <input type="email" name="email" id="email" placeholder="Entrez votre adresse email." autocomplete="email">
                </div>
                <div class="item">
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe." autocomplete="current-password">
                </div>
                <p id="messageStatus" class="none"></p>
                </div>
                <div class="item button">
                    <button type="submit" id="submit" name="submit" class="btn">Se connecter</button>
                </div>

            </form>
        </div>
    </div>
</section>

<script>
    // Pour se connecter


    login();
</script>
<?php
// </body> //
include ('app/footer.php');
?>

