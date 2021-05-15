<?php
session_start(); // Debut de la session pour tout les pages ! //
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/549364d478.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/styles/nav.css"> <!-- CSS pour le footer et la navbar -->
    <link rel="stylesheet" href="/assets/styles/style.css"> <!-- CSS main tout les pages -->
    <link rel="stylesheet" href="/assets/styles/normalize.css"> <!-- CSS NORMALIZE -->
    <link rel="stylesheet" href="/assets/styles/responsive.css">
    <link rel="stylesheet" href="/assets/styles/animations.css">
    <script src="/assets/js/main.js"></script>
    <title><?php echo $title?></title> <!-- Le titre = variable mis dans la page |||  UN TITLE POUR PAGE -->
</head>
<body>
<?php
include_once ('nav.php'); // Include la nav bar //
?>
