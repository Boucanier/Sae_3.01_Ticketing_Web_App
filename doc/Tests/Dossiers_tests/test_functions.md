# Dossier de tests

![logo_uvsq](../../annexes/logo_uvsq.png)

| Web App Ticketing                          | Version : 0             |
|--------------------------------------------|-------------------------|
| Document : Dossier de tests                | Date : 02/12/2023       |
| Responsables de la rédaction : Jules CHIRON, Matis RODIER |          |

## 1. Introduction

Ce dossier contient les tests pour les différents fonctions contenuesdans le fichier _functions.php_. Ce fichier regroupe des fonctions utilisées par les autres fichiers du projet. Il est donc important de vérifier que ces fonctions fonctionnent correctement.

## 2. Description de la procédure de test

Nous testons toutes les fonctions qui prennent des paramètres particuliers. Nous vérifions que les fonctions renvoient bien sur les bonnes pages en fonction des paramètres donnés.

## 3. Description des informations à enregistrer pour les tests

### 1. Campagne de test

| Produit testé : functions.php                                           |
|-------------------------------------------------------------------------|
| Configuration logicielle : Apache2, Google Chrome, Firefox, Brave       |
| Configuration matérielle : Ubuntu 23.10, Windows 11                     |
| Date de début : 02/12/2023                                              |
| Date de finalisation : 02/12/2023                                       |
| Tests à appliquer : log_acc, create_acc, update_acc                     |
| Responsable de la campagne de test : Jules CHIRON                       |

### 2. Tests

| Identification du test : 0               |
|------------------------------------------|
| Version : 0                              |
| Description du test : log_acc            |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Jules CHIRON               |

#### Cas de test

Partitions d'équivalence :

- _sys = {sys_admin}_
- _other = {user, tech, web_admin}_
- _all = sys U other_

| Classe |   Login    | Mot de passe | Rôle       | Résultat attendu        |
|:------:|:----------:|:------------:|:----------:|:-----------------------:|
|   P1   | existe     | correct      | a ∈ sys    | index.php               |
|   P2   | existe     | correct      | a ∈ other  | dashboard.php           |
|   P3   | existe     | incorrect    | a ∈ all    | connection.php?error=21 |
|   P4   | existe     | vide         | a ∈ all    | connection.php?error=23 |
|   P5   | existe pas | quelconque   | a ∈ all    | connection.php?error=21 |
|   P6   | existe pas | vide         | a ∈ all    | connection.php?error=23 |
|   P7   | vide       | quelconque   | a ∈ all    | connection.php?error=23 |

---

| Identification du test : 1               |
|------------------------------------------|
| Version : 0                              |
| Description du test : create_acc         |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave   |
| Responsable : Jules CHIRON               |

#### Cas de test

Partitions d'équivalence :

- _E1 = {'rmv-%'}_
- _E2 = {Logins existants}_
- _E3 = {'%' | taille > 40}_
- _E4 = ∅_
- _E5 = {'% %' (contient un/plusieurs espace)}_
- _E6 = E3 U E4_
- _E7 = E1 U E2 U E3 U E4_
- _E8 = E7 U E5_
- _E9 = E1 U E2 UE3 U E5_

| Classe | Login | Nom | Prénom | Mdp | Confirmation mdp | Captcha 1 | Captcha 2 | Résultat Captcha | role_courant | nv_role | Résultat attendu |
|:------:|:--------:|:--------:|:--------:|:--------:|:--------:|:--------:|:--------:|:--------:|:--------:|:--------:|:----------------:|
|   P1   | a ∉ E8 | b ∉ E7 | c ∉ E7 | d | e = d | f | g | h = f+g | 'visit' | 'user' | dashboard.php |
|   P2   | quelconque | quelconque | quelconque | quelconque | quelconque | f | g | h ≠ f+g | 'visit' | 'user' | connection.php?error=14 |
|   P3   | a ∈ E1 | quelconque | quelconque | quelconque | quelconque | f | g | h = f+g | 'visit' | 'user' | connection.php?error=11 |
|   P4   | a ∈ E2 | quelconque | quelconque | quelconque | quelconque | f | g | h = f+g | 'visit' | 'user' | connection.php?error=11 |
|   P5   | a ∈ E3 | quelconque | quelconque | quelconque | quelconque | f | g | h = f+g | 'visit' | 'user' | connection.php?error=11 |
|   P6   | a ∈ E5 | quelconque | quelconque | quelconque | quelconque | f | g | h = f+g | 'visit' | 'user' | connection.php?error=11 |
|   P7   | a ∈ E4 | quelconque | quelconque | quelconque | quelconque | f | g | h = f+g | 'visit' | 'user' | connection.php?error=13 |
|   P8   | a ∉ E9 | b ∈ E4 | quelconque | quelconque | quelconque | f | g | h = f+g | 'visit' | 'user' | connection.php?error=13 |
|   P9   | a ∉ E9 | quelconque | c ∈ E4 | quelconque | quelconque | f | g | h = f+g | 'visit' | 'user' | connection.php?error=13 |
|   P10   | a ∉ E9 | quelconque | quelconque | d ∈ E4 | quelconque | f | g | h = f+g | 'visit' | 'user' | connection.php?error=13 |
|   P11   | a ∉ E9 | quelconque | quelconque | quelconque | e ∈ E4 | f | g | h = f+g | 'visit' | 'user' | connection.php?error=13 |
|   P12   | a ∉ E8 | b ∈ E3 | c ∉ E6 | d ∉ E6 | e ∉ E6 | f | g | h = f+g | 'visit' | 'user' | connection.php?error=15 |
|   P13   | a ∉ E8 | b ∉ E6 | c ∈ E3 | d ∉ E6 | e ∉ E4 | f | g | h = f+g | 'visit' | 'user' | connection.php?error=16 |
|   P14   | a ∉ E8 | b ∉ E6 | c ∉ E6 | d ∈ E3 | e ∉ E4 | f | g | h = f+g | 'visit' | 'user' | connection.php?error=17 |
|   P15   | a ∉ E8 | b ∉ E7 | c ∉ E7 | d | e = d | f | g | h = f+g | 'web\_admin' | 'tech' | tech.php |
|   P16   | a ∉ E8 | b ∉ E7 | c ∉ E7 | d | e = d | f | g | h ≠ f+g | 'web\_admin' | 'tech' | tech.php |
|   P17   | a ∈ E1 | quelconque | quelconque | quelconque | quelconque | f | g | h = f+g | 'web\_admin' | 'tech' | tech.php?error=11 |
|   P18   | a ∈ E2 | quelconque | quelconque | quelconque | quelconque | f | g | h = f+g | 'web\_admin' | 'tech' | tech.php?error=11 |
|   P19   | a ∈ E3 | quelconque | quelconque | quelconque | quelconque | f | g | h = f+g | 'web\_admin' | 'tech' | tech.php?error=11 |
|   P20   | a ∈ E5 | quelconque | quelconque | quelconque | quelconque | f | g | h = f+g | 'web\_admin' | 'tech' | tech.php?error=11 |
|   P21   | a ∈ E4 | quelconque | quelconque | quelconque | quelconque | f | g | h = f+g | 'web\_admin' | 'tech' | tech.php?error=13 |
|   P22   | a ∉ E9 | b ∈ E4 | quelconque | quelconque | quelconque | f | g | h = f+g | 'web\_admin' | 'tech' | tech.php?error=13 |
|   P23   | a ∉ E9 | quelconque | c ∈ E4 | quelconque | quelconque | f | g | h = f+g | 'web\_admin' | 'tech' | tech.php?error=13 |
|   P24   | a ∉ E9 | quelconque | quelconque | d ∈ E4 | quelconque | f | g | h = f+g | 'web\_admin' | 'tech' | tech.php?error=13 |
|   P25   | a ∉ E9 | quelconque | quelconque | quelconque | e ∈ E4 | f | g | h = f+g | 'web\_admin' | 'tech' | tech.php?error=13 |
|   P26   | a ∉ E8 | b ∈ E3 | c ∉ E6 | d ∉ E6 | e ∉ E6 | f | g | h = f+g | 'web\_admin' | 'tech' | tech.php?error=15 |
|   P27   | a ∉ E8 | b ∉ E6 | c ∈ E3 | d ∉ E6 | e ∉ E4 | f | g | h = f+g | 'web\_admin' | 'tech' | tech.php?error=16 |
|   P28   | a ∉ E8 | b ∉ E6 | c ∉ E6 | d ∈ E3 | e ∉ E4 | f | g | h = f+g | 'web\_admin' | 'tech' | tech.php?error=17 |
|   P29   | quelconque | quelconque | quelconque | quelconque | quelconque | f | g | h | 'visit' | j != 'user' | index.php |
|   P30   | quelconque | quelconque | quelconque | quelconque | quelconque | f | g | h | 'web_admin' | j != 'tech' | index.php |

---

| Identification du test : 1               |
|------------------------------------------|
| Version : 0                              |
| Description du test : update_acc         |
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
