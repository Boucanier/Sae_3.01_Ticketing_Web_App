CREATE DATABASE IF NOT EXISTS ticket_app;
USE ticket_app;

DROP TABLES IF EXISTS Users, Tickets, Interventions;
DROP TRIGGER IF EXISTS check_interventions_user;
DROP TRIGGER IF EXISTS check_interventions_ticket;
DROP TRIGGER IF EXISTS check_tickets_user;

CREATE TABLE Users (
    login VARCHAR(30) UNIQUE NOT NULL PRIMARY KEY,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    password VARCHAR(40) NOT NULL,
    role VARCHAR(10) NOT NULL CHECK (role IN ('user', 'tech', 'web_admin', 'sys_admin'))
);

CREATE TABLE Tickets (
    ticket_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(30) NOT NULL,
    description TEXT NOT NULL,
    room VARCHAR(10) NOT NULL,
    status VARCHAR(20) NOT NULL CHECK (status IN ('open', 'closed', 'in_progress')),
    emergency VARCHAR(10) NOT NULL CHECK (emergency IN (1, 2, 3, 4)),
    creation_date DATE NOT NULL,
    user_login VARCHAR(30) NOT NULL REFERENCES Users(login)
);

CREATE TABLE Interventions (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    ticket_id INTEGER NOT NULL REFERENCES Tickets(ticket_id),
    tech_login VARCHAR(30) NOT NULL REFERENCES Users(login),
    end_date DATE
);

delimiter //
CREATE TRIGGER check_interventions_user BEFORE INSERT ON Interventions
FOR EACH ROW
BEGIN
    IF NOT (NEW.tech_login IN (SELECT login FROM Users)) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'User must exist';
    END IF;
    IF (SELECT role FROM Users WHERE login = NEW.tech_login) != 'tech' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Tech login must be a tech';
    END IF;
END;//
delimiter ;

delimiter //
CREATE TRIGGER check_interventions_ticket BEFORE INSERT ON Interventions
FOR EACH ROW
BEGIN
    IF (SELECT emergency FROM Tickets WHERE ticket_id = NEW.ticket_id) != 'open' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Ticket is closed or in progress';
    END IF;
END;//
delimiter ;

delimiter //
CREATE TRIGGER check_tickets_user BEFORE INSERT ON Tickets
FOR EACH ROW
BEGIN
    IF NOT (NEW.user_login IN (SELECT login FROM Users)) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'User must exist';
    END IF;
    IF (SELECT role FROM Users WHERE login = NEW.user_login) != 'user' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'User login must be a user';
    END IF;
END;//
delimiter ;

INSERT INTO Users VALUES ('admin', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'sys_admin');
INSERT INTO Users VALUES ('tec1', 'tec1', 'tec1', '73f7a2f5b9bd744ab54cd1d307975868fc93a844', 'tech');
INSERT INTO Users VALUES ('tec2', 'tec2', 'tec2', '73f7a2f5b9bd744ab54cd1d307975868fc93a844', 'tech');

DROP USER IF EXISTS 'ticket_app'@'localhost';
CREATE USER 'ticket_app'@'localhost' IDENTIFIED BY 'ticket_s301';
GRANT SELECT, INSERT, UPDATE ON *.* TO 'ticket_app'@'localhost' WITH GRANT OPTION;