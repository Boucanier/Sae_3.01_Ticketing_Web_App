#! /bin/bash


# Le premier paramètre passé au script correspond à l'emplacement du dossier de configuration ([...]/config)

# On récupère l'emplacement des fichiers de logs
logsPath=$(jq -r '.logsPath' $1/logs.json)

# On récupère la date d'hier
date_name=$(date -d "yesterday" +%Y-%m-%d)

# Les requêtes SQL des données de la veille
    # On récupère les tickets ouverts
ticketStmt="SELECT CONCAT_WS(',', DATE_FORMAT(creation_date,'%d/%m/%Y'), ticket_id, user_login, ip_address, emergency) 'date,ticket_id,login,ip_address,emergency'
    FROM Tickets
    WHERE status != 'closed'
    AND DATE(creation_date) = CURDATE() - INTERVAL 1 DAY
    ORDER BY creation_date DESC;"

    # On récupère toutes les connexions
connStmt="SELECT CONCAT_WS(',', DATE_FORMAT(date_co,'%d/%m/%Y %T'), id_co, login, password, ip_address, succes) 'date,id,login,password,ip_address,success'
    FROM Connections
    WHERE DATE(date_co) = CURDATE() - INTERVAL 1 DAY
    ORDER BY date_co DESC;"

    # On récupère les tickets fermés
closedStmt="SELECT CONCAT_WS(',', Tickets.ticket_id, emergency, room, title, user_login, DATE_FORMAT(creation_date,'%d/%m/%Y'), DATE_FORMAT(end_date,'%d/%m/%Y')) 'ticket_id,emergency,room,title,user_login,creation_date,end_date'
    FROM Tickets, Interventions
    WHERE Tickets.ticket_id = Interventions.ticket_id
    AND status = 'closed'
    AND DATE(end_date) = CURDATE() - INTERVAL 1 DAY
    ORDER BY creation_date DESC;"

# On récupère les paramètres de connexion à la base de données
user=$(jq -r '.user' $1/db_credentials.json)
passwd=$(jq -r '.passwd' $1/db_credentials.json)
database=$(jq -r '.name' $1/db_credentials.json)

# On exécute les requêtes et on enregistre les résultats dans des fichiers CSV
mysql -u $user -p$passwd -B -D $database -e "$ticketStmt" > $logsPath'tickets/tickets-'$date_name.csv
mysql -u $user -p$passwd -B -D $database -e "$connStmt" > $logsPath'connections/connections-'$date_name.csv
mysql -u $user -p$passwd -B -D $database -e "$closedStmt" > $logsPath'closed_tickets/closed-'$date_name.csv

# On supprime les logs de plus de 180 jours (6 mois)
find $logsPath -type f -mtime +180 -delete

exit 0