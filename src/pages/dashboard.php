<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>
<?php
    include "header.php";
?>

<?php
    $role = $type;

    if (isset($_GET['dispo']) && $_GET['dispo'] == "true"){
        $dispo = true;
    }
    else {
        $dispo = false;
    }

    $user = "ticket_app";
    $passwd = "ticket_s301";
    $db = "ticket_app";
    $host = "localhost";
    $mysqli = new mysqli($host, $user, $passwd,$db);

    $actual_user = $_SESSION['login'];

    echo '<main>
        <div id="part_top">';

    if ($role == "user") {
        echo '<h2>Mes tickets</h2>
        <button type="button" onclick="location.href=\'ticket.php\'">Créer un ticket</button></div>';
        $header = array('Niveau', 'Salle', 'Problème', 'Date', 'État');

        $stmt1 = $mysqli->prepare("SELECT ticket_id FROM Tickets WHERE user_login LIKE ?");
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
            $stmt2 = $mysqli->prepare("SELECT emergency, room, title, creation_date, status FROM Tickets WHERE ticket_id = ?");
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

            $stmt1 = $mysqli->prepare("SELECT ticket_id FROM Tickets WHERE status LIKE 'open'");
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
                $stmt2 = $mysqli->prepare("SELECT emergency, room, title, last_name, first_name, creation_date FROM Tickets T, Users U WHERE ticket_id = ? AND T.user_login = U.login");
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

            $stmt1 = $mysqli->prepare("SELECT ticket_id FROM Interventions WHERE tech_login LIKE ?");
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
                $stmt2 = $mysqli->prepare("SELECT emergency, room, title, last_name, first_name, creation_date FROM Tickets T, Users U WHERE ticket_id = ? AND T.user_login = U.login");
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

        $stmt1 = $mysqli->prepare("SELECT ticket_id FROM Tickets WHERE status LIKE 'open' OR status LIKE 'in_progress'");
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
            $stmt2 = $mysqli->prepare("SELECT emergency, room, title, creation_date, last_name, first_name, status FROM Tickets T, Users U WHERE ticket_id = ? AND U.login = T.user_login");
            $stmt2->bind_param("s", $ticket_id);
            $stmt2->execute();
            $stmt2->bind_result($emergency, $room, $title, $creation_date, $nom, $prenom, $status);
            
            $stmt2->fetch();
            $demandeur = "";
            $test_col[] = array($emergency, $room, $title, $creation_date, $nom, $prenom, $demandeur, $status);
            $stmt2->close();
        }
    }

    else {
        echo '</div>';
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
                echo '<td class="ticket_case_'.$row[$i].'">'.$row[$i].'</td>';
            }
            else if (($i == 3 && $role == 'tech') || ($i == 4 && $role == 'web_admin') || ($i == 6 && $role == 'web_admin')){
                if ($role == 'web_admin' && $row[$i] == '' && $row[$i+1] == '')
                    echo '<td>Non attribué</td>';
                else
                    echo '<td>'.$row[$i].' '.$row[$i+1].'</td>';
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
                echo '<td>' . $row[$i] . '</td>';
            }
        }
        echo '</tr>';   
    }

    echo '</table>';
    echo '<div id="details_button">';
    for ($i = 0; $i < count($test_col); $i++) {
        if ($role == 'user')
            echo '<button type="button" onclick="location.href=\'ticket_details.php?id='.$ticket_ids[$i].'\'">Détails</button>';
        else if ($role == 'tech'){
            if ($dispo)
                echo '<button type="button" onclick="location.href=\'ticket_details.php?id='.$ticket_ids[$i].'&function=take\'">Prendre en charge</button>';
            else
                echo '<button type="button" onclick="location.href=\'ticket_details.php?id='.$ticket_ids[$i].'&function=close\'">Détails</button>';
        }
        else if ($role == 'web_admin')
            echo '<button type="button" onclick="location.href=\'ticket_modification.php?id='.$ticket_ids[$i].'\'">Modifier</button>';
    }
    echo '</div>';

    echo '</div>
        </main>';
        include "footer.php";
    echo '</body>
    </html>';
?>