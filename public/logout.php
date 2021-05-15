<?php

// PAGE contact.PHP //

$title = "Déconnexion - WebCourse"; // Titre de la page concern //
include ('app/header.php'); // Le header, la navbar et le debut de la session + title //

session_start();
unset($_SESSION["auth"]);
unset($_SESSION["user"]);
header("Location:index.php");

// <body> //?>




<?php
// </body> //
include ('app/footer.php');
?>