<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>

<body>
<?php
    include "header.php";
?>

<main>
    <div class="form_containers">
        <div class="sign_up">
            <h2>Créer un compte</h2>
            <?php
                if (isset($_GET['error'])){
                    switch ($_GET['error']){
                        case 11:
                            echo '<div class="error"><p>Login invalide</p></div>';
                            break;
                        case 12:
                            echo '<div class="error"><p>Les mots de passe ne correspondent pas</p></div>';
                            break;
                        case 13:
                            echo '<div class="error"><p>Formulaire incomplet</p></div>';
                            break;
                    }
                }
            ?>
            <form action="account.php" method="get">
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
                <?php
                    $nb1 = rand(1, 5);
                    $nb2 = rand(1, 5);
                    $reponse_attendue = $nb1 + $nb2;

                echo '
                <div class="captcha_group">
                    <label for="captcha">'.$nb1.' + '.$nb2.' =&nbsp;</label>
                    <input type="number" id="captcha" name="captcha"/>';
                    if (isset($_GET['error'])){
                        if ($_GET['error'] == "14"){
                            echo "<pre>Le captcha n'est \n   pas valide !</pre>";
                        }
                    }
                echo '
                    <input type="hidden" name="reponse_attendue" value="'.$reponse_attendue.'"/>
                </div>';
                ?>
                <br>
                <div class="resetSubmitButtons">
                    <input type="reset" value="Effacer" class="reset_buttons">
                    <input type="submit" value="Créer" class="submit_buttons" name="create_acc">
                </div>
            </form>
        </div>

        <div class="log_in">
            <?php
                if (isset($_GET['error']) && $_GET['error'] == 21){
                    echo '<div class="error"><p>Erreur d\'identifiants</p></div>';
                }
            ?>
            <form action="account.php" method="get">
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
                    <input type="submit" value="Se connecter" class="submit_buttons" name="log_acc">
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
