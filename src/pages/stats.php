<?php
    $tab = array('fr' => 'Statistiques', 'en' => 'Statistics');
    
    include "header.php";

    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }
    else if ($_SESSION['role'] != 'sys_admin'){
        header('Location: index.php');
    }

    $infoTop = array('fr' => 'Statistiques sur le site', 'en' => 'Statistics about the website');

    echo '<main><div id="part_top"><h2>'.$infoTop[$lang].'</h2></div>';
    echo '<div class="stat_part">';

    echo '<iframe src="https://boucanier.shinyapps.io/proba/" id="stat_frame"></iframe>
        </div>
    </main>';

    include 'footer.php';
?>
</body>
</html>