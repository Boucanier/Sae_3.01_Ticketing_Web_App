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

Pour la page dashboard nous vérifions pour chaque lien que celui-ci renvoie bien vers la page attendue.

## 3. Description des informations à enregistrer pour les tests

### 1. Campagne de test

dashboard_tech contient les tickets qu'un technicien est en train de gérer. Il peut alors le clore.

dashboard_tech_dispo contient tous les tickets disponibles pour un technicien. Il peut alors le prendre en charge.

| Produit testé : dashboard.php                                 |
|-------------------------------------------------------------------------|
| Configuration logicielle : Apache2, Google Chrome, Firefox, Brave                   |
| Configuration matérielle : Ubuntu 23.10, Windows 11                     |
| Date de début : 02/12/2023                                              |
| Date de finalisation : 02/12/2023                                       |
| Tests à appliquer : dashboard_user, dashboard_tech, dashboard_tech_dispo, dashboard_web_admin, access|
| Responsable de la campagne de test : Matis RODIER                       |

### 2. Tests

| Identification du test : 0               |
|------------------------------------------|
| Version : 0                              |
| Description du test : dashboard_user     |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Matis  RODIER             |

#### Cas de test

"id=ticket_id" signifie que l'on envoie à la prochaine page le ticket sélectionner "ticket_id" dans la variable "id" que l'on pourra accéder grâce à un $_GET.

| Classe |        Donnée 1         |        Résultat attendu         |
|:------:|:-----------------------:|:-------------------------------:|
|   P1   | ‘Créer un ticket’       |              ticket.php         |
|   P2   |        ‘Détails’        | ticket_details.php?id=ticket_id |

---

| Identification du test : 1                                   |
|--------------------------------------------------------------|
| Version : 0                                                  |
| Description du test : dashboard_tech                         |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Matis  RODIER                                  |

#### Cas de test

"id=ticket_id" signifie que l'on envoie à la prochaine page le ticket sélectionner "ticket_id" dans la variable "id" que l'on pourra accéder grâce à un $_GET.

| Classe |      Donnée 1       |                 Résultat attendu                 |
|:------:|:-------------------:|:------------------------------------------------:|
|   P1   | ‘Détails’           |    ticket_details.php?id=ticket_id&function=take |

---

| Identification du test : 2               |
|------------------------------------------|
| Version : 0                              |
| Description du test : dashboard_tech_dispo     |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Matis  RODIER             |

#### Cas de test

"id=ticket_id" signifie que l'on envoie à la prochaine page le ticket sélectionner "ticket_id" dans la variable "id" que l'on pourra accéder grâce à un $_GET.

| Classe |          Donnée 1           |                 Résultat attendu                 |
|:------:|:---------------------------:|:------------------------------------------------:|
|   P1   | 'Prendre en charge'         |   ticket_details.php?id=ticket_id&function=close |

---

| Identification du test : 3               |
|------------------------------------------|
| Version : 0                              |
| Description du test : dashboard_web_admin     |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Matis  RODIER             |

#### Cas de test

"id=ticket_id" signifie que l'on envoie à la prochaine page le ticket sélectionner "ticket_id" dans la variable "id" que l'on pourra accéder grâce à un $_GET.

| Classe |        Donnée 1        |            Résultat attendu            |
|:------:|:----------------------:|:--------------------------------------:|
|   P1   | 'Modifier ticket'      |   ticket_modification.php?id=ticket_id |

---

| Identification du test : 4               |
|------------------------------------------|
| Version : 0                              |
| Description du test : access     |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Matis  RODIER             |

#### Cas de test

"id=ticket_id" signifie que l'on envoie à la prochaine page le ticket sélectionner "ticket_id" dans la variable "id" que l'on pourra accéder grâce à un $_GET.

La donnée 1 correspond au fait qu'un type d'utilisateur accède à la page dashboard.php. Si cet utilisateur y accède, alors il est renvoyé sur la page de la colonne "Résultat attendu".

| Classe |     Donnée 1     | Résultat attendu |
|:------:|:----------------:|:----------------:|
|   P1   |     visiteur     |    index.php     |
|   P2   | admin system     |   index.php      |

### 3. Résultats de tests

| Référence du test appliqué : 0             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |      Donnée 1      |        Résultat attendu         |        Résultat observé         | Résultat test |
|:------:|:------------------:|:-------------------------------:|:-------------------------------:|:-------------:|
|   P1   | ‘Créer un ticket’  |           ticket.php            |           ticket.php            |      OK       |
|   P2   |     ‘Détails’      | ticket_details.php?id=ticket_id | ticket_details.php?id=ticket_id |      OK       |

---

| Référence du test appliqué : 1             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |      Donnée 1       |                 Résultat attendu                 |                 Résultat observé                 | Résultat test |
|:------:|:-------------------:|:------------------------------------------------:|:------------------------------------------------:|:-------------:|
|   P1   | ‘Détails’           |    ticket_details.php?id=ticket_id&function=take |    ticket_details.php?id=ticket_id&function=take |      OK       |

---

| Référence du test appliqué : 2             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |          Donnée 1           |                 Résultat attendu                 |                 Résultat observé                 | Résultat test |
|:------:|:---------------------------:|:------------------------------------------------:|:------------------------------------------------:|:-------------:|
|   P1   | 'Prendre en charge'         |   ticket_details.php?id=ticket_id&function=close |   ticket_details.php?id=ticket_id&function=close |      OK       |

---

| Référence du test appliqué : 3             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |        Donnée 1        |            Résultat attendu            |            Résultat observé            | Résultat test |
|:------:|:----------------------:|:--------------------------------------:|:--------------------------------------:|:-------------:|
|   P1   | 'Modifier ticket'      |   ticket_modification.php?id=ticket_id |   ticket_modification.php?id=ticket_id |      OK       |

---

| Référence du test appliqué : 4             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |   Donnée 1    | Résultat attendu | Résultat observé | Résultat test |
|:------:|:-------------:|:----------------:|:----------------:|:-------------:|
|   P1   |   visiteur    |    index.php     |    index.php     |      OK       |
|   P2   | admin system  |   index.php      |   index.php      |      OK       |

### 4. Conclusion

Tous les tests que nous avons effectués pour la page dashboard sont OK.