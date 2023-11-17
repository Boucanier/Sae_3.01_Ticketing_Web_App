<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion techniciens</title>
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
        <div class="tech_view">
            <h2>Liste des techniciens</h2>
            <div id="scroll_table">
                <table id="tech_table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Tickets en cours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Zanzibare</td>
                            <td>Jean</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>Zanzibare</td>
                            <td>Jean</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>Madagascar</td>
                            <td>Rémi</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Martinique</td>
                            <td>Roger</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>Zanzibare</td>
                            <td>Julien</td>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="sign_up">
            <h2>Ajouter un technicien</h2>
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
                <br>
                <div class="resetSubmitButtons">
                    <input type="reset" value="Effacer" class="reset_buttons">
                    <input type="submit" value="Créer" class="submit_buttons">
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
