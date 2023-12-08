# Dossier de tests

![logo_uvsq](../../annexes/logo_uvsq.png)

| Web App Ticketing                          | Version : 0             |
|--------------------------------------------|-------------------------|
| Document : Dossier de tests                | Date : 02/12/2023       |
| Responsables de la rédaction : Jules CHIRON, Matis RODIER |          |

## 1. Introduction

Ce dossier contient les tests pour les différents utilisateurs pouvant (ou pas) accéder à la page _profile.php_.

## 2. Description de la procédure de test

Nous vérifions que les utilisateurs sont redirigés vers la bonne page en fonction de leur rôle.

## 3. Description des informations à enregistrer pour les tests

### 1. Campagne de test

| Produit testé : activity_log.php                                        |
|-------------------------------------------------------------------------|
| Configuration logicielle : Apache2, Google Chrome, Firefox, Brave       |
| Configuration matérielle : Ubuntu 23.10, Windows 11                     |
| Date de début : 02/12/2023                                              |
| Date de finalisation : 02/12/2023                                       |
| Tests à appliquer : acces                                               |
| Responsable de la campagne de test : Jules CHIRON                       |

### 2. Tests

| Identification du test : 0                                   |
|--------------------------------------------------------------|
| Version : 0                                                  |
| Description du test : acces                                  |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Jules CHIRON                                   |

#### Cas de test

Partitions d'équivalence :

- _other = {user, tech, sys_admin}_

| Classe |     Donnée 1     | Résultat attendu |
|:------:|:----------------:|:----------------:|
|   P1   |    a ∈ other     |  dashboard.php   |
|   P2   | a = 'sys\_admin' | activity_log.php |
|   P3   |   a = 'visit'    |  connection.php  |

### 3. Résultats de tests

| Référence du test appliqué : 0             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |     Donnée 1     | Résultat attendu | Résultat observé | Résultat test  |
|:------:|:----------------:|:----------------:|------------------|----------------|
|   P1   |    a ∈ other     |  dashboard.php   | dashboard.php    | OK             |
|   P2   | a = 'sys\_admin' | activity_log.php | activity_log.php | OK             |
|   P3   |   a = 'visit'    |  connection.php  | connection.php   | OK             |

### 4. Conclusion

Tous les tests que nous avons effectués pour la page test_activity_log sont OK.