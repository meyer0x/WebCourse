<section>
    <nav class="nav container">
        <div class="logo">
            <a href="index.php"><h1>WebCourse.</h1></a>
        </div>
        <div class="<?php if (isset($nav)) echo $nav ?>">
            <ul>
                <li class="deroulant">
                    <a href="notre-histoire.php">
                        L'association
                        <i class="fas fa-angle-down fa-1x" style="color: #0c0627;padding-left: 5px;"></i>
                    </a>
                    <ul class="submenu">
                        <li class="deroule"><a href="notre-histoire.php">Notre histoire</a></li>
                        <li class="deroule"><a href="calendrier.php">Calendrier evenementiel</a></li>
                    </ul>
                </li>

                <li>
                    <a href="clubs.php">Les clubs</a>
                </li>
                <li>
                    <a href="contact.php">Contact</a>
                </li>
                <?php
                if (isset($_SESSION['auth'])){
                    echo ('
            <ul class="">
            <div class="duo">
                <li>
                    <a href="myAccount.php">'.$_SESSION["user"]["userName"].'&nbsp'.$_SESSION["user"]["userPrenom"].'</a>
                </li>
                <li class="paragraphe">
                        <a href="myAccount.php">
                            Espace Perso
                        <i class="fas fa-angle-down fa-1x" style="color: #0c0627;padding-left: 5px;"></i>
                        </a>
                        <ul class="submenu">
                            <li class="deroule"><a href="myAccount.php">Mes scores.</a></li>
                            <li class="deroule"><a href="myAccount.php#s14">S\'incrire à un évenement.</a></li>
                            <li class="deroule"><a href="logout.php">Déconnexion.</a></li>
                        </ul>
                    </li>
            </div>
            </ul>');
                }
                else{
                    echo (

                    '<li>
                    <a href="login.php">Se-connecter</a>
                </li>
                <li>
                    <a href="register.php">
                        <button class="" id="">S\'inscrire</button>
                    </a>
                </li>'
                    );
                }
                ?>
            </ul>
        </div>
    </nav>
</section>