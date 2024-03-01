# Dossier de tests

![logo_uvsq](../../annexes/logo_uvsq.png)

| Web App Ticketing                                                          | Version : 0       |
|----------------------------------------------------------------------------|-------------------|
| Document : Dossier de tests                                                | Date : 02/12/2023 |
| Responsables de la rédaction : Jules CHIRON, Matis RODIER, Thomas GODINEAU |                   |

## 1. Introduction

Ce dossier contient les tests pour les différents headers utilisés sur les pages du site, qui se situent dans le fichier _header.php_.
Nous testerons toutes les pages possibles à afficher.

## 2. Description de la procédure de test

Pour chaque type d'utilisateur possible, nous testons les liens présents dans le header et depuis lesquels il est possible d'accéder à une autre page. Nous vérifions que le lien renvoie bien vers la page attendue. Chaque test correspond à un type d'utilisateur.

## 3. Description des informations à enregistrer pour les tests

### 1. Campagne de test

| Produit testé : header.php                                                                    |
|-----------------------------------------------------------------------------------------------|
| Configuration logicielle : Apache2, Google Chrome, Firefox, Brave                             |
| Configuration matérielle : Ubuntu 23.10, Windows 11                                           |
| Date de début : 02/12/2023                                                                    |
| Date de finalisation : 02/12/2023                                                             |
| Tests à appliquer : header_visit,header_user, header_web_admin, header_sys_admin, header_tech |
| Responsable de la campagne de test : Jules CHIRON                                             |

### 2. Tests

| Identification du test : 0                                   |
|--------------------------------------------------------------|
| Version : 0                                                  |
| Description du test : header_visit                           |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Jules CHIRON                                   |

#### Cas de test

| Classe |    Donnée 1    |    Résultat attendu    |
|:------:|:--------------:|:----------------------:|
|   P1   |   ‘Accueil’    |       index.php        |
|   P2   | ‘Se connecter’ |     connection.php     |

---

| Identification du test : 1                                   |
|--------------------------------------------------------------|
| Version : 0                                                  |
| Description du test : header_user                            |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Jules CHIRON                                   |

#### Cas de test

| Classe |     Donnée 1      | Résultat attendu |
|:------:|:-----------------:|:----------------:|
|   P1   |     ‘Accueil’     |    index.php     |
|   P2   | ‘Tableau de bord’ |  dashboard.php   |
|   P3   |     ‘Profil’      |   profile.php    |
|   P4   |   ‘Déconnexion’   |     out.php      |

---

| Identification du test : 2                                   |
|--------------------------------------------------------------|
| Version : 0                                                  |
| Description du test : header_web_admin                       |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Jules CHIRON, Thomas GODINEAU                  |

#### Cas de test

| Classe |          Donnée 1          | Résultat attendu |
|:------:|:--------------------------:|:----------------:|
|   P1   |     ‘Tableau de bord’      |  dashboard.php   |
|   P2   |         ‘Accueil’          |    index.php     |
|   P3   | ‘Gestion des techniciens’  |     tech.php     |
|   P4   | ‘Gestion des utilisateurs’ |    users.php     |
|   P5   |          ‘Profil’          |   profile.php    |
|   P6   |       ‘Déconnexion’        |     out.php      |

---

| Identification du test : 3                                   |
|--------------------------------------------------------------|
| Version : 0                                                  |
| Description du test : header_sys_admin                       |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Jules CHIRON, Thomas GODINEAU                  |

#### Cas de test

| Classe |        Donnée 1        | Résultat attendu |
|:------:|:----------------------:|:----------------:|
|   P1   |       ‘Accueil’        |    index.php     |
|   P2   | ‘Journaux d'activités’ | activity_log.php |
|   P3   |     ‘Statistiques’     |    stats.php     |
|   P4   |       ‘Sécurité‘       |   security.php   |
|   P5   |        ‘Profil’        |   profile.php    |
|   P6   |     ‘Déconnexion’      |     out.php      |

---

| Identification du test : 4                                   |
|--------------------------------------------------------------|
| Version : 4                                                  |
| Description du test : header_tech                            |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Jules CHIRON                                   |

#### Cas de test

| Classe |       Donnée 1        |     Résultat attendu     |
|:------:|:---------------------:|:------------------------:|
|   P1   |       ‘Accueil’       |        index.php         |
|   P2   |   ‘Tableau de bord’   |      dashboard.php       |
|   P3   | ‘Tickets disponibles’ | dashboard.php?dispo=true |
|   P4   |       ‘Profil’        |       profile.php        |
|   P5   |     ‘Déconnexion’     |         out.php          |

### 3. Résultats de tests

| Référence du test appliqué : 0             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |    Donnée 1    | Résultat attendu | Résultat obtenu | Résultat test |
|:------:|:--------------:|:----------------:|:---------------:|:-------------:|
|   P1   |   ‘Accueil’    |    index.php     |    index.php    |      OK       |
|   P2   | ‘Se connecter’ |  connection.php  | connection.php  |      OK       |

---

| Référence du test appliqué : 1             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |     Donnée 1      | Résultat attendu | Résultat obtenu | Résultat test |
|:------:|:-----------------:|:----------------:|:---------------:|:-------------:|
|   P1   |     ‘Accueil’     |    index.php     |    index.php    |      OK       |
|   P2   | ‘Tableau de bord’ |  dashboard.php   |  dashboard.php  |      OK       |
|   P3   |     ‘Profil’      |   profile.php    |   profile.php   |      OK       |
|   P4   |   ‘Déconnexion’   |     out.php      |     out.php     |      OK       |

---

| Référence du test appliqué : 2              |
|---------------------------------------------|
| Responsable : Matis RODIER, Thomas GODINEAU |
| Date de l'application du test : 08/12/2023  |
| Résultat de test : OK                       |
| Occurrence des résultats : systématique     |

| Classe |          Donnée 1          | Résultat attendu | Résultat obtenu | Résultat test |
|:------:|:--------------------------:|:----------------:|:---------------:|:-------------:|
|   P1   |         ‘Accueil’          |    index.php     |    index.php    |      OK       |
|   P2   |     ‘Tableau de bord’      |  dashboard.php   |  dashboard.php  |      OK       |
|   P3   | ‘Gestion des techniciens’  |     tech.php     |    tech.php     |      OK       |
|   P4   | ‘Gestion des utilisateurs’ |    users.php     |    users.php    |      OK       |
|   P5   |          ‘Profil’          |   profile.php    |   profile.php   |      OK       |
|   P6   |       ‘Déconnexion’        |     out.php      |     out.php     |      OK       |

---

| Référence du test appliqué : 3              |
|---------------------------------------------|
| Responsable : Matis RODIER, Thomas GODINEAU |
| Date de l'application du test : 08/12/2023  |
| Résultat de test : OK                       |
| Occurrence des résultats : systématique     |

| Classe |        Donnée 1        | Résultat attendu | Résultat obtenu  | Résultat test |
|:------:|:----------------------:|:----------------:|:----------------:|:-------------:|
|   P1   |       ‘Accueil’        |    index.php     |    index.php     |      OK       |
|   P2   | ‘Journaux d'activités’ | activity_log.php | activity_log.php |      OK       |
|   P3   |     ‘Statistiques’     |    stats.php     |    stats.php     |      OK       |
|   P4   |       ‘Sécurité‘       |   security.php   |   security.php   |      OK       |
|   P5   |        ‘Profil’        |   profile.php    |   profile.php    |      OK       |
|   P6   |     ‘Déconnexion’      |     out.php      |     out.php      |      OK       |

---

| Référence du test appliqué : 4             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |       Donnée 1        |     Résultat attendu     |     Résultat obtenu      | Résultat test |
|:------:|:---------------------:|:------------------------:|:------------------------:|:-------------:|
|   P1   |       ‘Accueil’       |        index.php         |        index.php         |      OK       |
|   P2   |   ‘Tableau de bord’   |      dashboard.php       |      dashboard.php       |      OK       |
|   P3   | ‘Tickets disponibles’ | dashboard.php?dispo=true | dashboard.php?dispo=true |      OK       |
|   P4   |       ‘Profil’        |       profile.php        |       profile.php        |      OK       |
|   P5   |     ‘Déconnexion’     |         out.php          |         out.php          |      OK       |

### 4. Conclusion

Tous les tests que nous avons effectués pour la page header sont OK.
