<?php
    session_start();

    if (!isset($_SESSION['login'])){
        header('Location: connection.php');
    }
    else if ($_SESSION['role'] != 'sys_admin'){
        header('Location: index.php');
    }

    // On vérifie que le paramètre 'file' est bien présent
    if (isset($_GET['file']) && !empty($_GET['file'])) {

        // On récupère le nom du fichier à télécharger
        $filename = $_GET['file'];

        // On vérifie que le fichier existe
        if(file_exists($filename)){

            //  On paramètre les entêtes pour le téléchargement
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: 0");
            header('Content-Disposition: attachment; filename="'.basename($filename).'"');
            header('Content-Length: ' . filesize($filename));
            header('Pragma: public');

            // On vide le tampon de sortie
            flush();

            // On ajoute le contenu du fichier au tampon de sortie
            readfile($filename);

            // On quitte le script
            die();
        }
    }