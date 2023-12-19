<?php
    $tab = array('fr' => 'Page en construction', 'en' => 'Page under construction');
    
    include "header.php";
?>
<body>
    <main>
        <?php
            $title = array('fr' => 'Page en construction', 'en' => 'Page under construction');
            echo '<div id="construction_container">';
                echo '<h1>'.$title[$lang].'</h1>';
                echo '<div id="construction">';
                    echo '<div id="construction_text">';
                    $constructionText = array('fr' => 'Cette page est en cours de construction, merci de votre compréhension. Veuillez revenir plus tard.', 'en' => 'This page is under construction, thank you for your understanding. Please come back later.');
                    echo '<p>'.$constructionText[$lang].'</p>'; ?>
                </div>
                <img src="resources/chantier.png" alt="Image de construction">
            </div>
        </div>
    </main>
</body>
<?php
    include "footer.php";
?>
</html>