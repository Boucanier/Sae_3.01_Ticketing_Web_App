# Cahier des Charges SAE

L’objectif général de ce projet est la gestion d’un système de ticketing qui sera implémenté en PHP et MySQL. Il aura pour but de recueillir les demandes de dépannage de différents utilisateurs dans les salles de l'établissement. La plateforme de ticketing devra être accessible par l’intermédiaire de n’importe quel autre poste de l’IUT. Nous devons réaliser cette plateforme par groupe de quatre. Le projet doit  être complètement fini et déposé en janvier.

## Liste des acteurs, objets et actions

| Acteurs | Objets | Actions |
|---------|--------|---------|
|étudiants|Application web|Formuler des demandes|
|professeurs|plateforme de tickecting|Accueillir les users|
|utilisateurs|page d'acueil|proposer texte explicatif|
|admin système|texte explicatif|consulter différentes demandes|
|admin web|tableau de bord|visualiser 10 dernières demandes|
|techniciens|demandes|s'inscrire sur la plateforme|
|utilisateurs inscrits|statut des demandes|ouvrir un ticket|
|visiteurs|vidéo de démonstration|changer son mdp|
|clients|formulaire d'inscription|accéder à son profil|
|M. Hoguin|CAPTCHA|se connecter|
||lien vers page en construction|se connecter en ssh|
||base de données|gérer liste des libellés|
||login|modifier statut des tickets|
||mot de passe|définir les niveaux d'urgence|
||liste des libellés|créer comptes techniciens|
||ticket (ouvert, fermé, en cours)|se déconnecter|
||niveaux d'urgence|visualiser tickets|
||comptes|affecter tickets aux techniciens|
||journaux d'activités|~~techniciens se connectent~~|
||date|techniciens s'attribuent les tickets eux-même|
||adresse ip|changer état de tickets pris en charge|
||historique|consulter journaux d'activité|
||statistiques|création journal d'activité (pour chaque tentative de connexion)|
||système|création historique de tickets fermés|
||serveur web||
||serveur SGBD||
||RPi4||
||connexion ssh||
||carte sd||
||documentation||
||dépôt distant||
||code||
||nature du problème||
||_salle du problème_||

## Tableau de définition des cas d’utilisation

|🪁 (Niveau Stratégique) 🔲|
|---------------------------|
|Gérer les utilisateurs|
|Gérer les tickets|
|Configuration du système|

|🌊 (Niveau Utilisateur) ⬛|
|--------------------------|
|Créer ticket|
|Accéder à son profil|
|Visualiser 10 derniers tickets|
|Gérer liste libellés|
|Gérer status tickets|
|Définir les niveaux d’urgence|
|Creer comptes techniciens|
|Consulter journaux d’activités|
|Créer historique|
|Inscription des nouveaux  utilisateurs|
|Affecter les tickets aux techniciens (les techniciens s’attribuent les tickets)|

|🐟 (Niveau Sous-fonction)|
|-------------------------|
|Proposer texte explicatif|
|Se connecter (+ en ssh)|
|Consulter les différentes demandes|
|Se déconnecter|
|Changer son mdp|
|Création d’un journal d’activité|
|Création tableau de bord|

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


## La technologie employée
Le site va être effectué en PHP, MySQL, HTML, CSS. Le serveur pourra tourner sur un système Linux. Il faudra se connecter en ssh afin que les autres utilisateurs puissent accéder à la plateforme. Il y aura des pages web dynamiques dans et statiques se mettant à jour grâce à une base de données qui se remplit par l’intermédiaire des différentes actions des utilisateurs.
