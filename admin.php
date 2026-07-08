<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <!-- Inclusion du head pour definir les metadonnes et certaines informations lies a la page-->
    <?php include "./includes/head.php";
    function correct_input($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    };
    $_SESSION["category"] = "Entrees";
    function afficherPrix($prix = 0){
        return number_format($prix, 2, '.', ',') . " FCFA";
    };
    $GLOBALS["ADMIN"] = [
        "username" => "",
        "password" => "",
    ];
    $file=file_get_contents(".env");
    $lines = explode("\n", $file);
    foreach ($lines as $line){
        if (!str_contains($line, "="))
            continue;
        [$key, $value] = explode("=", trim($line), 2);
        $GLOBALS["ADMIN"][$key] = trim($value);
    }
    if (!isset($_SESSION["_IS_ADMIN"])) {
    $_SESSION["_IS_ADMIN"] = false;
}
    $error = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["admin-username"])){
        $fields = [
            "username" => correct_input($_POST["admin-username"]),
            "password" => correct_input($_POST["admin-password"]),
        ];
        if ($_SESSION["_IS_ADMIN"] == true || ($fields["username"] === $GLOBALS["ADMIN"]["username"] && password_verify($fields["password"], $GLOBALS["ADMIN"]["password"]))){
            $_SESSION["_IS_ADMIN"] = true;
            $_SESSION["username"] = $fields["username"];
        }
        else {
            $error = "Incorrect username or password";
        }
    }
    if (isset($_POST["logout"])){
        $_SESSION = [];
        session_destroy();
    }
    $list = json_decode(file_get_contents("./data/menu.json"), true);
    ?>
    <?php if(!$_SESSION["_IS_ADMIN"]):?>
        <body class="login-body">
        <main id="login">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="admin-input">
                    <p>Formulaire d'authentification admin</p>
                    <label for="admin-username">Username: </label>
                    <input type="text" name="admin-username" id="admin-username" required/>
                </div>
                <div class="admin-input">
                    <label for="admin-password">Password: </label>
                    <input type="password" name="admin-password" id="admin-password" required/>
                </div>
                <div class="admin-input">
                    <p id="admin-error"><?php if (!empty($error)) echo $error?></p>
                    <button type="submit">Send</button>
                </div>
            </form>
        </main>
    </body>
    <?php else: ?>
        <body class="admin-body">
            <nav>
                <p>Admin panel</p>
                <form method="POST">
                    <button type="submit" name="logout">Logout</button>
                </form>
            </nav>
            <main>
                <section class="section">
                     <p></p>
                     <form method="POST" action="<?php echo htmlspecialchars_decode($_SERVER["PHP_SELF"])?>">
                     <?php foreach ($list as $name => $el):?>
                     <fieldset>
                            <legend><?= $name ?></legend>
                            <label>Name</label>
                            <input type="text" value="<?php echo $name?>"/>
                        </fieldset>
                        <fieldset>
                            <legend>Foods</legend>
                            <?php foreach ($el as $i => $elmt):?>
                                <?php $str = strtolower(str_replace(" ", "_", $name)) . $i?>
                                <fieldset id="<?= $str ?>">
                                    <legend><?= $elmt["name"] ?></legend>
                                    <label>Price</label>
                                    <input type="text" value="<?= $elmt["price"] ?>"/>
                                    <label>Name</label>
                                    <input type="text" value="<?= $elmt["name"] ?>"/>
                                    <label>Description</label>
                                    <input type="text" value="<?= $elmt["description"] ?>"/>
                                    <label>Image</label>
                                    <input type="text" value="<?= $elmt["img"] ?>"/>
                                    <input type="file" value="">
                                </fieldset>
                            <?php endforeach; ?>
                        </fieldset>
                    <?php endforeach; ?>
                    <button name="add_category">Add</button>
                     </form>
                </section>
                <section class="section">
                    <?php
                        $list = json_decode(file_get_contents("./data/menu.json"), true);
                        foreach ($list as $name => $menu){
                            echo '<section class="admin-menu">';
                            echo '<p>'.$name.'</p><br/>';
                            echo'<ul class="food-list">';
                            for ($i = 0; $i < count($menu); $i++){
                                $str = strtolower(str_replace(" ", "_", $name)) . $i;
                                echo'<li class="food">';
                                echo '<img src="'.$menu[$i]["img"].'"'.'alt="Meal">';
                                echo'<div class="food-text"><p>'.$menu[$i]['name'].'</p>';
                                echo '<span class="price">'.afficherPrix($menu[$i]['price']).'</span>';
                                echo '<p>'.$menu[$i]['description'].'</p></div>';
                                echo'<button>Delete</button><a href="#'.$str.'">Update</a></li>';
                            }
                            echo '</section>';
                        }
                    ?>
                </section>
            </main>
        </body>
    <?php endif;?>

</html>