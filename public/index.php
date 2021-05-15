<?php

// PAGE INDEX.PHP //

$title = "HomePage - Webcourse"; // Titre de la page concern //
include ('app/header.php'); // Le header, la navbar et le debut de la session + title //

// <body> //?>

<!-- Section du haut s1 gros titre-->
<section class="s1 container animatedParent">
    <div class="">
        <h1 id="textIndex"></h1>
        <a href="#s2">
        <i class="fas fa-angle-down fa-4x" style="color: #706C81; padding-top: 5vh;"></i>
        </a>
    </div>

</section>
<!-- Section du haut s2 background et a propos-->
<section class="s2 container" id="s2">
    <div class="content animatedParent data-sequence='200' animateOnce ">
        <h2 class="animated fadeIn slow ">A propos</h2>
        <h1 class="animated fadeIn slower ">Le site des courses pour amateurs et professionels !</h1>
        <p class="animated fadeIn slowest">Chez WebCourse l’effort ne s’arrête pas et chacun doit donner son maximum !<br>
            Ce site est dédié au coureurs amateurs et professionels cherchant à partciper à differentes courses au niveau national.</p>
        <a class="animated fadeIn  " href="notre-histoire.php">Notre Histoire</a>
    </div>
</section>
<!-- Section du haut s5 nos valeurs / les chiffres-->
<section class="s5 container ">
    <div class="valeur animatedParent data-sequence='300' animateOnce">
        <h2 class="animated fadeInLeftShort ">Les chiffres de l'association.</h2>
        <div class="valeur_items animated  fadeInLeftShort ">
            <div class="item animated  fadeInLeftShort ">
                <i class="fas fa-address-book fa-4x"></i>
                <div class="texte">
                    <h1>1 millions d'adhérents !</h1>
                </div>
            </div>
            <div class="item animated  fadeInLeftShort ">
                <i class="fas fa-trophy fa-4x"></i>
                <div class="texte">
                    <h1>+ de 50 championnats !</h1>
                </div>
            </div>
            <div class="item animated  fadeInLeftShort ">
                <i class="fas fa-swimmer fa-4x"></i>
                <div class="texte">
                    <h1>20 épreuves disponibles !</h1>
                </div>
            </div>
            <div class="item animated  fadeInLeftShort">
                <i class="fab fa-accessible-icon fa-4x"></i>
                <div class="texte">
                    <h1 class="dernier">Parcours accessible <br> depuis 2007.</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section du bas s3 s'inscrire se connecter-->
<section class="s3 container" ID="s5">
    <div class="item left">
        <h2>Créer un compte</h2>
        <h1>Crée un compte facilement.</h1>
        <p>Envie de vous inscrire à une course ? <br>Créer un compte personnel sur le site et accéder à votre espace personnel !</p>
        <a href="register.php">S'inscrire.</a>
    </div>
    <div class="item right">
        <h2>Se connecter</h2>
        <h1>Déjà inscrit ? <br> Connectez-vous !</h1>
        <p>Allez sur votre espace personnel vous y trouverez le bulletin d'inscription pour la participation à un évenement, vos classements  !</p>
        <a href="login.php">Se connecter.</a>
    </div>
</section>
<!-- Section du bas s4 nous contactez-->
<section class="s4 container animatedParent animateOnce">
    <div class="content animated fadeIn slowest">
        <h2>NOUS CONTACTER</h2>
        <h1>Un problème ?<br>
            Contactez-nous.</h1>
        <p>Nous tenons comptes de nos expériences sur les parcours pour répondre à vos questions !<br>
        Nous vous répondrons rapidement et sans détour.</p>
        <a href="contact.php">Nous contactez.</a>
    </div>
</section>


<?php
// </body> //
include ('app/footer.php');
?>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src='assets/js/css3-animate-it.js'></script>
<script>
    autoWriteText();
</script>
