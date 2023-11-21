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
                    
                    # TODO: Remplacer ce tableau par une requête SQL
                    $data = array(
                        array('19-11-2023', 'matis', '192.168.1.1', 4),
                        array('18-3-2023', 'jules', '192.168.1.13', 3),
                        array('22-1-2023', 'thomas', '192.168.1.32', 2),
                        array('23-5-2023', 'thomas', '192.168.1.11', 4),
                        array('19-11-2023', 'thomas', '192.168.1.14', 1),
                        array('14-11-2023', 'jules', '192.168.1.57', 2),
                        array('8-10-2023', 'matis', '192.168.1.35', 4),
                        array('22-1-2023', 'thomas', '192.168.1.45', 2),
                        array('23-5-2023', 'thomas', '192.168.1.1', 4),
                        array('19-11-2023', 'thomas', '192.168.1.32', 1),
                        array('14-11-2023', 'jules', '192.168.1.1', 2),
                        array('8-10-2023', 'matis', '192.168.1.13', 4)
                    );

                    echo '<tbody>';
                    foreach ($data as $row) {
                        echo '<tr>';
                        for ($i = 0; $i < count($row); $i++) {
                            if ($i == 3) {
                                echo '<td class="ticket_case_'.$row[$i].'">'.$row[$i].'</td>';
                            }
                            else {
                                echo '<td>'.$row[$i].'</td>';
                            }
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
                    
                    # TODO: Remplacer ce tableau par une requête SQL
                    $data = array(
                        array('19-11-2023', 'matis', 'gfsg8gad8g6agd756a675faf7da89', '192.168.1.1'),
                        array('18-3-2023', 'jules', 'gfsg8gad8g6agd756a675faf7da89', '192.168.1.32'),
                        array('22-1-2023', 'thomas', 'gfsg8gad8g6agd756a675faf7da89', '192.168.1.14'),
                        array('23-5-2023', 'thomas', 'g7df89s7g8asd9g78g7g7gd78da7', '192.168.1.45'),
                        array('19-11-2023', 'thomas', 'g7f9s8g7fs89gsf9gsf98gs89g', '192.168.1.3'),
                        array('14-11-2023', 'jules', 'fd98fad7das87gsdgsf9a8da89d78', '192.168.1.1'),
                        array('8-10-2023', 'matis', 'g7sdf6h78sffad9g7s9', '192.168.1.3'),
                        array('22-1-2023', 'thomas', 'g7f89f7hng6fasgad89ghad9', '192.168.1.14'),
                        array('23-5-2023', 'thomas', '7hbfg8ga8h7f89ag79adg', '192.168.1.67'),
                        array('19-11-2023', 'thomas', 'hn7g897adf9h89da09ghas', '192.168.1.1'),
                        array('14-11-2023', 'jules', 'hn7g897adf890ghadf789fad', '192.168.1.14'),
                        array('8-10-2023', 'matis', 'h789af976gh87adf0adgags', '192.168.1.1')
                    );

                    echo '<tbody>';
                    foreach ($data as $row) {
                        echo '<tr>';
                        for ($i = 0; $i < count($row); $i++) {
                            echo '<td>'.$row[$i].'</td>';
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
                    
                    # TODO: Remplacer ce tableau par une requête SQL
                    $data = array(
                        array(2, 'G23' , 'projecteur cassé', 'matis', '19-11-2023', '25-11-2023'),
                        array(1, 'G21' , 'projecteur cassé', 'thomas', '27-11-2023', '30-11-2023'),
                        array(4, 'I21' , 'lumiere ne marche plus', 'jules', '2-11-2023', '10-11-2023'),
                        array(3, 'G23' , 'projecteur cassé', 'matis', '19-11-2023', '25-11-2023'),
                        array(2, 'G21' , 'projecteur cassé', 'thomas', '27-11-2023', '30-11-2023'),
                        array(4, 'I21' , 'lumiere ne marche plus', 'thomas', '2-11-2023', '10-11-2023'),
                        array(3, 'G23' , 'projecteur cassé', 'matis', '19-11-2023', '25-11-2023'),
                        array(1, 'G21' , 'projecteur cassé', 'matis', '27-11-2023', '30-11-2023'),
                        array(2, 'I21' , 'lumiere ne marche plus', 'thomas', '2-11-2023', '10-11-2023'),
                        array(3, 'G23' , 'projecteur cassé', 'thomas', '19-11-2023', '25-11-2023'),
                        array(1, 'G21' , 'projecteur cassé', 'matis', '27-11-2023', '30-11-2023'),
                        array(4, 'I21' , 'lumiere ne marche plus', 'jules', '2-11-2023', '10-11-2023')
                    );

                    echo '<tbody>';
                    foreach ($data as $row) {
                        echo '<tr>';
                        for ($i = 0; $i < count($row); $i++) {
                            if ($i == 0) {
                                echo '<td class="ticket_case_'.$row[$i].'">'.$row[$i].'</td>';
                            }
                            else {
                                echo '<td>'.$row[$i].'</td>';
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