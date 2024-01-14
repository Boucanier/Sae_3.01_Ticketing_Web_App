# SAÉ 3.01 : Application web de gestion de tickets

![Raspberry Pi](https://img.shields.io/badge/-RaspberryPi-C51A4A?style=for-the-badge&logo=Raspberry-Pi)
![Apache](https://img.shields.io/badge/apache-%23D42029.svg?style=for-the-badge&logo=apache&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)

![logo_uvsq](doc/annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

Groupe : **INF2 - FI A**

## Présentation

Ce projet a pour but de créer une **application web de gestion de tickets**. Cette application permettra à des utilisateurs de créer des tickets, de les assigner à des techniciens et de les gérer.

## Contenu

Tous les rapports sont disponibles dans le dossier [doc](doc/) :

- Rapports de [conception](doc/Conception/)
- Rapports de [spécification](doc/Specification/) :
  - [Base de données](doc/Specification/base_de_donnees.md)
  - [Cas d'utilisations](doc/Specification/cas_d_utilisations.md)
  - [Charte graphique](doc/Specification/charte_graphique.md)
  - [Configuration du Raspberry Pi](doc/Specification/config_rpi.md)
  - [Rapport de cryptographie](doc/Specification/cryptographie.pdf)
  - [Rapport de statistiques](doc/Specification/statistiques.pdf)
- Rapports de [tests](doc/Tests/) :
  - [Dossiers de tests unitaires](doc/Tests/Dossiers_tests/)
- Rapport de [droits](doc/Droit/) :
  - [Droits des contrats et du numérique](doc/Droit/rapport_droit.pdf)

Les fichiers de code source sont disponibles dans le dossier [src](src/) :

- [Scripts **SQL**](src/db/):
  - [Création de la base de données](src/db/creation_mariadb.sql) (pour *mariaDB*)
  - [Création de la base de données](src/db/creation_mysql.sql) (pour *mysql*)
  - [Insertion de données de test](src/db/insert.sql)
- [Fichiers du site](src/pages/):
  - Fichiers **PHP**
  - [Feuilles de style](src/pages/style/)
  - [Scripts JavaScript](src/pages/scripts/)
  - [Images utilisées par le site](src/pages/resources/)
- [Application **Shiny**](src/stats):
  - [Application](src/stats/app.R)
  - Fichiers **csv** :
    - [Connexions](src/stats/connexions.csv)
    - [Tickets](src/stats/tickets.csv)

## Installation

Pour installer le serveur web sur une machine **Linux** (*basé sur *Debian**), il faut exécuter la script [installation.sh](installation.sh) depuis la racine du projet avec la commande *`sudo bash installation.sh`*. Ce script va installer les paquets nécessaires au fonctionnement du serveur web, puis va configurer le serveur web et la base de données.

Pour installer le serveur web **ET** le serveur shiny, il faut exécuter le script [installation.sh](installation.sh) depuis la racine du projet avec le paramètre ***-shiny*** : *`sudo bash installation.sh -shiny`*.

Consulter le [rapport de configuration du RPi](doc/Specification/config_rpi.md) pour plus d'informations.

## Remarques

Attention, certains fichiers comme les **maquettes** et leurs rapports ne sont pas disponible depuis toutes les versions de ce projet. Il faut consulter les différentes [*releases*](https://github.com/Boucanier/Sae_3.01_Ticketing_Web_App/releases) pour les retrouver.

## Crédits

Projet réalisé par :

- [Jules CHIRON](https://github.com/Boucanier)
- [Matis RODIER](https://github.com/matisrod)
- [Thomas GODINEAU](https://github.com/ThomasGODINEAU)

---

Projet réalisé dans le cadre de la SAÉ 3.01 du troisième semestre de BUT informatique à l'IUT de Vélizy
