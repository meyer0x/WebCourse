<?php
session_start();
require_once('connect.php'); // L'endroit pour se connecter à la BDD
require_once('function.php'); // Le fichier ou il y'a toute mes fonctions

if (isset($_POST["submit"]))
{
    $IDClub = $_POST["listeClub"];
    
    if($IDClub)
    {
        header('location:/clubs.php?club='.$IDClub.'');
    }
    else{
        header('location:/clubs.php?club=none');
    }
}