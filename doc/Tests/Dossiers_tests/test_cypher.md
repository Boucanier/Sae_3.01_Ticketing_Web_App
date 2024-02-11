# Dossier de tests

![logo_uvsq](../../annexes/logo_uvsq.png)

| Web App Ticketing                          | Version : 1             |
|--------------------------------------------|-------------------------|
| Document : Dossier de tests                | Date : 11/02/2024       |
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
| Version : 1                              |
| Description du test : gen (Algorithme de génération de suite chiffrante) : Tests boîte noire, nous testons ces tableaux avec les différents types d'entrée possibles et avec les données de tests fournies dans le sujet de cryptographie |
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
- _g1 = {Key}_
- _g2 = {Wiki}_
- _g3 = {Secret}_

| Classe |   Clé    | Taille | Résultat attendu (taille du tableau)   | Résultat attendu (contenu du tableau)   |
|:------:|:--------:|:------:|:--------------------------------------:|:---------------------------------------:|
|   P1   |  x ∈ a   | y ∈ d  |                  z = y                 |                  z ∈ c                  |
|   P2   |  x ∈ a   | y ∈ e  |                  z ∈ f                 |                  z ∈ a                  |
|   P3   |  x ∈ a   | y ∈ f  |                  z ∈ f                 |                  z ∈ a                  |
|   P4   |  x ∈ b   | y ∈ d  |                  z = y                 |                  z ∈ c                  |
|   P5   |  x ∈ b   | y ∈ e  |                  z ∈ f                 |                  z ∈ a                  |
|   P6   |  x ∈ b   | y ∈ f  |                  z ∈ f                 |                  z ∈ a                  |
|   P7   |  x ∈ g1  | y ∈ d  |                  z = y                 |                  z ∈ c                  |
|   P8   |  x ∈ g2  | y ∈ d  |                  z = y                 |                  z ∈ c                  |
|   P9   |  x ∈ g3  | y ∈ d  |                  z = y                 |                  z ∈ c                  |

---

| Identification du test : 2               |
|------------------------------------------|
| Version : 1                              |
| Description du test : cypher (Fonction de chiffrement) : Tests boîte noire, nous testons cette fonction avec des données d'entrée vides ou non-vides. Nous testons également la fonction avec les données de tests fournies dans le sujet de cryptographie |
| Ressources requises : php 8.2, phpUnit 11.0.2 |
| Responsable : Jules CHIRON               |

#### Cas de test

Partitions d'équivalence :

- _a = {chaîne de caractères vide}_
- _b = {chaînes de caractères non vides}_
- _d1 = {Key}_
- _d2 = {Wiki}_
- _d3 = {Secret}_
- _e1 = {Plaintext}_
- _e2 = {pedia}_
- _e3 = {Attack at dawn}_
- _f1 = {bbf316e8d940af0ad3297a18578672a53d6d7c1662274bae4ab225dc649b600eb00b}_
- _f2 = {1021bf042087d8d794e6c9cbe472b364683c88c1436497c9824037b2c59a20835817}_
- _f3 = {45a01f645fc35b383552544b9bf589a20221e405697f30472df9296f7846c0b7c241}_
- _f4 = {b \ {f1 U f2 U f3}}_

| Classe | Message  |  Clé   | Résultat attendu |
|:------:|:--------:|:------:|:----------------:|
|   P1   |  x ∈ b   | y ∈ b  |      z ∈ f4      |
|   P2   |  x ∈ a   | y ∈ b  |      z ∈ f4      |
|   P3   |  x ∈ b   | y ∈ a  |      z ∈ f4      |
|   P4   |  x ∈ a   | y ∈ a  |      z ∈ f4      |
|   P5   |  x ∈ e1  | y ∈ d1 |      z ∈ f1      |
|   P6   |  x ∈ e2  | y ∈ d2 |      z ∈ f2      |
|   P7   |  x ∈ e2  | y ∈ d3 |      z ∈ f3      |

### 3. Résultats de tests

| Référence du test appliqué : 0             |
|--------------------------------------------|
| Responsable : Jules CHIRON                 |
| Date de l'application du test : xx/02/2024 |
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
| Date de l'application du test : xx/02/2024 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |   Clé    | Taille | Résultat attendu (taille) | Résultat attendu (contenu) | Résultat observé (taille) | Résultat observé (contenu) | Résultat du test  |
|:------:|:--------:|:------:|:-------------------------:|:-:|:-:|:-------------------------:|:-----------------:|
|   P1   |   ""     |  128   |            128            | _Tableau d'entiers non vide_ |   |   |   |
|   P2   |   ""     | -128   |             0             | _Tableau d'entiers vide_ |   |   |   |
|   P3   |   ""     |   0    |             0             | _Tableau d'entiers vide_ |   |   |   |
|   P4   |   "a"    |  128   |            128            | _Tableau d'entiers non vide_ |   |   |   |
|   P5   |   "a"    | -128   |             0             | _Tableau d'entiers vide_ |   |   |   |
|   P6   |   "a"    |   0    |             0             | _Tableau d'entiers vide_ |   |   |   |
|   P7   |  "Key" | 16 | 16 | [235,159,119,129,183,52,202,114,167,25,74,40,103,182,66,149] |   |   | |
|   P8   | "Wiki" | 16 | 16 | [96,68,219,109,65,183,232,231,164,214,249,251,212,66,131,84] |   |   | |
|   P9   | "Secret" | 16 | 16 | [4,212,107,5,60,168,123,89,65,114,48,42,236,155,185,146] |   |   | |

---

| Référence du test appliqué : 2             |
|--------------------------------------------|
| Responsable : Jules CHIRON                 |
| Date de l'application du test : xx/02/2024 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe | Message  |  Clé   | Résultat attendu  | Résultat observé  | Résultat du test  |
|:------:|:--------:|:------:|:-----------------:|:-----------------:|:-----------------:|
|   P1   |   "a"    |  "a"   |        68         |                 |                 |
|   P2   |   ""     |  "a"   |        68         |                 |                 |
|   P3   |   "a"    |  ""    |        68         |                 |                 |
|   P4   |   ""     |  ""    |        68         |                 |                 |
|   P5   |"Plaintext"| "Key" |bbf316e8d940af0ad3297a18578672a53d6d7c1662274bae4ab225dc649b600eb00b|||
|   P6   |  "pedia" | "Wiki" |1021bf042087d8d794e6c9cbe472b364683c88c1436497c9824037b2c59a20835817|||
|   P7   |"Attack at dawn"|"Secret"|45a01f645fc35b383552544b9bf589a20221e405697f30472df9296f7846c0b7c241|||

### 4. Conclusion

Tous les tests que nous avons effectués pour les fonctions de chiffrement sont OK.
Ces fonctions fonctionnent correctement et peuvent être utilisées dans les autres fichiers du projet.
