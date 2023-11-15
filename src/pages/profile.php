<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>

<body>
<header>
    <div id="top">
        <img src="../resources/logo.png" alt="logo de la plateforme" id="image1">
        <h1>Ticket App</h1>
        <img src="../resources/logo_UVSQ.png" alt="logo de l'UVSQ" id="image2">
    </div>
    <nav>
        <div id="nav1">
            <a href="index.php">Accueil</a>
            <a href="dashboard.php">Tableau de bord</a>
        </div>
        <div id="nav2">
            <a href="profile.php">Profil</a>
            <a href="connection.php">Se connecter</a>
            <a href="index.php">Déconnexion</a>
        </div>
    </nav>
</header>

<main>
    <div id="profile">
        <div id="profile_part1">
            <div id="img_info">
                <div id="information">
                        <img src="../resources/temp_user_icon.png" alt="icone d'utilisateur" style="height: 300px; width: 300px">
                    <div id="info_perso">
                        <p>Nom</p>
                        <p>Prénom</p>
                        <p>Login</p>
                    </div>
                </div>
                <button style="min-width: 60%" id="account_sup">Supprimer le compte</button>
            </div>
        </div>
        <form class="user_info" action="" method="get">
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
                <input class="submit_buttons" type="submit" value="Changer le mot de passe"  style="min-width: 250px">
            </div>
        </form>
    </div>
</main>
<?php
    include "footer.php";
?>
</body>
</html>
