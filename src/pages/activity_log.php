<?php
    $tab = array('fr' => 'Journaux d\'activité', 'en' => 'Activity logs');
    
    include "header.php";
    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }
    else if ($_SESSION['role'] != 'sys_admin'){
        header('Location: index.php');
    }

    $infoTop = array('fr' => 'Journaux d\'activité', 'en' => 'Activity logs');

    echo '<main><div id="part_top"><h2>'.$infoTop[$lang].'</h2></div>';
    echo '<div id="activity_log_page">';

    $selection_en = array('Connections logs', 'Closed tickets logs', 'Tickets logs');
    $selection_fr = array('Logs de connexions', 'Logs des tickets fermés', 'Logs des tickets');
    $selection = array('en' => $selection_en, 'fr' => $selection_fr);

    $directory = array('connections', 'closed_tickets', 'tickets');

    $download = array('en' => 'Download', 'fr' => 'Télécharger');

    for ($i = 0; $i < count($directory); $i++) {
        $dir = $directory[$i];
        echo '<div class="activity_log_parts">';
            echo '<h2>'.$selection[$lang][$i].'</h2>';

            echo '<table id="ticket_log_table">';

            $files = scandir('../../logs/'.$dir);
            foreach($files as $file) {
                if ($file != '.' and $file != '..') {
                    echo '<tr><td>' . $file . '</td>';
                    echo '<td><a href="../../logs/' . $dir . '/' . $file . '" download>' . $download[$lang] . '</a></td></tr>';
                }
            }
            echo '</table>';
    }

    echo '</main>';
    include "footer.php";
?>

</body>
</html>