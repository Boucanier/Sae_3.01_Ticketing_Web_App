<?php
    $tab = array('fr' => 'Tableau de bord', 'en' => 'Dashboard');
    
    include "header.php";
    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }
    else if ($_SESSION['role'] == 'sys_admin'){
        header('Location: index.php');
    }
    
    $role = $type;

    if (isset($_GET['dispo']) && $_GET['dispo'] == "true"){
        $dispo = true;
    }
    else {
        $dispo = false;
    }

    $mysqli = new mysqli(HOST_DB, USER_DB, PASSWD_DB, DB) or die ("Impossible de se connecter à la base de données");

    $actual_user = $_SESSION['login'];

    echo '<main>
        <div id="part_top">';

    if ($role == "user") {
        $infoTop = array('fr' => 'Mes tickets', 'en' => 'My tickets');
        $createButtonValue = array('fr' => 'Créer un ticket', 'en' => 'Create a ticket');
        echo '<h2>'.$infoTop[$lang].'</h2>
        <button type="button" onclick="location.href=\'ticket.php\'">'.$createButtonValue[$lang].'</button></div>';
        $header_eng = array('Level', 'Room', 'Title', 'Date', 'Status');
        $header_fr = array('Niveau', 'Salle', 'Problème', 'Date', 'État');
        $header = array('fr' => $header_fr, 'en' => $header_eng);

        $stmt1 = $mysqli->prepare("SELECT ticket_id FROM Tickets WHERE user_login LIKE ? ORDER BY creation_date DESC, ticket_id DESC");
        $stmt1->bind_param("s", $actual_user);
        $stmt1->execute();
        $stmt1->bind_result($ticket_id);

        $ticket_ids = array();
        while ($stmt1->fetch()) {
            $result = $ticket_id;
            $ticket_ids[] = $result;
        }
        $stmt1->close();

        $test_col = array();
        foreach ($ticket_ids as $ticket_id){
            $stmt2 = $mysqli->prepare("SELECT emergency, room, title, DATE_FORMAT(creation_date,'%Y/%m/%d'), status FROM Tickets WHERE ticket_id = ?");
            $stmt2->bind_param("s", $ticket_id);
            $stmt2->execute();
            $stmt2->bind_result($emergency, $room, $title, $creation_date, $status);

            $stmt2->fetch();

            $test_col[] = array(
                $emergency, $room, $title, $creation_date, $status
            );

            $stmt2->close();
        }
    }

    else if ($role == "tech") {
        $header_eng = array('Level', 'Room', 'Title', 'User', 'Date');
        $header_fr = array('Niveau', 'Salle', 'Problème', 'Demandeur', 'Date');
        $header = array('fr' => $header_fr, 'en' => $header_eng);

        if ($dispo) {
            $infoTop = array('fr' => 'Tickets disponibles', 'en' => 'Available tickets');
            echo '<h2>'.$infoTop[$lang].'</h2>';

            $stmt1 = $mysqli->prepare("SELECT ticket_id FROM Tickets WHERE status LIKE 'open' ORDER BY creation_date DESC, ticket_id DESC");
            $stmt1->execute();
            $stmt1->bind_result($ticket_id);

            $ticket_ids = array();
            while ($stmt1->fetch()) {
                $result = $ticket_id;
                $ticket_ids[] = $result;
            }
            $stmt1->close();

            $test_col = array();
            foreach ($ticket_ids as $ticket_id) {
                $stmt2 = $mysqli->prepare("SELECT emergency, room, title, last_name, first_name, DATE_FORMAT(creation_date,'%Y/%m/%d') FROM Tickets T, Users U WHERE ticket_id = ? AND T.user_login = U.login");
                $stmt2->bind_param("s", $ticket_id);
                $stmt2->execute();
                $stmt2->bind_result($emergency, $room, $title, $nom, $prenom, $creation_date);

                $stmt2->fetch();

                $test_col[] = array($emergency, $room, $title, $nom, $prenom, $creation_date);

                $stmt2->close();
            }
        }

        else {
            $infoTop = array('fr' => 'Mes interventions en cours', 'en' => 'My interventions in progress');
            echo '<h2>'.$infoTop[$lang].'</h2>';
            $status = "in_progress";
            $stmt1 = $mysqli->prepare("SELECT I.ticket_id FROM Interventions I, Tickets T WHERE tech_login LIKE ? AND I.ticket_id = T.ticket_id AND status LIKE ? ORDER BY creation_date DESC, ticket_id DESC");
            $stmt1->bind_param("ss", $actual_user, $status);
            $stmt1->execute();
            $stmt1->bind_result($ticket_id);

            $ticket_ids = array();
            while ($stmt1->fetch()) {
                $result = $ticket_id;
                $ticket_ids[] = $result;
            }
            $stmt1->close();

            $test_col = array();
            foreach ($ticket_ids as $ticket_id){
                $stmt2 = $mysqli->prepare("SELECT emergency, room, title, last_name, first_name, DATE_FORMAT(creation_date,'%Y/%m/%d') FROM Tickets T, Users U WHERE ticket_id = ? AND T.user_login = U.login");
                $stmt2->bind_param("s", $ticket_id);
                $stmt2->execute();
                $stmt2->bind_result($emergency, $room, $title, $nom, $prenom, $creation_date);

                $stmt2->fetch();

                $test_col[] = array($emergency, $room, $title, $nom, $prenom, $creation_date);

                $stmt2->close();
            }
        }
        echo '</div>';
    }

    if ($role == "web_admin") {
        $infoTop = array('fr' => 'Liste des tickets', 'en' => 'Tickets list');
        echo '<h2>'.$infoTop[$lang].'</h2></div>';
        
        $header_eng = array('Level', 'Room', 'Title', 'Date', 'User', 'Technician', 'Status');
        $header_fr = array('Niveau', 'Salle', 'Problème', 'Date', 'Demandeur', 'Technicien', 'État');
        $header = array('fr' => $header_fr, 'en' => $header_eng);

        $stmt1 = $mysqli->prepare("SELECT ticket_id FROM Tickets WHERE status LIKE 'open' OR status LIKE 'in_progress' ORDER BY creation_date DESC, ticket_id DESC");
        $stmt1->execute();
        $stmt1->bind_result($ticket_id);

        $ticket_ids = array();
        while ($stmt1->fetch()) {
            $result = $ticket_id;
            $ticket_ids[] = $result;
        }
        $stmt1->close();


        $test_col = array();
        foreach ($ticket_ids as $ticket_id){
            $stmt2 = $mysqli->prepare("SELECT emergency, room, title, DATE_FORMAT(creation_date,'%Y/%m/%d'), last_name, first_name, status FROM Tickets T, Users U WHERE ticket_id = ? AND U.login = T.user_login");
            $stmt2->bind_param("s", $ticket_id);
            $stmt2->execute();
            $stmt2->bind_result($emergency, $room, $title, $creation_date, $nom, $prenom, $status);
            
            $stmt2->fetch();
            $stmt2->close();

            if ($status == 'in_progress'){
                $stmt3 = $mysqli->prepare("SELECT last_name, first_name FROM Users WHERE login IN (SELECT tech_login FROM Interventions WHERE ticket_id = ?)");
                $stmt3->bind_param("s", $ticket_id);
                $stmt3->execute();
                $stmt3->bind_result($nom_tech, $prenom_tech);

                $stmt3->fetch();
                $stmt3->close();

                if ($nom_tech == NULL && $prenom_tech == NULL){
                    $nom_tech = 'attribué';
                    $prenom_tech = 'Non';
                }
            }

            else {
                switch ($lang) {
                    case 'fr':
                        $nom_tech = 'Attribué';
                        $prenom_tech = 'Non';
                        break;
                    case 'en':
                        $nom_tech = 'Assigned';
                        $prenom_tech = 'Not';
                        break;
                }
            }

            $test_col[] = array($emergency, $room, $title, $creation_date, $nom, $prenom, $nom_tech, $prenom_tech, $status);
        }
    }

    else {
        echo '</div>';
    }
    $error_fr = array('Le libellé doît être compris entre 1 et 30 caractères', 'Niveau d\'urgence compris entre 1 et 4', 'Le status doît être ouvert, en cours ou clos', 'Vous pouvez attribué des tickets uniquement à des techniciens');
    $error_en = array('The label must be between 1 and 30 characters', 'Emergency level must be between 1 and 4', 'Status must be open, in_progress or closed', 'You can only assign tickets to technicians');
    $error = array('fr' => $error_fr, 'en' => $error_en);

    $success_fr = array('Vous avez bien clos le ticket', 'Vous avez bien pris le ticket', 'Vous avez bien édité le ticket');
    $success_en = array('You have successfully closed the ticket', 'You have successfully taken the ticket', 'You have successfully edited the ticket');
    $success = array('fr' => $success_fr, 'en' => $success_en);

    // les erreurs et les succes :
    // du web admin :
    if ($role == 'web_admin' & isset($_GET['error'])){
        if ($_GET['error'] == '1'){
            echo "<div class='ticketPageError'><p>".$error[$lang][0]."</p></div>";
        }
        else if ($_GET['error'] == '2'){
            echo "<div class='ticketPageError'><p>".$error[$lang][1]."</p></div>";
        }
        else if ($_GET['error'] == '3'){
            echo "<div class='ticketPageError'><p>".$error[$lang][2]."</p></div>";
        }
        else if ($_GET['error'] == '4'){
            echo "<div class='ticketPageError'><p>".$error[$lang][3]."</p></div>";
        }
    }

    else if ($role == 'web_admin' & isset($_GET['success'])){
        if($_GET['success'] == '3'){
            echo "<div class='success'><p>".$success[$lang][2]."</p></div>";
        }
    }
    // du technicien
    else if ($role == 'tech' & isset($_GET['success'])){
        if($_GET['success'] == '1'){
            echo "<div class='success'><p>".$success[$lang][0]."</p></div>";
        }
        if($_GET['success'] == '2'){
            echo "<div class='success'><p>".$success[$lang][1]."</p></div>";
        }   
    }

    echo '<div id="ticket_table">
        <table>
        <tr>';
    
    foreach ($header[$lang] as $h) {
        echo '<th>' . $h . '</th>';
    }

    echo '</tr>';

    $status_fr = array('open' => 'Ouvert', 'in_progress' => 'En cours', 'closed' => 'Clos');
    $status_en = array('open' => 'Open', 'in_progress' => 'In progress', 'closed' => 'Closed');
    $status = array('fr' => $status_fr, 'en' => $status_en);

    foreach ($test_col as $row) {
        echo '<tr class="fond_hover">';
        for ($i = 0; $i < count($row); $i++) {
            if ($i == 0) {
                echo '<td class="ticket_case_'.htmlentities($row[$i]).'">'.htmlentities($row[$i]).'</td>';
            }
            else if ($i == 1 && $row[$i] == 'other'){
                echo '<td>Autre</td>';
            }
            else if (($i == 3 && $role == 'tech') || ($i == 4 && $role == 'web_admin') || ($i == 6 && $role == 'web_admin')){
                    echo '<td>'.htmlentities($row[$i+1]).' '.htmlentities($row[$i]).'</td>';
                $i ++;
            }
            else if (($i == 4 && $role == 'user') || ($i == 8 && $role == 'web_admin')) {
                echo '<td>'.$status[$lang][$row[$i]].'</td>';
            }
            else if(($i == 5 && $role == 'tech') || ($i == 3 && $role == 'user') || ($i == 3 && $role == 'web_admin')){
                echo '<td>' .htmlentities(afficherDifferenceDate($row[$i])). '</td>';
            }
            else {
                echo '<td>' . htmlentities($row[$i]) . '</td>';
            }
        }
        echo '</tr>';   
    }

    echo '</table>';
    echo '<div id="details_button">';

    $buttonValue_fr = array('Détails', 'Prendre en charge', 'Modifier');
    $buttonValue_en = array('Details', 'Take', 'Edit');
    $buttonValue = array('fr' => $buttonValue_fr, 'en' => $buttonValue_en);

    for ($i = 0; $i < count($test_col); $i++) {
        if ($role == 'user'){
            echo '<form action="ticket_details.php" method="post">
                    <input type="hidden" name="id" value="'.$ticket_ids[$i].'">
                    <input type="submit" value='.$buttonValue[$lang][0].'>
                </form>';
        }
        else if ($role == 'tech'){
            if ($dispo){
                echo '<form action="ticket_details.php" method="post">
                        <input type="hidden" name="id" value="'.$ticket_ids[$i].'">
                        <input type="hidden" name="function" value="take">
                        <input type="submit" value='.$buttonValue[$lang][1].'>
                    </form>';
            }
            else {
                echo '<form action="ticket_details.php" method="post">
                        <input type="hidden" name="id" value="'.$ticket_ids[$i].'">
                        <input type="hidden" name="function" value="close">
                        <input type="submit" value='.$buttonValue[$lang][0].'>
                    </form>';
            }
        }
        else if ($role == 'web_admin'){
            echo '<form action="ticket_modification.php" method="post">
                    <input type="hidden" name="id" value="'.$ticket_ids[$i].'">
                    <input type="submit" value='.$buttonValue[$lang][2].'>
                </form>';
        }
    }
    echo '</div>';

    echo '</div>
        </main>';
        include "footer.php";
    echo '</body>
    </html>';
?>