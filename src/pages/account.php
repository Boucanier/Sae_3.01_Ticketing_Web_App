<?php            
    session_start();

    $user = "ticket_app";
    $passwd = "ticket_s301";
    $db = "ticket_app";
    $host = "localhost";

    if (isset($_GET['create_acc'], $_GET['role']) && (($_GET['role'] == 'user' && !isset($_SESSION['role'])) || ($_GET['role'] == 'tech' && isset($_SESSION['role']) && $_SESSION['role'] == "web_admin"))){
        $mysqli = new mysqli($host, $user, $passwd, $db);
        $role = $_GET['role'];

        if ($role == "tech" || isset($_GET['captcha'])){

            if (isset($_GET['captcha'])){
                $reponse_attendue = $_GET["reponse_attendue"];
                $reponse_utilisateur = $_GET["captcha"];
            }

            if ($role == "tech" || $reponse_utilisateur == $reponse_attendue) {
                if (isset($_GET['login'], $_GET['f_name'], $_GET['name'], $_GET['pwd'], $_GET['conf_pwd'])){
                    $login = $_GET['login'];
                    $test_login = 'rmv-'.md5($login);
                    
                    $stmt = $mysqli->prepare("SELECT COUNT(*) FROM Users WHERE login = ? OR login = ?");
                    $stmt->bind_param("ss", $test_login, $login);
                    $stmt->execute();
                    $taille = $stmt->get_result()->fetch_row()[0];
                    
                    $stmt->close();
        
                    if ($taille > 0 || substr($login, 0, 4) == 'rmv-'){
                        header('Location: connection.php?error=11');
                        # Login invalide
                    }
        
                    else {
                        $f_name = $_GET['f_name'];
                        $l_name = $_GET['name'];
                        $pwd = $_GET['pwd'];
                        $conf_pwd = $_GET['conf_pwd'];
        
                        if ($login != '' && $f_name != '' && $l_name != '' && $pwd != '' && $conf_pwd != ''){
                            $pwd = sha1($_GET['pwd']);
                            $conf_pwd = sha1($_GET['conf_pwd']);
        
                            if (!($pwd == $conf_pwd)){
                                header('Location: connection.php?error=12');
                                # Mots de passe différents
                            }
                            
                            else {
                                $stmt = $mysqli->prepare("INSERT INTO Users(login, first_name, last_name, password, role) VALUES (?, ?, ?, ?, ?)");
                                $stmt->bind_param("sssss", $login, $f_name, $l_name, $pwd, $role);
                                $stmt->execute();
                                $stmt->close();
                    
                                $mysqli->close();

                                if ($role == 'user'){
                                    $_SESSION['login'] = $login;
                                    $_SESSION['role'] = 'user';
                                    $_SESSION['date'] = date('F j, Y, g:i a');

                                    header("Location: dashboard.php");
                                }

                                else {
                                    header("Location: tech.php");
                                }
                            }
                        }
        
                        else {
                            header('Location: connection.php?error=13');
                            # Champs vides
                        }
                    }
                }
                
                else {
                    #il manque des parametres dans le formulaire
                    header('Location: connection.php');
                }
            }
            else{
                # le captcha n'est pas bon
                header('Location: connection.php?error=14');
            }
        }
    }

    else if (isset($_GET['log_acc'])){
        $mysqli = new mysqli($host, $user, $passwd, $db);

        if (isset($_GET['login_connect'], $_GET['pwd_connect'])){
            $login = $_GET['login_connect'];
            $pwd = $_GET['pwd_connect'];
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $date = date('Y-m-d H:i:s');

            if ($login != '' && $pwd != ''){
                $pwd = sha1($pwd);
                
                $mysqli = new mysqli($host, $user, $passwd, $db);
                
                $stmt = $mysqli->prepare("SELECT COUNT(*) FROM Users WHERE login = ?");
                $stmt->bind_param("s", $login);
                $stmt->execute();

                $taille = $stmt->get_result()->fetch_row()[0];

                if ($taille == 0){
                    header('Location: connection.php?error=21');
                    # Erreur d'identifiants
                }

                else if ($taille > 1){
                    header('Location: connection.php?error=22');
                    # Erreur de base de données
                }

                else {
                    $stmt = $mysqli->prepare("SELECT password FROM Users WHERE login = ?");
                    $stmt->bind_param("s", $login);
                    $stmt->execute();

                    $get_pwd = $stmt->get_result()->fetch_row()[0];

                    if ($pwd == $get_pwd && !(substr($login, 0, 4) == 'rmv-')){
                        $stmt = $mysqli->prepare("SELECT role FROM Users WHERE login = ?");
                        $stmt->bind_param("s", $login);
                        $stmt->execute();

                        $role = $stmt->get_result()->fetch_row()[0];
                
                        $stmt = $mysqli->prepare("INSERT INTO Connections(login, ip_address, password, succes, date_co) VALUES (?, ?, ?, 1, ?)");
                        $stmt->bind_param("ssss", $login, $ip_address, $pwd, $date);
                        $stmt->execute();

                        $mysqli->close();
                        
                        $_SESSION['login'] = $login;
                        $_SESSION['role'] = $role;
                        $_SESSION['date'] = $date;

                        if ($role == 'sys_admin'){
                            header('Location: index.php');
                        }

                        else {
                            header('Location: dashboard.php');
                        }
                    }

                    else {
                        $stmt = $mysqli->prepare("INSERT INTO Connections(login, ip_address, password, succes, date_co) VALUES (?, ?, ?, 0, ?)");
                        $stmt->bind_param("ssss", $login, $ip_address, $pwd, $date);
                        $stmt->execute();
                        
                        $mysqli->close();

                        header('Location: connection.php?error=21');
                        # Erreur d'identifiants
                    }
                }
            }

            else {
                header('Location: connection.php?error=13');
                # Champs vides
            }
        }

        else {
            header('Location: connection.php');
            # Paramètres manquants
        }
    }

    else if (isset($_GET['update_acc'])){
        if (isset($_SESSION['login'])){
            $mysqli = new mysqli($host, $user, $passwd,$db);
            $pwd = sha1($_GET['actual_pwd']);
            $new_pwd = $_GET['new_pwd'];
            $conf_pwd = $_GET['conf_pwd'];

            if ($new_pwd == $conf_pwd){
                $stmt = $mysqli->prepare("SELECT password FROM Users WHERE login = ?");
                $stmt->bind_param("s", $_SESSION['login']);
                $stmt->execute();
                $taille = $stmt->get_result()->num_rows;
                
                $stmt->execute();
                $get_pwd = $stmt->get_result()->fetch_row()[0];

                if ($taille == 0){
                    header('Location: profile.php?error=31');
                    # Erreur d'identifiants
                }

                else if ($taille > 1){
                    header('Location: profile.php?error=32');
                    # Erreur de base de données
                }

                else {
                    if ($pwd == $get_pwd){
                        $new_pwd = sha1($new_pwd);
                        $stmt = $mysqli->prepare("UPDATE Users SET password = ? WHERE login = ?");
                        $stmt->bind_param("ss", $new_pwd, $_SESSION['login']);
                        $stmt->execute();
                        $mysqli->close();
                        header('Location: profile.php?success=1');
                        # Mot de passe modifié

                        mysqli_close($mysqli);
                    }

                    else {
                        header('Location: profile.php?error=31');
                        # Erreur d'identifiants
                    }
                }
            }
            
            else {
                header('Location: profile.php?error=33');
                # Mots de passe différents
            }
        }
    }

    else if (isset($_GET['sup_acc']) && $_GET['sup_acc'] == true){
        if (isset($_SESSION['login'])){
            $mysqli = new mysqli($host, $user, $passwd, $db);

            $stmt = $mysqli->prepare("SELECT last_name, first_name FROM Users WHERE login = ?");
            $stmt->bind_param("s", $_SESSION['login']);
            $stmt->execute();
            $stmt->bind_result($last_name, $first_name);

            $stmt->fetch();

            $stmt->close();

            $last_name = md5($last_name);
            $first_name = md5($first_name);
            $login = 'rmv-'.md5($_SESSION['login']);

            $stmt = $mysqli->prepare("UPDATE Users Usr SET Usr.last_name = ?, Usr.first_name = ?, Usr.login = ? WHERE Usr.login = ?");
            $stmt->bind_param("ssss", $last_name, $first_name, $login, $_SESSION['login']);
            $stmt->execute();
            $stmt->close();

            $mysqli->close();
            header('Location: out.php?sup_acc=true');
        }
    }

    else header('Location: index.php');
    # Paramètres manquants
?>