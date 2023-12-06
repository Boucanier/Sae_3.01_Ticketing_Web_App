CREATE DATABASE IF NOT EXISTS ticket_app;
USE ticket_app;



DROP TABLES IF EXISTS Users, Tickets, Interventions, Connections;
DROP TRIGGER IF EXISTS check_interventions_user;
DROP TRIGGER IF EXISTS check_interventions_ticket;
DROP TRIGGER IF EXISTS check_tickets_user;



CREATE TABLE Users (
    login VARCHAR(40) UNIQUE NOT NULL PRIMARY KEY,
    first_name VARCHAR(40) NOT NULL,
    last_name VARCHAR(40) NOT NULL,
    password VARCHAR(40) NOT NULL,
    role VARCHAR(10) NOT NULL CHECK (role IN ('user', 'tech', 'web_admin', 'sys_admin'))
);

CREATE TABLE Tickets (
    ticket_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(30) NOT NULL,
    description TEXT NOT NULL,
    room VARCHAR(10) NOT NULL,
    status VARCHAR(20) NOT NULL CHECK (status IN ('open', 'closed', 'in_progress')),
    emergency INTEGER NOT NULL CHECK (emergency IN (1, 2, 3, 4)),
    creation_date DATE NOT NULL,
    user_login VARCHAR(40) NOT NULL REFERENCES Users(login),
    ip_address VARCHAR(15) NOT NULL
);

CREATE TABLE Interventions (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    ticket_id INTEGER NOT NULL REFERENCES Tickets(ticket_id),
    tech_login VARCHAR(40) NOT NULL REFERENCES Users(login),
    end_date DATE
);

CREATE TABLE Connections (
    id_co INTEGER PRIMARY KEY AUTO_INCREMENT,
    ip_address VARCHAR(15) NOT NULL,
    login VARCHAR(40) NOT NULL REFERENCES Users(login),
    password VARCHAR(40) NOT NULL,
    succes BOOLEAN NOT NULL,
    date_co DATETIME NOT NULL
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
CREATE TRIGGER check_ticket_id_intervention BEFORE INSERT ON Interventions
FOR EACH ROW
BEGIN
    IF NEW.ticket_id NOT IN (SELECT ticket_id FROM Tickets)
        THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Ticket must exist';
    END IF;
END;//
delimiter ;

delimiter //
CREATE TRIGGER check_interventions_ticket_open BEFORE INSERT ON Interventions
FOR EACH ROW
BEGIN
    IF (SELECT status FROM Tickets WHERE ticket_id = NEW.ticket_id) != 'open' THEN
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

delimiter //
CREATE TRIGGER update_login_references AFTER UPDATE ON Users
FOR EACH ROW
BEGIN
    UPDATE Connections Cnt SET Cnt.login = NEW.login WHERE Cnt.login = OLD.login;
    UPDATE Interventions Itv SET Itv.tech_login = NEW.login WHERE Itv.tech_login = OLD.login;
    UPDATE Tickets Tkt SET Tkt.user_login = NEW.login WHERE Tkt.user_login = OLD.login;
END;//
delimiter ;

delimiter //
CREATE TRIGGER update_ticket_status_in_progress AFTER INSERT ON Interventions
FOR EACH ROW
BEGIN
    UPDATE Tickets SET status = 'in_progress' WHERE ticket_id = NEW.ticket_id;
END;//
delimiter ;

delimiter //
CREATE TRIGGER update_end_date AFTER UPDATE ON Tickets
FOR EACH ROW
BEGIN
    IF (NEW.status = 'closed') THEN
        UPDATE Interventions SET end_date = CURDATE() WHERE ticket_id = NEW.ticket_id;
    END IF;
END;//
delimiter ;

delimiter //
CREATE TRIGGER close_tickets_for_deleted_account AFTER UPDATE ON Users
FOR EACH ROW
BEGIN
    IF (NEW.login LIKE 'rmv-%') THEN
        UPDATE Tickets SET status = 'closed' WHERE user_login = NEW.login;
        IF (NEW.login IN (SELECT DISTINCT tech_login FROM Interventions)) THEN
            UPDATE Tickets SET status = 'open'
            WHERE status = 'in_progress'
            AND ticket_id IN (SELECT ticket_id FROM Interventions WHERE tech_login = NEW.login);
        END IF;
    END IF ;
END //
delimiter ;


-- Ajout des utilisateurs demandés dans le sujet
INSERT INTO Users VALUES ('admin', 'sys', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'sys_admin');
INSERT INTO Users VALUES ('tec1', 'tec1', 'tec1', '73f7a2f5b9bd744ab54cd1d307975868fc93a844', 'tech');
INSERT INTO Users VALUES ('tec2', 'tec2', 'tec2', '73f7a2f5b9bd744ab54cd1d307975868fc93a844', 'tech');

-- Ajout d'un admin web
INSERT INTO Users VALUES ('webadmin', 'web', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'web_admin');

DROP USER IF EXISTS 'ticket_app'@'localhost';
CREATE USER 'ticket_app'@'localhost' IDENTIFIED BY 'ticket_s301';
GRANT SELECT, INSERT, UPDATE ON *.* TO 'ticket_app'@'localhost';