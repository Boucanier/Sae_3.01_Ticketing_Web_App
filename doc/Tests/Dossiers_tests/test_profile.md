# Dossier de tests

![logo_uvsq](../../annexes/logo_uvsq.png)

| Web App Ticketing                          | Version : 0             |
|--------------------------------------------|-------------------------|
| Document : Dossier de tests                | Date : 02/12/2023       |
| Responsables de la rédaction : Jules CHIRON, Matis RODIER |          |

## 1. Introduction

Ce dossier contient les tests pour les différents formulaires utilisés sur la page _profile.php_. On teste également quel utilisateur peut accéder à la page.

## 2. Description de la procédure de test

Nous testons les formulaires présents sur la page et depuis lesquels il est possible d'effectuer des actions sur son compte. Nous vérifions que les formulaires renvoient aux bons endroits en fonction des champs (remplis ou pas). Nous vérifions également que les utilisateurs non connectés sont redirigés vers la page de connexion.

## 3. Description des informations à enregistrer pour les tests

### 1. Campagne de test

| Produit testé : profile.php                                             |
|-------------------------------------------------------------------------|
| Configuration logicielle : Apache2, Google Chrome, Firefox, Brave       |
| Configuration matérielle : Ubuntu 23.10, Windows 11                     |
| Date de début : 02/12/2023                                              |
| Date de finalisation : 02/12/2023                                       |
| Tests à appliquer : acces_page, suppression_compte, changement_mdp      |
| Responsable de la campagne de test : Jules CHIRON                       |

### 2. Tests

| Identification du test : 0               |
|------------------------------------------|
| Version : 0                              |
| Description du test : acces |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Jules CHIRON               |

#### Cas de test

Partitions d'équivalence :

- _roles = {user, tech, web_admin, sys_admin}_

| Classe | Donnée 1 |   Résultat attendu    |
|:------:|:--------:|:----------------:|
|   P1   |   a ∉ roles  | connection.php |
|   P2   |   a ∈ roles  | profile.php |

---

| Identification du test : 1               |
|------------------------------------------|
| Version : 0                              |
| Description du test : suppression_compte |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Jules CHIRON               |

#### Cas de test

| Classe | Donnée 1 | Résultat attendu |
|:------:|:--------:|:----------------:|
|   P1   | 'Supprimer le compte' | confirmation.php?sup_acc=true |

---

| Identification du test : 1               |
|------------------------------------------|
| Version : 0                              |
| Description du test : changement_mdp     |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Jules CHIRON               |

#### Cas de test

| Classe | Mdp actuel | Nouveau mdp | Confirmation mdp | Résultat attendu     |
|:------:|:----------:|:-----------:|:----------------:|:--------------------:|
|   P1   | mauvais    |      a      |      b = a       | profile.php?error=31 |
|   P2   | mauvais    |      a      |     b != a       | profile.php?error=33 |
|   P3   | correct    |      a      |     b != a       | profile.php?error=33 |
|   P4   | correct    |      a      |      b = a       | profile.php?success=1|

### 3. Résultats de tests
