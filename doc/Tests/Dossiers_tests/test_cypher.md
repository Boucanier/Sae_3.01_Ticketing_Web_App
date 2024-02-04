# Dossier de tests

![logo_uvsq](../../annexes/logo_uvsq.png)

| Web App Ticketing                          | Version : 0             |
|--------------------------------------------|-------------------------|
| Document : Dossier de tests                | Date : 04/02/2024       |
| Responsables de la rédaction : Jules CHIRON|                         |

## 1. Introduction

Ce dossier contient les tests pour les différents fonctions contenues dans le fichier _cypher.php_. Ce fichier regroupe des fonctions utilisées par les autres fichiers du projet. Il est donc important de vérifier que ces fonctions fonctionnent correctement.

## 2. Description de la procédure de test

Nous testons toutes les fonctions qui prennent des paramètres particuliers. Nous effectuons une campagne de tests boîte noire avec une stratégie _Bottom Up_. Nous vérifions que les fonctions renvoient bien les valeurs attendues.

## 3. Description des informations à enregistrer pour les tests

### 1. Campagne de test

| Produit testé : functions.php                                                               |
|---------------------------------------------------------------------------------------------|
| Configuration logicielle : Apache2, php 8.2, phpUnit 11.0.2                                 |
| Configuration matérielle : Ubuntu 23.10                                                     |
| Date de début : 03/02/2024                                                                  |
| Date de finalisation : 04/02/2024                                                           |
| Tests à appliquer : ksa, gen, cypher                                                        |
| Responsable de la campagne de test : Jules CHIRON                                           |

### 2. Tests

| Identification du test : 0               |
|------------------------------------------|
| Version : 0                              |
| Description du test : ksa (key schedule algorithm) : Tests boîte noire |
| Ressources requises : php 8.2, phpUnit 11.0.2 |
| Responsable : Jules CHIRON               |

#### Cas de test

Partitions d'équivalence :

- _a = {chaîne de caractères vide}_
- _b = {chaînes de caractères non vides}_
- _c = {tableaux non vides}_

| Classe |   Clé    | Résultat attendu  |
|:------:|:--------:|:-----------------:|
|   P1   |  x ∈ a   |     y ∈ c         |
|   P2   |  x ∈ b   |     y ∈ c         |

---

| Identification du test : 1               |
|------------------------------------------|
| Version : 0                              |
| Description du test : gen (Algorithme de génération de suite chiffrante) : Tests boîte noire |
| Ressources requises : php 8.2, phpUnit 11.0.2 |
| Responsable : Jules CHIRON               |

#### Cas de test

Partitions d'équivalence :

- _a = {chaîne de caractères vide}_
- _b = {chaînes de caractères non vides}_
- _c = {tableaux non vides}_
- _d = ℕ*_
- _e = {x ∈ ℤ | x < 0}_
- _f = {0}_

| Classe |   Clé    | Taille | Résultat attendu  |
|:------:|:--------:|:------:|:-----------------:|
|   P1   |  x ∈ a   | y ∈ d  |     z = y         |
|   P2   |  x ∈ a   | y ∈ e  |     z ∈ f         |
|   P3   |  x ∈ a   | y ∈ f  |     z ∈ f         |
|   P4   |  x ∈ b   | y ∈ d  |     z = y         |
|   P5   |  x ∈ b   | y ∈ e  |     z ∈ f         |
|   P6   |  x ∈ b   | y ∈ f  |     z ∈ f         |

---

| Identification du test : 2               |
|------------------------------------------|
| Version : 0                              |
| Description du test : cypher (Fonction de chiffrement) : Tests boîte noire |
| Ressources requises : php 8.2, phpUnit 11.0.2 |
| Responsable : Jules CHIRON               |

#### Cas de test

Partitions d'équivalence :

- _a = {chaîne de caractères vide}_
- _b = {chaînes de caractères non vides}_
- _c = {tableaux non vides}_
- _d = ℕ*_

| Classe | Message  |  Clé   | Résultat attendu  |
|:------:|:--------:|:------:|:-----------------:|
|   P1   |  x ∈ b   | y ∈ b  |     z ∈ d         |
|   P2   |  x ∈ a   | y ∈ b  |     z ∈ d         |
|   P3   |  x ∈ b   | y ∈ a  |     z ∈ d         |
|   P4   |  x ∈ a   | y ∈ a  |     z ∈ d         |

### 3. Résultats de tests

| Référence du test appliqué : 0             |
|--------------------------------------------|
| Responsable : Jules CHIRON                 |
| Date de l'application du test : 04/02/2024 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |   Clé    | Résultat attendu  | Résultat observé  | Résultat du test  |
|:------:|:--------:|:-----------------:|:-----------------:|:-----------------:|
|   P1   |    ""    |    taille > 0     |   taille = 256    |        OK         |
|   P2   |   "a"    |    taille > 0     |   taille = 256    |        OK         |

---

| Référence du test appliqué : 1             |
|--------------------------------------------|
| Responsable : Jules CHIRON                 |
| Date de l'application du test : 04/02/2024 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |   Clé    | Taille | Résultat attendu  | Résultat observé  | Résultat du test  |
|:------:|:--------:|:------:|:-----------------:|:-----------------:|:-----------------:|
|   P1   |   ""     |  128   |       128         |        128        |        OK         |
|   P2   |   ""     | -128   |        0          |         0         |        OK         |
|   P3   |   ""     |   0    |        0          |         0         |        OK         |
|   P4   |   "a"    |  128   |       128         |        128        |        OK         |
|   P5   |   "a"    | -128   |        0          |         0         |        OK         |
|   P6   |   "a"    |   0    |        0          |         0         |        OK         |

---

| Référence du test appliqué : 2             |
|--------------------------------------------|
| Responsable : Jules CHIRON                 |
| Date de l'application du test : 04/02/2024 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe | Message  |  Clé   | Résultat attendu  | Résultat observé  | Résultat du test  |
|:------:|:--------:|:------:|:-----------------:|:-----------------:|:-----------------:|
|   P1   |   "a"    |  "a"   |        68         |        68         |        OK         |
|   P2   |   ""     |  "a"   |        68         |        68         |        OK         |
|   P3   |   "a"    |  ""    |        68         |        68         |        OK         |
|   P4   |   ""     |  ""    |        68         |        68         |        OK         |

### 4. Conclusion

Tous les tests que nous avons effectués pour les fonctions de chiffrement sont OK.
Ces fonctions fonctionnent correctement et peuvent être utilisées dans les autres fichiers du projet.
