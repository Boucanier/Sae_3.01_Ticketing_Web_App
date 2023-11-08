# Rapport de spécification : Base de données

![logo*uvsq](../annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

Groupe : **INF2 - FI A**

## Introduction

Ce document présente les choix que nous avons fait pour créer la base de données, conformément à sa conception dans la [conception architecturale](../Conception/conception_architecturale.md). Ce rapport présente les différentes tables de la base de données ainsi que leurs colonnes, leurs types et leurs contraintes.

## Description des tables

### Tables

Nous avons défini 3 tables :

- **Users** qui contient les informations sur les utilisateurs
- **Tickets** qui contient les informations sur les tickets
- **Interventions** qui contient les informations sur les interventions : c'est une table-association des tables Users et Tickets

### Colonnes

#### Users

Cette table contient les colonnes suivantes :

- **login** : champ de type *varchar(30)* qui est un identifiant unique à chaque l'utilisateur, c'est la ***clé primaire*** de la table
- **first_name** : prénom de l'utilisateur de type *varchar(30)*
- **last_name** : nom de l'utilisateur de type *varchar(30)*
- **password** : mot de passe de l'utilisateur de type *varchar(40)* car nous stockons le hash du mot de passe en format **sha1**
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

- **date** : date de création du ticket de type *date*
- **user_login** : champ de type *varchar(30)* qui correspond à l'utilisateur qui a créé le ticket, c'est une ***clé étrangère*** de la table qui fait référence à la colonne *login* de la table **Users**

Aucun de ces champs ne peut être nul, sans quoi nous aurions des tickets incomplets.

#### Interventions

Cette table est une table-association des tables **Users** et **Tickets**. Elle contient les colonnes suivantes :

- **id_int** : champ de type *integer* qui est un identifiant unique à chaque intervention, c'est la ***clé primaire*** de la table, elle s'auto-incrémente
- **ticket_id** : champ de type *integer* qui correspond à l'identifiant du ticket, c'est une ***clé étrangère*** de la table qui fait référence à la colonne *ticket_id* de la table **Tickets**
- **tech_login** : champ de type *varchar(30)* qui correspond à l'identifiant du technicien qui a pris en charge le ticket, c'est une ***clé étrangère*** de la table qui fait référence à la colonne *login* de la table **Users**
- **end_date** : date de fin de l'intervention de type *date*

Seul la colonne **end_date** peut être nulle, car une intervention peut être en cours.

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
- creation_date
- #login

Interventions :

- $id_int
- #ticket_id
- #login
- end_date

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
