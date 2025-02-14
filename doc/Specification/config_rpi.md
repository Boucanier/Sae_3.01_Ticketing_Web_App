# Rapport de spécification : Configuration du Raspberry Pi

![logo*uvsq](../annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

Groupe : **INF2 - FI A**

## Introduction

La plateforme de ticketing qui fait l'objet de ce projet est destinée à être hébergée sur un Raspberry Pi. Ce document présente les choix que nous avons fait pour configurer le Raspberry Pi, conformément à sa conception dans la [conception architecturale](../Conception/conception_architecturale.md). Ce rapport présente les différentes étapes de configuration du Raspberry Pi.

**Note** : l'adresse ip du Raspberry Pi est ***192.168.1.163*** et son nom est ***raspb03***.

## Distribution du Raspberry Pi

Nous avons choisi d'utiliser une distribution de Linux fourni par Raspberry Pi : Raspberry Pi OS (Raspbian) en 64-bit. Cette distribution est basée sur Debian.

Nous avons utilisé le logiciel **Pi imager** pour installer l'image du système sur une carte SD de 32 Go.

## Installation des paquets nécessaires

Afin de pouvoir utiliser le Raspberry Pi pour héberger notre plateforme, nous avons installé les paquets suivants :

- **apache2** : serveur web
- **php 8.2** : pour interpréter le code PHP de nos pages web
- **php 8.2-mysql** : pour pouvoir effectuer des requêtes SQL sur notre base de données depuis les pages web
- **MariaDB** : pour héberger la base de données
- **r-base** : pour la page **R shiny**
- **shiny** : pour le serveur shiny (module de **R**)

La distribution que nous utilisons est basée sur Debian, nous avons donc utilisé le gestionnaire de paquets **apt** pour installer ces paquets. Par exemple, pour installer le paquet apache2 : *`sudo apt install apache2`*.

Nous installons le paquet **shiny** depuis R avec la commande : *`install.packages('shiny')`*.

## Configuration de la base de données

Afin de créer la base de données, nous avons exécuté le script SQL situé dans [ce fichier](../../src/db/creation_mariadb.sql). Ce script crée la base de données, les tables nécessaires au fonctionnement de la plateforme et l'utilisateur qui sera utilisé par la plateforme pour accéder à la base de données. Il insère également dans les tables les utilisateurs nécessaires au fonctionnement de la plateforme (*admin web* et *admin système*) ainsi que deux techniciens. Pour plus de détails : [Rapport de base de données](base_de_donnees.md)

## Configuration du serveur web

Afin de vérifier que le serveur Apache soit bien lancé et fonctionne correctement, nous vérifions son état avec la commande *`systemctl status apache2`*. Si le serveur n'est pas lancé, nous le lançons avec la commande *`systemctl start apache2`*.

Pour vérifier que le serveur fonctionne, nous accédons à la page de test située à l'adresse *localhost/index.html*.

Pour que nous accédions directement à la plateforme depuis l'adresse ***raspb03***, nous devons modifier la configuration du serveur Apache.

- Premièrement, nous modifions le fichier **/etc/apache2/sites-available/000-default.conf**. Dans ce fichier, nous modifions *DocumentRoot*. Nous remplaçons */var/www/html* par */home/pisae/sae/src/pages* (répertoire contenant le site web). Ainsi, notre site web devient le site par défaut à l'adresse de notre Raspberry Pi.

- Deuxièmement, nous créons un fichier de configuration **saeconf.conf** dans le répertoire **/etc/apache2/conf-available**. Dans ce fichier, nous ajoutons les lignes suivantes :

  ```apache
  <Directory /home/pisae/sae/src/pages>
    AllowOverride None
    Require all granted
  </Directory>
  ```

  Ces lignes permettent de définir les paramètres du répertoire contenant le site web. Nous n'ajoutons pas l'option *Options Indexes* car nous ne souhaitons pas que les personnes accédant à notre site puissent lister les fichiers présents sur le serveur.

- Troisièmement, nous activons le fichier de configuration avec la commande *`a2enconf saeconf.conf`*.

Pour que ces modifications soient prises en compte, nous rechargeons le serveur Apache avec la commande *`systemctl reload apache2`*.

## Configuration du Raspberry Pi

### Gestions des connexions

#### Connexion SSH

Afin de pouvoir accéder au Raspberry Pi depuis l'extérieur, nous avons activé le service ssh dès le démarrage du Raspberry Pi avec la commande *`systemctl enable ssh.service`*.

#### Système fail2ban

Afin de sécuriser un minimum le Raspberry Pi, nous avons installé le système **fail2ban** avec la commande *`sudo apt install fail2ban`*. Pour cela, nous devons aussi installé les modules *rsyslog* et *iptables* avec la commande *`sudo apt install rsyslog iptables`*. Nous avons ensuite activé le service fail2ban avec la commande *`sudo systemctl enable fail2ban`*.

Pour configurer fail2ban, nous avons créé le fichier */etc/fail2ban/jail.d/saeban.conf* avec le contenu suivant :

```conf
[DEFAULT]
ignoreip = 127.0.0.1 192.168.1.163
findtime = 1h
bantime = 24h
maxretry = 3
```

Ce fichier permet de définir les paramètres par défaut de fail2ban. Nous avons ajouté l'adresse ip du Raspberry Pi dans la liste des adresses ip ignorées afin de ne pas être banni de notre propre serveur. Nous avons aussi défini le temps de bannissement à 24h et le nombre de tentatives de connexion avant bannissement à 3, toutes les heures.

#### Versions du site

La configuration réseau du Raspberry Pi dans le réseau de l'IUT a été assurée par M. Hoguin. Nous pouvons donc accéder à notre Raspberry Pi à distance. Cependant, on ne peut y accéder que depuis le réseau de l'IUT. Nous copions donc les fichiers de la plateforme sur le Raspberry Pi depuis un ordinateur de l'IUT. Ainsi, il se peut que le site ne soit pas tout le temps à jour sur le Raspberry Pi.

---

### Fichiers de logs

Les données enregistrées par la plateforme dans sa base de données (connexions, tickets ...) sont quotidiennement sauvegardées dans des fichiers de logs. Ces fichiers sont situés dans le répertoire *logs/* à la racine du projet. Cependant, si l'on souhaite changer l'emplacement de ce répertoire, il faut modifier le fichier [logs.json](../../config/logs.json) dans le répertoire *config/* du projet. Ce fichier indique l'emplacement des logs au serveur web. Les fichiers csv sont créés **tous les jours à 2h du matin**.

Afin de faire cela, nous avons créé un script bash ([logs_job.sh](../../src/logs_job.sh)) qui effectue cette tâche. Ce script est exécuté tous les jours à 2h du matin avec la commande par un *cron*. Pour créer le cron, nous exécutons la commande *`crontab -u pisae config/cron`*.  de créer le cron, nous créons un fichier *cron* dans le répertoire *config/* du projet avec le contenu suivant :

```cron
00 02 * * * /home/pisae/sae/src/logs_job.sh pisae
```

***Attention***, cette commande supprime tous les crons déjà existants !

Pour récupérer les données de la base de données, nous exécutons des requêtes **SQL** depuis ce script. Pour pouvoir se connecter à la base de données, ce script lit le fichier [db_credentials.json](../../config/db_credentials.json) qui contient les identifiants de connexion à la base de données.

Ce script bash lit des fichiers *json*, c'est pourquoi nous avons installé le paquet **jq** avec la commande *`sudo apt install jq`*.

Conformément aux [recommandations de la CNIL](https://www.cnil.fr/sites/cnil/files/atoms/files/recommandation_-_journalisation.pdf) (*Comission Nationale de l'Informatique et des Libertés*), nous avons choisi de conserver les logs pendant une durée de **6 mois** (*180 jours*). Ainsi, le script supprime les logs qui ont plus de 6 mois à chaque exécution.

---

### Script d'installation

Afin de prévenir tout problème avec la carte SD, nous avons créé une copie du système chez nous. De plus, nous avons créé [un script bash](../../installation.sh) qui effectue les actions décrites dans ce rapport afin de faciliter la configuration du Raspberry Pi en cas de problème sur la carte sd ou si on souhaite installer installer le serveur pour faire des tests chez nous. Ce script est exécutable en root sur une distribution de linux basée sur Debian avec la commande *`sudo bash installation.sh`* depuis la racine du projet. ***Attention***, ce script supprime **toutes les versions de PHP existantes** sur le système avant d'installer PHP 8.2 et les modules que nous utilisons. Il faut donc faire attention à ne pas l'exécuter sur un système qui utilise PHP pour d'autres applications.

Ce script conserve une **copie des fichiers** du serveur au cas où l'on rencontre un problème avec une nouvelle version.

#### Remarques

Comme expliqué dans le [rapport de statistiques](statistiques.md), nous n'avons pas installé le serveur shiny sur le Raspberry Pi.
Cependant, il est quand même possible de lancer le serveur shiny sur le Raspberry Pi. Pour cela, il faut exécuter le script avec l'option *--shiny* : *`sudo bash installation.sh --shiny`*.

***Attention***, pour afficher les statistiques du serveur **local**, il faut modifier l'*iframe* dans le fichier [stats.php](../../src/pages/stats.php) en remplaçant l'adresse *Boucanier.shinyapps.io/proba* par *localhost:3000*.

Si l'on ne souhaite pas écraser la base de données existante, il faut rajouter l'option *--save-db* : *`sudo bash installation.sh --save-db`*.

Si l'on souhaite conserver les fichiers de logs déjà existants, il faut rajouter l'option *--save-logs* : *`sudo bash installation.sh --save-logs`*.
