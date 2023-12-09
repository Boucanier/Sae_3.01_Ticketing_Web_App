<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>

<body>
<?php
    include "header.php";
    if (!isset($_SESSION['login'])){
        header('Location: index.php');
    }
?>

<main>
    <?php
        if (isset($_GET['success'])) {
            echo '<div class="success"><p>Mot de passe changé avec succès !</p></div>';
        }
    ?>
    <div id="profile">
        <div id="profile_part1">
            <div id="img_info">
                <div id="information">
                    <img src="resources/temp_user_icon.png" alt="icone d'utilisateur" style="height: 300px; width: 300px">
                    <div id="info_perso">
                        <?php
                            $mysqli = new mysqli($host, $user, $passwd,$db);
                            $stmt = $mysqli->prepare("SELECT last_name, first_name, login FROM Users WHERE login = ?");
                            $stmt->bind_param("s", $_SESSION['login']);
                            $stmt->execute();
                            $result = $stmt->get_result()->fetch_row();
                            
                            $mysqli->close();

                            echo "<p>Nom : ".htmlentities($result[0])."</p>";
                            echo "<p>Prénom : ".htmlentities($result[1])."</p>";
                            echo "<p>Login : ".htmlentities($result[2])."</p>";
                            echo '</div></div>';

                        if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'tech')
                            echo '<button id="account_sup" onclick="location.href=\'confirmation.php?sup_acc=true\'">Supprimer le compte</button>';
                        else
                            echo '<button id="account_sup" onclick="location.href=\'confirmation.php?sup_acc=true\'" disabled>Supprimer le compte</button>';
                    ?>
            </div>
        </div>

        <form class="user_info" action="account.php" method="get">
            <?php
                if (isset($_GET['error'])){
                    switch ($_GET['error']){
                        case 31:
                            echo '<div class="error"><p>Erreur d\'identifiants</p></div>';
                            break;
                        case 33:
                            echo '<div class="error"><p>Mots de passe différents</p></div>';
                            break;
                    }
                }
            ?>
            <label for="actual_pwd">Mot de passe actuel :</label>
            <input type="password" id="actual_pwd" name="actual_pwd"/>
            <br>
            <label for="new_pwd">Nouveau mot de passe :</label>
            <input type="password" id="new_pwd" name="new_pwd"/>
            <br>
            <label for="conf_pwd">Confirmer le nouveau mot de passe :</label>
            <input type="password" id="conf_pwd" name="conf_pwd"/>
            <br>
            <div class="resetSubmitButtons">
                <input class="reset_buttons" type="reset" value="Effacer">
                <input class="submit_buttons" type="submit" value="Changer le mot de passe"  style="min-width: 250px" name="update_acc">
            </div>
        </form>
    </div>
</main>
<?php
    include "footer.php";
?>
</body>
</html>
