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

    echo '<main>
        <div id="part_top">
        <h2>Mes tickets</h2>';

    if ($role == "user") {
            echo '<button type="button" onclick="location.href=\'ticket.php\'">Créer un ticket</button></div>';
            $header = array('Niveau', 'Salle', 'Problème', 'Date', 'État');

            # TODO: Remplacer ce tableau par une requête SQL
            $test_col = array(array(1, '315', 'Câble projecteur HS', '04/10/2023', 'open'),
                                array(4, 'G23', 'Écran cassé', '14/09/2023', 'closed'));

            # TODO: Remplacer ce tableau par une requête SQL
            $ticket_id = array(1, 2);
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
                echo '<td class="ticket_case_' . $row[$i] . '">' . $row[$i] . '</td>';
            }
            else if ($i == 4) {
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

    if ($role == 'user'){
        echo '<div id="details_button">';
        for ($i = 0; $i < count($test_col); $i++) {
            echo '<button type="button" onclick="location.href=\'ticket_details.php?id='.$ticket_id[$i].'\'">Détails</button>';
        }
        echo '</div>';
    }

    echo '</div>
        </main>';
        include "footer.php";
    echo '</body>
    </html>';
?>