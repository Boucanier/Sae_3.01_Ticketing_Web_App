<?php
    if (isset($_GET['create_acc'])){
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
    
                $user = "ticket_app";
                $passwd = "ticket_s301";
                $db = "ticket_app";
                $host = "localhost";
    
                $connection = mysqli_connect($host,$user,$passwd) or die ("erreur");
    
                $db = mysqli_select_db($connection,$db) or die ("erreur");
    
                $requete = "INSERT INTO Users VALUES('$login','$f_name','$l_name','$pwd','user')";
    
                mysqli_query($connection,$requete) or die ("erreur");
                
                mysqli_close($connection);
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
        if (isset($_GET['login_connect'], $_GET['pwd_connect'])){
            $login = $_GET['login_connect'];
            $pwd = $_GET['pwd_connect'];
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $date = date('Y-m-d H:i:s');

            if ($login != '' && $pwd != ''){
                $pwd = sha1($pwd);
    
                $user = "ticket_app";
                $passwd = "ticket_s301";
                $db = "ticket_app";
                $host = "localhost";
    
                $connection = mysqli_connect($host,$user,$passwd) or die ("erreur");
    
                $db = mysqli_select_db($connection,$db) or die ("erreur");

                $requete = "SELECT COUNT(*) FROM Users WHERE login='$login'";
                $taille = mysqli_fetch_row(mysqli_query($connection,$requete))[0];

                if ($taille == 0){
                    header('Location: connection.php?error=12');
                }

                else if ($taille > 1){
                    header('Location: connection.php?error=13');
                }

                else {
                    $requete = "SELECT password FROM Users WHERE login = '$login'";
                    $get_pwd = mysqli_fetch_row(mysqli_query($connection,$requete))[0];

                    if ($pwd == $get_pwd){
                        $requete = "SELECT role FROM Users WHERE login = '$login'";
                        $role = mysqli_fetch_row(mysqli_query($connection,$requete))[0];

                        $requete = "INSERT INTO Connections(login, ip_address, password, succes, date_co) VALUES('$login', '$ip_address', '$pwd', 1, '$date')";
                        mysqli_query($connection,$requete) or die ("erreur");
                        
                        mysqli_close($connection);
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
                        $requete = "INSERT INTO Connections(login, ip_address, password, succes, date_co) VALUES('$login', '$ip_address', '$pwd', 0, '$date')";
                        mysqli_query($connection,$requete) or die ("erreur");

                        mysqli_close($connection);
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
    else header('Location: connection.php?error=0');
?>