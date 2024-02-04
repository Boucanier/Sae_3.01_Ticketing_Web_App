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

| Identification du test : 2               |
|------------------------------------------|
| Version : 0                              |
| Description du test : changement_mdp     |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Jules CHIRON               |

#### Cas de test

| Classe | Donnée 1 | Résultat attendu |
|:------:|:--------:|:----------------:|
|   P1   | 'Changer le mot de passe' | account.php |

### 3. Résultats de tests

| Référence du test appliqué : 0             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe | Donnée 1 |   Résultat attendu    |Résultat observé | Résultat test |
|:------:|:--------:|:----------------:|:----------------:|:----------------:|
|   P1   |   a ∉ roles  | connection.php |connection.php |OK|
|   P2   |   a ∈ roles  | profile.php |profile.php |OK|

---

| Référence du test appliqué : 1             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe | Donnée 1 | Résultat attendu |Résultat observé | Résultat test |
|:------:|:--------:|:----------------:|:----------------:|:----------------:|
|   P1   | 'Supprimer le compte' | confirmation.php?sup_acc=true |confirmation.php?sup_acc=true |OK|

---

| Référence du test appliqué : 2             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe | Donnée 1 | Résultat attendu |Résultat observé | Résultat test |
|:------:|:--------:|:----------------:|:----------------:|:----------------:|
|   P1   | 'Changer le mot de passe' | account.php |account.php |OK|

### 4. Conclusion

Tous les tests que nous avons effectués pour la page profile sont OK.
