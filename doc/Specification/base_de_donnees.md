# Rapport de spécification : Base de données

![logo*uvsq](../annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

Groupe : **INF2 - FI A**

## Introduction

Ce document présente les choix que nous avons fait pour créer la base de données, conformément à sa conception dans la [conception architecturale](../Conception/conception_architecturale.md). Ce rapport présente les différentes tables de la base de données ainsi que leurs colonnes, leurs types et leurs contraintes.

Les fichiers de création de la base de données sont disponibles dans le dossier [src/db](../../src/db), il y a un fichier de création pour une base de données MySQL et son équivalent pour une base de données MariaDB, respectivement [creation_mysql.sql](../../src/db/creation_mysql.sql) et [creation_mariadb.sql](../../src/db/creation_mariadb.sql).

## Description des tables

### Tables

Nous avons défini 4 tables :

- **Users** qui contient les informations sur les utilisateurs
- **Tickets** qui contient les informations sur les tickets
- **Interventions** qui contient les informations sur les interventions : c'est une table-association des tables Users et Tickets
- **Connections** qui contient les informations sur les tentatives de connections (réussies ou échouées)

### Colonnes

#### Users

Cette table contient les colonnes suivantes :

- **login** : champ de type *varchar(40)* qui est un identifiant unique à chaque l'utilisateur, c'est la ***clé primaire*** de la table
- **first_name** : prénom de l'utilisateur de type *varchar(40)*
- **last_name** : nom de l'utilisateur de type *varchar(40)*
- **password** : mot de passe de l'utilisateur de type *varchar(64)*, nous autorisons des mots de passe de 32 caractères maximum et la fonction **RC4** que nous utilisons renvoie une empreinte dont la taille est de $2 \times$ la taille du mdp $+$ la taille du mdp (sur 2 octets) ($2 \times 32 + 4 = 68$)
- **role** : rôle de l'utilisateur de type *varchar(10)* qui peut prendre les valeurs suivantes :

  - *user* : utilisateur
  - *tech* : technicien
  - *web_admin* : administrateur web
  - *sys_admin* : administrateur système

Aucun de ces champs ne peut être nul, sans quoi nous aurions des profils incomplets.

#### Tickets

Cette table contient les colonnes suivantes :

- **ticket_id** : champ de type *integer* qui est un identifiant unique à chaque ticket, c'est la ***clé primaire*** de la table, elle s'auto-incrémente
- **title** : titre du ticket de type *varchar(30)*, c'est le libellé du ticket
- **description** : description du ticket de type *text*, c'est le détail du ticket
- **status** : statut du ticket de type *varchar(20)* qui peut prendre les valeurs suivantes :

  - *open* : ticket ouvert
  - *closed* : ticket fermé
  - *in_progress* : ticket en cours de traitement

- **emergency** : niveau d'urgence du ticket de type *integer* qui peut prendre les valeurs suivantes :

  - *1* : faible
  - *2* : moyen
  - *3* : élevé
  - *4* : critique

- **date** : date de création du ticket de type *date*
- **user_login** : champ de type *varchar(40)* qui correspond à l'utilisateur qui a créé le ticket, c'est une ***clé étrangère*** de la table qui fait référence à la colonne *login* de la table **Users**

Aucun de ces champs ne peut être nul, sans quoi nous aurions des tickets incomplets.

#### Interventions

Cette table est une table-association des tables **Users** et **Tickets**. Elle contient les colonnes suivantes :

- **id_int** : champ de type *integer* qui est un identifiant unique à chaque intervention, c'est la ***clé primaire*** de la table, elle s'auto-incrémente
- **ticket_id** : champ de type *integer* qui correspond à l'identifiant du ticket, c'est une ***clé étrangère*** de la table qui fait référence à la colonne *ticket_id* de la table **Tickets**
- **tech_login** : champ de type *varchar(30)* qui correspond à l'identifiant du technicien qui a pris en charge le ticket, c'est une ***clé étrangère*** de la table qui fait référence à la colonne *login* de la table **Users**
- **end_date** : date de fin de l'intervention de type *date*

Seul la colonne **end_date** peut être nulle, car une intervention peut être en cours.

#### Connections

Cette table contient les colonnes suivantes :

- **id_co** : champ de type *integer* qui est un identifiant unique à chaque tentative, c'est la ***clé primaire*** de la table
- **ip_adress** : adresse ip de l'utilisateur *varchar(15)*
- **login** : login de l'utilisateur de type *varchar(40)*, c'est une ***clé étrangère*** de la table qui fait référence à la colonne *login* de la table **Users**
- **password** : mot de passe tenté de type *varchar(64)*
- **succes** : *booleen* qui indique si l'utilisateur à pu se connecter
- **date_co** : de type *datetime*, indique la date et l'heure de la tentative de connexion

Aucun de ces champs ne peut être nul.

## Modèle logique de données

Le modèle logique de données permet de représenter les tables et leurs colonnes en précisant les clés primaires et étrangères. Il est présenté ci-dessous :

Users :

- $login
- first_name
- last_name
- password
- role

Tickets :

- $ticket_id
- title,
- description
- room
- status
- emergency
- creation_date
- #login

Interventions :

- $id
- #ticket_id
- #tech_login
- end_date

Connections :

- $id_co
- ip_adress
- #login
- password
- succes
- date_co

**Légende** : Les champs précédés d'un **$** sont les clés primaires et ceux précédés d'un **#** sont des clés étrangères.

## Contraintes

Voici les différentes contraintes que nous avons définies pour les différentes tables qui ne sont pas présentées dans la description des tables :

- **Users** :
  - **login** : unique
  - **role** : uniques valeurs possibles : *user*, *tech*, *web_admin*, *sys_admin*

- **Tickets** :
  - **status** : uniques valeurs possibles : *open*, *closed*, *in_progress*
  - **user_login** : référence la colonne **login** de la table **Users** -> l'utilisateur qui crée un ticket doit être du type *user*

- **Interventions** :
  - **ticket_id** : référence la colonne **ticket_id** de la table **Tickets** -> une intervention sur un ticket ne peut être créée que si son état est *open*
  - **tech_login** : référence la colonne **login** de la table **Users** -> l'utilisateur qui prend en charge un ticket doit être du type *tech*

- **Connections** :
  - **login** référence la colonne **login** de la table **Users** -> la tentative de connexion doit référencer un utilisateur.

## Déclencheurs (triggers)

Certaines actions sur une table la base de données entrainent des changements implicites sur une autre table.
Pour cette raison, nous avons écrit des déclencheurs qui vont réaliser ces changements automatiquement.
Chaque changement s'effectue **avant** ou **apres** chaque changement correspondant aux critères du déclencheur.
Il y a également des déclencheurs permettant de vérifier la possibilité d'un changement.

Voici les différents déclencheurs que nous avons :

- **check_interventions_user** : Permet de verifier que la prise en charge d'un ticket est effectué par un utillisateur existant et qui est un technicien.
  - La vérification va s'effectuer *avant* l'ajout de l'intervention.
  - Pour cela, il vérifie que le login existe dans la table *User*.
    - Si ce n'est pas le cas, une erreur est renvoyée et la prise en charge du ticket ne se fait pas.
  - Il vérifie que l'utilisateur en question a le rôle *tech*.
    - Si ce n'est pas le cas, une erreur est renvoyée et la prise en charge du ticket ne se fait pas.
  - Si l'utilisateur existe et a le role technicien, alors la prise en charge est effectuée.

- **check_ticket_id_intervention** : Permet de vérifier que le ticket pris en charge existe.
  - La vérification va s'effectuer *avant* l'ajout de l'intervention.
  - Pour cela, il vérifie que le ticket existe dans la table *Tickets*.
    - Si ce n'est pas le cas, une erreur est renvoyée et la prise en charge du ticket ne se fait pas.
  - Si le ticket existe, alors la prise en charge est effectuée.

- **check_interventions_ticket_open** : Permet de vérifier que le ticket pris en charge a le status "ouvert"
  - La vérification va s'effectuer *avant* l'ajout de l'intervention.
  - Pour cela, il vérifie que le status du ticket est *ouvert*.
    - Si ce n'est pas le cas, une erreur est renvoyée et la prise en charge du ticket ne se fait pas.
  - Si le ticket est *ouvert*, alors la prise en charge est effectuée.

- **update_ticket_status_in_progress** : Actualise le status d'un ticket à "in_progress" lors de sa prise en charge
  - S'effectue *après* la prise en charge du ticket.
  - Change dans la table *Tickets* le status d'un ticket pris à "in_progress"

- **update_end_date** : Ajoute la date de résolution d'un ticket lors de la fermeture de celui-ci
  - S'effectue *après* la fermeture d'un ticket
  - Change met la valeur de *end_date* dans la table *intervention* lorsque l'état du ticket est mis à 'closed'

- **closed_tickets_for_deleted_account** : Ferme les tickets d'un compte supprimé
  - S'effectue *après* la suppression du compte
  - Met le *status* de tous les tickets appartenant à l'utilisateur supprimé à "closed"

## Conclusion

Nous avons présenté dans ce rapport les différentes tables de la base de données ainsi que leurs colonnes, leurs types et leurs contraintes. Nous avons également présenté le modèle logique de données qui permet de représenter les tables et leurs colonnes en précisant les clés primaires et étrangères. Cette spécification nous permettra de créer la base de données et de l'utiliser dans notre application.
