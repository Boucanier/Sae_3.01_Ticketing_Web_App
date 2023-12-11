<footer>
    <?php
        $contact = array('fr' => 'Nous contacter', 'en' => 'Contact us');

        echo '<a href="contact.php">'.$contact[$lang].'</a>';

        $language = array('fr' => 'Switch to english', 'en' => 'Passer en français');

        $altValue_fr = array('drapeau&nbsp;français', 'drapeau&nbsp;anglais');
        $altValue_en = array('french&nbsp;flag', 'english&nbsp;flag');
        $altValue = array('fr' => $altValue_fr, 'en' => $altValue_en);

        echo '<div id=languages><a href="footer_switch.php?lang=fr" id="change_fr"><div id=fr_text></div><img src="resources/fr_flag.png" alt='.$altValue[$lang][0].' id="fr_flag"></a>';
        echo '<a href="footer_switch.php?lang=en" id="change_en"><img src="resources/uk_flag.png" alt='.$altValue[$lang][1].' id="en_flag"><div id=en_text></div></div></a>';

        if (isset($_SESSION['font']) && $_SESSION['font'] == "dyslexic"){
            $dys_on = array('fr' => 'Passer en police normale', 'en' => 'Change to normal font');
            echo '<a href="footer_switch.php?font=normal">'.$dys_on[$lang].'</a>';
        }
        else {
            $dys_off = array('fr' => 'Passer en police dyslexie', 'en' => 'Change to dyslexic font');
            echo '<a href="footer_switch.php?font=dyslexic">'.$dys_off[$lang].'</a>';
        }
    ?>
</footer>