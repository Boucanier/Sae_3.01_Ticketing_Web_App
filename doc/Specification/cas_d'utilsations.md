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
