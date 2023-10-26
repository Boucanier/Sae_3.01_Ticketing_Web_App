# Conception architecturale

![logo_uvsq](../annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

Groupe : **INF2 - FI A**

## Introduction

Nous choisissons de représenter la conception architecturale du projet par une vue composant-connecteur.
Effectivement, cette vue est la plus adaptée pour un site web car chaque composant représente un type de donnée.
Nous rappelons que dans cette version, nous n'avons pas installé le serveur sur le RaspberryPi. 

## Projet global

Tout d'abord nous allons réaliser la conception architecturale du projet dans sa globalité (hors installation sur RaspberryPi).
Nous devons réfléchir à quels sont les grands objets du projets.

Nous définissons 4 grands objets : 

- Le **navigateur internet** : biais par lequel l'utilisateur va acceder au site web.
- La **base de données** : base de données ***MySql*** permettant de stocker toutes les données relatives aux tickets et aux utilisateurs
- Le **site web** : site web ***PHP*** qui sera le corps de l'application
- Le **serveur** : serveur ***Apache2*** qui fera la connexion entre la base de données, le navigateur du client et le site web

Maintenant que nous avons nos objets, nous devons définir les relations ces grands objets.
