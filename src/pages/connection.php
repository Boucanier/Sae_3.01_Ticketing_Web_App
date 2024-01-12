<?php
    $tab = array('fr' => 'Connexion', 'en' => 'Connection');
    
    include "header.php";
    if (isset($_SESSION['login'])){
        header('Location: dashboard.php');
    }

echo '<main>
    <div class="form_containers">
        <div class="sign_up">';
        
                $infoTop = array('fr' => '<h2>Créer un compte</h2>', 'en' => '<h2>Create an account</h2>');
                echo '<h2>'.$infoTop[$lang].'</h2>';

                $error_fr = array('Login invalide', 'Les mots de passe ne correspondent pas', 'Formulaire incomplet', 'Le captcha n\'est pas valide !', 'Erreurs d\'identifiants', 'Champ(s) trop long(s)');
                $error_en = array('Invalid login', 'Passwords do not match', 'Incomplete form', 'Invalid captcha !', 'Invalid credentials', 'Field(s) too long');
                $error = array('fr' => $error_fr, 'en' => $error_en);

                if (isset($_GET['error'])){
                    switch ($_GET['error']){
                        case 11:
                            echo '<div class="error"><p>'.$error[$lang][0].'</p></div>';
                            break;
                        case 12:
                            echo '<div class="error"><p>'.$error[$lang][1].'</p></div>';
                            break;
                        case 13:
                            echo '<div class="error"><p>'.$error[$lang][2].'</p></div>';
                            break;
                        case 15:
                            echo '<div class="error"><p>'.$error[$lang][5].'</p></div>';
                            break;
                    }
                }

            $formValue_fr = array('Login', 'Nom', 'Prénom', 'Mot de passe', 'Confirmer le mot de passe', 'Effacer', 'Créer', 'Se&nbsp;connecter', 'J\'ai oublié mon mot de passe');
            $formValue_en = array('Login', 'Name', 'First name', 'Password', 'Confirm password', 'Reset', 'Create', 'Sign&nbsp;in', 'I forgot my password');
            $formValue = array('fr' => $formValue_fr, 'en' => $formValue_en);

            $placeholder_fr = array('40&nbsp;caractères&nbsp;max,&nbsp;sans&nbsp;espace', '40&nbsp;caractères&nbsp;max', '40&nbsp;caractères&nbsp;max', '32&nbsp;caractères&nbsp;max', 'Confirmez&nbsp;votre&nbsp;mot&nbsp;de&nbsp;passe');
            $placeholder_en = array('Max&nbsp;40&nbsp;characters,&nbsp;no&nbsp;space', 'Max&nbsp;40&nbsp;characters', 'Max&nbsp;40&nbsp;characters', 'Max&nbsp;32&nbsp;characters', 'Confirm&nbsp;your&nbsp;password');
            $placeholder = array('fr' => $placeholder_fr, 'en' => $placeholder_en);
            
            echo '<form action="account.php" method="post">
                <div class="user_info">
                    <div class="form_group">
                        <label for="login">'.$formValue[$lang][0].'&nbsp;:</label>
                        <input type="text" id="login" name="login" placeholder='.$placeholder[$lang][0].'>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="name">'.$formValue[$lang][1].'&nbsp;:</label>
                        <input type="text" id="name" name="name" placeholder='.$placeholder[$lang][1].'>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="f_name">'.$formValue[$lang][2].'&nbsp;:</label>
                        <input type="text" id="f_name" name="f_name" placeholder='.$placeholder[$lang][2].'>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="pwd">'.$formValue[$lang][3].'&nbsp;:</label>
                        <input type="password" id="pwd" name="pwd" placeholder='.$placeholder[$lang][3].'>
                    </div>
                    <input type="hidden" name="role" value="user"/>
                    <br>
                    <div class="form_group">
                        <label for="conf_pwd">'.$formValue[$lang][4].'&nbsp;:</label>
                        <input type="password" id="conf_pwd" name="conf_pwd" placeholder='.$placeholder[$lang][4].'>
                    </div>
                    <br>
                </div>';
                    $nb1 = rand(1, 5);
                    $nb2 = rand(1, 5);
                    $reponse_attendue = $nb1 + $nb2;

                echo '<div class="captcha_group">
                    <label for="captcha">'.$nb1.' + '.$nb2.'&nbsp;=&nbsp;</label>
                    <input type="number" id="captcha" name="captcha"/>';
                    if (isset($_GET['error'])){
                        if ($_GET['error'] == "14"){
                            echo '<pre>'.$error[$lang][3].'</pre>';
                        }
                    }
                echo '
                    <input type="hidden" name="reponse_attendue" value="'.$reponse_attendue.'"/>
                </div>
                <br>
                <div class="resetSubmitButtons">
                    <input type="reset" value='.$formValue[$lang][5].' class="reset_buttons">
                    <input type="submit" value='.$formValue[$lang][6].' class="submit_buttons" name="create_acc">
                </div>
            </form>
        </div>

        <div class="log_in">';
                if (isset($_GET['error'])){
                    switch ($_GET['error']){
                        case 21:
                            echo '<div class="error"><p>'.$error[$lang][4].'</p></div>';
                            break;
                        case 23:
                            echo '<div class="error"><p>'.$error[$lang][2].'</p></div>';
                            break;
                    }
                }
            echo '<form action="account.php" method="post">
                <div class="form_group2">
                    <label for="login_connect">'.$formValue[$lang][0].'&nbsp;:</label>
                    <input type="text" id="login_connect" name="login_connect" placeholder='.$placeholder[$lang][0].'>
                </div>
                <br>
                <div class="form_group2">
                    <label for="pwd_connect">'.$formValue[$lang][3].'&nbsp;:</label>
                    <input type="password" id="pwd_connect" name="pwd_connect" placeholder='.$placeholder[$lang][1].'>
                    <a href="construction.php">'.$formValue[$lang][8].'</a>
                </div>
                <br>
                <div class="resetSubmitButtons">
                    <input type="reset" value='.$formValue[$lang][5].' class="reset_buttons">
                    <input type="submit" value='.$formValue[$lang][7].' class="submit_buttons" name="log_acc">
                </div>
            </form>
        </div>
    </div>
</main>';
    include "footer.php";
?>
</body>
</html>
