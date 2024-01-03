library(shiny)

# On utilise le port 3000
options(shiny.port = 3000)

# UI
ui = fluidPage(

	#Titre de la page
	titlePanel("Statistiques"),

	# Sidebar
	sidebarLayout(

		# Sidebar panel
		sidebarPanel(

			titlePanel("Pourcentage de tickets selon leur status"),

      		# Input: Choix du status de ticket
      		selectInput(inputId = "statusType",
                  	label = "Status du ticket :",
				choices = c("open", "in_progress", "closed")
			),

			# Input: Choix du nombre de tickets
			numericInput(inputId = "nbTickets",
                  	label = "Nombre de tickets à observer :",
				max = 40,
				min = 1,
                  	value = 15)
			),

		# Main panel
		mainPanel(

			textOutput('texte'),
			plotOutput('graph')

		)
	)
)



# Serveur
server = function(input, output) {

	data = read.csv("data.csv")

	output$texte = renderPrint({	
		type = input$statusType
		nbTickets = input$nbTickets
		pourcentage = (length(which((data$status)[0:nbTickets] == type)))/nbTickets

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
	})

	output$graph = renderPlot({
		nbTickets = input$nbTickets
		pourcentages = data.frame("status" = c("open", "in_progress", "closed") , "pourcentage" = c(round(((length(which((data$status)[0:nbTickets] == 'open')))/nbTickets), 2), round(((length(which((data$status)[0:nbTickets] == 'in_progress')))/nbTickets), 2), round(((length(which((data$status)[0:nbTickets] == 'closed')))/nbTickets), 2)))
		
		pie(pourcentages$pourcentage, col=c("#AAFFAA","#FFEE44","#FFAAAA"), labels=pourcentages$pourcentage, main="Pourcentage de tickets par status", cex=1.5)
		legend(x="bottomright", legend=pourcentages$status, cex=1.2,fill=c("green","orange","red"))
		})

}

# Lancer l'application
shinyApp(ui = ui, server = server)