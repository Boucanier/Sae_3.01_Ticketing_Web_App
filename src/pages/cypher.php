<?php
    /**
     * Fichier contenant les fonctions de chiffrement
     * 
     * @package Chiffrement
     */

    /**
     * Chemin vers le fichier contenant la clé de chiffrement
     * 
     * @var string
     */
    const KEY_PATH = "../../security/key.txt";

    /**
     * Récupère la clé de chiffrement dans le fichier dédié
     * 
     * @return string Clé de chiffrement
     */
    function get_key(){
        $keyFile = fopen(KEY_PATH, "r") or die ("Impossible d'ouvrir en lecture le fichier key.txt");
        $key = fgets($keyFile);
        fclose($keyFile);
        return trim($key);
    }

    /**
     * Génère un tableau de permutation à partir d'une clé
     * 
     * @param string $k Clé de chiffrement
     * 
     * @return array{int} Tableau de permutation
     */
    function ksa($k){
        // On crée un tableau de caractères à partir de la clé
        $k = str_split($k);

        if (count($k) == 0){
            // Si la clé est vide, on retourne un tableau vide

            for ($i = 0; $i < 256; $i++){
                // On récupère le code ASCII de chaque caractère
                $k[] = 0;
            }

            return $k;
        }
        
        for ($i = 0; $i < count($k); $i++){
            // On récupère le code ASCII de chaque caractère
            $k[$i] = intval(ord($k[$i]));
        }

        $s = array();
        for ($i = 0; $i < 256; $i++){
            // On crée un tableau de 0 à 255
            $s[] = $i;
        }

        $j = 0;
        for ($i = 0; $i < 256; $i++){
            // On mélange le tableau de manière à obtenir
            // une permutation des 256 valeurs
            $j = ($j + $s[$i] + $k[$i % count($k)]) % 256;
            $temp = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $temp;
        }

        return $s;
    }

    /**
     * Génère une suite chiffrante à partir d'un tableau de permutation
     * 
     * @param string $k Clé de chiffrement
     * @param int $n Nombre de valeurs à générer
     * 
     * @return array{int} Suite chiffrante
     */
    function gen($k, $n){
        $s = ksa($k);
        $j = 0;
        $k = array();
    
        for ($i = 0; $i < $n; $i++){
            // On initialise le tableau de sortie avec n 0
            $k[] = 0;
        }
        
        $i = 0;
        for ($l = 0; $l < $n; $l++){ // /!\ Changement dans le sujet
            $i = ($i + 1) % 256;
            // On récupère la valeur du tableau à l'indice i
            // et on l'ajoute à j
            $j = ($j + $s[$i]) % 256;
    
            // On échange les valeurs de s[i] et s[j]
            $temp = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $temp;
    
            // On modifie la valeur de k à l'indice l
            // avec la valeur de s à l'indice (s[i] + s[j]) % 256
            $k[$l] = $s[($s[$i] + $s[$j]) % 256];
        }
    
        return $k;
    }

    /**
     * Chiffre un message à partir d'une clé
     * 
     * @param string $m Message à chiffrer
     * @param string $k Clé de chiffrement
     * 
     * @return string Message chiffré
     */
    function cypher($m, $k){
        $m = str_split($m);
        
        // On génère la suite chiffrante
        $s = gen($k, 128);
    
        for ($i = 0; $i < count($m); $i++){
            // On récupère le code ASCII de chaque caractère du message
            $m[$i] = intval(ord($m[$i]));
        }

        $size = strval(intval(count($m) / 10)).strval(count($m) % 10);

        while (count($m) < 32){
            // On ajoute à la fin du message le caractère NULL
            $m[] = intval(ord('0'));
        }
        
        $m[] = intval(ord($size[0]));
        $m[] = intval(ord($size[1]));

    
        $c = array();
        for ($i = 0; $i < count($m); $i++){
            // On effectue un XOR entre le message et la suite
    
            // On convertit le résultat en hexadécimal
            // et on l'ajoute au tableau de sortie
            if (strlen(dechex($m[$i] ^ $s[$i])) == 2)
                $c[] = dechex($m[$i] ^ $s[$i]);
            else
                // Si le code ASCII est inférieur à 16,
                // on ajoute un 0 devant le résultat
                $c[] = '0'.dechex($m[$i] ^ $s[$i]);
        }
    
        // On retourne le résultat sous forme de chaîne de caractères
        return implode('', $c);
    }

    /**
     * Déchiffre un message à partir d'une clé
     * 
     * @param string $c Message chiffré
     * @param string $k Clé de chiffrement
     * 
     * @return string Message déchiffré
     */
    function decypher($c, $k){
        $c = str_split($c, 2);
        $s = gen($k, 128);
    
        for ($i = 0; $i < count($c); $i++){
            // On convertit chaque caractère hexadécimal en décimal
            $c[$i] = hexdec($c[$i]);
        }
    
        $m = array();
        for ($i = 0; $i < count($c); $i++){
            // On effectue un XOR entre le message chiffré et la suite
            $m[] = chr($c[$i] ^ $s[$i]);
        }

        $size = intval($m[count($m) - 2].$m[count($m) - 1]);

        $m = array_slice($m, 0, $size);
    
        return implode('', $m);
    }

    /**
     * Change la clé de chiffrement
     * 
     * Modifie le fichier contenant la clé
     * Met à jour les mots de passe de la base de données
     * 
     * @param string $old_key Ancienne clé de chiffrement
     * @param string $new_key Nouvelle clé de chiffrement
     * 
     * @return void
     */
    function change_key($old_key, $new_key){
        $keyFile = fopen(KEY_PATH, "w") or die ("Impossible d'ouvrir en écriture le fichier key.txt");
        fwrite($keyFile, $new_key);
        fclose($keyFile);

        $tables = array('Users', 'Connections');
        
        $mysqli = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_passwd'], $GLOBALS['db_name']) or die ("Impossible de se connecter à la base de données");

        for ($i = 0; $i < count($tables); $i++){
            $stmt = $mysqli->prepare("SELECT login, password FROM ".$tables[$i]." WHERE login NOT LIKE 'rmv-%'");
            $stmt->execute();
            $stmt->bind_result($login, $password);
            $saveLogin = array();
            $savePassword = array();

            while ($stmt->fetch()){
                $password = decypher($password, $old_key);
                $password = cypher($password, $new_key);
                $savePassword[] = $password;
                $saveLogin[] = $login;
            }
            $stmt->close();

            for ($j = 0; $j < count($saveLogin); $j++){
                echo $saveLogin[$j].' : '.$savePassword[$j].'<br>';
                $stmt2 = $mysqli->prepare("UPDATE ".$tables[$i]." SET password = ? WHERE login = ?");
                $stmt2->bind_param("ss", $savePassword[$j], $saveLogin[$j]);
                $stmt2->execute();
                $stmt2->close();
            }
        }

        $mysqli->close();
    }