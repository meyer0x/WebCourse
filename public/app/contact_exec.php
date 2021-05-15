<?php
session_start();
require_once 'connect.php'; // L'endroit pour se connecter à la BDD
require_once('function.php'); // Le fichier ou il y'a toute mes fonctions


if (isset($_POST['submit'])){

    $nom = $_POST['nom'];
    $mail = $_POST['email'];
    $date = date("d-m-Y H:i:s");

    $sujet = 
            "Vous avez un nouveau message par la rubrique contact du site WebCourse.";
    $message = $_POST['msg'];


    contactFormSend($nom, $prenom, $mail, $tel, $sujet, $message, $date);
}
?>