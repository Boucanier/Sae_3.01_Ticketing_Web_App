# Conception détaillée

![logo_uvsq](../annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

Groupe : **INF2 - FI A**

## Site web

Nous avons défini 3 composants dans la conception architecturale :

- Pages web
- Feuilles de style
- Images

Nous allons ici faire la conception détaillée de ces composants.

### Pages web

Les pages web sont du code **HTML** contenu dans des fichiers **PHP**.

Nous avons donc les pages suivantes :

- Page d'accueil utilisateur (*index.php*)
- Page de connexion / création de compte (*connection.php*)
- Page contact (*contact.php*)
- Page affichage ticket utilisateur (*ticket_details.php*)
- Page tableau de bord (*dashboard.php*)
- Page profil utilisateur (*profile.php*)
- Page de création de ticket (*ticket.php*)
- Page des tickets disponibles
- Page modification du ticket du technicien
- Page modification du ticket de l'admin web
- Page gestion des techniciens
- Page journaux d'activité
- Page modification de la clé de chiffrement

Voici les différents utilisateurs du site et les pages auxquelles ils ont accès :

#### Visiteur

- Page d'accueil utilisateur
- Page de connexion / création de compte
- Page contact

#### Utilisateurs inscrits

- Page d'accueil utilisateur
- Page contact
- Page affichage ticket utilisateur
- Page tableau de bord
- Page profil utilisateur
- Page de création de ticket

#### Techniciens

- Page d'accueil utilisateur
- Page contact
- Page tableau de bord
- Page des tickets disponibles
- Page profil utilisateur
- Page affichage ticket utilisateur
- Page modification du ticket du technicien

#### Administrateurs web

- Page d'accueil utilisateur
- Page contact
- Page tableau de bord
- Page gérer les techniciens
- Page profil utilisateur
- Page modification du ticket de l'admin web

#### Administrateurs système

- Page d'accueil utilisateur
- Page contact
- Page journaux d'activité
- Page profil utilisateur
- Page modification de la clé de chiffrement

### Feuilles de style

Nous avons deux feuilles de style CSS : **style.css** et **dys_styles.css**.
La première est associée à tous les fichiers PHP. La raison est que toutes les pages se ressemblent et sont même identiques pour l'entête de page et le pied de page.

La seconde permet de modifier la police pour la rendre plus lisible pour les personnes dyslexiques. Elle est appliquée à toutes les pages quand l'utilisateur active le mode dyslexique.

### Images

Les images utilisées sont le logo de l'IUT de Vélizy, notre logo et une icône d'utilisateur.
De plus, nous avons ajouté une vidéo de présentation du site.
