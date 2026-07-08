<!--Menu-->
<!DOCTYPE html>
<html lang="fr">
    <!-- Inclusion du head pour definir les metadonnes et certaines informations lies a la page-->
    <?php include "./includes/head.php"?>
    <body>
        <!-- Header -->
        <?php include "./includes/header.php";
        /* Definition de la fonction afficherPrix pour afficher le prix en fonction de la devise et du nombre de chiffres apres la virgule*/
        function afficherPrix($prix = 0){
            return number_format($prix, 2, '.', ',') . " FCFA";
        };
        /*Tableau definissant les divers plats du menu*/
        $MENU = json_decode(file_get_contents("./data/menu.json"), true);
        ?>
        <!-- Main -->
        <main class="menu">
            <!-- Entete -->
            <h1>Bienvenue chez "Le Comptoir"</h1>
            <h2>Notre carte</h2>
            <!-- Affichage du menu a partir du tableau $MENU-->
            <?php 
                foreach ($MENU as $name => $menu){
                    echo '<section class="meal-section">';
                    echo '<h3>'.$name.'</h3>';
                    echo'<ul class="meal-list">';
                    for ($i = 0; $i < count($menu); $i++){
                        echo'<li class="meal">';
                        echo '<img src="'.$menu[$i]["img"].'"'.'alt="Meal">';
                        echo '<div>';
                        echo'<h4>'.$menu[$i]['name'].'</h4>';
                        echo '<span class="price">'.afficherPrix($menu[$i]['price']).'</span></div>';
                        echo '<p>'.$menu[$i]['description'].'</p>';
                        echo'<button>Commander</button>';
                        echo'</li>';
                    }
                }
            ?>
        </main>
            <!-- Footer -->
        <?php include "./includes/footer.php"?>
    </body>
</html>