# Dossier de tests

![logo_uvsq](../../annexes/logo_uvsq.png)

| Web App Ticketing                 | Version : 0             |
|--------------------------------------------|-------------------------|
| Document : Dossier de tests                | Date : 02/12/2023       |
| Responsables de la rédaction : Jules CHIRON, Matis RODIER |          |

## 1. Introduction

Ce dossier contient les tests pour les différentes pages du site.
Nous testerons toutes les pages possiblement à afficher.

## 2. Description de la procédure de test

Pour la page ticket_modification nous vérifions que chaque lien en fonction de l'utilisateur, il redirige vers la bonne page.

## 3. Description des informations à enregistrer pour les tests

### 1. Campagne de test

| Produit testé : ticket_modification.php                                 |
|-------------------------------------------------------------------------|
| Configuration logicielle : Apache2, Google Chrome, Firefox, Brave                   |
| Configuration matérielle : Ubuntu 23.10, Windows 11                     |
| Date de début : 02/12/2023                                              |
| Date de finalisation : 02/12/2023                                       |
| Tests à appliquer : create_ticket, access|
| Responsable de la campagne de test : Matis RODIER     |

### 2. Tests

| Identification du test : 0               |
|------------------------------------------|
| Version : 0                              |
| Description du test : create_ticket |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Matis  RODIER     |

#### Cas de test

| Classe | Donnée 1 |   Résultat attendu    |
|:------:|:--------:|:----------------:|
|   P1   |         'Modifier le ticket'      |     action_ticket.php    |

| Identification du test : 0               |
|------------------------------------------|
| Version : 1                              |
| Description du test : access |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Matis  RODIER             |

#### Cas de test

La donnée 1 correspond au fait qu'un type d'utilisateur accède à la page ticket_modification.php. Si cet utilisateur y accède, alors il est renvoyé sur la page de la colonne "Résultat attendu".

| Classe | Donnée 1 |   Résultat attendu    |
|:------:|:--------:|:----------------:|
|   P1   |        visiteur      |   index.php  |
|   P2   |        admin system      |   index.php  |
|   P3   |        technicien      |   index.php  |
|   P4   |        user      |   index.php  |

### 3. Résultats de tests
