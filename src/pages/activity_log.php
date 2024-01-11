<?php
    $tab = array('fr' => 'Journaux d\'activité', 'en' => 'Activity logs');
    
    include "header.php";
    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }
    else if ($_SESSION['role'] != 'sys_admin'){
        header('Location: index.php');
    }
?>
    <main>
        <div class="activity_log_parts">
            <?php
                $infoTop = array('fr' => 'Journal des tickets', 'en' => 'Ticket log');
                echo '<h2>'.$infoTop[$lang].'</h2>
                <div id="scrollable-table">
                    <table id="ticket_log_table">
                    <thead>
                        <tr>';

                        $header_en = array('Date', 'User', 'Ip address', 'Level');
                        $header_fr = array('Date', 'Demandeur', 'Adresse Ip', 'Niveau d\'urgence');
                        $header = array('en' => $header_en, 'fr' => $header_fr);

                        echo '<th>'.$header[$lang][0].'</th>';
                        echo '<th>'.$header[$lang][1].'</th>';
                        echo '<th>'.$header[$lang][2].'</th>';
                        echo '<th class=short_cell>'.$header[$lang][3].'</th>';
                        echo '</tr>
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
                        echo '<tr id="fond_hover">';
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
                <?php
                    $infoTop = array('fr' => 'Journal des connexions échouées', 'en' => 'Failed connection log');
                    echo '<h2>'.$infoTop[$lang].'</h2>
                    <div id="scrollable-table">
                    <table id="ticket_log_table">
                    <thead>
                        <tr>';

                        $header_en = array('Date', 'Login', 'Tried password', 'Ip address');
                        $header_fr = array('Date', 'Login', 'Mot de passe essayé', 'Adresse Ip');
                        $header = array('en' => $header_en, 'fr' => $header_fr);

                        foreach ($header[$lang] as $value){
                            echo '<th>'.$value.'</th>';
                        }

                        echo '</tr>
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
                        echo '<tr id="fond_hover">';
                        for ($j = 0; $j < 4; $j++) {
                            if ($j == 1){
                                $stmt = $mysqli->prepare("SELECT * 
                                                                FROM Users
                                                                WHERE login LIKE '%$row[$j]%'");
                                $stmt->execute();
                                $exist_logins = $stmt->get_result();
                                if (mysqli_num_rows($exist_logins) == 1){
                                    echo '<td style="color: green">'.htmlentities($row[$j]).'</td>';
                                }
                                else{
                                    echo '<td style="color: red">'.htmlentities($row[$j]).'</td>';
                                }
                            }
                            else{
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

        <div class="activity_log_parts">
                <?php
                    $infoTop = array('fr' => 'Historique des tickets fermés', 'en' => 'Closed ticket log');
                    echo '<h2>'.$infoTop[$lang].'</h2>
                    <div id="scrollable-table">
                    <table id="ticket_log_table">
                    <thead>
                        <tr>';

                        $header_en = array('Level', 'Room', 'Title', 'User', 'Creation date', 'End date');
                        $header_fr = array('Niveau', 'Salle', 'Problème', 'Demandeur', 'Date de création', 'Date de fin');
                        $header = array('en' => $header_en, 'fr' => $header_fr);
                        
                        foreach ($header[$lang] as $value){
                            echo '<th>'.$value.'</th>';
                        }
                        echo '</tr>
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
                        echo '<tr id="fond_hover">';
                        for ($j = 0; $j < 6; $j++) {
                            if ($j == 0){
                                echo '<td class="ticket_case_'.htmlentities($row[$j]).'">'.htmlentities($row[$j]).'</td>';
                            }
                            else if ($j == 1 && $row[$j] == 'other'){
                                switch ($lang) {
                                    case 'fr':
                                        echo '<td>Autre</td>';
                                        break;
                                    case 'en':
                                        echo '<td>Other</td>';
                                        break;
                                }
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
<?php
    include "footer.php";
?>
</body>
</html>