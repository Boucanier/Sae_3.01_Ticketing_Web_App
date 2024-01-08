<?php
    $keyFile = fopen("../../security/key.txt", "r") or die ("Impossible d'ouvrir le fichier key.txt");
    $key = fgets($keyFile);
    $key = substr($key,0,strlen($key)-1);
    fclose($keyFile);

    function ksa($k){
        // On crée un tableau de caractères à partir de la clé
        $k = str_split($k);
        
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


    function gen($s, $n){
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


    function cypher($m, $k){
        $m = str_split($m);
        
        // On génère la suite chiffrante
        $s = gen(ksa($k), 128);
    
        for ($i = 0; $i < count($m); $i++){
            // On récupère le code ASCII de chaque caractère du message
            $m[$i] = intval(ord($m[$i]));
        }
    
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


    function decypher($c, $k){
        $c = str_split($c, 2);
        $s = gen(ksa($k), 128);
    
        for ($i = 0; $i < count($c); $i++){
            // On convertit chaque caractère hexadécimal en décimal
            $c[$i] = hexdec($c[$i]);
        }
    
        $m = array();
        for ($i = 0; $i < count($c); $i++){
            // On effectue un XOR entre le message chiffré et la suite
            $m[] = chr($c[$i] ^ $s[$i]);
        }
    
        return implode('', $m);
    }
?>