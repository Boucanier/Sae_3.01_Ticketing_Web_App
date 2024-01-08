<?php
    function ksa($k){
        $k = str_split($k);

        for ($i = 0; $i < count($k); $i++){
            $k[$i] = intval(ord($k[$i]));
        }

        $s = array();
        for ($i = 0; $i < 256; $i++){
            $s[] = $i;
        }

        $j = 0;
        for ($i = 0; $i < 256; $i++){
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
            $k[] = 0;
        }
        
        $i = 0;

        for ($l = 0; $l < $n; $l++){
            $i = ($i + 1) % 256;
            $j = ($j + $s[$i]) % 256;

            $temp = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $temp;

            $k[$l] = $s[($s[$i] + $s[$j]) % 256];
        }

        return $k;
    }


    function cypher($m, $k){
        $m = str_split($m);

        for ($i = 0; $i < count($m); $i++){
            $m[$i] = intval(ord($m[$i]));
        }

        $c = array();
        for ($i = 0; $i < count($m); $i++){
            if (strlen(dechex($m[$i] ^ $k[$i])) == 2)
                $c[] = dechex($m[$i] ^ $k[$i]);
            else
                $c[] = '0'.dechex($m[$i] ^ $k[$i]);
        }

        return implode('', $c);
    }


    function decypher($c, $k){
        $c = str_split($c, 2);

        for ($i = 0; $i < count($c); $i++){
            $c[$i] = hexdec($c[$i]);
        }

        $m = array();
        for ($i = 0; $i < count($c); $i++){
            $m[] = chr($c[$i] ^ $k[$i]);
        }

        return implode('', $m);
    }
?>