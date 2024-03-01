<?php
    /**
     * Fichier contenant les informations de connexion à la base de données
     * 
     * @package Donnees
     */

    $file = fopen("../../config/db_credentials.json", "r");
    $json = fread($file, filesize("../../config/db_credentials.json"));

    $credentials = json_decode($json, true);


    /**
     * Hôte de la base de données
     * 
     * @var string
     */
    $GLOBALS['db_host'] = $credentials['host'];

    /**
     * Nom d'utilisateur de la base de données
     * 
     * @var string
     */
    $GLOBALS['db_user'] = $credentials['user'];

    /**
     * Mot de passe de la base de données
     * 
     * @var string
     */
    $GLOBALS['db_passwd'] = $credentials['passwd'];

    /**
     * Mot de passe de la base de données
     * 
     * @var string
     */
    $GLOBALS['db_name'] = $credentials['name'];
    