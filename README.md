# SAÉ 3.01 : Web App

![logo_uvsq](doc/annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

Groupe : **INF2 - FI A**

## Présentation

Ce projet a pour but de créer une application web de gestion de tickets. Cette application permettra à des utilisateurs de créer des tickets, de les assigner à des techniciens et de les gérer.

## Contenu

Tous les rapports sont disponibles dans le dossier [doc](doc/) :

- Rapports de [conception](doc/Conception/)
- Rapports de [spécification](doc/Specification/) :
  - [Base de données](doc/Specification/base_de_donnees.md)
  - [Cas d'utilisations](doc/Specification/cas_d_utilisations.md)
  - [Charte graphique](doc/Specification/charte_graphique.md)
  - [Configuration du Raspberry Pi](doc/Specification/config_rpi.md)
- Rapports de [tests](doc/Tests/) :
  - [Dossiers de tests unitaires](doc/Tests/Dossiers_tests/)

Les fichiers de code source sont disponibles dans le dossier [src](src/) :

- [Scripts SQL](src/db/):
  - [Création de la base de données](src/db/creation_mariadb.sql) (pour mariaDB)
  - [Création de la base de données](src/db/creation_mysql.sql) (pour mysql)
- [Fichiers du site](src/pages/):
  - Fichiers PHP
  - [Feuilles de style](src/pages/style/)
  - [Scripts JavaScript](src/pages/scripts/)
  - [Images utilisées par le site](src/pages/resources/)

## Installation

Pour installer le serveur web sur une machine Linux (basé sur Debian), il faut exécuter la script [installation.sh](installation.sh) depuis la racine du projet avec la commande *`bash installation.sh`*. Ce script va installer les paquets nécessaires au fonctionnement du serveur web, puis va configurer le serveur web et la base de données (cf [rapport de configuration du RPi](doc/Specification/config_rpi.md)).

## Crédits

Projet réalisé par :

- [Jules CHIRON](https://github.com/Boucanier)
- [Matis RODIER](https://github.com/matisrod)
- [Thomas GODINEAU](https://github.com/ThomasGODINEAU)

---

Projet réalisé dans le cadre de la SAÉ 3.01 du troisième semestre de BUT informatique à l'IUT de Vélizy
