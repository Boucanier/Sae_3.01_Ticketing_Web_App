<?php
    $tab = array('fr' => 'Profil', 'en' => 'Profile');
    
    include "header.php";
    if (!isset($_SESSION['login'])){
        header('Location: index.php');
    }

    $infoTop = array('fr' => 'Mon profil', 'en' => 'My profile');

    echo '<main><div id="part_top"><h2>'.$infoTop[$lang].'</h2></div>';

    $success1 = array('fr' => 'Photo de profil modifié avec succès !', 'en' => 'Profile picture changed successfully !');
    $success2 = array('fr' => 'Mot de passe modifié avec succès !', 'en' => 'Password changed successfully !');

    $error1 = array('fr' => 'Fichier pas au bon format !', 'en' => 'File does not match with an image format !');

    if (isset($_GET['success']) == 51)
        echo '<div class="success"><p>'.$success1[$lang].'</p></div>';
    elseif (isset($_GET['error']) == 52)
        echo '<div class="error"><p>'.$error1[$lang].'</p></div>';
    elseif (isset($_GET['success']))
        echo '<div class="success"><p>'.$success2[$lang].'</p></div>';
    ?>
    <div id="profile">
        <div id="profile_part1">
            <div id="img_info">
                <div id="information">
                    <?php
                    afficher_image($_SESSION['login'], "in_profile")
                    ?>
                    <div id="info_perso">
                        <?php
                            $mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_passwd'], $GLOBALS['db_name']) or die ("Impossible de se connecter à la base de données");
                            $stmt = $mysqli->prepare("SELECT last_name, first_name, login FROM Users WHERE login = ?");
                            $stmt->bind_param("s", $_SESSION['login']);
                            $stmt->execute();
                            $result = $stmt->get_result()->fetch_row();

                            $mysqli->close();

                            $presProfile_fr = array('Nom', 'Prénom', 'Login', 'Supprimer le compte');
                            $presProfile_en = array('Last name', 'First name', 'Login', 'Delete account');
                            $presProfile = array('fr' => $presProfile_fr, 'en' => $presProfile_en);

                            echo '<p>'.$presProfile[$lang][0].' : '.htmlentities($result[0])."</p>";
                            echo '<p>'.$presProfile[$lang][1].' : '.htmlentities($result[1])."</p>";
                            echo '<p>'.$presProfile[$lang][2].' : '.htmlentities($result[2])."</p>";
                            $changer_photo_texte = array('fr' => 'Changer la photo de profil', 'en' => 'Change profile picture');
                            echo '<form id="choisir_image" action="action_image.php?login='.$result[2].'" method="post" enctype="multipart/form-data">
                                    <label for="new_image">'.$changer_photo_texte[$lang].'</label>
                                    <input type="file" name="new_image" id="new_image">
                                    <input type="submit" name="submit" value="Valider">
                                   </form>';
                            echo '</div></div>';

                        if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'tech')
                            echo '<button id="account_sup" onclick="supMyAccount()">'.$presProfile[$lang][3].'</button>';
                        else
                            echo '<button id="account_sup" onclick="supMyAccount()" disabled>'.$presProfile[$lang][3].'</button>';
                    ?>
            </div>
        </div>
        
        <form action="account.php" method="post" id="formSupAccount" type="hidden">
            <input type="hidden" name="sup_acc" value="true">
        </form>

        <form class="user_info" action="account.php" method="post">
            <?php
                $error_fr = array('Erreur d\'identifiants', 'Mots de passe différents');
                $error_en = array('Wrong credentials', 'Different passwords');
                $error = array('fr' => $error_fr, 'en' => $error_en);
                if (isset($_GET['error'])){
                    switch ($_GET['error']){
                        case 31:
                            echo '<div class="error"><p>'.$error[$lang][0].'</p></div>';
                            break;
                        case 33:
                            echo '<div class="error"><p>'.$error[$lang][1].'</p></div>';
                            break;
                    }
                }

            $updateProfile_fr = array('Mot de passe actuel', 'Nouveau mot de passe', 'Confirmer le nouveau mot de passe', 'Effacer', 'Changer&nbsp;le&nbsp;mot&nbsp;de&nbsp;passe');
            $updateProfile_en = array('Current password', 'New password', 'Confirm new password', 'Reset', 'Change&nbsp;password');
            $updateProfile = array('fr' => $updateProfile_fr, 'en' => $updateProfile_en);
            
            echo '<label for="actual_pwd">'.$updateProfile[$lang][0].' :</label>
                <input type="password" id="actual_pwd" name="actual_pwd"/>
                <br>
                <label for="new_pwd">'.$updateProfile[$lang][1].' :</label>
                <input type="password" id="new_pwd" name="new_pwd"/>
                <br>
                <label for="conf_pwd">'.$updateProfile[$lang][2].' :</label>
                <input type="password" id="conf_pwd" name="conf_pwd"/>
                <br>
                <div class="resetSubmitButtons">
                    <input class="reset_buttons" type="reset" value='.$updateProfile[$lang][3].'>
                    <input class="submit_buttons" type="submit" value='.$updateProfile[$lang][4].' style="min-width: 250px" name="update_acc">
                </div>
            </form>
        </div>
    </main>';
    include "footer.php";
?>
</body>
</html>
