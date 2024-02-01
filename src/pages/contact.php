<?php
$tab = array('fr' => 'Contact', 'en' => 'Contact');

include "header.php";
$mail = array('fr' => '<p>Si vous souhaitez nous contacter, cliquez sur <a href="mailto:?to=contact.golemcorp@gmail.com" target="_blank" class="link_on_page">ce lien</a></p>',
    'en' => '<p>If you want to contact us, please click on <a href="mailto:?to=contact.golemcorp@gmail.com" target="_blank" class="link_on_page">this link</a></p>');

$project = array('fr' => '<p>Voici notre <a href="https://github.com/Boucanier/Sae_3.01_Ticketing_Web_App" target="_blank" class="link_on_page">lien GitHub</a> pour ce projet</p>',
    'en' => '<p>Here is our <a href="https://github.com/Boucanier/Sae_3.01_Ticketing_Web_App" target="_blank" class="link_on_page">Github link</a> for this project</p>');
?>
<main>
    <div id="contact_containers">
        <div class="contact_text">
            <?php
            echo $mail[$lang];
            ?>
            <a href="mailto:?to=contact.golemcorp@gmail.com" target="_blank"><img src="resources/logo_mail.png" alt="logo Mail"></a>
        </div>
        <div class="contact_text">
            <?php
            echo $project[$lang];
            ?>
            <a href="https://github.com/Boucanier/Sae_3.01_Ticketing_Web_App" target="_blank"><img src="resources/logo_github.png" alt="logo Github"></a>
        </div>
    </div>
</main>
<?php
include "footer.php";
?>
</body>
</html>
