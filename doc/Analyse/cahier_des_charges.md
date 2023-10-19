# Recueil des besoins

![logo_uvsq](../annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

Groupe : **INF2 - FI A**

## Introduction

Le document suivant a pour objectif de présenter le projet de la SAÉ 3.01 ainsi que ses objectifs
réunis dans un cahier des charges. Dans le cadre de cette SAÉ, le client demande la réalisation
d’une application web de ticketing afin de renseigner les problèmes informatiques au sein de l’IUT
dans le but qu’ils soient résolus. L’application web sera un site en PHP avec une feuille de style
CSS qui accèdera à une base de données MySql. Toutes les communications entre les utilisateurs, le
site web et la base de données se feront par l’intermédiaire d’un serveur Apache2. Le tout sera
installé sur un Raspberry Pi connecté au réseau de l’IUT.  Afin de réaliser cela nous allons détailler
les attentes du client, nous verrons ensuite les pré-requis pour réaliser ce projet et enfin les priorités.

## Énoncé

Commençons tout d’abord par présenter l’énoncé du projet et ce que nous pouvons en déduire.
Il s’agit de mettre en place une application web en PHP en liaison avec une base de données
MySQL qui aura pour but de recueillir les demandes de dépannage, par le biais de tickets,
des différents utilisateurs dans les salles de l’IUT.
C’est une plateforme de ticketing interne.

La plateforme accueillera cinq types d’utilisateurs différents :

- le visiteur (sans compte)
- l’utilisateur inscrit
- l’administrateur web
- le technicien
- l’administrateur système

À présent, nous allons voir ce que les différents types d’utilisateurs seront capable de réaliser :

### Le visiteur

Le visiteur peut accéder à la page d’accueil qui explique le but de la plateforme avec un texte
et une vidéo et consulter les 10 derniers tickets enregistrés. Il ne peut pas utiliser la plateforme
pour faire une demande de dépannage. Il peut aussi créer un compte afin de devenir un utilisateur inscrit.
Pour cela, il devra remplir un formulaire d’inscription avec la confirmation d’une captcha.

### L’utilisateur inscrit

Dans le cadre de l'application web, l'utilisateur inscrit sera en capacité de :

- Se connecter à son compte avec son login et son mot de passe
- Accéder à la page profil où il pourra changer son mot de passe et visualiser ses informations
- Accéder à son tableau de bord qui liste les tickets créé par cet utilisateur
- Il peut les consulter pour avoir plus de détails
- Faire une demande de dépannage depuis son tableau de bord, c’est à dire ouvrir un ticket
- Se déconnecter

### L’administrateur web

Il n’y a qu’un seul administrateur web enregistré dans la base de données. L’administrateur web peut :

- Se connecter
- Gérer la liste des libellés affectés aux différents problèmes qui peuvent être rencontrés dans les salles informatiques
- Définir les différents statuts du ticket : ouvert, en cours de traitement, fermé
- Redéfinir les différents niveaux d’urgences accordés au ticket selon le point de vue de l’utilisateur: 4 (faible), 3 (moyen), 2 (important), 1 (urgent)
- Créer les comptes des techniciens, par défaut il y en a deux : tec1 et tec2 qui possèdent le mot de passe tec
- Visualiser les tickets en état ouvert et en cours de traitement et peut les affecter à un technicien
- Se déconnecter

### Le technicien

Le technicien peut :

- Se connecter
- S’attribuer des tickets pour les prendre en charge
- Se déconnecter

### L’administrateur système

Et enfin, l'administrateur système sera capable de réaliser les tâches suivantes:

- Se connecter
- Accéder aux journaux d’activité de l’application web (tickets, tickets fermés, connexions échouées)
- Se déconnecter

### Tickets

Pour les tickets, la demande de dépannage enregistrera :

- la nature du problème (libellé)
- le niveau d’urgence estimée par l’utilisateur
- la description problème
- La salle d’où vient le problème
- le login de l’utilisateur
- les nom et prénom de l’utilisateur
- L’état du ticket (ouvert, en cours de traitement, fermé). 
Il est par défaut ouvert et ne peut être changé par l’utilisateur.
- L’adresse ip sera également enregistrée mais ne sera visible uniquement par l’administrateur système.

Une fois créé, le ticket apparaîtra dans le tableau de bord de l’utilisateur, des techniciens, 
de l’administrateur web ainsi que dans le journal d’activité du serveur.

### Journeaux d'activités

Il y a différents journaux d’activités visibles uniquement par 
l’administrateur système sur une page qui lui est propre :

- Journal ticket : à chaque création d’un ticket par un utilisateur, un journal d’activité est enregistré sur le système.
Ce journal contient les éléments suivants : la date, l’adresse ip et le niveau d’urgence.
- Journal de connexions échouées : à chaque tentative de connexion infructueuse sur la plateforme,
un journal d’activité sera également enregistré avec la date, le login, le mot de passe tenté et l’adresse IP.
- Journal de ticket fermé (historique) : Les tickets fermés sont stockés dans un historique,
ils contiennent le niveau d’urgence, la salle, le libellé, les nom et prénom de l’utilisateur
qui a créé le ticket, les dates de création de fermeture du ticket.

Ces données seront stockées à des fins de statistique par l’administrateur système.

Ensuite, abordons comment le système se doit d’être implémenté:
L’ application web sera installée sur un Raspberry Pi 4 connecté au réseau de
l’IUT qui sera disponible en connexion ssh depuis les postes des salles machines
et à terme en tunnel ssh depuis l’extérieur.

Il faudra préparer une carte SD pour y installer :

- le système d’exploitation
- un serveur Apache2
- le site web php
- et la base de données Mysql.

Dans la première version du projet, nous proposons au client une version du site web statique afin qu’il puisse visualiser la base de notre travail. Pour réaliser cela, voici les différentes étapes à effectuer :
- Conception et réalisation des maquettes
- Réalisation de la charte graphique
- Création des logos
- Programmation des pages du site web statique (maquette HTML)
Par la suite, cette maquette HTML, ainsi que la charte graphique et le logo choisi représenteront la structure finale du site web dans le projet final.

## Pré-requis

Dans cette partie, nous allons détailler et expliquer les connaissances requises,
les ressources matérielles et logicielles ainsi que les compétences nécessaires afin
de réaliser les différentes parties du projet. 

Afin de réaliser le premier livrable du projet, nous avons besoin de plusieurs pré-requis
pour réaliser le site web statique. En effet, comme nous l’avons vu précédemment,
la réalisation de cette version a demandé de nombreuses compétences ainsi que l’emploi
de divers outils et logiciels. Tout d’abord pour réaliser les maquettes, nous avons utilisé
le site web excalidraw. Il s’agit d’un site permettant de réaliser des schémas.
Ensuite pour réaliser les logos, nous avons utilisé le logiciel de création graphique Canva.
Enfin, pour réaliser les pages html du site web statique, nous avons utilisé les logiciels
WebStorm ainsi que Visual Studio Code qui sont toutes les deux des environnements de développement.
Dans le cadre de l’emploi de ces différents logiciels et outils, nous avons eu besoin d’utiliser
les ordinateurs de l’IUT sur nos heures de travail, ainsi que des postes de travail personnels
lorsque nous travaillions chez nous.

À présent, passons aux connaissances et compétences nécessaires pour le bon déroulement
des activités de production de cette version. Afin de créer les logos demandés,
il nous faut une bonne connaissance du site web Canva. Pour ce qui est de la création
des pages du site web statique, cela nécessite la connaissance des langages de programmation HTML5,
qui permet de faire le site web et CSS3, qui permet de faire le style de ce site web.

## Livrables

Le premier livrable contient le site web static (HTML et CSS). Il sera rendu la semaine du 16 octobre 2023.
