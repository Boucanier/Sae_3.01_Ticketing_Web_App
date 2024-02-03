# Dossier de tests

![logo_uvsq](../../annexes/logo_uvsq.png)

| Web App Ticketing                                         | Version : 0       |
|-----------------------------------------------------------|-------------------|
| Document : Dossier de tests                               | Date : 02/12/2023 |
| Responsables de la rédaction : Jules CHIRON, Matis RODIER |                   |

## 1. Introduction

Ce dossier contient les tests pour les différents formulaires utilisés sur la page _connection.php_. On teste également quel utilisateur peut accéder à la page.

## 2. Description de la procédure de test

Nous vérifions que les utilisateurs déjà connectés sont redirigés vers leur tableau de bord. Sinon, nous vérifions que les différents boutons renvoient bien aux bonnes pages.

## 3. Description des informations à enregistrer pour les tests

### 1. Campagne de test

| Produit testé : connection.php                                             |
|-------------------------------------------------------------------------|
| Configuration logicielle : Apache2, Google Chrome, Firefox, Brave       |
| Configuration matérielle : Ubuntu 23.10, Windows 11                     |
| Date de début : 02/12/2023                                              |
| Date de finalisation : 02/12/2023                                       |
| Tests à appliquer : acces, connexion, creation_compte                   |
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

- _roles = {user, tech, web_admin, sys_admin}_

| Classe |  Donnée 1   | Résultat attendu |
|:------:|:-----------:|:----------------:|
|   P1   | a ∉ roles   | connection.php   |
|   P2   |  a ∈ roles  |  dashboard.php   |

 ---

| Identification du test : 1                                   |
|--------------------------------------------------------------|
| Version : 0                                                  |
| Description du test : connexion                              |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Jules CHIRON                                   |

#### Cas de test

Partitions d'équivalence :

- _roles = {user, tech, web_admin, sys_admin}_

| Classe |    Donnée 1     | Résultat attendu |
|:------:|:---------------:|:----------------:|
|   P1   | 'Se connecter'  |   account.php    |

 ---

| Identification du test : 1                                   |
|--------------------------------------------------------------|
| Version : 0                                                  |
| Description du test : creation_compte                        |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Jules CHIRON                                   |

#### Cas de test

Partitions d'équivalence :

- _roles = {user, tech, web_admin, sys_admin}_

| Classe | Donnée 1 | Résultat attendu  |
|:------:|:--------:|:-----------------:|
|   P1   | 'Créer'  |    account.php    |

### 3. Résultats de tests

| Référence du test appliqué : 0             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe | Donnée 1  | Résultat attendu | Résultat observé | Résultat test |
|:------:|:---------:|:----------------:|:---------------:|:-------------:|
|   P1   | a ∉ roles |  connection.php  | connection.php  |      OK       |
|   P2   | a ∈ roles |  dashboard.php   |  dashboard.php  |      OK       |
 
---

| Référence du test appliqué : 1             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe | Donnée 1 | Résultat attendu  | Résultat observé | Résultat test |
|:------:|:--------:|:-----------------:|:---------------:|:-------------:|
|   P1   | 'Créer'  |    account.php    |   account.php   |      OK       |

### 4. Conclusion

Tous les tests que nous avons effectués pour la page connection sont OK.