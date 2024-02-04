# Dossier de tests

![logo_uvsq](../../annexes/logo_uvsq.png)

| Web App Ticketing                                         | Version : 0       |
|-----------------------------------------------------------|-------------------|
| Document : Dossier de tests                               | Date : 02/12/2023 |
| Responsables de la rédaction : Jules CHIRON, Matis RODIER |                   |

## 1. Introduction

Ce dossier contient les tests pour les différents liens utilisés sur la page _contact.php_.

## 2. Description de la procédure de test

Nous testons les liens présents sur la page et depuis lesquels il est possible d'accéder à une autre page. Nous vérifions que le lien renvoie bien vers la page attendue.

## 3. Description des informations à enregistrer pour les tests

### 1. Campagne de test

| Produit testé : contact.php                                       |
|-------------------------------------------------------------------|
| Configuration logicielle : Apache2, Google Chrome, Firefox, Brave |
| Configuration matérielle : Ubuntu 23.10, Windows 11               |
| Date de début : 02/12/2023                                        |
| Date de finalisation : 02/12/2023                                 |
| Tests à appliquer : page_contact                                  |
| Responsable de la campagne de test : Jules CHIRON                 |

### 2. Tests

| Identification du test : 0                                   |
|--------------------------------------------------------------|
| Version : 0                                                  |
| Description du test : page_contact                           |
| Ressources requises : Apache2, Google Chrome, Firefox, Brave |
| Responsable : Jules CHIRON                                   |

#### Cas de test

| Classe |   Donnée 1    |                              Résultat attendu                               |
|:------:|:-------------:|:---------------------------------------------------------------------------:|
|   P1   |   ‘ce lien’   |  _Lien vers un client mail avec un mail vers <contact.golemcorp@gmail.com>_ |
|   P2   | ‘lien GitHub’ |         _<https://github.com/Boucanier/Sae_3.01_Ticketing_Web_App>_         |

### 3. Résultats de tests

| Référence du test appliqué : 0             |
|--------------------------------------------|
| Responsable : Matis RODIER                 |
| Date de l'application du test : 08/12/2023 |
| Résultat de test : OK                      |
| Occurrence des résultats : systématique    |

| Classe |   Donnée 1    |                              Résultat attendu                               |                              Résultat observé                              | Résultat test |
|:------:|:-------------:|:---------------------------------------------------------------------------:|:--------------------------------------------------------------------------:|:-------------:|
|   P1   |   ‘ce lien’   |  _Lien vers un client mail avec un mail vers <contact.golemcorp@gmail.com>_ | _Lien vers un client mail avec un mail vers <contact.golemcorp@gmail.com>_ |      OK       |
|   P2   | ‘lien GitHub’ |         _<https://github.com/Boucanier/Sae_3.01_Ticketing_Web_App>_         |        _<https://github.com/Boucanier/Sae_3.01_Ticketing_Web_App>_         |      OK       |

### 4. Conclusion

Tous les tests que nous avons effectués pour la page contact sont OK.