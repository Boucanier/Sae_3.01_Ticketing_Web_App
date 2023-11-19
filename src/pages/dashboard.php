<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>
<header>
    <div id="top">
        <img src="../resources/logo.png" alt="logo de la plateforme" id="image1">
        <h1>Ticket App</h1>
        <img src="../resources/logo_UVSQ.png" alt="logo de l'UVSQ" id="image2">
    </div>
    <nav>
        <div id="nav1">
            <a href="index.php">Accueil</a>
            <a href="dashboard.php">Tableau de bord</a>
        </div>
        <div id="nav2">
            <a href="profile.php">Profil</a>
            <a href="connection.php">Se connecter</a>
            <a href="index.php">Déconnexion</a>
        </div>
    </nav>
</header>

<?php
    $role = "user";

    if (isset($_GET['dispo']) && $_GET['dispo'] == "true"){
        $dispo = true;
    }
    else {
        $dispo = false;
    }

    echo '<main>
        <div id="part_top">';

    if ($role == "user") {
        echo '<h2>Mes tickets</h2>
            <button type="button" onclick="location.href=\'ticket.php\'">Créer un ticket</button></div>';
        $header = array('Niveau', 'Salle', 'Problème', 'Date', 'État');

        # TODO: Remplacer ce tableau par une requête SQL
        $ticket_id = array(1, 2);

        # TODO: Remplacer ce tableau par une requête SQL en utilisant les id
        $test_col = array(array(1, '315', 'Câble projecteur HS', '04/10/2023', 'open'),
                            array(4, 'G23', 'Écran cassé', '14/09/2023', 'closed'));
    }

    else if ($role == "tech") {
        $header = array('Niveau', 'Salle', 'Problème', 'Demandeur', 'Date');

        if ($dispo){
            echo '<h2>Tickets disponibles</h2>';

            # TODO: Remplacer ce tableau par une requête SQL
            $ticket_id = array(3, 2, 1, 4, 5);

            # TODO: Remplacer ce tableau par une requête SQL en utilisant les id
            $test_col = array(array(4,'G26', 'Fuite d\'eau sur les machines', 'Jérémy', 'Cabessa', '05/10/2023'),
                            array(1, '315', 'Câble projecteur HS', 'Fabrice', 'Hoguin', '04/10/2023'),
                            array(2, 'I21', 'Multiprise cassée', 'David', 'Auger', '26/09/2023'),
                            array(3, 'G26', 'Projecteur en panne', 'Alain', 'Oster', '24/09/2023'),
                            array(4, 'G21', 'Prise ethernet cassée', 'David', 'Auger', '10/09/2023'));
        }

        else {
            echo '<h2>Mes interventions en cours</h2>';

            # TODO: Remplacer ce tableau par une requête SQL
            $ticket_id = array(3, 2, 1, 4, 5);
    
            # TODO: Remplacer ce tableau par une requête SQL en utilisant les id
            $test_col = array(array(4,'G26', 'Fuite d\'eau sur les machines', 'Jérémy', 'Cabessa', '05/10/2023'),
                            array(1, '315', 'Câble projecteur HS', 'Fabrice', 'Hoguin', '04/10/2023'),
                            array(2, 'I21', 'Multiprise cassée', 'David', 'Auger', '26/09/2023'),
                            array(3, 'G26', 'Projecteur en panne', 'Alain', 'Oster', '24/09/2023'),
                            array(4, 'G21', 'Prise ethernet cassée', 'David', 'Auger', '10/09/2023'));
        }
        echo '</div>';
    }

    if ($role == "web_admin") {
        echo '<h2>Liste des tickets</h2>
            </div>';
        $header = array('Niveau', 'Salle', 'Problème', 'Date', 'Demandeur', 'Technicien', 'État');

        # TODO: Remplacer ce tableau par une requête SQL
        $ticket_id = array(3, 2, 1, 4, 5);

        # TODO: Remplacer ce tableau par une requête SQL en utilisant les id
        $test_col = array(array(4,'G26', 'Fuite d\'eau sur les machines', '05/10/2023', 'Jérémy', 'Cabessa', 'Jean', 'Zanzibare', 'in_progress'),
                        array(1, '315', 'Câble projecteur HS', '04/10/2023', 'Fabrice', 'Hoguin', '', '', 'open'),
                        array(2, 'I21', 'Multiprise cassée', '26/09/2023', 'David', 'Auger', 'Roger', 'Martinique', 'in_progress'),
                        array(3, 'G26', 'Projecteur en panne', '24/09/2023', 'Alain', 'Oster', 'Jean', 'Zanzibare', 'in_progress'),
                        array(4, 'G21', 'Prise ethernet cassée', '10/09/2023', 'David', 'Auger', '', '', 'open'));
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
            echo '<button type="button" onclick="location.href=\'ticket_details.php?id='.$ticket_id[$i].'\'">Détails</button>';
        else if ($role == 'tech'){
            if ($dispo)
                echo '<button type="button" onclick="location.href=\'ticket_details.php?id='.$ticket_id[$i].'&function=take\'">Prendre en charge</button>';
            else
                echo '<button type="button" onclick="location.href=\'ticket_details.php?id='.$ticket_id[$i].'&function=close\'">Détails</button>';
        }
        else if ($role == 'web_admin')
            echo '<button type="button" onclick="location.href=\'ticket_modification.php?id='.$ticket_id[$i].'\'">Modifier</button>';
    }
    echo '</div>';

    echo '</div>
        </main>';
        include "footer.php";
    echo '</body>
    </html>';
?>