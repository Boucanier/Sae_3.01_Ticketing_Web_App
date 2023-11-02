# Conception détaillée

![logo_uvsq](../annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

Groupe : **INF2 - FI A**

## Site web

Nous avons dans la conception architecturale défini 3 composants :

- Pages web
- Feuilles de style
- Images

Nous allons ici faire la conception détaillée des ces composants.

### Pages web

Les pages web sont des fichiers HTML.
Elles correspondent aux pages définies dans la spécification des maquettes (cf [spécification maquette](../Specification/maquettes.md)).
On a donc les pages suivantes :

- Page d'accueil utilisateur (index.html)
- Page de connexion / création de compte (connection.html)
- Page contact (contact.html)
- Page affichage ticket utilisateur (ticket_details.html)
- Page tableau de bord (dashbord.html)
- Page profil utilisateur (profile.html)
- Page de création de ticket (ticket.html)
- Page des tickets disponibles
- Page modification du ticket du technicien
- Page modification du ticket de l'admin web
- Page gérer les techniciens
- Page journaux d'activité

Voici les différents utilisasteurs du site et les pages auquelles ils ont acces :

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

#### Administrateurs systems

- Page d'accueil utilisateur
- Page contact
- Page journaux d'activité
- Page profil utilisateur

La navigabilité entre ces différentes pages est également présentée dans le dossier de spécification (cf [spécification maquette](../Specification/maquettes.md)).

### Feuille de style

Nous n'avons qu'une seule feuille de style CSS : **style.css**
Elle est associée à tous les fichiers HTML. La raison est que toutes les pages se ressemblent et sont même identiques pour l'entête de page et le pied de page.

### Images

Les images utilisées sont le logo de l'IUT de Vélizy, notre logo et une icône d'utilisateur temporaire.
De plus nous avons ajouté une vidéo de présentation du site.
