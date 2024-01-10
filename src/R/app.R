# Chargement de la librarie shiny
library(shiny)

# On utilise le port 3000
options(shiny.port = 3000)

# UI
ui = fluidPage(

	#Titre de la page
	titlePanel("Statistiques"),

	sidebarLayout(

		sidebarPanel(

			titlePanel("Pourcentage de tickets selon leur status"),

      		# Input: Choix du status de ticket
      		selectInput(
      		    inputId = "statusType",
                label = "Status du ticket :",
				choices = c("open", "in_progress", "closed")
			),

			# Input: Choix du nombre de tickets
			numericInput(
			    inputId = "nbTickets",
                label = "Nombre de tickets à observer :",
				max = 40,
				min = 1,
                value = 15
            )
		),

		mainPanel(
		    verbatimTextOutput('texte'),
			plotOutput('graph1')
		)
	),

	sidebarLayout(

	    sidebarPanel(

            titlePanel("Pourcentage de connexion échouées"),

      		# Input: Choix du nombre de connexions
			numericInput(
			    inputId = "nbCo",
                label = "Nombre de dernieres connexions à observer :",
				max = 40,
				min = 1,
                value = 15
            )
	    ),

	    mainPanel(
			plotOutput('graph2'),
			plotOutput('graph3')
	    )
	)
)



# Serveur
server = function(input, output) {

    # On récupère les données des fichiers CSV
	tickets = read.csv("tickets.csv")
	connexions = read.csv("connexions.csv")

    # On affiche les résultats

    # Premier affichage
	output$texte = renderPrint(
	    {
	        # On récupère les valeurs entrées
            type = input$statusType
            nbTickets = input$nbTickets

            # On calcule le pourcentage
            pourcentage = (length(which((tickets$status)[0:nbTickets] == type)))/nbTickets

            # On affiche le résultats
            if (type == "open"){
                print("Pourcentage de ticket ouvert : ")
                print(pourcentage)
            }
            if (type == "in_progress"){
                print("Pourcentage de ticket en cours : ")
                print(pourcentage)
            }
            if (type == "closed"){
                print("Pourcentage de ticket fermés : ")
                print(pourcentage)
            }
	    }
	)

    # Deuxième affichage
	output$graph1 = renderPlot(
	    {
	        # On récupère les valeurs entrées
            nbTickets = input$nbTickets

            # On calcule le pourcentage
            pourcentages = data.frame("status" = c("open", "in_progress", "closed"), "pourcentage" = c(round(((length(which((tickets$status)[0:nbTickets] == 'open')))/nbTickets), 2), round(((length(which((tickets$status)[0:nbTickets] == 'in_progress')))/nbTickets), 2), round(((length(which((tickets$status)[0:nbTickets] == 'closed')))/nbTickets), 2)))

            # On affiche le résultats
            pie(
                pourcentages$pourcentage,
                col = c("#AAFFAA", "#FFEE44", "#FFAAAA"),
                labels = pourcentages$pourcentage,
                main = "Pourcentage de tickets par status",
                cex = 1.5
            )
            legend(
                x = "bottomright",
                legend = pourcentages$status,
                cex = 1.2,
                fill = c("green", "orange", "red")
            )
		}
	)

    # Troisième affichage
	output$graph2 = renderPlot(
	    {
	        # On récupère les valeurs entrées
	        nbCo = input$nbCo

            # On calcule le pourcentage
	        succes = data.frame( "status" = c("réussie", "échouée"), "succes" = c(round(((length(which((connexions$succes)[0:nbCo] == 'true')))/nbCo), 2), round(((length(which((connexions$succes)[0:nbCo] == 'false')))/nbCo), 2)))

            # On affiche le résultats
	        pie(
                succes$succes,
                col = c("#AAFFAA", "#FFAAAA"),
                labels = succes$succes,
                main = "Pourcentage de succes de connexion",
                cex = 1.5
            )
            legend(
                x = "bottomright",
                legend = succes$status,
                cex = 1.2,
                fill = c("green", "red")
            )
	    }
	)

    # Quatrième affichage
	output$graph3 = renderPlot(
        {
	        # On récupère les valeurs entrées
            nbCo = input$nbCo

            # On calcule le pourcentage
            pourcentages = c()

	        for (i in 1:nbCo){
	            pourcentage = round(((length(which((connexions$succes)[0:i] == 'true')))/i), 2)
	            pourcentages = c(pourcentages, pourcentage)
	        }

            # On affiche le résultats
            plot(seq(1, nbCo), pourcentages, pch=4, xlab = "Pourcentage de connexions réussies", ylab = "Nombre de tentatives de connexions")
            title("Pourcentage de connexions réussies")
        }
	)
}

# Lancer l'application
shinyApp(ui = ui, server = server)