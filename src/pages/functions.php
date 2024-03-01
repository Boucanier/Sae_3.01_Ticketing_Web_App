<?php
    /**
     * Fichier contenant les fonctions de gestion de compte et de tickets
     * 
     * @package Fonctions
     */
    session_start();

    include_once 'db_credentials.php';
    include_once 'cypher.php';

    /**
     * Connecte un utilisateur
     * 
     * Redirige vers la page de connexion si les identifiants sont invalides
     * 
     * @param string $login Nom d'utilisateur
     * @param string $pwd Mot de passe
     * 
     * @return void
     */
    function log_acc($login, $pwd){
        // On récupère l'adresse IP de l'utilisateur
        $ip_address = $_SERVER['REMOTE_ADDR'];

        // On récupère la date de connexion
        $date = date('Y-m-d H:i:s');

        // On continue si les champs ne sont pas vides
        if ($login != '' && $pwd != ''){
            
            if (strlen($login) > 40 || strlen($pwd) > 32){
                header('Location: connection.php?error=21');
                // Champs trop longs - identifiants invalides
            }
            
            else {
                $mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_passwd'], $GLOBALS['db_name']) or die ("Impossible de se connecter à la base de données");
                
                // On compte le nombre de lignes avec le login entré
                $stmt = $mysqli->prepare("SELECT COUNT(*) FROM Users WHERE login = ?");
                $stmt->bind_param("s", $login);
                $stmt->execute();

                $taille = $stmt->get_result()->fetch_row()[0];

                // Si le login n'existe pas
                if ($taille == 0){
                    $pwd = cypher($pwd, get_key());

                    // On insère la tentative de connexion dans la base de données
                    $stmt = $mysqli->prepare("INSERT INTO Connections(login, ip_address, password, succes, date_co) VALUES (?, ?, ?, 0, ?)");
                    $stmt->bind_param("ssss", $login, $ip_address, $pwd, $date);
                    $stmt->execute();

                    $mysqli->close();
                    header('Location: connection.php?error=21');
                    // Erreur d'identifiants

                }

                // Si le login existe plusieurs fois
                else if ($taille > 1){
                    header('Location: connection.php?error=22');
                    // Erreur de base de données
                }

                // Si le login existe une seule fois
                else {
                    $stmt = $mysqli->prepare("SELECT password FROM Users WHERE login = ?");
                    $stmt->bind_param("s", $login);
                    $stmt->execute();

                    $get_pwd = $stmt->get_result()->fetch_row()[0];

                    // Si le mot de passe est correct et que le login n'est pas un login supprimé
                    if ($pwd == decypher($get_pwd, get_key()) && !(substr($login, 0, 4) == 'rmv-')){
                        $stmt = $mysqli->prepare("SELECT role FROM Users WHERE login = ?");
                        $stmt->bind_param("s", $login);
                        $stmt->execute();

                        $role = $stmt->get_result()->fetch_row()[0];
                        $pwd = cypher($pwd, get_key());
                
                        // On insère la connexion dans la base de données
                        $stmt = $mysqli->prepare("INSERT INTO Connections(login, ip_address, password, succes, date_co) VALUES (?, ?, ?, 1, ?)");
                        $stmt->bind_param("ssss", $login, $ip_address, $pwd, $date);
                        $stmt->execute();

                        $mysqli->close();
                        
                        // On crée les variables de session
                        $_SESSION['login'] = $login;
                        $_SESSION['role'] = $role;
                        $_SESSION['date'] = $date;

                        // Redirection vers la page d'accueil en fonction du rôle
                        if ($role == 'sys_admin'){
                            header('Location: index.php');
                        }

                        else {
                            header('Location: dashboard.php');
                        }
                    }

                    else {
                        // On chiffre le mot de passe
                        $pwd = cypher($pwd, get_key());

                        // On insère la tentative de connexion dans la base de données
                        $stmt = $mysqli->prepare("INSERT INTO Connections(login, ip_address, password, succes, date_co) VALUES (?, ?, ?, 0, ?)");
                        $stmt->bind_param("ssss", $login, $ip_address, $pwd, $date);
                        $stmt->execute();
                        
                        $mysqli->close();

                        header('Location: connection.php?error=21');
                        // Erreur d'identifiants
                    }
                }
            }
        }

        else {
            header('Location: connection.php?error=23');
            // Champs vides
        }
    }

    /**
     * Crée un compte dans la base de données
     * 
     * Redirige vers la page de connexion si les identifiants sont invalides
     * 
     * @param string $login Login
     * @param string $l_name Nom de famille
     * @param string $f_name Prénom
     * @param string $pwd Mot de passe
     * @param string $conf_pwd Confirmation du mot de passe
     * @param string $reponse_attendue Réponse attendue au captcha
     * @param string $reponse_utilisateur Réponse donnée par l'utilisateur
     * @param string $role Rôle du nouvel utilisateur
     * 
     * @return void
     */
    function create_acc($login, $l_name, $f_name, $pwd, $conf_pwd, $reponse_attendue, $reponse_utilisateur, $role){
        $mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_passwd'], $GLOBALS['db_name']) or die ("Impossible de se connecter à la base de données");

        // On définit sur quelle page une erreur redirige en fonction du rôle
        if ($role == 'tech'){
            $error_link = 'Location: tech.php?error=';
        }
        else {
            $error_link = 'Location: connection.php?error=';
        }

        // Si la réponse au captcha est correcte
        if ($reponse_utilisateur == $reponse_attendue) {
            $test_login = 'rmv-'.md5($login);
            
            // On compte le nombre de lignes avec le login entré ou le login supprimé
            $stmt = $mysqli->prepare("SELECT COUNT(*) FROM Users WHERE login = ? OR login = ?");
            $stmt->bind_param("ss", $test_login, $login);
            $stmt->execute();
            $taille = $stmt->get_result()->fetch_row()[0];
            
            $stmt->close();

            // Si le login existe déjà ou est un login supprimé
            // Ou si le login contient des espaces
            // Ou si le login est trop long
            if ($taille > 0 || substr($login, 0, 4) == 'rmv-' || str_contains($login, ' ') || strlen($login) > 40){
                header($error_link.'11');
            }

            // Si le login est valide
            else {
                // On continue si les champs ne sont pas vides
                if ($login != '' && $f_name != '' && $l_name != '' && $pwd != '' && $conf_pwd != ''){

                    // Si les mots de passe ne sont pas identiques
                    if (!($pwd == $conf_pwd)){
                        header($error_link.'12');
                    }

                    // Si des champs sont trop longs
                    else if (strlen($l_name) > 40 || strlen($f_name) > 40 || strlen($pwd) > 32){
                        header($error_link.'15');
                    }
                    
                    else {
                        // On chiffre le mot de passe
                        $pwd = cypher($pwd, get_key());

                        $stmt = $mysqli->prepare("INSERT INTO Users(login, first_name, last_name, password, role) VALUES (?, ?, ?, ?, ?)");
                        $stmt->bind_param("sssss", $login, $f_name, $l_name, $pwd, $role);
                        $stmt->execute();
                        $stmt->close();
            
                        $mysqli->close();

                        // On connecte l'utilisateur si le rôle est user
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

                // Si des champs sont vides
                else {
                    header($error_link.'13');
                }
            }
        }

        // Si la réponse au captcha est incorrecte
        else{
            header($error_link.'14');
        }
    }

    /**
     * Modifie le mot de passe d'un utilisateur
     * 
     * Redirige vers la page de profil/des utilisateurs si les identifiants sont invalides
     * 
     * @param string $login Login
     * @param string $actual_pwd Mot de passe actuel
     * @param string $new_pwd Nouveau mot de passe
     * @param string $conf_pwd Confirmation du nouveau mot de passe
     * 
     * @return void
     */
    function update_acc($login, $actual_pwd, $new_pwd, $conf_pwd, $role){
        // On définit sur quelle page une erreur redirige en fonction du rôle
        if ($role == 'user'){
            $redirect_link = 'Location: profile.php?';
        }
        else {
            $redirect_link = 'Location: users.php?';
        }

        $mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_passwd'], $GLOBALS['db_name']) or die ("Impossible de se connecter à la base de données");

        // Si les nouveaux mots de passe sont identiques
        if ($new_pwd == $conf_pwd){
            $stmt = $mysqli->prepare("SELECT password FROM Users WHERE login = ?");
            $stmt->bind_param("s", $login);
            $stmt->execute();
            $taille = $stmt->get_result()->num_rows;
            
            $stmt->execute();
            $get_pwd = $stmt->get_result()->fetch_row()[0];

            $stmt->close();

            // Si le login n'existe pas
            if ($taille == 0){
                header($redirect_link.'error=31');
                # Erreur d'identifiants
            }

            // Si le login existe plusieurs fois
            else if ($taille > 1){
                header($redirect_link.'error=32');
                # Erreur de base de données
            }

            // Si le login existe une seule fois
            else {
                // Si le mot de passe est correct
                if ($actual_pwd == decypher($get_pwd, get_key()) || $role == 'web_admin'){

                    // On chiffre le nouveau mot de passe
                    $new_pwd = cypher($new_pwd, get_key());

                    // On met à jour le mot de passe dans la base de données
                    $stmt = $mysqli->prepare("UPDATE Users SET password = ? WHERE login = ?");
                    $stmt->bind_param("ss", $new_pwd, $login);
                    $stmt->execute();
                    $mysqli->close();

                    header($redirect_link.'success=1');
                    # Mot de passe modifié
                }

                // Si le mot de passe est incorrect
                else {
                    header($redirect_link.'error=31');
                    # Erreur d'identifiants
                }
            }
        }
        
        // Si les nouveaux mots de passe ne sont pas identiques
        else {
            header($redirect_link.'error=33');
        }
    }

    /**
     * Anonymise un compte
     * 
     * @param string $login Login
     * 
     * @return void
     */
    function del_acc($login){
        $mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_passwd'], $GLOBALS['db_name']) or die ("Impossible de se connecter à la base de données");

        // On récupère les données de l'utilisateur
        $stmt = $mysqli->prepare("SELECT last_name, first_name FROM Users WHERE login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->bind_result($last_name, $first_name);

        $stmt->fetch();

        $stmt->close();

        // On anonymise les données de l'utilisateur avec un hash md5
        $last_name = md5($last_name);
        $first_name = md5($first_name);
        $new_login = 'rmv-'.md5($login);

        // On met à jour les données de l'utilisateur dans la base de données
        $stmt = $mysqli->prepare("UPDATE Users Usr SET Usr.last_name = ?, Usr.first_name = ?, Usr.login = ? WHERE Usr.login = ?");
        $stmt->bind_param("ssss", $last_name, $first_name, $new_login, $login);
        $stmt->execute();
        $stmt->close();

        $mysqli->close();
        // Compte supprimé
    }

    /**
     * Modifie un ticket
     * 
     * @param int $ticket_id id du ticket
     * @param string $newLibelle nouveau titre
     * @param int $newEmergency nouveau niveau d'urgence
     * @param string $newStatus nouveau status
     * @param string $newTech nouveau technicien
     * @param string $previous_libelle ancien titre
     * @param int $previous_emergency ancien niveau d'urgence
     * @param string $previous_status ancien status
     * 
     * @return void
     * 
     */
    function edit_ticket($ticket_id, $newLibelle, $newEmergency, $newStatus, $newTech, $previous_libelle, $previous_emergency, $previous_status){
        $mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_passwd'], $GLOBALS['db_name']) or die ("Impossible de se connecter à la base de données");

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
            
            take_ticket($ticket_id, $newTech);
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

    /**
     * Attribution du ticket a un technicien
     * 
     * @param int $ticket_id id du ticket sélectionné
     * @param int $actual_user id tu technicien sélectionné
     * 
     * @return void
     */
    function take_ticket($ticket_id, $actual_user){
        $mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_passwd'], $GLOBALS['db_name']) or die ("Impossible de se connecter à la base de données");

        $stmt = $mysqli->prepare("SELECT status FROM Tickets WHERE ticket_id = ?");
        $stmt->bind_param("s", $ticket_id);
        $stmt->execute();
        $stmt->bind_result($status);
        $stmt->fetch();
        $stmt->close();

        $stmt = $mysqli->prepare("SELECT COUNT(*) FROM Interventions WHERE ticket_id = ?");
        $stmt->bind_param("s", $ticket_id);
        $stmt->execute();
        $stmt->bind_result($ctTicket);
        $stmt->fetch();
        $stmt->close();

        if ($status != "open"){
            // On vérifie que le ticket est bien ouvert
            $mysqli->close();
            header("Location: dashboard.php");
        }

        else {
            if ($ctTicket == 0){
                // ajouter le technicien (SESSION) dans les interventions avec le ticket en question
                $stmt = $mysqli->prepare("INSERT INTO Interventions (ticket_id, tech_login) VALUES (?, ?)");
                $stmt->bind_param("is", $ticket_id, $actual_user);
                $stmt->execute();
                $stmt->close();
            }

            else {
                // update la base en en mofifiant le technicien actuel dans les interventions en le remplacant
                $stmt1 = $mysqli->prepare("UPDATE Interventions SET tech_login = ? WHERE ticket_id = ?");
                $stmt1->bind_param("si", $actual_user, $ticket_id);
                $stmt1->execute();
                $stmt1->close();
            }

            // update du status (in_progress)
            $stmt = $mysqli->prepare("UPDATE Tickets SET status = ? WHERE ticket_id = ?");
            $status = "in_progress";
            $stmt->bind_param("si", $status, $ticket_id);
            $stmt->execute();
            $stmt->close();
    
            $mysqli->close();
            // redirection : tout c'est bien passé pour take
            header("Location: dashboard.php?success=2");
        }
    }

    /**
     * Permet de fermer un ticket
     * 
     * @param int $ticket_id id du ticket sélectionné
     * 
     * @return void
     */
    function close_ticket($ticket_id){
        $actual_user = $_SESSION['login'];
        $mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_passwd'], $GLOBALS['db_name']) or die ("Impossible de se connecter à la base de données");

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

    /**
     * Renvoie la période aproximative de création d'un ticket
     *      Ex : si on est le 3 et que le ticket a été créé le 2 du même mois, alors on renvoie "Il y a 1 jour"
     * 
     * @param string $date correspond a une date
     * 
     * @return string $val_tab une valeur du tableau
     */
    function afficherDifferenceDate($date) {
        if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en'){
            $lang = $_SESSION['lang'];
        }
        else {
            $lang = 'fr';
        }

        // Convertit la date en timestamp
        $dateTimestamp = strtotime($date);

        // Calcule la différence entre la date donnée et maintenant en secondes
        $difference = time() - $dateTimestamp;

        // Convertit la différence en jours, semaines, mois et années
        $jours = floor($difference / (60 * 60 * 24));
        $semaines = floor($jours / 7);
        $mois = floor($jours / 30);
        $annees = floor($jours / 365);

        // Définit les tableaux de textes en français et en anglais
        $tab_fr = array('Il y a', 'année', 'années', 'mois', 'mois', 'semaine', 'semaines', 'jour', 'jours', 'Aujourd\'hui');
        $tab_en = array('', 'year ago', 'years ago', 'month ago', 'months ago', 'week ago', 'weeks ago', 'day ago', 'days ago', 'Today');
        $tab_lang = array('fr' => $tab_fr, 'en' => $tab_en);

        // Détermine la période et renvoie la chaîne correspondante
        if ($annees >= 1){
            if ($annees == 1)
                return $tab_lang[$lang][0]." ".$annees." ".$tab_lang[$lang][1];
            else
                return $tab_lang[$lang][0]." ".$annees." ".$tab_lang[$lang][2];
        }
        else if ($mois >= 1){
            if ($mois == 1)
                return $tab_lang[$lang][0]." ".$mois." ".$tab_lang[$lang][3];
            else
                return $tab_lang[$lang][0]." ".$mois." ".$tab_lang[$lang][4];
        }
        else if($semaines >= 1){
            if ($semaines == 1)
                return $tab_lang[$lang][0]." ".$semaines." ".$tab_lang[$lang][5];
            else
                return $tab_lang[$lang][0]." ".$semaines." ".$tab_lang[$lang][6];
        }
        else if($jours >= 1){
            if ($jours == 1)
                return $tab_lang[$lang][0]." ".$jours." ".$tab_lang[$lang][7];
            else
                return $tab_lang[$lang][0]." ".$jours." ".$tab_lang[$lang][8];
        }
        else{
            return $tab_lang[$lang][9];
        }
    }

    /**
     * Permet de stocker une image pour un certain user en base de données
     *
     * @param file $image image téléchargée
     * @param string $specific_user le login de l'utilisateur dans la base de données
     * @return void
     */
    function ajouterImageBD($image, $specific_user){
        $conn = new mysqli(HOST_DB, USER_DB, PASSWD_DB, DB) or die ("Impossible de se connecter à la base de données");

        if($image['error'] == 0){
            $imageType = exif_imagetype($image['tmp_name']);

            if ($imageType != false) {
                list($width, $height) = getimagesize($image['tmp_name']);

                $maxSize = 1920;

                // on resize l taille de l'image si celle-ci est trop grande (elle dépasse les 1920 pixel)
                if($width > $maxSize || $height > $maxSize){
                    $ratio = min($maxSize / $width, $maxSize / $height);
                    $newWidth = $width * $ratio;
                    $newHeight = $height * $ratio;
                } else {
                    $newWidth = $width;
                    $newHeight = $height;
                }

                // on prend la largeur minimum
                $size = min($newWidth, $newHeight);

                $imageSquare = imagecreatetruecolor($size, $size);

                $white = imagecolorallocate($imageSquare, 255, 255, 255);
                imagefill($imageSquare, 0, 0, $white);

                $imageOriginal = imagecreatefromstring(file_get_contents($image['tmp_name']));

                // lecture et correction de l'orientation EXIF (la façon dont l'image a été prise)
                $exif = @exif_read_data($image['tmp_name']);
                if(!empty($exif['Orientation'])) {
                    switch($exif['Orientation']) {
                        case 8:
                            $imageOriginal = imagerotate($imageOriginal, 90, 0);
                            break;
                        case 3:
                            $imageOriginal = imagerotate($imageOriginal, 180, 0);
                            break;
                        case 6:
                            $imageOriginal = imagerotate($imageOriginal, -90, 0);
                            break;
                    }
                }

                $x = ($size - $newWidth) / 2;
                $y = ($size - $newHeight) / 2;

                imagecopyresampled($imageSquare, $imageOriginal, $x, $y, 0, 0, $newWidth, $newHeight, $width, $height);

                $tempFileName = tempnam(sys_get_temp_dir(), 'square');
                imagejpeg($imageSquare, $tempFileName, 100);

                $imageData = file_get_contents($tempFileName);
                $imageData = $conn->real_escape_string($imageData);

                unlink($tempFileName);
                imagedestroy($imageOriginal);
                imagedestroy($imageSquare);

                $query = "UPDATE Users SET image='$imageData' WHERE login='$specific_user'";

                if($conn->query($query) == TRUE){
                    header("Location: profile.php?success=51"); // update dans la BD avec succes
                } else {
                    header("Location: profile.php?error=52"); // erreur lors de l'update
                }
            } else {
                header("Location: profile.php?error=52"); // le fichier n'est pas une image
            }
        } else {
            header("Location: profile.php"); // aucun fichier sélectionné => on fait rien
        }
        $conn->close();
    }

    /**
     * @param string $login le login de l'utilisateur pour lequel on doit afficher la photo
     * @param string $typeOfPfp permet de savoir ou on doit afficher la photo
     * @return void
     */
    function afficher_image($login, $typeOfPfp){
        $mysqli = new mysqli(HOST_DB, USER_DB, PASSWD_DB, DB) or die ("Impossible de se connecter à la base de données");
        $stmt = $mysqli->prepare("SELECT image FROM Users WHERE login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result && $result['image']) {
            // photo de profil personalisé du user
            switch ($typeOfPfp){
                case "in_table":
                    echo '<img id="pfp_in_table" src="data:image/jpeg;base64,' . base64_encode($result['image']) . '" alt="Icone d\'utilisateur">';
                    break;
                case "in_profile":
                    echo '<img id="pfp" src="data:image/jpeg;base64,' . base64_encode($result['image']) . '" alt="Icone d\'utilisateur">';
                    break;
                case "in_ticket_details":
                    echo '<img id="pfp_ticket_details" src="data:image/jpeg;base64,' . base64_encode($result['image']) . '" alt="Icone d\'utilisateur">';
                    break;
            }

        } else {
            // photo de profil de base du user
            switch ($typeOfPfp){
                case "in_table":
                    echo '<img id="pfp_in_table" src="resources/temp_user_icon.png" alt="Icone d\'utilisateur">';
                    break;
                case "in_profile":
                    echo '<img id="pfp" src="resources/temp_user_icon.png" alt="Icone d\'utilisateur">';
                    break;
                case "in_ticket_details":
                    echo '<img id="pfp_ticket_details" src="resources/temp_user_icon.png" alt="Icone d\'utilisateur">';
                    break;
            }
        }
    }
