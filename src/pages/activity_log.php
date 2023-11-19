<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Journaux d'activité</title>
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
                            <th>Id</th>
                            <th>Demandeur</th>
                            <th>Niveau d\'urgence</th>
                        </tr>
                    </thead>';
                    
                    # TODO: Remplacer ce tableau par une requête SQL
                    $data = array(
                        array('19-11-2023', 'matis', 'Matis', 4),
                        array('18-3-2023', 'jules', 'Jules', 3),
                        array('22-1-2023', 'thomas', 'Thomas', 2),
                        array('23-5-2023', 'thomas', 'Thomas', 4),
                        array('19-11-2023', 'thomas', 'Thomas', 1),
                        array('14-11-2023', 'jules', 'Jules', 2),
                        array('8-10-2023', 'matis', 'Matis', 4),
                        array('22-1-2023', 'thomas', 'Thomas', 2),
                        array('23-5-2023', 'thomas', 'Thomas', 4),
                        array('19-11-2023', 'thomas', 'Thomas', 1),
                        array('14-11-2023', 'jules', 'Jules', 2),
                        array('8-10-2023', 'matis', 'Matis', 4)
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
            <h2>Historiaque des tickets fermés</h2>
            <div id="scrollable-table">
                <?php
                    echo '
                    <table id="ticket_log_table">
                    <thead>
                        <tr>
                            <th>Niveau</th>
                            <th>Salle</th>
                            <th>Probleme</th>
                            <th>Demandeur</th>
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