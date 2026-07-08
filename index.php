<!--Index-->

<!DOCTYPE html>
<html lang="fr">
    <!-- Inclusion du head pour definir les metadonnes et certaines informations lies a la page-->
    <?php include "./includes/head.php"?>
    <body>
        <!-- Header -->
        <?php include "./includes/header.php"?>
        <!-- Main -->
        <main>
            <!-- Section Hero pour attirer l'attentio de l'utilisateur-->
            <section id="hero">
                <h1><b>Le Comptoir – boissons & cuisine artisanale</b></h1>
                <p>Le plaisir de boire et de partager</p>
                <a href="./menu.php">Commander maintenant</a>
            </section>
            <!-- Section presentation pour presenter le restaurant ses qualites et ses points forts-->
            <section id="presentation">
                <div class="quality">
                    <div>
                    <h2>À propos de nous</h2>
                    <hr>
                    <div class="pre-p">
                    <img src="./public/images/12.jpeg" alt="Meal">
                    <p>Le Comptoir est un lieu convivial où l’on se retrouve pour savourer des boissons uniques et une cuisine simple mais généreuse, préparée avec passion.</p>
                    <img src="./public/images/12.jpeg" alt="Meal">
                    <p>Nous mettons en avant la qualité, le goût et le partage. Chaque visite est pensée comme une expérience chaleureuse et authentique.</p>
                    </div>
                </div>
            </div>
            </section>
            <!-- Section a la une (Differents repas apprecies ou a la carte du menu du jour)-->
            <section id="section-une">
                <h2>À la une</h2>
                <hr>
                <div>
               <!-- Definition de chaque repas de la carte du jour-->
                <article class="a-la-une">
                    <h2>Bœuf rôti aux herbes et sauce maison</h2>
                    <p>Un plat savoureux, tendre et parfaitement assaisonné.</p>
                    <img src="./public/images/16.jpeg" alt="Plat a la une">
                    <a href="./menu.php">Commander</a>
                </article>
                <!-- Definition de chaque repas de la carte du jour-->
                <article class="a-la-une">
                    <h2>Poulet grillé façon Comptoir avec épices douces</h2>
                    <p>Une recette croustillante et pleine de saveurs.</p>
                    <img src="./public/images/16.jpeg" alt="Plat a la une">
                    <a href="./menu.php">Commander</a>
                </article>
                <!-- Definition de chaque repas de la carte du jour-->
                <article class="a-la-une">
                    <h2>Assiette mixte signature du chef</h2>
                    <p>Un mélange gourmand pour les vrais amateurs de bonne cuisine.</p>
                    <img src="./public/images/16.jpeg" alt="Plat a la une">
                    <a href="./menu.php">Commander</a>
                </article>
            </div>
            </section>
        </main>
        <!-- Footer -->
        <?php include "./includes/footer.php"?>
    </body>
</html>
