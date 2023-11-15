<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
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
    <div class="form_containers">
        <div class="sign_up">
            <h2>Créer un compte</h2>
            <form action="dashboard.php" method="get">
                <div class="user_info">
                    <div class="form_group">
                        <label for="login">Login&nbsp;:</label>
                        <input type="text" id="login" name="login"/>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="name">Nom&nbsp;:</label>
                        <input type="text" id="name" name="name"/>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="f_name">Prénom&nbsp;:</label>
                        <input type="text" id="f_name" name="f_name"/>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="pwd">Mot de passe&nbsp;:</label>
                        <input type="password" id="pwd" name="pwd"/>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="conf_pwd">Confirmer le mot de passe&nbsp;:</label>
                        <input type="password" id="conf_pwd" name="conf_pwd"/>
                    </div>
                    <br>
                </div>
                <div class="captcha_group">
                    <label for="captcha">2 + 3 =</label>
                    <input type="number" id="captcha" name="captcha"/>
                </div>
                <br>
                <div class="resetSubmitButtons">
                    <input type="reset" value="Effacer" class="reset_buttons">
                    <input type="submit" value="Créer" class="submit_buttons">
                </div>
            </form>
        </div>
        <div class="log_in">
            <form action="dashboard.php" method="get">
                <div class="form_group2">
                    <label for="login_connect">Login :</label>
                    <input type="text" id="login_connect" name="login_connect"/>
                </div>
                <br>
                <div class="form_group2">
                    <label for="pwd_connect">Mot de passe :</label>
                    <input type="password" id="pwd_connect" name="pwd_connect"/>
                </div>
                <br>
                <div class="resetSubmitButtons">
                    <input type="reset" value="Effacer" class="reset_buttons">
                    <input type="submit" value="Se connecter" class="submit_buttons">
                </div>
            </form>
        </div>
    </div>
</main>
<?php
    include "footer.php";
?>
</body>
</html>