<?php
session_start();
require_once ('connect.php');
require_once ('function.php');

//

$username = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);
$nom = htmlspecialchars($_POST["nom"]);
$prenom = htmlspecialchars($_POST["prenom"]);
$adresse = htmlspecialchars($_POST["adresse"]);
$dnaissance = htmlspecialchars($_POST["dnaissance"]);
$tel = htmlspecialchars($_POST["tel"]);
$sexe = htmlspecialchars($_POST["sexe"]);
$consentement = $_POST["checkConsentement"];



if ($consentement == 1 && $password && $username && $nom && $prenom && $adresse && $dnaissance && $tel && $sexe){
    echo createUser($conn,$username, $password, $nom, $prenom, $adresse, $dnaissance, $tel, $sexe, $consentement);
}

else{
    if (!$nom || !$prenom || !$username || !$sexe || !$tel || !$dnaissance || !$adresse || !$consentement == 0){
        $rep['status'] = "Empty";
        echo json_encode($rep);
    }   
    elseif (!$password){
        $rep['status'] = "Password";
        echo json_encode($rep);
    }
    
}


