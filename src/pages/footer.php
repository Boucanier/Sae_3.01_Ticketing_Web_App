<footer>
    <?php
        $lang = 'en';

        $contact = array('fr' => '<a href="contact.php">Nous contacter</a>',
            'en' => '<a href="contact.php">Contact us</a>');

        $language = array('fr' => ' <a href="">Change language</a>',
            'en' => '<a href="">Changer la langue</a>');

        echo $contact[$lang];
        echo $language[$lang];

        if (isset($_SESSION['font']) && $_SESSION['font'] == "dyslexic"){
            $dys_on = array('fr' => '<a href="font_switch.php?font=normal">Passer en police normale</a>',
                'en' => '<a href="font_switch.php?font=normal">Change to normal font</a>');
            echo $dys_on[$lang];
        }
        else {
            $dys_off = array('fr' => '<a href="font_switch.php?font=dyslexic">Passer en police dyslexie</a>',
                'en' => '<a href="font_switch.php?font=dyslexic">Change to dyslexic font</a>');
            echo $dys_off[$lang];
        }
    ?>
</footer>