# Cahier des Charges SAE

L’objectif général est la gestion d’un système de ticketing

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
