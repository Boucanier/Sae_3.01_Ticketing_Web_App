#! /bin/bash


read -p "Si un serveur apache est déjà installé sur cette machine, ce script écrasera vos données, voulez-vous continuer ? [o/n] " goValue

if [[ $goValue != "o" ]]
then
	echo -e "\nAbandon\n"
	exit 1
fi

downloadPath=$(pwd | rev | cut -f2-50 -d/ | rev)

# Installation des dépendances
sudo apt update
sudo apt purge apache2 php*
sudo apt install apache2 php8.2 php8.2-mysql mariadb-common mariadb-server



# Déplacement des fichiers
saePath="/home/$USER/sae"
sudo rm -r $saePath
mkdir $saePath
cp -r src $saePath/src



# Création de la base de données
sudo mysql -e "source $saePath/src/db/creation_mariadb.sql"



# Configuration du serveur
fileRoot="/etc/apache2/sites-enabled/000-default.conf"
rootLine="        DocumentRoot \/home\/$USER\/sae\/src\/pages"

lineNbr=$(grep --line-number 'DocumentRoot /var/www' $fileRoot | cut -f1 -d:)

if [[ -z $lineNbr ]]
then
	echo -e "\nProblème dans $fileRoot, DocumentRoot introuvable, le serveur doit être initialisé\n"
	echo -e "\nSupprimez puis réinstallez apache2"
	exit 1
else
	sudo cp $fileRoot $fileRoot.old
	sudo sed -i "${lineNbr}s/.*/${rootLine}/" $fileRoot
fi


fileConf="/etc/apache2/apache2.conf"
confLine="<Directory \/home\/$USER\/sae\/src\/pages>"

lineNbr=$(grep --line-number 'Directory /var/www' $fileConf | cut -f1 -d:)


if [[ -z $lineNbr ]]
then
	echo -e "\nProblème dans $fileConf, le serveur doit être initialisé\n"
	echo -e "\nSupprimez puis réinstallez apache2"
	exit 1
else
	sudo cp $fileConf $fileConf.old
	sudo sed -i "${lineNbr}s/.*/${confLine}/" $fileConf
fi

sudo systemctl restart apache2


echo -e "\nInstallation du serveur terminée, vous pouvez supprimer le répertoire $downloadPath"
exit 0