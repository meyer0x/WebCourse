<section CLASS="footer <?php if (isset($footer)) echo $footer?>">
    <footer>
        <div class="container">
        <div class="logo">
            <a href=""><h1>WebCourse.</h1></a>
            <div class="newsletter">
              <form action="" class="newsletter">
                <input type="email" placeholder="Inscrivez-vous à la newsletter">
                <input type="button" value="Recevoir la newsletter">
              </form>
            </div>
        
        </div>

        <div class="bot">
            <div class="coder">
                <h1>Coder par Meyer.</h1>
            </div>
            <ul>
                <li class="deroulant">
                    <a href="notre-histoire.php">
                        L'association
                        <i class="fas fa-angle-down fa-1x" style="color: #0c0627;padding-left: 5px;"></i>
                    </a>
                    <ul class="submenu">
                        <li class="deroule"><a href="">Notre histoire</a></li>
                        <li class="deroule"><a href="">Calendrier evenementiel</a></li>
                    </ul>
                </li>
                <li>
                    <a href="clubs.php">Les clubs</a>
                </li>
                <li>
                    <a href="contact.php">Contact</a>
                </li>
                <li>
                    <a href="login.php">Se-connecter</a>
                </li>
                <li>
                    <a href="register.php">
                        <button class="" id="">S'inscrire</button>
                    </a>
                </li>
            </ul>
        </div>
        <div class="ml" >
            <a href="/mentions-legales.php">Mentions légales</a>
            <a href="/politique-confidentialite.php">Politique de confidentialité</a>
            <a href="/assets/pdf/Rectification Des Données.pdf" target="_blank">Rectification des données</a>
        </div>
        </div>
    </footer>
</section>

</body>
<script src="https://cdn.jsdelivr.net/gh/fcmam5/nightly.js@v1.0/dist/nightly.min.js"></script>
    <script type="text/javascript">
    // Persistence disabled
    var Nightly = new Nightly();
    document.getElementById("btnDark").addEventListener("click", function(){
        Nightly.toggle();
    });
    </script>
</html>
