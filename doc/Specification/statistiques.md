# Rapport de spécification : R Shiny

![logo*uvsq](../annexes/logo_uvsq.png)

**Godineau Thomas**, **Rodier Matis**, **Chiron Jules**

Groupe : **INF2 - FI A**

## Introduction

R Shiny est une library du langage R. Elle permet de créer des pages web dynamiques.

## Présentation

### Library Shiny

La page shiny contient 3 principaux éléments :

- **L'UI**
- **Le serveur**
- **ShinyApp**

#### L'UI

L'UI, interface utilisateur (User Interface), permet à l'utilisateur d'ajouter, de modifier ou de supprimer des données. Mais il peut également choisir entre différentes données proposées. Ces données seront enregistrées comme **input**. Pour faire cela, l'utilisateur a accès à différents panels.

Il doit également contenir les **outputs** qui doivent définir leur type de représentation.

L'UI est le nom de la variable qui va contenir l'élément **fluidPage**

Cet élément contient les différents éléments qui vont composer la page.

#### Le serveur

Le serveur est une **fonction**. Elle récupère les valeurs **input** saisies ou choisies par l'utilisateur puis réalise des opérations dessus. Elle peut simplement les afficher dans un tableau ou un graphique, mais aussi faire des moyennes des probabilités ...

#### ShinyApp

**ShinyApp** est une commande qui prend en argument l'**UI** et le **Serveur** et qui permet de lancer la page. La page se lance sur le réseau **localhost**.

## Notre page

Nous avons décidé de représenter 2 statistiques :

- Le pourcentage de tickets selon leur status
- Le pourcentage de connexions réussies

### Le code

Notre page commence par charger la bibliothèque **shiny**.

Nous avons également la commande **options(shiny.port = 3000)** qui nous permet de toujours lancer la page sur le port 3000.

### UI

Notre **fluidPage** contient 3 éléments :

- Un **titlePanel**
- Deux **sidebarLayout**

**titlePanel** permet de mettre un titre à notre page. On l'a appelé ici 'Statistiques'.

Nos **sidebarLayout** contiennent chacun un **sidebarPanel** et un **mainPanel**.

Le premier **sidebarLayout** sert à la représentation de la première statistique (le pourcentage de tickets selon leur status). Son **sidebarPanel** contient un **titlePanel** permettant de donner un titre au panel, ainsi deux **inputs**:

- Le premier input est un **selectInput** qui permet de choisir entre les différents status de ticket (open, in_progress, closed).
- Le deuxième input est un **numericInput** qui permet de choisir le nombre de tickets à étudier.
  
Son **mainPanel** contient deux **outputs** :

- Le premier est de type **verbatimTextOutput**. La sortie sera sous forme de texte.
- Le deuxieme est de type : **plotOutput**. La sortie sera un graphique.

Le deuxième **sidebarLayout** sert à la représentation de la seconde statistique (le pourcentage de connexions réussies). Son **sidebarPanel** contient un **titlePanel** et un seul **input** :

- L'input est un **numericInput**  qui permet de choisir le nombre de connexions à étudier.

Son **mainPanel** contient deux **outputs** :

- Les deux sont de type **plotOutput**. Il y aura donc deux graphiques.

### Serveur

Notre fonction serveur commence par récupérer les données des fichiers csv.

Il y a ensuite les représentations de nos **outputs**.

Ils seront listés dans l'ordre décrit dans la partie précédente.

- Le premier est une zone de texte contenant le pourcentage de ticket selon le type choisis dans le selectInput.
- Le deuxième est un graphique camembert qui découpe par le pourcentage de chaque status de ticket.
- Le troisième est encore un graphique camembert qui lui découpe par le pourcentage de connexions réussies ou échouées.
- Le quatrième graphique est la représentation du pourcentage de connexions réussies sous forme de points.

## Hébergement

Nous avons d'abord souhaité héberger notre serveur shiny sur le **Raspberry Pi** de la SAÉ. Cependant, il s'est avéré impossible de lancer une application shiny sur ce serveur.
Nous avons essayer d'installer R depuis les dépôts officiels et nous avions une *erreur de bus*. Nous avons donc installé R par compilation depuis les sources. Cependant, nous avions toujours une erreur lors du lancement de l'application.

Finalement, nous avons décider d'héberger notre application shiny sur un serveur **ShinyApps.io**. Ce site est un site officiel qui permet d'héberger des applications shiny. Nous avons créé un compte gratuit qui permet d'héberger jusqu'à 5 applications. Cependant, une application ne peut être *active* (chargée sur un navigateur) que 25 heures par mois. Étant donné que cette page ne sert que dans ce projet, nous avons choisi cette solution.
