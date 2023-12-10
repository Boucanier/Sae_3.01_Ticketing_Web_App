# Spécification des cas d'utilisations

![logo_uvsq](../annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

Groupe : **INF2 - FI A**

## Introduction

Ce rapport a pour but de détailler les cas d'utilisations définis dans le [recueil de besoins](../Analyse/recueil_des_besoins.md).

## Cas 1

Le cas d'utilisation 1 "se connecter", permet à un utilisateur non-connecté de se connecter.

Pour cela, il doit se rendre sur la page de connexion, accessible depuis toutes les pages, en cliquant sur le bouton "se connecter" dans la barre de navigation.
Il doit ensuite remplir le formulaire correspondant à la connexion en saisissant son login et son mot de passe puis valider en cliquant sur le bouton "valider".
Les données saisies sont récupérées par les méthodes PHP et sont mises dans des requêtes SQL et envoyées à la base de données par le serveur Apache2.
Les requêtes vont vérifier l'existence du compte de l'utilisateur en comparant le login et le sha1 du mot de passe avec la ligne correspondante dans la base de données.
Il y a donc deux possibilités :

- Le compte n'existe pas.

  - On reste sur la page de connexion en affichant une erreur à l'utilisateur.

- Le compte existe.

  - On récupère le rôle du compte correspondant puis on redirige la personne qui vient de se connecter à la page correspondant à son compte (utilisateur standard, technicien, administrateur web ou administrateur système)

## Cas 2

Le cas d'utilisation 2 "se déconnecter", permet à un utilisateur connecté quel que soit son rôle de pouvoir se déconnecter.

Pour cela il doit tout simplement cliquer sur le bouton se déconnecter dans la barre de navigation.
Il est alors redirigé en tant qu'utilisateur non-connecté vers la page d'accueil.

## Cas 3

Le cas d'utilisation 3 "changer de mot de passe", permet à un utilisateur standard de changer de mot de passe.

Pour cela, l'utilisateur doit être connecté et accéder à la page de son profil, accessible depuis le bouton "profil" dans la barre de navigation.
Il doit remplir le formulaire pour changer de mot de passe. Celui-ci comprend le mot de passe actuel, le nouveau mot de passe et une confirmation du nouveau mot de passe.
Il valide ensuite en cliquant sur le bouton "Changer le mot de passe".
Si les champs n'ont pas été remplis correctement, il ne se passe rien au niveau de la base de données et il s'affiche une erreur.
Si les champs ont été correctement remplis, le changement de mot de passe s'effectue dans la base de données.

## Cas 4

Le cas d'utilisation 4 "supprimer un compte", permet à un utilisateur de supprimer son compte.

Pour cela, l'utilisateur doit être connecté et accéder à la page de son profil.
Il n'a qu'à appuyer sur le bouton "supprimer mon compte" pour supprimer son compte.
Il sera ensuite redirigé sur la page d'accueil du site en étant déconnecté.

## Cas 5

Le cas d'utilisation 5 "afficher une page web", permet d'afficher une page web.

Pour cela, il suffit qu'un utilisateur quel qu'il soit, inscrit ou non, clique sur un lien hypertext.
Ce dernier peut être n'importe lequel présent sur la page actuelle, dans la barre de navigation ou le pied de page.

## Cas 6

Le cas d'utilisation 6 "créer un ticket", permet à l'utilisateur d'ouvrir un ticket.

Pour cela, il doit être connecté et se rendre sur son tableau de bord.
Sur cette page, il doit cliquer sur le bouton "créer un ticket" qui le redirigera vers la page de création d'un ticket.
Il doit ensuite remplir tous les champs et valider.
Les informations seront envoyées à la base de données et enregistrées dans la table tickets.

## Cas 7

Le cas d'utilisation 7 "afficher son profil", permet à l'utilisateur d'accéder à la page de son profil.

Pour cela, il doit se connecter et cliquer sur le bouton "profil" dans la barre de navigation.
La page de son profil va donc s'afficher.
Cette page contient toutes ses informations personnelles : son login, son nom et son prénom.
Elle contient également un formulaire pour pouvoir changer de mot de passe.

## Cas 8

Le cas d'utilisation 8 "accéder au tableau de bord", permet à l'utilisateur d'accéder à son tableau de bord.

Pour cela, il doit se connecter et cliquer sur le bouton "tableau de bord" dans la barre de navigation.
La page tableau de bord va donc s'afficher.
Cette page contient un tableau contenant tous les tickets créés par cet utilisateur.
Elle contient aussi un bouton pour pouvoir créer un nouveau ticket.

## Cas 9

Le cas d'utilisation 9 "Gérer les libellés", permet à l'administrateur web de redéfinir les niveaux d'urgence d'un ticket.

Une fois connecté sur le site, l'administrateur web doit se rendre sur son tableau de bord.
Il a ainsi accès à tous les tickets ouverts ou en cours de traitement.
Il doit ensuite appuyer sur le bouton de détails d'un ticket afin d'obtenir des options avancées concernant ce ticket.
Il aura alors accès aux caractéristiques du ticket.
De plus, il aura la possibilité de changer le libellé du ticket concerné.

## Cas 10

Le cas d'utilisation 10 "Gérer statuts tickets", permet à l'administrateur web de redéfinir les niveaux d'urgence d'un ticket.

Une fois connecté sur le site, l'administrateur web doit se rendre sur son tableau de bord.
Il a ainsi accès à tous les tickets ouverts ou en cours de traitement.
Il doit ensuite appuyer sur le bouton de détails d'un ticket afin d'obtenir des options avancées concernant ce ticket.
Il aura alors accès aux caractéristiques du ticket.
De plus, il aura la possibilité de changer le statut du ticket concerné.

## Cas 11

Le cas d'utilisation 11 "Définir les niveaux d’urgence", permet à l'administrateur web de redéfinir les niveaux d'urgence d'un ticket.

Une fois connecté sur le site, l'administrateur web doit se rendre sur son tableau de bord.
Il a ainsi accès à tous les tickets ouverts ou en cours de traitement.
Il doit ensuite appuyer sur le bouton de détails d'un ticket afin d'obtenir des options avancées concernant ce ticket.
Il aura alors accès aux caractéristiques du ticket.
De plus, il aura la possibilité de changer le niveau d'urgence du ticket concerné.

## Cas 12

Le cas d’utilisation 12 "Créer comptes techniciens", permet à l'administrateur web de créer des comptes techniciens.

Pour se faire, l’administrateur web doit tout d’abord se connecter sur le site.
Puis il doit se diriger vers sa page de gestion des techniciens.
Il aura alors accès à une page permettant d’ajouter un technicien sur le site web en renseignant son login, son nom, son prénom et le mot de passe qu’il devra utiliser.
De plus, sur la même page il a accès à la liste de tous les techniciens du site.

## Cas 13

Le cas d’utilisation 13 "Consulter journaux d’activités", permet à l'administrateur système de consulter les journaux d’activités.

L’administrateur système doit tout d’abord se connecter sur le site web.
Puis celui-ci doit se rendre sur page des journaux d’activités.
Sur cette page, il a accès au journal des tickets qui référence tous les tickets créés avec leur date de création l’ip de la personne l’ayant créé et le niveau d’urgence de celui-ci.
De plus, il peut voir le journal des connexions ayant échouées avec la date, le login et le mot de passe de la personne ayant tenté de se connecter et enfin l’ip de celle-ci.
Pour finir l’administrateur système a accès à l’historique des tickets fermés qui comprend le niveau d’urgence, la salle, la description du problème, le demandeur, la date et la date de fin.

## Cas 14

Le cas d’utilisation 14 "Inscription des nouveaux utilisateurs", permet aux utilisateurs non inscrits de se créer un compte.

Pour se faire un utilisateur non inscrit devra se rendre sur "se connecter" puis remplir la partie de page correspondante à créer un compte.
Il devra alors renseigner son login, son nom, son prénom et le mot de passe qu’il souhaite utiliser.

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
Sur cette page, il peut créer des comptes techniques.
De plus, il a accès à la liste de tous les techniciens du site web.

## Cas 17

Le cas d'utilisation 17 "Configuration du système", permet à l'administrateur système de se gérer la partie système du site web.

Dans ce cas-ci, l'administrateur système se connecte via la page de connexion.
Une fois connecté, celui-ci peut aller dans son tableau de bord et ainsi avoir accès au journal des tickets créés, des connexions échouées et de l'historique des tickets fermés.

## Cas 18

Le cas d'utilisation 18 "Gérer les tickets", permet aux utilisateurs ou à l'administrateur web de gérer les tickets.

Pour cela, un utilisateur doit se connecter s'il ne l'a pas déjà fait puis il pourra enfin accéder à son tableau de bord contenant tous les tickets qu'il a déjà créés. De plus, depuis cette page l'utilisateur peut avoir accès aux détails de son ticket en plus de pouvoir en créer un nouveau.
L'administrateur web quant à lui doit être connecté et aller sur son tableau afin d'avoir accès à tous les tickets ouverts et en cours. Depuis son tableau de bord, il peut aussi avoir accès à des détails plus précis des tickets.
