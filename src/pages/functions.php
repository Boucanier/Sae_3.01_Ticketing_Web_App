<?php
    session_start();

    const USER_DB = "ticket_app";
    const PASSWD_DB = "ticket_s301";
    const DB = "ticket_app";
    const HOST_DB = "localhost";

    function log_acc($login, $pwd){
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $date = date('Y-m-d H:i:s');

        if ($login != '' && $pwd != ''){
            $pwd = sha1($pwd);
            
            $mysqli = new mysqli(HOST_DB, USER_DB, PASSWD_DB, DB);
            
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
            header('Location: connection.php?error=23');
            # Champs vides
        }
    }

    function create_acc($login, $l_name, $f_name, $pwd, $conf_pwd, $reponse_attendue, $reponse_utilisateur, $role){
        $mysqli = new mysqli(HOST_DB, USER_DB, PASSWD_DB, DB);

        # On définit sur quelle page une erreur redirige en fonction du rôle
        if ($role == 'tech'){
            $error_link = 'Location: tech.php?error=';
        }
        else {
            $error_link = 'Location: connection.php?error=';
        }

        if ($reponse_utilisateur == $reponse_attendue) {
            $test_login = 'rmv-'.md5($login);
            
            $stmt = $mysqli->prepare("SELECT COUNT(*) FROM Users WHERE login = ? OR login = ?");
            $stmt->bind_param("ss", $test_login, $login);
            $stmt->execute();
            $taille = $stmt->get_result()->fetch_row()[0];
            
            $stmt->close();

            if ($taille > 0 || substr($login, 0, 4) == 'rmv-'){
                header($error_link.'11');
                # Login invalide
            }

            else {
                if ($login != '' && $f_name != '' && $l_name != '' && $pwd != '' && $conf_pwd != ''){
                    $pwd = sha1($pwd);
                    $conf_pwd = sha1($conf_pwd);

                    if (!($pwd == $conf_pwd)){
                        header($error_link.'12');
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
                    header($error_link.'13');
                    # Champs vides
                }
            }
        }

        else{
            # le captcha n'est pas bon
            header($error_link.'14');
        }
    }

    function update_acc($login, $actual_pwd, $new_pwd, $conf_pwd){
        $mysqli = new mysqli(HOST_DB, USER_DB, PASSWD_DB, DB);
        $pwd = sha1($actual_pwd);

        if ($new_pwd == $conf_pwd){
            $stmt = $mysqli->prepare("SELECT password FROM Users WHERE login = ?");
            $stmt->bind_param("s", $login);
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
                    $stmt->bind_param("ss", $new_pwd, $login);
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

    function del_acc($login){
        $mysqli = new mysqli(HOST_DB, USER_DB, PASSWD_DB, DB);

        $stmt = $mysqli->prepare("SELECT last_name, first_name FROM Users WHERE login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->bind_result($last_name, $first_name);

        $stmt->fetch();

        $stmt->close();

        $last_name = md5($last_name);
        $first_name = md5($first_name);
        $new_login = 'rmv-'.md5($login);

        $stmt = $mysqli->prepare("UPDATE Users Usr SET Usr.last_name = ?, Usr.first_name = ?, Usr.login = ? WHERE Usr.login = ?");
        $stmt->bind_param("ssss", $last_name, $first_name, $new_login, $login);
        $stmt->execute();
        $stmt->close();

        $mysqli->close();
        header('Location: out.php?sup_acc=true');
    }

    function edit_ticket($ticket_id, $newLibelle, $newEmergency, $newStatus, $newTech, $previous_libelle, $previous_emergency, $previous_status, $previous_tech){
        $mysqli = new mysqli(HOST_DB, USER_DB, PASSWD_DB, DB);

        if ($newTech != "Vide"){
            $stmt = $mysqli->prepare("SELECT login FROM Users WHERE role = 'tech'");
            $stmt->execute();
            $stmt->bind_result($techs);
            $techs = $stmt->get_result()->fetch_all();
            $stmt->close();

            $techs = array_column($techs, 0);

            if (!in_array($newTech, $techs)){
                header('Location: dashboard.php?error=4');
            }
            else if ($previous_tech == ""){
                // ajouter le technicien dans les interventions si il y en avait pas avant
                $stmt1 = $mysqli->prepare("INSERT INTO Interventions (ticket_id, tech_login) VALUES (?, ?)");
                $stmt1->bind_param("is", $ticket_id, $newTech);
                $stmt1->execute();
                $stmt1->close();
                $newStatus = "in_progress";
            }
            else {
                // update la base en en mofifiant le technicien actuel dans les interventions en le remplacant
                $stmt1 = $mysqli->prepare("UPDATE Interventions SET tech_login = ? WHERE ticket_id = ?");
                $stmt1->bind_param("si", $newTech, $ticket_id);
                $stmt1->execute();
                $stmt1->close();
                $newStatus = "in_progress";
            }
        }

        $dataToInsert = array();

        if ($newLibelle == "") $dataToInsert[] = $previous_libelle;
        else $dataToInsert[] = $newLibelle;
        
        if ($newEmergency == "") $dataToInsert[] = $previous_emergency;
        else $dataToInsert[] = $newEmergency;

        if ($newStatus == "Vide") $dataToInsert[] = $previous_status;
        else $dataToInsert[] = $newStatus;

        if (strlen($dataToInsert[0]) > 30){
            header('Location: dashboard.php?error=1');
        }
        else if ($dataToInsert[1] > 4 || $dataToInsert[1] < 0){
            header('Location: dashboard.php?error=2');
        }
        else if ($dataToInsert[2] != "open" && $dataToInsert[2] != "in_progress" && $dataToInsert[2] != "closed"){
            header('Location: dashboard.php?error=3');
        }
        else {
            // les updates nécessaires pour le ticket en question
            $stmt = $mysqli->prepare("UPDATE Tickets SET title = ?, emergency = ?, status = ? WHERE ticket_id = ?");
            $stmt->bind_param("sisi", $dataToInsert[0], $dataToInsert[1], $dataToInsert[2], $ticket_id);
            $stmt->execute();
            $stmt->close();

            $mysqli->close();
            // redirection : tout c'est bien passé
            header("Location: dashboard.php?success=3");
        }
    }

    function take_ticket($ticket_id){
        $actual_user = $_SESSION['login'];

        $mysqli = new mysqli(HOST_DB, USER_DB, PASSWD_DB, DB);

        $stmt = $mysqli->prepare("SELECT status FROM Tickets WHERE ticket_id = ?");
        $stmt->bind_param("s", $ticket_id);
        $stmt->execute();
        $stmt->bind_result($status);
        $stmt->fetch();
        $stmt->close();

        if ($status != "open"){
            // On vérifie que le ticket est bien ouvert
            $mysqli->close();
            header("Location: dashboard.php");
        }

        else {
            // ajouter le technicien (SESSION) dans les interventions avec le ticket en question
            $stmt = $mysqli->prepare("INSERT INTO Interventions (ticket_id, tech_login) VALUES (?, ?)");
            $stmt->bind_param("is", $ticket_id, $actual_user);
            $stmt->execute();
            $stmt->close();

            $mysqli->close();
            // redirection : tout c'est bien passé pour take
            header("Location: dashboard.php?success=2");
        }
    }

    function close_ticket($ticket_id){
        $actual_user = $_SESSION['login'];
        $mysqli = new mysqli(HOST_DB, USER_DB, PASSWD_DB, DB);

        $stmt = $mysqli->prepare("SELECT status FROM Tickets WHERE ticket_id = ?");
        $stmt->bind_param("s", $ticket_id);
        $stmt->execute();
        $stmt->bind_result($status);
        $stmt->fetch();
        $stmt->close();

        if ($status != "in_progress"){
            // On vérifie que le ticket est bien ouvert
            $mysqli->close();
            header("Location: dashboard.php");
        }

        else {
            $stmt = $mysqli->prepare("SELECT tech_login FROM Interventions WHERE ticket_id = ?");
            $stmt->bind_param("s", $ticket_id);
            $stmt->execute();
            $stmt->bind_result($user_tech);
            $stmt->fetch();
            $stmt->close();

            if ($user_tech != $actual_user){
                // On vérifie que le technicien qui ferme le ticket est bien celui qui l'a pris en charge
                $mysqli->close();
                header("Location: dashboard.php");
            }

            else {
                // update du status (closed)
                $stmt = $mysqli->prepare("UPDATE Tickets SET status = ? WHERE ticket_id = ?");
                $status = "closed";
                $stmt->bind_param("si", $status, $ticket_id);
                $stmt->execute();
                $stmt->close();

                $mysqli->close();
                // redirection : tout c'est bien passé pour close
                header("Location: dashboard.php?success=1");
            }
        }
    }
?>