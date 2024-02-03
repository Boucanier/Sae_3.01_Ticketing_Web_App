<?php
    session_start();
    session_destroy();

    if (isset($_GET['sup_acc']) && $_GET['sup_acc']){
        header('Location: index.php?success=1');
    }
    
    else {
        header('Location: index.php?test=1');
    }