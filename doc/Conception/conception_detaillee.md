# Conception détaillée

![logo_uvsq](../annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

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

La navigabilité entre ces différentes pages est également présentée dans le dossier de spécification (cf [spécification maquette](../Specification/maquettes.md)).

### Feuille de style

Nous n'avons qu'une seule feuille de style CSS : **style.css**
Elle est associée à tous les fichiers HTML. La raison est que toutes les pages se ressemblent et sont même identiques pour l'entête de page et le pied de page.

### Images

Les images utilisées sont le logo de l'IUT de Vélizy, notre logo et une icône d'utilisateur temporaire.
