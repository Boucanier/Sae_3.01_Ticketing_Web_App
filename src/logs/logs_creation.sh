#! /bin/bash

ticketStmt="SELECT CONCAT_WS(',', DATE_FORMAT(creation_date,'%d/%m/%Y'), ticket_id, user_login, ip_address, emergency) 'date, ticket_id, login, ip_adress, emergency'
    FROM Tickets
    WHERE status != 'closed'
    ORDER BY creation_date DESC;"

connStmt="SELECT CONCAT_WS(',', DATE_FORMAT(date_co,'%d/%m/%Y %T'), id_co, login, password, ip_address) 'date, id, login, password, ip_adress'
    FROM Connections
    WHERE succes = 0
    ORDER BY date_co DESC;"

closedStmt="SELECT CONCAT_WS(',', Tickets.ticket_id, emergency, room, title, user_login, DATE_FORMAT(creation_date,'%d/%m/%Y'), DATE_FORMAT(end_date,'%d/%m/%Y')) 'ticket_id, emergency, room, title, user_login, creation_date, end_date'
    FROM Tickets, Interventions
    WHERE Tickets.ticket_id = Interventions.ticket_id
    AND status = 'closed'
    ORDER BY creation_date DESC;"

user="ticket_app"
passwd="ticket_s301"
database="ticket_app"

date_name=$(date +%Y-%m-%d)

mysql -u $user -p$passwd -B -D $database -e "$ticketStmt" > 'tickets/tickets-'$date_name.csv
mysql -u $user -p$passwd -B -D $database -e "$connStmt" > 'connections/connections-'$date_name.csv
mysql -u $user -p$passwd -B -D $database -e "$closedStmt" > 'closed_tickets/closed-'$date_name.csv