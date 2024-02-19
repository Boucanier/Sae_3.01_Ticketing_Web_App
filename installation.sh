#! /bin/bash


# On récupère l'option passée en paramètre
option=$1

# On vérifie que l'option est bien -shiny ou vide
if [[ $option != "-shiny" ]] && [[ -n $option ]]
then
	echo -e 'Option `'$option'` invalide\n\n Abandon'
	exit 1
fi


# On vérifie que le script est bien exécuté en root (Effective User ID = 0)
if [[ $EUID != 0 ]]
then
	echo -e 'Ce script doit être exécuté en root\n\n Abandon'
	exit 1
fi

read -p 'Si un serveur apache est déjà installé sur cette machine, ce script peut modifier votre configuration. Toutes les versions de PHP présentes sur cette machine vont être supprimées, voulez-vous continuer ? [o/n] ' goValue

if [[ $goValue != "o" ]]
then
	echo -e '\n Abandon'
	exit 1
fi


# On récupère la version de PHP installée sur la machine
phpVersion=$(php -v | grep -o 'PHP [0-9]\.[0-9]' | cut -f2 -d' ')

if [[ $phpVersion != "8.2" ]]
then
	echo -e '\n Désinstallation de PHP\n'

	# On supprime toutes les versions de PHP possiblement existantes sur cette machine pour éviter tout problème
	sudo apt purge -y php*
fi

# Installation des dépendances nécessaires
sudo apt update
sudo apt install -y apache2 php8.2 php8.2-mysql mariadb-common mariadb-server jq


# Installation du serveur shiny (si l'option -shiny est passée en paramètre)
if [[ $option == "-shiny" ]]
then
	# Installation de R
	sudo apt install -y r-base


	# Installation du module shiny
		# On vérifie si le package existe
	if [[ $(Rscript -e 'installed.packages()') != *"shiny"* ]]
	then
		echo -e '\nInstallation du module shiny'
		sudo Rscript -e "install.packages('shiny')"
	else
		# Sinon on l'installe
		echo -e '\nModule shiny déjà installé'
	fi


	# On lance le serveur shiny
	cd src/stats
	sudo Rscript app.R &
	cd ../..
fi


# Déplacement des fichiers
# $SUDO_USER renvoie l'utilisateur qui a appelé la commande sudo
saePath='/home/'$SUDO_USER'/sae'
sudo rm -r $saePath
mkdir $saePath
cp -r src $saePath/src


# On crée les dossiers pour stocker les logs
mkdir $saePath/logs
mkdir $saePath/logs/connections
mkdir $saePath/logs/closed_tickets
mkdir $saePath/logs/tickets
mkdir $saePath/config/

# On enregistre le chemin des logs dans un fichier de configuration
echo -e "{\"logsPath\":\"$saePath/logs/\"}" > $saePath/config/logs.json

# On rajoute les droits d'exécution sur le script de création des logs
sudo chmod +x $saePath/src/logs_creation.sh

# On ajoute le cron pour l'ajout des logs
	# ATTENTION : cela supprime tous les crons déjà existants
echo -e "00 02 * * * $saePath/src/logs_creation.sh $SUDO_USER" > $saePath/config/cron
crontab -u $SUDO_USER $saePath/config/cron


# On crée le fichier contenant la clé de chiffrement des mdp
	# On rend ce fichier accessible en écriture au serveur apache
	# Il faut impérativement changer la clé de chiffrement par défaut depuis un compte d'admin système
mkdir -p $saePath/security
echo "default" > $saePath/security/key.txt
sudo chmod 666 $saePath/security/key.txt


# Création de la base de données
sudo mysql -e "source $saePath/src/db/creation_mariadb.sql" 


# On supprime toute configuration pour le dossier de notre site déjà existante dans apache2.conf
confSearch='<Directory /home/'$SUDO_USER'/sae*'
confFile='/etc/apache2/apache2.conf'

# On recherche la ligne où se trouve la configuration
fline=$(grep --line-number "$confSearch" "$confFile" | cut -f1 -d:)

# On recherche toutes les lignes de fin de configuration
lline=$(grep --line-number '</Directory>' "$confFile" | cut -f1 -d:)


	# On supprime les lignes pour ce dossier si elles existent
if [[ -z fline ]]
then
	echo -e '\nConfiguration trouvée\nSuppression de cette configuration'
	nline=$(echo $lline | grep -o ' ' | wc -l)
	toCut=0

	for (( i=1; i<=$nline+1; i++ ))
	do
		new=$(echo $lline | cut -f$i -d' ')

		# On cherche la fin de la configuration qui nous intéresse
		if [[ $new > $fline ]]
		then
			toCut=$new
			i=$nline+1
		fi
	done

	# On calcule le nombre de lignes à supprimer
	diff=$(( $toCut-$fline ))
	for (( i=0; i<=$diff; i++ ))
	do
		sudo sed -i $fline'd' $confFile
	done
else
	echo -e '\nPas de configuration déjà existante\n...'
fi


# On rajoute un fichier de configuration pour notre dossier contenant le site dans conf-available (on l'écrase si il existe déjà)
confLine='<Directory /home/'$SUDO_USER'/sae/src/pages>\n\tRequire all granted\n\tAllowOverride None\n</Directory>'
echo -e 'Création du fichier de configuration saeconf.conf\n...'
sudo echo -e $confLine > /etc/apache2/conf-available/saeconf.conf


# On active cette configuration
sudo a2enconf saeconf.conf


# Maintenant on modifie la page par défaut du site
fileRoot='/etc/apache2/sites-available/000-default.conf'
saeLine='DocumentRoot '$saePath'/src/pages'
rootLine='\tDocumentRoot \/home\/'$SUDO_USER'\/sae\/src\/pages'

# Ligne contenant DocumentRoot
siteConfLine=$(grep --line-number 'DocumentRoot' $fileRoot | cut -f1 -d:)

# Ligne contenant DocumentRoot pour notre site
saeConfLine=$(grep --line-number "$saeLine" $fileRoot | cut -f1 -d:)

# Si la ligne DocumentRoot n'esiste pas il y a un problème, il faut vérifier à la main
if [[ -z $siteConfLine ]]
then
	echo -e '\n DocumentRoot introuvable, vérifiez '$fileRoot
	exit 1
fi

# On regarde si le site par défaut n'est pas déjà celui de la plateforme
if [[ -z $saeConfLine ]]
then
	# On crée une copie de l'ancien fichier de configuration en cas de problème
	sudo cp $fileRoot $fileRoot.old
	
	# On change la ligne de DocumentRoot
	sudo sed -i "${siteConfLine}s/.*/${rootLine}/" $fileRoot
	echo -e '\nSite par défaut configuré'

else
	echo -e '\nSite par défaut déjà configuré'
fi


# On recharge apache
sudo systemctl reload apache2
echo -e '\nConfiguration mise à jour'


# On met à jour les droits des fichiers pour qu'ils appartiennent à la bonne personne
sudo chown -R $SUDO_USER $saePath


echo -e '\nInstallation du serveur terminée, vous pouvez supprimer le dossier '$(pwd)
exit 0
