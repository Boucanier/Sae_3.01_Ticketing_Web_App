# Chargement de la librarie shiny
library(shiny)

# On utilise le port 3000
options(shiny.port = 3000)

# UI
ui <- fluidPage(

  #Titre de la page
  titlePanel("Statistiques"),

  sidebarLayout(

    sidebarPanel(

      titlePanel("Pourcentage de tickets selon leur status"),

      # Input: Choix du status de ticket
      selectInput(
        input_id <- "statusType",
        label <- "Status du ticket :",
        choices <- c("open", "in_progress", "closed")
      ),

      # Input: Choix du nombre de tickets
      numericInput(
        input_id <- "nb_tickets",
        label <- "Nombre de tickets à observer :",
        max <- 40,
        min <- 1,
        value <- 40
      )
    ),

    mainPanel(
      verbatimTextOutput("texte"),
      plotOutput("graph1")
    )
  ),

  sidebarLayout(

    sidebarPanel(

      titlePanel("Pourcentage de connexion échouées"),

      # Input: Choix du nombre de connexions
      numericInput(
        input_id <- "nb_co",
        label <- "Nombre de dernieres connexions à observer :",
        max <- 40,
        min <- 1,
        value <- 40
      )
    ),

    mainPanel(
      plotOutput("graph2"),
      plotOutput("graph3")
    )
  )
)



# Serveur
server <- function(input, output) {

  # On récupère les données des fichiers CSV
  tickets <- read.csv("tickets.csv")
  connexions <- read.csv("connexions.csv")

  # On affiche les résultats

  # Premier affichage
  output$texte <- renderPrint(
    {
      # On récupère les valeurs entrées
      type <- input$statusType
      nb_tickets <- input$nb_tickets

      # On calcule le pourcentage
      pourcentage <- (length(which((tickets$status)[0:nb_tickets] == type))) / nb_tickets

      # On affiche le résultats
      if (type == "open") {
        print("Pourcentage de ticket ouvert : ")
        print(pourcentage)
      }
      if (type == "in_progress") {
        print("Pourcentage de ticket en cours : ")
        print(pourcentage)
      }
      if (type == "closed") {
        print("Pourcentage de ticket fermés : ")
        print(pourcentage)
      }
    }
  )

  # Deuxième affichage
  output$graph1 <- renderPlot(
    {
      # On récupère les valeurs entrées
      nb_tickets <- input$nb_tickets

      # On calcule le pourcentage
      pourcentages <- data.frame("status" = c("open", "in_progress", "closed"), "pourcentage" = c(round(((length(which((tickets$status)[0:nb_tickets] == "open"))) / nb_tickets), 2), round(((length(which((tickets$status)[0:nb_tickets] == "in_progress"))) / nb_tickets), 2), round(((length(which((tickets$status)[0:nb_tickets] == "closed"))) / nb_tickets), 2)))

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
  output$graph2 <- renderPlot(
    {
      # On récupère les valeurs entrées
      nb_co <- input$nb_co

      # On calcule le pourcentage
      succes <- data.frame("status" = c("réussie", "échouée"), "succes" = c(round(((length(which((connexions$succes)[0:nb_co] == "true"))) / nb_co), 2), round(((length(which((connexions$succes)[0:nb_co] == "false"))) / nb_co), 2)))

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
  output$graph3 <- renderPlot(
    {
      # On récupère les valeurs entrées
      nb_co <- input$nb_co

      # On calcule le pourcentage
      pourcentages <- c()

      for (i in 1:nb_co) {
        pourcentage <- round(((length(which((connexions$succes)[0:i] == "true"))) / i), 2)
        pourcentages <- c(pourcentages, pourcentage)
      }

      # On affiche le résultats
      plot(seq(1, nb_co), pourcentages, pch = 4, xlab = "Nombre de tentatives de connexions", ylab = "Pourcentage de connexions réussies")
      title("Pourcentage de connexions réussies")
    }
  )
}

# Lancer l"application
shinyApp(ui <- ui, server <- server)