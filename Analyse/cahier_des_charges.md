# Cahier des Charges SAE

L’objectif général de ce projet est la gestion d’un système de ticketing qui sera implémenté en PHP et MySQL. Il aura pour but de recueillir les demandes de dépannage de différents utilisateurs dans les salles de l'établissement. La plateforme de ticketing devra être accessible par l’intermédiaire de n’importe quel autre poste de l’IUT. Nous devons réaliser cette plateforme par groupe de quatre. Le projet doit  être complètement fini et déposé en janvier.

## Liste des acteurs, objets et actions

| Acteurs               | Objets                           | Actions                                                          |
|-----------------------|----------------------------------|------------------------------------------------------------------|
| étudiants             | Application web                  | Formuler des demandes                                            |
| professeurs           | plateforme de tickecting         | Accueillir les users                                             |
| utilisateurs          | page d'acueil                    | ~~proposer texte explicatif~~                                    |
| admin système         | texte explicatif                 | consulter différentes demandes                                   |
| admin web             | tableau de bord                  | visualiser 10 dernières demandes                                 |
| techniciens           | demandes                         | s'inscrire sur la plateforme                                     |
| utilisateurs inscrits | statut des demandes              | ouvrir un ticket                                                 |
| visiteurs             | vidéo de démonstration           | changer son mdp                                                  |
| clients               | formulaire d'inscription         | accéder à son profil                                             |
| M. Hoguin             | CAPTCHA                          | se connecter                                                     |
|                       | lien vers page en construction   | se connecter en ssh                                              |
|                       | base de données                  | gérer liste des libellés                                         |
|                       | login                            | modifier statut des tickets                                      |
|                       | mot de passe                     | définir les niveaux d'urgence                                    |
|                       | liste des libellés               | créer comptes techniciens                                        |
|                       | ticket (ouvert, fermé, en cours) | se déconnecter                                                   |
|                       | niveaux d'urgence                | visualiser tickets                                               |
|                       | comptes                          | affecter tickets aux techniciens                                 |
|                       | journaux d'activités             | ~~techniciens se connectent~~                                    |
|                       | date                             | techniciens s'attribuent les tickets eux-même                    |
|                       | adresse ip                       | changer état de tickets pris en charge                           |
|                       | historique                       | consulter journaux d'activité                                    |
|                       | statistiques                     | création journal d'activité (pour chaque tentative de connexion) |
|                       | système                          | création historique de tickets fermés                            |
|                       | serveur web                      | supprimer un compte                                              |
|                       | serveur SGBD                     |                                                                  |
|                       | RPi4                             |                                                                  |
|                       | connexion ssh                    |                                                                  |
|                       | carte sd                         |                                                                  |
|                       | documentation                    |                                                                  |
|                       | dépôt distant                    |                                                                  |
|                       | code                             |                                                                  |
|                       | nature du problème               |                                                                  |
|                       | _salle du problème_              |                                                                  |

## Tableaux de définition des cas d’utilisation

| 🪁 (Niveau Stratégique) 🔲 |
|----------------------------|
| Gérer les utilisateurs     |
| Configuration du système   |
| Gérer les tickets          |

| 🌊 (Niveau Utilisateur) ⬛                                                       |
|---------------------------------------------------------------------------------|
| Créer ticket                                                                    |
| Accéder à son profil                                                            |
| Afficher les tickets                                                            |
| Gérer liste libellés                                                            |
| Gérer status tickets                                                            |
| Définir les niveaux d’urgence                                                   |
| Creer comptes techniciens                                                       |
| Consulter journaux d’activités                                                  |
| Inscription des nouveaux utilisateurs                                           |
| Affecter les tickets aux techniciens (les techniciens s’attribuent les tickets) |

| 🐟 (Niveau Sous-fonction) |
|---------------------------|
| Se connecter (+ en ssh)   |
| Se déconnecter            |
| Changer son mdp           |
| Supprimer un compte       |


## Glossaire

Ce glossaire défini les mots complexes utilisés dans le cahier des charges.

| Mot                     | Définition                                                                                                                                                                          |
|-------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Application web         | Logiciel qui s'exécute dans un navigateur                                                                                                                                           |
| Plateforme de ticketing | Plateforme permettant de signaler des problèmes informatiques (1 problème = 1 ticket) afin que leur dépannage soit pris en charge                                                   |
| CAPTCHA                 | 'Completely Automated Public Turing test to tell Computers and Humans Apart' est un système d'authentification permettant de différencier les utilisateurs humains de robots        |
| Libellé                 | Titre d'un ticket                                                                                                                                                                   |
| Ticket                  | Demande de dépannage, contient la nature du problème, un niveau d'urgence, le demandeur, le lieu et la description du problème. Il peut être ouvert, fermé ou en cours de traitement|
| Journal d'activité      | Recueil de différentes actions qui ont eu lieu sur le serveur et de leur détails (historique de connexions ...)                                                                     |
| Adresse IP              | 'Internet Protocol', adresses liées aux différents appareils numériques qui nous entoure, permet de différencier les différentes personnes qui se connectent à la plateforme        |
| Serveur web             | Système permettant de lier les pages web entre elles (ici Apache)                                                                                                                   |
| Serveur SGBD            | Serveur de 'Système de Gestion de Base de Données', système de base de données lié à la plateforme (MySQL, MariaDB ...)                                                             |
| RPi 4                   | Raspberry Pi 4 : Nano-ordinateur supportant notre plateforme                                                                                                                        |
| Connexion ssh           | Connexion 'Secure Shell' : protocole de communication permettant de se connecter au serveur                                                                                         |
## Cas d'utilisations

### Niveau Sous-fonction

| Cas d'ulilisation 1 : Se connecter                                                                                                                                                                                                                                                                                                                                                                                                       |
|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Se connecter                                                                                                                                                                                                                                                                                                                                                                                                                   |
| **Portée** : Application Web                                                                                                                                                                                                                                                                                                                                                                                                             |
| **Niveau** : Sous-fonction                                                                                                                                                                                                                                                                                                                                                                                                               |
| **Acteurs Principaux** : Utilisateur, Aministrateur Web                                                                                                                                                                                                                                                                                                                                                                                  |
| **Scénario nominal** :<ol><li>L'utilisateur entre son login et son mot de passe</li><li>Récupérer les données et chercher dans la base de données</li><li>Récupérer le statut de l'utilisateur</li><li>Redirige vers la page correspondante</li></ol>                                                                                                                                                                                    |
| **Extension** :<ul><li>Si les informations données correspondent à un administrateur web<ul><li>Redirection vers la page administrateur web</li></ul></li><li>Si les informations données correspondent à un utilisateur<ul><li>Redirection vers la page d'accueil en étant conneté</li></ul></li><li>Si les informations données sont incorrectes<ul><li>Redirection vers la page d'accueil avec un message d'erreur</li></ul></li></ul> |

| Cas d'ulilisation 2 : Se déconnecter                                                                                                                           |
|----------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Se déconnecter                                                                                                                                       |
| **Portée** : Application Web                                                                                                                                   |
| **Niveau** : Sous-fonction                                                                                                                                     |
| **Acteurs Principaux** : Utilisateur, Aministrateur Web                                                                                                        |
| **Scénario** : <ol><li>L'acteur clique sur le boutton "se déconnecter"</li><li>Redirige sur la page d'accueil avec le message "déconnection réussie"</li></ol> |

| Cas d'utilisation 3 : Changer de mot de passe                                                                                                                                                 |
|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Changer de mot de passe                                                                                                                                                             |
| **Portée** : Base de donnée                                                                                                                                                                   |
| **Niveau** : Sous-fonction                                                                                                                                                                    |
| **Acteurs principaux** : Utilisateur                                                                                                                                                          |
| **Scénario** : <ol><li>L'utilisateur remplit les champs pour pouvoir changer son mot de passe</li><li>Change dans la base de données le mot de passe de l'utilisateur correspondant</li></ol> |
| **Extensions** : <ul><li>Si les données ne sont pas correctes<ul><li>Ne modifie pas la base de données et renvoie un message d'eereur</li></ul></li></ul>                                     |

| Cas d'utilisation 4 : Supprimer un compte                                                            |
|------------------------------------------------------------------------------------------------------|
| **Nom** : Supprimer un compte                                                                        |
| **Portée** : Base de donnée                                                                          |
| **Niveau** : Sous-fonction                                                                           |
| **Acteurs principaux** : Utilisateur                                                                 |
| **Scénario** : <ol><li>L'utilisateur se connecte</li><li>L'utilisateur supprime son compte</li></ol> |

### Niveau utilisateur

| Cas d'utilisation 5 : Créer ticket                                                                                                                                               |
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Création d'un ticket                                                                                                                                                   |
| **Portée** : Base de donnée                                                                                                                                                      |
| **Niveau** : Utilisateur                                                                                                                                                         |
| **Acteurs principaux** : Utilisateur                                                                                                                                             |
| **Scénario** : <ol><li>L'utilisateur se connecte</li><li>Il remplie les champs nécessaire à la création d'un ticket</li><li>Creation du ticket dans la base de données</li></ol> |

| Cas d'utilisation 6 : Accéder à son profil                                                                                                                                                                                                                 |
|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Accéder à son profil                                                                                                                                                                                                                             |
| **Portée** : Application web                                                                                                                                                                                                                               |
| **Niveau** : Utilisateur                                                                                                                                                                                                                                   |
| **Acteurs principaux** : Utilisateur                                                                                                                                                                                                                       |
| **Scénario** : <ol><li>L'utilisateur se connecte</li><li>Il peut changer son mot de passe</li><li>Il peut acceder à son tableau de bord</li><li>Il peut creer un ticket</li><li>Il peut supprimer son compte</li><li>L'utilisateur se déconnecte</li></li> |

| Cas d'utilisation 7 : Afficher les tickets                                                                                                                                     |
|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Afficher les tickets                                                                                                                                                 |
| **Portée** : Application web                                                                                                                                                   |
| **Niveau** : Utilisateur                                                                                                                                                       |
| **Acteurs principaux** : Utilisateur                                                                                                                                           |
| **Scénario** : <ol><li>L'utilisateur se connecte</li><li>Il peut choisir l'ordre d'affichage des tickets selon certains critères</li><li>L'utilisateur se déconnecte</li></ol> |
| **Extension** : <ul><li>Si c'est un utilisateur non-inscrit<ul><li>Il ne peut voir que les 10 derniers tickets</li></ul></li></ul>                                             |

| Cas d'utilisation 8 : Gérer liste libellés                                                                                                                       |
|------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Gérer liste libellés                                                                                                                                   |
| **Portée** : Base de donnée                                                                                                                                      |
| **Niveau** : Utilisateur                                                                                                                                         |
| **Acteurs principaux** : Administrateur web                                                                                                                      |
| **Scénario** : <ol><li>L'administrateur se connecte</li><li>L'administrateur web peut modifier les libéllés</li><li>L'administrateur web se déconnecte</li></ol> |

| Cas d'utilisation 9 : Gérer status tickets                                                                                                                               |
|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Gérer status tickets                                                                                                                                           |
| **Portée** : Base de données                                                                                                                                             |
| **Niveau** : Utilisateur                                                                                                                                                 |
| **Acteurs principaux** : Administrateur web                                                                                                                              |
| **Scénario** : <ol><li>L'administrateur se connecte</li><li>L'administrateur web peut changer le statut d'un ticket</li><li>L'administrateur web se déconnecte</li></ol> |

| Cas d'utilisation 10 : Définir les niveaux d’urgence                                                                                                                                |
|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Définir les niveaux d’urgence                                                                                                                                             |
| **Portée** : Base de données                                                                                                                                                        |
| **Niveau** : Utilisateur                                                                                                                                                            |
| **Acteurs principaux** : Administrateur web                                                                                                                                         |
| **Scénario** : <ol><li>L'administrateur se connecte</li><li>L'administrateur web peut modifier le niveau d'urgence d'un ticket</li><li>L'administrateur web se déconnecte</li></ol> |

| Cas d'utilisation 11 : Creer comptes techniciens                                                                                                                            |
|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Creer comptes techniciens                                                                                                                                         |
| **Portée** : Base de données                                                                                                                                                |
| **Niveau** : Utilisateur                                                                                                                                                    |
| **Acteurs principaux** : Administrateur web                                                                                                                                 |
| **Scénario** : <ol><li>L'administrateur se connecte</li><li>L'administrateur web peut créer des comptes de techniciens</li><li>L'administrateur web se déconnecte</li></ol> |

| Cas d'utilisation 12 : Consulter journaux d’activités                                                                                                                            |
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Consulter journaux d’activités                                                                                                                                         |
| **Portée** : Journaux d'activités                                                                                                                                                |
| **Niveau** : Utilisateur                                                                                                                                                         |
| **Acteurs principaux** : Administrateur système                                                                                                                                  |
| **Scénario** : <ol><li>L'administrateur se connecte</li><li>L'administrateur système peut consulter les journaux d'activité</li><li>L'administrateur web se déconnecte</li></ol> |

| Cas d'utilisation 13 : Inscription des nouveaux utilisateurs                       |
|------------------------------------------------------------------------------------|
| **Nom** : Inscription des nouveaux utilisateurs                                    |
| **Portée** : Base de données                                                       |
| **Niveau** : Utilisateur                                                           |
| **Acteurs principaux** : Utilisateur                                               |
| **Scénario** : <ol><li>L'utilisateur non-inscrit peut se créer un compte</li></ol> |

| Cas d'utilisation 14 : Affecter les tickets aux techniciens                                                                                                                                                                                   |
|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Affecter les tickets aux techniciens                                                                                                                                                                                                |
| **Portée** : Base de données                                                                                                                                                                                                                  |
| **Niveau** : Utilisateur                                                                                                                                                                                                                      |
| **Acteurs principaux** : Administrateur web, techniciens                                                                                                                                                                                      |
| **Scénario** : <ol><li>L'administrateur ou le technicien se connecte</li><li>L'administrateur web peut attribuer un ticket à un technice ou celui-ci peut s'en attribuer un</li><li>L'administrateur ou le technicien se déconnecte</li></ol> |

### Niveau stratégique

| Cas d'utilisation 15 : Gérer les utilisateurs                                                                                                                                                        |
|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Gérer les utilisateurs                                                                                                                                                                     |
| **Portée** : Base de donnée                                                                                                                                                                          |
| **Niveau** : Stratégique                                                                                                                                                                             |
| **Acteurs principaux** : Utilisateurs                                                                                                                                                                |
| **Scénario** : <ol><li>L'utilisateur peut se créer un compte s'il n'est pas inscrit</li><li>Il peut accéder à son compte</li><li>Créer un compte technicien s'il est un administrateur web</li></ol> |

| Cas d'utilisation 16 : Configuration du système                                                                                                                                                                               |
|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Configuration du système                                                                                                                                                                                            |
| **Portée** : Base de donnée                                                                                                                                                                                                   |
| **Niveau** : Stratégique                                                                                                                                                                                                      |
| **Acteurs principaux** : Administrateur sysème                                                                                                                                                                                |
| **Scénario** : <ol><li>L'administrateur système se connecte</li><li>Il gère la base de données de l'application web</li><li>Il gère l'administration réseau du serveur</li><li>Il consulte les journaux d'activités</li></ol> |

| Cas d'utilisation 17 : Gérer les tickets                                                                                                                                                                                                                                                                                      |
|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Nom** : Gérer les tickets                                                                                                                                                                                                                                                                                                   |
| **Portée** : Base de donnée                                                                                                                                                                                                                                                                                                   |
| **Niveau** : Stratégique                                                                                                                                                                                                                                                                                                      |
| **Acteurs principaux** : Utilisateur, Administrateur web                                                                                                                                                                                                                                                                      |
| **Scénario** : <ol><li>L'utilisateur ou l'administrateur web se connecte</li><li>L'utilisateur peut créer un ticket</li><li>L'administrateur web peut : <ul><li>Définir les niveaux d'urgence</li><li>Affecter les ticket aux techniciens</li><li>Gérer les status des tickets</li><li>Gérer les libéllés</li></ul></li></ol> |                               |

## La technologie employée

Le site va être effectué en PHP, MySQL, HTML, CSS. Le serveur pourra tourner sur un système Linux. Il faudra se connecter en ssh afin que les autres utilisateurs puissent accéder à la plateforme. Il y aura des pages web dynamiques dans et statiques se mettant à jour grâce à une base de données qui se remplit par l’intermédiaire des différentes actions des utilisateurs.

## Autres exigences

Les participants au projet sont Jules Chiron, Matis Rodier, Thomas Godineau, Maxence Ouvrard. Nous privilégions l’accessibilité pour tous sur notre plateforme. Nous souhaitons que les utilisateurs trouvent des réponses aux problèmes qu’ils rencontrent le plus efficacement et rapidement possible. Nous allons devoir installer Apache, PHP, MySQL afin que la plateforme puisse fonctionner correctement. De plus, le site doit ressembler plus ou moins aux maquettes que nous avons réalisées en amont. Ce projet est soumis à des dépendances client/utilisateurs car notre site dépend de la satisfaction de ces personnes. De plus ce projet à des dépendances techniques vis-à-vis de la base de données du site.
