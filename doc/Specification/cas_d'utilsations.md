# Spécification des cas d'utilisations

![logo_uvsq](../annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

Groupe : **INF2 - FI A**

## Cas 1

Le cas d'utilisation 1 "se connecter", permet à un utilisateur non-connecté de se connecter.

Pour cela il doit se rendre sur la page de connexion, accessible depuis toutes les pages, en cliquant sur le bouton "se connecter" dans la barre de navigation.
Il doit ensuite remplir le formulaire correspondant à la connexion en saisissant son login et son mot de passe puis valider en cliquant sur le bouton "valider".
Les données saisies récupérées par les méthodes PHP et sont mises dans des requêtes SQL et envoyées à la base de données par le serveur Apache2.
Les requêtes vont vérifier l'existence du compte de l'utilisateur en comparant le login et le sha1 du mot de passe avec la ligne correspondante dans la base de données.
Il y a donc deux possibilités :

- Le compte n'existe pas.

  - On reste sur la page de connexion en affichant une erreur à l'utilisateur.

- Le compte existe.

  - On récupère le role du compte correspondant puis on redirige la personne qui vient de se connecter à la page correspondant à son compte (utilisateur standard, technicien, administrateur web ou administrateur système)

## Cas 2

Le cas d'utilisation 2 "se déconnecter", permet à un utilisateur connecté quel que soit son rôle de pouvoir se déconnecter.

Pour cela il doit tout simplement cliquer sur le bouton se déconnecter dans la barre de navigation.
Il est alors redirigé en tant qu'utilisateur non-connecté vers la page d'accueil.

## Cas 3

Le cas d'utilisation 3 "changer de mot de passe", permet à un utilisateur standard de changer de mot de passe.

Pour cela, l'utilisateur doit être connecté et accéder à la page de son profile, accessible depuis le bouton "profil" dans la barre de navigation.
Il doit remplir le formulaire pour changer de mot de passe. Celui-ci comprend le mot de passe actuel, le nouveau mot de passe et une confirmation du nouveau mot de passe.
Il valide ensuite en cliquant sur le bouton "Changer le mot de passe".
Si les champs n'ont pas été remplie correctement, il ne se passe rien au niveau de la base de données et il s'affiche une erreur.
Si les champs ont été correctement remplis, le changement de mot de passe s'effectue dans la base de données.

## Cas 4

Le cas d'utilisation 4 "supprimer un compte", permet à un utilisateur de supprimer son compte.

Pour cela, l'utilisateur doit être connecté et accéder à la page de son profile.
Il n'a qu'à appuyer sur le bouton "supprimer mon compte" pour supprimer son compte.

## Cas 5

Le cas d'utilisation 5 "afficher une page web", permet d'afficher une page web.

Pour cela, il suffit qu'un utilisateur quel qu'il soit, inscrit ou non, de clique sur un lien hypertext.
Ce dernier peut être n'importe lequel présent sur la page actuelle, dans la barre de navigation ou le pied de page.

## Cas 15

Le cas d'utilisation 15 "Affecter les tickets aux techniciens", permet aux administrateurs web d'affecter un ticket à un technicien.

Une fois connecté à la page d'accueil l'administrateur web devra alors aller sur son tableau de bord.
Il cliquera ensuite sur les détails d'un ticket afin de pouvoir avoir accès aux détails du ticket et affecter un ticket à un technicien. De plus, il peut modifier le libellé, le niveau d'urgence et le nouvel état de celui-ci.

## Cas 16

Le cas d'utilisation 16 "Gérer les utilisateurs", permet aux utilisateurs de se gérer et à l'administrateur web de gérer les techniciens.

Un utilisateur non connecté pourra désormais se créer un compte ou alors se connecter.
Si celui-ci est connecté, il peut accéder à son profil.
Une fois cela effectué, l'utilisateur inscrit peut ainsi changer son mot de passe ou supprimer son compte.
Un administrateur web quant à lui peut aller sur sa page gérer les techniciens.
Sur cette page, il peut créer des comptes techniques en précisant le login, le nom, le prénom et le mot de passe du nouveau technicien.
De plus, il a accès à la liste de tous les techniciens du site web.

## Cas 17

Le cas d'utilisation 17 "Configuration du système", permet à l'administrateur système de se gérer la partie système du site web.

Dans ce cas-ci, l'administrateur système se connecte via la page de connexion.
Une fois connecté, celui-ci peut aller dans son tableau de bord et ainsi avoir accès au journal des tickets créés (date, ip et niveau), des connexions échoués (date, login, mot de passe, ip) et de l'historique des tickets fermé (niveau, salle, problème, demandeur, date et la date de fin.)

## Cas 18

Le cas d'utilisation 18 "Gérer les tickets", permet aux utilisateurs ou à l'administrateur web de gérer les tickets.

Pour cela, un utilisateur doit se connecter s'il ne l'a pas déjà fait puis il pourra enfin accéder à son tableau de bord contenant tous les tickets qu'il a déjà créés. De plus, depuis cette page l'utilisateur peut avoir accès aux détails de son ticket en plus de pouvoir en créer un nouveau.
L'administrateur web quant à lui doit être connecté et aller sur son tableau afin d'avoir accès à tous les tickets ouverts et en cours. Depuis son tableau de bord, il peut aussi avoir accès à des détails plus précis des tickets.
