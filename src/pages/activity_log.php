<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Journaux d'activité</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>

<body>
<?php
    include "header.php";
    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }
    else if ($_SESSION['role'] != 'sys_admin'){
        header('Location: index.php');
    }
?>
<body>
    <main>
        <div class="activity_log_parts">
            <h2>Journal des tickets</h2>
            <div id="scrollable-table">
                <?php
                    echo '
                    <table id="ticket_log_table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Login</th>
                            <th>Ip</th>
                            <th class="short_cell">Niveau d\'urgence</th>
                        </tr>
                    </thead>';

                    $mysqli = new mysqli($host, $user, $passwd, $db);
                    $stmt = $mysqli->prepare("SELECT DATE_FORMAT(creation_date,'%d/%m/%Y'), user_login, ip_address, emergency 
                                                        FROM Tickets
                                                        WHERE status != 'closed'
                                                        ORDER BY creation_date DESC");
                    $stmt->execute();
                    $data = $stmt->get_result();

                    echo '<tbody>';
                    for ($i=0; $i<mysqli_num_rows($data); $i++) {
                        $row = mysqli_fetch_array($data);
                        echo '<tr>';
                        for ($j = 0; $j < 4; $j++) {
                            if ($j == 3)
                                echo '<td class="ticket_case_'.htmlentities($row[$j]).'">'.htmlentities($row[$j]).'</td>';
                            else
                                echo '<td>'.htmlentities($row[$j]).'</td>';
                        }
                        echo '</tr>';
                    }
                    echo '</tbody>';
                ?>
                </table>
            </div>
        </div>

        <div class="activity_log_parts">
            <h2>Journal des connexions échouées</h2>
            <div id="scrollable-table">
                <?php
                    echo '
                    <table id="ticket_log_table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Login</th>
                            <th>Mot de passe tenté</th>
                            <th>Ip</th>
                        </tr>
                    </thead>';

                    $stmt = $mysqli->prepare("SELECT DATE_FORMAT(date_co,'%d/%m/%Y %T'), login, password, ip_address 
                                                            FROM Connections
                                                            WHERE succes = 0
                                                            ORDER BY date_co DESC");
                    $stmt->execute();
                    $data = $stmt->get_result();

                    echo '<tbody>';
                    for ($i=0; $i < mysqli_num_rows($data); $i++) {
                        $row = mysqli_fetch_array($data);
                        echo '<tr>';
                        for ($j = 0; $j < 4; $j++) {
                            echo '<td>'.htmlentities($row[$j]).'</td>';
                        }
                        echo '</tr>';
                    }
                    echo '</tbody>';
                ?>
                </table>
            </div>
        </div>

        <div class="activity_log_parts">
            <h2>Historique des tickets fermés</h2>
            <div id="scrollable-table">
                <?php
                    echo '
                    <table id="ticket_log_table">
                    <thead>
                        <tr>
                            <th>Niveau</th>
                            <th>Salle</th>
                            <th>Problème</th>
                            <th>Login</th>
                            <th>Date</th>
                            <th>Date fin</th>
                        </tr>
                    </thead>';

                    $stmt = $mysqli->prepare("SELECT emergency, room, title, user_login, DATE_FORMAT(creation_date,'%d/%m/%Y'), DATE_FORMAT(end_date,'%d/%m/%Y')
                                                            FROM Tickets, Interventions
                                                            WHERE Tickets.ticket_id = Interventions.ticket_id
                                                            AND status = 'closed'
                                                            ORDER BY creation_date DESC");
                    $stmt->execute();
                    $data = $stmt->get_result();

                    echo '<tbody>';
                    for ($i=0; $i<mysqli_num_rows($data); $i++) {
                        $row = mysqli_fetch_array($data);
                        echo '<tr>';
                        for ($j = 0; $j < 6; $j++) {
                            if ($j == 0){
                                echo '<td class="ticket_case_'.htmlentities($row[$j]).'">'.htmlentities($row[$j]).'</td>';
                            }
                            else if ($j == 1 && $row[$j] == 'other'){
                                echo '<td>Autre</td>';
                            }
                            else {
                                echo '<td>'.htmlentities($row[$j]).'</td>';
                            }
                        }
                        echo '</tr>';
                    }
                    echo '</tbody>';
                ?>
                </table>
            </div>
        </div>
    </main>
</body>
<?php
    include "footer.php";
?>
</html>