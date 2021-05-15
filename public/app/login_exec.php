<?php
session_start();
require_once ('connect.php'); // L'endroit pour se connecter à la BDD
require_once('function.php'); // Le fichier ou il y'a toute mes fonctions


$username = $_POST["email"];
$password = $_POST["password"];

loginUser($conn, $username, $password);
echo loginUser($conn, $username, $password);



