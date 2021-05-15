<?php

// PAGE notre-histoire.PHP //

$title = "Notre Histoire - WebCourse"; // Titre de la page concern //
include ('app/header.php'); // Le header, la navbar et le debut de la session + title //

// <body> //?>

<section class="s9 container">
    <div class="texte">
        <h2 class="titreh2">A propos</h2>
        <h1 class="titreh1">Un début tout à fait normal.</h1>
        <p class="titrep">Webcourse, crée par deux frères passionée par le sport est devenu le site réference dans ce domaine.</p>
    </div>
    <div class="image">
        <img src="img/img_nh.svg" alt="Photo d'un vélo">
    </div>
</section>
<section class="s10 container animatedParent ">
    <div class="image animated fadeInLeft slow">
        <img src="img/img_nh_mid.svg" alt="Photo d'un vélo">
    </div>
    <div class="texte animated fadeInRight slow">
        <h2 class="titreh2">A propos</h2>
        <h1 class="titreh1">Des courses, et épreuves dans le monde.</h1>
        <p class="titrep">Webcourse est présent dans plus de 100 villes et communes. Grâce à notre partenaire IPSUM, nous pouvons assurer chaque courses au niveau de l'assurance.</p>
    </div>
</section>
<section class="s11 container animatedParent">
    <div class="texte animated fadeInUp">
        <h2 class="titreh2">A propos</h2>
        <h1 class="titreh1">Une communauté grandissante.</h1>
        <p class="titrep">Aujourd'hui, WebCourse est la réference et permet à quiquoncque de participer à des épreuves. Que vous soyez débutant, intermediaire ou avancé, jeune ou adulte.</p>
    </div>
    <div class="image animated fadeInUp">
        <img src="img/img_nh_bot.svg" alt="Photo d'un vélo">
    </div>
</section>



<?php
// </body> //
include ('app/footer.php');
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src='../assets/js/css3-animate-it.js'></script>

