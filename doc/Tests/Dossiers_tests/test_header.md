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

Pour chaque test, les ensembles des cas de test sont définis. Puis pour chaque
cas, des données de test sont définies. Nous utilisons JUnit 5 pour réaliser nos tests.
Nous comparerons ensuite les résultats obtenus avec les résultats attendus.

## 3. Description des informations à enregistrer pour les tests

### 1. Campagne de test

| Produit testé : header.php                                 |
|-------------------------------------------------------------------------|
| Configuration logicielle : Apache2, Google Chrome, Firefox, Brave                   |
| Configuration matérielle : Ubuntu 23.10, Windows 11                     |
| Date de début : 02/12/2023                                              |
| Date de finalisation : 02/12/2023                                       |
| Tests à appliquer : header_visit,header_user, header_web_admin, header_sys_admin, header_tech |
| Responsable de la campagne de test : Jules CHIRON                       |

### 2. Tests

| Identification du test : 0               |
|------------------------------------------|
| Version : 0                              |
| Description du test : header_visit |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Jules CHIRON               |

#### Cas de test

| Classe | Donnée 1 |   Résultat attendu    |
|:------:|:--------:|:----------------:|
|   P1   |         ‘Se connecter’           |          connection.php            |
|   P2   |        ‘Accueil’           |          index.php            |

---

| Identification du test : 1               |
|------------------------------------------|
| Version : 0                              |
| Description du test : header_user|
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Jules CHIRON               |

#### Cas de test

| Classe | Donnée 1 |   Résultat attendu    |
|:------:|:--------:|:----------------:|
|   P1   |         ‘Accueil’         |          index.php            |
|   P2   |        ‘Tableau de bord’’           |          dashboard.php            |
|   P3   |        ‘Profil’          |          profile.php            |
|   P4   |        ‘Déconnexion’          |          out.php            |

---

| Identification du test : 2               |
|------------------------------------------|
| Version : 0                              |
| Description du test : header_web_admin |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Jules CHIRON               |

#### Cas de test

| Classe | Donnée 1 |   Résultat attendu    |
|:------:|:--------:|:----------------:|
|   P1   |         ‘Tableau de bord’           |          dashboard.php            |
|   P2   |        ‘Accueil’           |          index.php            |
|   P3   |        ‘Gestion des techniciens’           |          tech.php            |
|   P4   |        ‘Profil’           |          profile.php            |
|   P5   |        ‘Déconnexion’           |          out.php            |

---

| Identification du test : 3               |
|------------------------------------------|
| Version : 0                              |
| Description du test : header_sys_admin|
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Jules CHIRON               |

#### Cas de test

| Classe | Donnée 1 |   Résultat attendu    |
|:------:|:--------:|:----------------:|
|   P1   |        ‘Accueil’           |          index.php            |
|   P2   |        ‘Tableau de bord’          |          dashboard.php            |
|   P3   |        ‘Gestion des techniciens’’           |         tech.php            |
|   P4   |        ‘Profil’           |          profile.php            |
|   P5   |        ‘Déconnexion’           |          out.php            |

---

| Identification du test : 4               |
|------------------------------------------|
| Version : 4                              |
| Description du test : header_tech |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Jules CHIRON               |

#### Cas de test

| Classe | Donnée 1 |   Résultat attendu    |
|:------:|:--------:|:----------------:|
|   P1   |         ‘Tableau de bord’           |          dashboard.php            |
|   P2   |        ‘Accueil’           |          index.php            |
|   P3   |        ‘Tickets disponibles’           |          dashboard.php?dispo=true            |
|   P4   |        ‘Profil’           |          profile.php            |
|   P5   |        ‘Déconnexion’           |          out.php            |

### 3. Résultats de tests
