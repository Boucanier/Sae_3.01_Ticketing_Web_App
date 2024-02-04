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

Pour la page footer nous vérifions pour chaque lien que celui-ci renvoie bien vers la page attendue.

## 3. Description des informations à enregistrer pour les tests

### 1. Campagne de test

| Produit testé : footer.php                                 |
|-------------------------------------------------------------------------|
| Configuration logicielle : Apache2, Google Chrome, Firefox, Brave                   |
| Configuration matérielle : Ubuntu 23.10, Windows 11                     |
| Date de début : 02/12/2023                                              |
| Date de finalisation : 02/12/2023                                       |
| Tests à appliquer : footer|
| Responsable de la campagne de test : Matis RODIER                       |

### 2. Tests

| Identification du test : 0               |
|------------------------------------------|
| Version : 0                              |
| Description du test : footer |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Matis  RODIER             |

#### Cas de test

| Classe |         Donnée 1         |  Résultat attendu   |
|:------:|:------------------------:|:-------------------:|
|   P1   |     ‘Nous contacter’     |     contact.php     |
|   P2   |   ‘Changer la langue’    |      index.php      |
|   P2   | ‘Police dyslexie’        | index.php           |

### 3. Résultats de tests

| Référence du test appliqué : 0             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |      Donnée 1       | Résultat attendu | Résultat observé | Résultat test |
|:------:|:-------------------:|:----------------:|:----------------:|:-------------:|
|   P1   |  ‘Nous contacter’   |   contact.php    |   contact.php    |      OK       |
|   P2   | ‘Changer la langue’ |    index.php     |    index.php     |      OK       |
|   P2   |  ‘Police dyslexie’  |    index.php     |    index.php     |      OK       |

### 4. Conclusion

Tous les tests que nous avons effectués pour la page footer sont OK.
