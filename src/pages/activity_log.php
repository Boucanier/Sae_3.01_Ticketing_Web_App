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

    $selection_en = array('Closed tickets logs', 'Connections logs', 'Tickets logs');
    $selection_fr = array('Logs des tickets fermés', 'Logs de connexions', 'Logs des tickets');
    $selection = array('en' => $selection_en, 'fr' => $selection_fr);

    $json_log_path = '../../config/logs.json';
    $json_log_file = fopen($json_log_path, 'r');
    $json_log = fread($json_log_file,filesize($json_log_path));

    $logs_dir = json_decode($json_log,true)['logsPath'];
    foreach (scandir($logs_dir) as $dir){
        if ($dir != '.' and $dir != '..')
            $directory[] = $dir;
    }

    for ($i = 0; $i < count($directory); $i++) {
        $dir = $directory[$i];
        echo '<div class="activity_log_parts">';
            echo '<h2>'.$selection[$lang][$i].'</h2>';
            echo '<div id="scrollable-table">';
                echo '<table id="ticket_log_table">';
                    echo '<tr><th>Date</th>';
                    echo '<th>' .(array("en" => "File", "fr" => "Fichier"))[$lang] .'</th></tr>';

                    $files = scandir($logs_dir.$dir);
                    sort($files);
                    $files = array_reverse($files);
                    foreach($files as $file) {
                        if ($file != '.' and $file != '..') {
                            $file = explode(".", $file)[0];
                            $date = explode("-", $file);
                            echo '<tr class="fond_hover"><td>' . $date[3] . '/' . $date[2] . '/' . $date[1] . '</td>';
                            echo '<td><a href="../../logs/' . $dir . '/' . $file . '" download>' . $file . '</a></td></tr>';
                        }
                    }
        echo '</table></div></div>';
    }

    echo '</div></main>';
    include "footer.php";
?>

</body>
</html>