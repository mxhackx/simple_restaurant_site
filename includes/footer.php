<!-- Footer -->
<footer>
    <?php
    /* Definition des personnes  a contacter ainsi que leurs differents contacts dans un tableau double dimensionnel*/
        $GLOBALS["CONTACTS"] = [
            0 => [
            "name" => "Lara COINCE",
            "tel" => "06 77 60 44 82",
            "email" => "laracoince@gmail.com",
            ],
            1 => [
                "name" => "Louis ZCOINCE",
                "tel" => "06 77 69 44 82",
                "email" => "louiszcoince@gmail.com",
            ]
        ];
        /* Definition de timezone a Africa/Porto-Novo pour se conformer a l'heure actuelle*/
        date_default_timezone_set("Africa/Porto-Novo");
        /*Conversion des heures d'ouverture et de fermeture en minute pour faciliter les calculs*/
        $GLOBALS["OPENING"] = 8 * 60;
        $GLOBALS["CLOSING"] = 18 * 60;
        /*Declaration et definition d'une fonction minimaliste pour determiner l'etat d'ouverture du restaurant*/
        function compute_state(){
            global $OPENING, $CLOSING;
            $time = (int)date("H") * 60 + (int)date("i");
            return $time >= $OPENING and $time <= $CLOSING;
        };
        /*Calcul de l'etat d'ouverture du restaurant et stockage dans la variable $STATE*/
        $STATE = compute_state();
    ?>
    <!-- Ajout du logo de la page pour referencer l'index / home -->
    <a href="./index.php"><img src="./public/images/header.png" alt="Le Comptoir(Logo)" width="100" height="100"></a>
    <!-- Horaires d'ouverture/fermeture et liens vers medias sociaux-->
    <div id="horaire-links">
        <p>Heures d'ouverture : <?php echo (int)($OPENING/ 60). "h00 – ". (int)($CLOSING / 60). "h00 - ".  ($STATE ? "Ouvert" : "Ferme") ?></p>
        <p><?php echo date("h:i");?></p>
        <ul id="footer-links">
            <li><a href="https://facebook.com" target="_blank" rel="noopener"><img src="./public/images/facebook.svg" alt="Facebook" width="30"></a></li>
            <li><a href="https://x.com" target="_blank" rel="noopener"><img src="./public/images/twitter.svg" alt="X (Twitter.com)" width="30"></a></li>
            <li><a href="https://instagram.com" target="_blank" rel="noopener"><img src="./public/images/instagram.svg" alt="Instagram" width="30"></a></li>
        </ul>
    </div>
    <!-- Definition des addresses, personnes a contacter et leurs differentes informations-->
    <address>
        <ul id="footer-contact">
            <li>
                <p>Contact presse</p>
                <p>Bureau de presse Pascale Venot</p>
            </li>
            <!-- Utilisation d'une boucle foreach pour parcourir le tableau CONTACTS et afficher les differents contacts-->
            <?php 
            foreach ($CONTACTS as $CONTACT){
                echo '<li>';
                echo '<p>'.$CONTACT['name'].'</p>';
                echo '<p>'.$CONTACT['tel'].'</p>';
                echo '<p>'.$CONTACT['email'].'</p>';
                echo '</li>';
            }
            ?>
        </ul>
        <!-- Mail -->
        <div id="mail-location">
            <a href="mailto:#">Mail : lecomptoir@gmail.com</a>
            <p>Bénin, Cotonou – quartier Zogbohouè</p>
        </div>
    </address>
</footer>