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

| Produit testé : functions.php                                                               |
|---------------------------------------------------------------------------------------------|
| Configuration logicielle : Apache2, Google Chrome, Firefox, Brave                           |
| Configuration matérielle : Ubuntu 23.10, Windows 11                                         |
| Date de début : 02/12/2023                                                                  |
| Date de finalisation : 02/12/2023                                                           |
| Tests à appliquer : log_acc, create_acc, update_acc, close_ticket, take_ticket, edit_ticket |
| Responsable de la campagne de test : Jules CHIRON                                           |

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
- _E10 = {'user', 'tech'}_
- _Q = "quelconque"_

| Classe | Login | Nom | Prénom | Mdp | Confirmation mdp | Captcha attendu | Captcha donné | Role | Résultat attendu |
|:------:|:--------:|:--------:|:--------:|:--------:|:--------:|:--------:|:--------:|:--------:|:----------------:|
|   P1   | a ∉ E8 | b ∉ E7 | c ∉ E7 | d | e = d | f | h = f | 'user' | dashboard.php |
|   P2   | Q | Q | Q | Q | Q | f | h ≠ f | i ∈ E10 | connection.php?error=14 |
|   P3   | a ∈ E1 | Q | Q | Q | Q | f | h = f | i ∈ E10 | connection.php?error=11 |
|   P4   | a ∈ E2 | Q | Q | Q | Q | f | h = f | i ∈ E10 | connection.php?error=11 |
|   P5   | a ∈ E3 | Q | Q | Q | Q | f | h = f | i ∈ E10 | connection.php?error=11 |
|   P6   | a ∈ E5 | Q | Q | Q | Q | f | h = f | i ∈ E10 | connection.php?error=11 |
|   P7   | a ∈ E4 | Q | Q | Q | Q | f | h = f | i ∈ E10 | connection.php?error=13 |
|   P8   | a ∉ E9 | b ∈ E4 | Q | Q | Q | f | h = f | i ∈ E10 | connection.php?error=13 |
|   P9   | a ∉ E9 | Q | c ∈ E4 | Q | Q | f | h = f | i ∈ E10 | connection.php?error=13 |
|   P10   | a ∉ E9 | Q | Q | d ∈ E4 | Q | f | h = f | i ∈ E10 | connection.php?error=13 |
|   P11   | a ∉ E9 | Q | Q | Q | e ∈ E4 | f | h = f | i ∈ E10 | connection.php?error=13 |
|   P12   | a ∉ E8 | b ∈ E3 | c ∉ E6 | d ∉ E6 | e ∉ E6 | f | h = f | i ∈ E10 | connection.php?error=15 |
|   P13   | a ∉ E8 | b ∉ E6 | c ∈ E3 | d ∉ E6 | e ∉ E4 | f | h = f | i ∈ E10 | connection.php?error=16 |
|   P14   | a ∉ E8 | b ∉ E6 | c ∉ E6 | d ∈ E3 | e ∉ E4 | f | h = f | i ∈ E10 | connection.php?error=17 |

---

| Identification du test : 2                                   |
|--------------------------------------------------------------|
| Version : 0                                                  |
| Description du test : update_acc                             |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Jules CHIRON                                   |

#### Cas de test

| Classe | Mdp actuel | Nouveau mdp | Confirmation mdp | Résultat attendu     |
|:------:|:----------:|:-----------:|:----------------:|:--------------------:|
|   P1   | mauvais    |      a      |      b = a       | profile.php?error=31 |
|   P2   | mauvais    |      a      |     b != a       | profile.php?error=33 |
|   P3   | correct    |      a      |     b != a       | profile.php?error=33 |
|   P4   | correct    |      a      |      b = a       | profile.php?success=1|

---

| Identification du test : 3                                   |
|--------------------------------------------------------------|
| Version : 0                                                  |
| Description du test : close_ticket                           |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Matis RODIER                                   |

- _tech = {tech}_
- _other = {user, sys_admin, web_admin}_
- _ticket_clos = {oui, non}_

| Classe |   User    | Ticket clos |    Résultat attendu     |
|:------:|:---------:|:-----------:|:-----------------------:|
|   P1   | a ∈ tech  |     non     | dashboard.php?success=1 |
|   P2   | a ∈ tech  |     oui     |      dashboard.php      |
|   P3   | a ∈ other |  oui U non  |        index.php        |

---

| Identification du test : 4                                   |
|--------------------------------------------------------------|
| Version : 0                                                  |
| Description du test : take_ticket                            |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Matis RODIER                                   |

- _tech = {tech}_
- _other = {user, sys_admin, web_admin}_

Il faudra trouver un id correspond au success et a l'error (x et y)

| Classe |   User    | Ticket pris |    Résultat attendu     |
|:------:|:---------:|:-----------:|:-----------------------:|
|   P1   | a ∈ tech  |     non     | dashboard.php?success=2 |
|   P2   | a ∈ tech  |     oui     |      dashboard.php      |
|   P3   | a ∈ other |  oui U non  |        index.php        |

---

| Identification du test : 5                                   |
|--------------------------------------------------------------|
| Version : 0                                                  |
| Description du test : edit_ticket                            |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Matis RODIER                                   |

- _web_admin = {web_admin}_
- _other = {user, sys_admin, tech}_
- _E1 = {1 < nombre de caractères < 30}_
- _E2 = {1, 2, 3, 4}_
- _E3 = {open, in_progress, closed}_
- _E3 = {users ayant le rôle de tech}_
- _Q = "quelconque"_

Il faudra trouver un id correspond au success et a l'error (x et y)

| Classe |     User      | newLibelle | newEmergency | newStatus | newTech | previousLibelle | previousEmergency | previousStatus | previousTech |        Résultat attendu         |
|:------:|:-------------:|:----------:|:------------:|:---------:|:-------:|:---------------:|:-----------------:|:--------------:|:------------:|:-------------------------------:|
|   P1   | a ∈ web_admin |   a ∈ E1   |    a ∈ E2    |  a ∈ E3   | a ∈ E4  |        Q        |         Q         |       Q        |      Q       |     dashboard.php?success=3     |
|   P1   | a ∈ web_admin |   a ∉ E1   |      Q       |     Q     |    Q    |        Q        |         Q         |       Q        |      Q       | ticket_modification.php?error=1 |
|   P1   | a ∈ web_admin |     Q      |    a ∉ E2    |     Q     |    Q    |        Q        |         Q         |       Q        |      Q       | ticket_modification.php?error=2 |
|   P1   | a ∈ web_admin |     Q      |      Q       |  a ∉ E3   |    Q    |        Q        |         Q         |       Q        |      Q       | ticket_modification.php?error=3 |
|   P1   | a ∈ web_admin |     Q      |      Q       |     Q     | a ∉ E4  |        Q        |         Q         |       Q        |      Q       | ticket_modification.php?error=4 |
|   P2   |   a ∈ other   |     Q      |      Q       |     Q     |    Q    |        Q        |         Q         |       Q        |      Q       |            index.php            |

### 3. Résultats de tests
