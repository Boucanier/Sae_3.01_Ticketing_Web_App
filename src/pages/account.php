<?php
    $user = "ticket_app";
    $passwd = "ticket_s301";
    $db = "ticket_app";
    $host = "localhost";

    if (isset($_GET['create_acc'])){
        $mysqli = new mysqli($host, $user, $passwd, $db);

        if (isset($_GET['login'], $_GET['f_name'], $_GET['name'], $_GET['pwd'], $_GET['conf_pwd'])){
            $login = $_GET['login'];
            $f_name = $_GET['f_name'];
            $l_name = $_GET['name'];
            $pwd = $_GET['pwd'];
            $conf_pwd = $_GET['conf_pwd'];

            if ($login != '' && $f_name != '' && $l_name != '' && $pwd != '' && $conf_pwd != ''){
                $pwd = sha1($_GET['pwd']);
                $conf_pwd = sha1($_GET['conf_pwd']);

                if (!($pwd == $conf_pwd)){
                    header('Location: connection.php?error=2');
                }
    
                $stmt = $mysqli->prepare("INSERT INTO Users(login, first_name, last_name, password, role) VALUES (?, ?, ?, ?, 'user')");
                $stmt->bind_param("ssss", $login, $f_name, $l_name, $pwd);
                $stmt->execute();
    
                $mysqli->close();

                session_start();
                        
                $_SESSION['login'] = $login;
                $_SESSION['role'] = 'user';
                $_SESSION['date'] = date('F j, Y, g:i a');
    
                header("Location: dashboard.php");
            }

            else {
                header('Location: connection.php?error=1');
            }
        }
        
        else {
            header('Location: connection.php');
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
                    header('Location: connection.php?error=12');
                }

                else if ($taille > 1){
                    header('Location: connection.php?error=13');
                }

                else {
                    $stmt = $mysqli->prepare("SELECT password FROM Users WHERE login = ?");
                    $stmt->bind_param("s", $login);
                    $stmt->execute();

                    $get_pwd = $stmt->get_result()->fetch_row()[0];

                    if ($pwd == $get_pwd){
                        $stmt = $mysqli->prepare("SELECT role FROM Users WHERE login = ?");
                        $stmt->bind_param("s", $login);
                        $stmt->execute();

                        $role = $stmt->get_result()->fetch_row()[0];
                
                        $stmt = $mysqli->prepare("INSERT INTO Connections(login, ip_address, password, succes, date_co) VALUES (?, ?, ?, 1, ?)");
                        $stmt->bind_param("ssss", $login, $ip_address, $pwd, $date);
                        $stmt->execute();

                        $mysqli->close();
                        
                        session_start();
                        
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

                        header('Location: connection.php?error=14');
                    }
                }
            }

            else {
                header('Location: connection.php?error=11');
            }
        }

        else {
            header('Location: connection.php');
        }
    }

    else if (isset($_GET['update_acc'])){
        session_start();
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
                header('Location: profile.php?error=12');
            }

            else if ($taille > 1){
                header('Location: profile.php?error=13');
            }

            else {

                if ($pwd == $get_pwd){
                    $new_pwd = sha1($new_pwd);
                    $stmt = $mysqli->prepare("UPDATE Users SET password = ? WHERE login = ?");
                    $stmt->bind_param("ss", $new_pwd, $_SESSION['login']);
                    $stmt->execute();
                    $mysqli->close();
                    header('Location: profile.php?success=1');

                    mysqli_close($mysqli);
                }

                else {
                    header('Location: profile.php?error=2');
                }
            }
        }
        
        else {
            header('Location: profile.php?error=1');
        }
    }

    else if (isset($_GET['sup_acc']) && $_GET['sup_acc'] == true){
        session_start();
        if (isset($_SESSION['login'])){
            $mysqli = new mysqli($host, $user, $passwd, $db);

            $stmt = $mysqli->prepare("SELECT last_name, first_name FROM Users WHERE login = ?");
            $stmt->bind_param("s", $_SESSION['login']);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_row();

            $stmt->close();

            $last_name = md5($result[0]);
            $first_name = md5($result[1]);
            $login = 'rmv-'.md5($_SESSION['login']);

            $stmt = $mysqli->prepare("UPDATE Users Usr SET Usr.last_name = ?, Usr.first_name = ?, Usr.login = ? WHERE Usr.login = ?");
            $stmt->bind_param("ssss", $last_name, $first_name, $login, $_SESSION['login']);
            $stmt->execute();
            $stmt->close();

            $mysqli->close();
            header('Location: out.php');
        }
    }

    else header('Location: index.php?error=0');
?>