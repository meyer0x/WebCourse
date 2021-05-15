<?php
session_start();
require_once('connect.php'); // L'endroit pour se connecter à la BDD
require_once('function.php'); // Le fichier ou il y'a toute mes fonctions

if (isset($_POST['submit'])){

    $name = trim(htmlentities(htmlspecialchars($_POST["nom"])));

    $prenom = trim(htmlentities(htmlspecialchars($_POST["prenom"])));

    $mail = trim(htmlentities(htmlspecialchars($_POST["email"])));

    $adresse = trim(htmlentities(htmlspecialchars($_POST["adresse"])));

    $dnaissance = trim(htmlentities(htmlspecialchars($_POST["dnaissance"])));

    $sexe = trim(htmlentities(htmlspecialchars($_POST["sexe"])));

    $id = trim(htmlentities(htmlspecialchars(intval($_SESSION['user']['userID']))));

    $tel =trim(htmlentities(htmlspecialchars( $_POST["ntel"])));

    if (
        $_SESSION["user"]["userName"] == $name &&
        $_SESSION["user"]["userPrenom"] == $prenom &&
        $_SESSION["user"]["userEmail"] == $mail && 
        $_SESSION["user"]["userBirthday"] == $dnaissance &&
        $_SESSION["user"]["userGender"] == $sexe &&
        $_SESSION["user"]["userAdress"] == $adresse &&
        $_SESSION["user"]["userPhone"] == $tel
          ){
              header('location:/myAccount.php?changement=none');
          }
    else{
        if(!($_SESSION["user"]["userName"] == $name)){
            $col = trim("userName", "'");
            replaceData($conn, $name, $col, $id);
        }
        if(!($_SESSION["user"]["userPrenom"] == $prenom)){
            $col = trim("userPrenom", "'");
            replaceData($conn, $prenom, $col, $id);
        }
        if(!($_SESSION["user"]["userEmail"] == $mail)){
            $col = trim("userEmail", "'");
            replaceData($conn, $mail, $col, $id);
        }
        if(!($_SESSION["user"]["userBirthday"] == $dnaissance)){
            $col = trim("userBirthday", "'");
            replaceData($conn, $dnaissance, $col, $id);
        }
        if(!($_SESSION["user"]["userGender"] == $sexe)){
            $col = trim("userGender", "'");
            replaceData($conn, $sexe, $col, $id);
        }
        if(!($_SESSION["user"]["userAdress"] == $adresse)){
            $col = trim("userAdress", "'");
            replaceData($conn, $adresse, $col, $id);
        }
        if(!($_SESSION["user"]["userPhone"] == $tel)){
            $col = trim("userPhone", "'");
            replaceData($conn, $tel, $col, $id);
        }
        refreshSession($conn, $mail);
        header('location:/myAccount.php');
    }

    
   
    
}
