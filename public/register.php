<?php

// PAGE register.PHP //
$nav = "none";$footer = "none";
$title = "Inscription - WebCourse"; // Titre de la page concern //
include ('app/header.php'); // Le header, la navbar et le debut de la session + title //
if (isset($_SESSION['auth']))
{
    header('location:myAccount.php');
}
// <body> //?>

<section class="s6 container">
    <div class="form">
        <form action="/app/register_exec.php" id="myForm">
            <div class="titre">
                <h1>
                    Créer un compte facilement.
                </h1>
            </div>
            <div class="item trio">
                <div class="item">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" placeholder="Entrez votre nom.">
                </div>
                <div class="item">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" id="prenom" placeholder="Entrez votre prénom.">
                </div>
                <div class="item">
                    <label for="sexe">Sexe</label>
                    <select name="sexe" id="sexe">
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                    </select>
                </div>
            </div>
            <div class="item duo petit">
                <div class="item">
                    <label for="adresse">Adresse postale</label>
                    <input type="text" name="adresse" id="adresse" placeholder="Entrez votre adresse.">
                </div>
                
                
                <div class="item">
                    <label for="dnaissance">Date naissance</label>
                    <input type="date" name="dnaissance" id="dnaissance" placeholder="Entrez votre date de naissance.">
                </div>
            </div>
            <div class="item duo">
                <div class="item">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" id="email" placeholder="Entrez votre adresse email.">
                </div>
                <div class="item">
                    <label for="tel">Numéro de téléphone</label>
                    <input type="tel" name="tel" id="tel" placeholder="Entrez votre numéro.">
                </div>
            </div>
            <div class="item">
                <label for="password">Nouveau mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe.">
            </div>
            <div style="line-height: 1.4; margin-top: 10px;">
                <label for="ml" >J'accepte que mes données soit utilisés <br>dans le cadre de la <a href="/politique-confidentialite.php">politique de confidentialité</a> <br>et des <a href="/mentions-legales.php">mention légales</a>.</label>
                <input type="hidden" value="0" name="checkConsentement" id="checkConsentementHidden">
                <input type="checkbox" id="checkConsentement" name="checkConsentement" value="1">
            </div>
            <div id="messageStatus" class="none messageStatus"></div>
            <div class="item button">
                <a href=""><input type="submit" name="submit" id="submit" value="S'inscrire" > </a>
            </div>
            
        </form>
    </div>
</section>

<script>
    register();
    if(document.getElementById("checkConsentement").checked) {
    document.getElementById('checkConsentementHidden').disabled = true;
}
</script>
<?php
// </body> //
include ('app/footer.php');
?>
