# Rapport de spécification : Configuration du Raspberry Pi

![logo*uvsq](../annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

Groupe : **INF2 - FI A**

## Introduction

La plateforme de ticketing qui fait l'objet de ce projet est destinée à être hébergée sur un Raspberry Pi. Ce document présente les choix que nous avons fait pour configurer le Raspberry Pi, conformément à sa conception dans la [conception architecturale](../Conception/conception_architecturale.md). Ce rapport présente les différentes étapes de configuration du Raspberry Pi.

## Distribution du Raspberry Pi

Nous avons choisi d'utiliser une distribution de Linux fourni par Raspberry Pi : Raspberry Pi OS (Raspbian) en 64-bit. Cette distribution est basée sur Debian.

Nous avons utilisé le logiciel Pi imager pour installer l'image du système sur une carte SD de 32 Go.

## Installation des paquets nécessaires

Afin de pouvoir utiliser le Raspberry Pi pour héberger notre plateforme, nous avons installé les paquets suivants :

- **apache2** : serveur web
- **php 8.2** : pour interpréter le code PHP de nos pages web
- **php 8.2-mysql** : pour pouvoir effectuer des requêtes SQL sur notre base de données depuis les pages web
- **MariaDB** : pour héberger la base de données

La distribution que nous utilisons est basée sur Debian, nous avons donc utilisé le gestionnaire de paquets **apt** pour installer ces paquets. Par exemple, pour installer le paquet apache2 : *`sudo apt install apache2`*.

## Configuration de la base de données

Afin de créer la base de données, nous avons exécuté le script SQL situé dans [ce fichier](../../src/db/creation.sql)(*branche en cours : website*). Ce script crée la base de données, les tables nécessaires au fonctionnement de la plateforme et l'utilisateur qui sera utilisé par la plateforme pour accéder à la base de données.

## Configuration du serveur web

Afin de vérifier que le serveur Apache soit bien lancé et fonctionne correctement, nous vérifions son état avec la commande *`systemctl status apache2`*. Si le serveur n'est pas lancé, nous le lançons avec la commande *`systemctl start apache2`*.

Pour vérifier que le serveur fonctionne, nous accédons à la page de test située à l'adresse *localhost/index.html*.

## Configuration du Raspberry Pi

Afin de pouvoir accéder au Raspberry Pi depuis l'extérieur, nous avons activé le service ssh dès le démarrage du Raspberry Pi avec la commande *`systemctl enable ssh.service`*.

Afin de prévenir tout problème avec la carte SD, nous avons créé une copie du système chez nous.
