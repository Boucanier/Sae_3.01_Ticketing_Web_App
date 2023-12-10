<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<?php
    include "header.php";
    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }
    else if ($_SESSION['role'] == 'sys_admin'){
        header('Location: index.php');
    }
?>

<?php
    $role = $type;

    if (isset($_GET['dispo']) && $_GET['dispo'] == "true"){
        $dispo = true;
    }
    else {
        $dispo = false;
    }

    # TODO : success = 1 pour ticket clos,
    # TODO : success = 2 pour ticket pris
    # TODO : success = 3 pour ticket éditer

    $mysqli = new mysqli($host, $user, $passwd,$db);

    $actual_user = $_SESSION['login'];

    echo '<main>
        <div id="part_top">';

    if ($role == "user") {
        echo '<h2>Mes tickets</h2>
        <button type="button" onclick="location.href=\'ticket.php\'">Créer un ticket</button></div>';
        $header = array('Niveau', 'Salle', 'Problème', 'Date', 'État');

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
            $stmt2 = $mysqli->prepare("SELECT emergency, room, title, DATE_FORMAT(creation_date,'%d/%m/%Y'), status FROM Tickets WHERE ticket_id = ?");
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
        $header = array('Niveau', 'Salle', 'Problème', 'Demandeur', 'Date');

        if ($dispo) {
            echo '<h2>Tickets disponibles</h2>';

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
                $stmt2 = $mysqli->prepare("SELECT emergency, room, title, last_name, first_name, DATE_FORMAT(creation_date,'%d/%m/%Y') FROM Tickets T, Users U WHERE ticket_id = ? AND T.user_login = U.login");
                $stmt2->bind_param("s", $ticket_id);
                $stmt2->execute();
                $stmt2->bind_result($emergency, $room, $title, $nom, $prenom, $creation_date);

                $stmt2->fetch();

                $test_col[] = array($emergency, $room, $title, $nom, $prenom, $creation_date);

                $stmt2->close();
            }
        }

        else {
            echo '<h2>Mes interventions en cours</h2>';
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
                $stmt2 = $mysqli->prepare("SELECT emergency, room, title, last_name, first_name, DATE_FORMAT(creation_date,'%d/%m/%Y') FROM Tickets T, Users U WHERE ticket_id = ? AND T.user_login = U.login");
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
        echo '<h2>Liste des tickets</h2>
            </div>';
        $header = array('Niveau', 'Salle', 'Problème', 'Date', 'Demandeur', 'Technicien', 'État');

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
            $stmt2 = $mysqli->prepare("SELECT emergency, room, title, DATE_FORMAT(creation_date,'%d/%m/%Y'), last_name, first_name, status FROM Tickets T, Users U WHERE ticket_id = ? AND U.login = T.user_login");
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
                $nom_tech = 'attribué';
                $prenom_tech = 'Non';
            }

            $test_col[] = array($emergency, $room, $title, $creation_date, $nom, $prenom, $nom_tech, $prenom_tech, $status);
        }
    }

    else {
        echo '</div>';
    }

    // les erreurs et les succes :
    // du web admin :
    if ($role == 'web_admin' & isset($_GET['error'])){
        if ($_GET['error'] == '1'){
            echo "<div class='ticketPageError'><p>Le libelle doît être compris entre 1 et 30 caractères</p></div>";
        }
        else if ($_GET['error'] == '2'){
            echo "<div class='ticketPageError'><p>Niveau d'urgence compris entre 1 et 4</p></div>";
        }
        else if ($_GET['error'] == '3'){
            echo "<div class='ticketPageError'><p>Le status doît être open, in_progress ou closed</p></div>";
        }
        else if ($_GET['error'] == '4'){
            echo "<div class='ticketPageError'><p>Le login du technicien doit avoir le rôle de technicien</p></div>";
        }
    }
    else if ($role == 'web_admin' & isset($_GET['success'])){
        if($_GET['success'] == '3'){
            echo "<div class='success'><p>Vous avez bien édité le ticket</p></div>";
        }
    }
    // du technicien
    else if ($role == 'tech' & isset($_GET['success'])){
        if($_GET['success'] == '1'){
            echo "<div class='success'><p>Vous avez bien clos le ticket</p></div>";
        }
        if($_GET['success'] == '2'){
            echo "<div class='success'><p>Vous avez bien pris le ticket</p></div>";
        }   
    }

    echo '<div id="ticket_table">
        <table>
        <tr>';
    
    foreach ($header as $h) {
        echo '<th>' . $h . '</th>';
    }

    echo '</tr>';

    foreach ($test_col as $row) {
        echo '<tr>';
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
                switch ($row[$i]){
                    case 'open':
                        echo '<td>Ouvert</td>';
                        break;
                    case 'in_progress':
                        echo '<td>En cours</td>';
                        break;
                    case 'closed':
                        echo '<td>Fermé</td>';
                        break;
                    default:
                        echo '<td>Inconnu</td>';
                }
            }
            else {
                echo '<td>' . htmlentities($row[$i]) . '</td>';
            }
        }
        echo '</tr>';   
    }

    echo '</table>';
    echo '<div id="details_button">';
    for ($i = 0; $i < count($test_col); $i++) {
        if ($role == 'user'){
            echo '<form action="ticket_details.php" method="post">
                    <input type="hidden" name="id" value="'.$ticket_ids[$i].'">
                    <input type="submit" value="Détails">
                </form>';
        }
        else if ($role == 'tech'){
            if ($dispo){
                echo '<form action="ticket_details.php" method="post">
                        <input type="hidden" name="id" value="'.$ticket_ids[$i].'">
                        <input type="hidden" name="function" value="take">
                        <input type="submit" value="Prendre en charge">
                    </form>';
            }
            else {
                echo '<form action="ticket_details.php" method="post">
                        <input type="hidden" name="id" value="'.$ticket_ids[$i].'">
                        <input type="hidden" name="function" value="close">
                        <input type="submit" value="Détails">
                    </form>';
            }
        }
        else if ($role == 'web_admin'){
            echo '<form action="ticket_modification.php" method="post">
                    <input type="hidden" name="id" value="'.$ticket_ids[$i].'">
                    <input type="submit" value="Modifier">
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