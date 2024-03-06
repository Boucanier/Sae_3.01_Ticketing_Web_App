DROP DATABASE IF EXISTS ticket_app;
CREATE DATABASE IF NOT EXISTS ticket_app;
USE ticket_app;



DROP TABLES IF EXISTS Users, Tickets, Interventions, Connections, Rooms;
DROP TRIGGER IF EXISTS check_interventions_user;
DROP TRIGGER IF EXISTS check_interventions_ticket;
DROP TRIGGER IF EXISTS check_tickets_user;

SET GLOBAL max_allowed_packet=104857600;

CREATE TABLE Rooms (
    room VARCHAR(10) PRIMARY KEY
);

CREATE TABLE Users (
    login VARCHAR(40) UNIQUE NOT NULL PRIMARY KEY,
    first_name VARCHAR(40) NOT NULL,
    last_name VARCHAR(40) NOT NULL,
    password VARCHAR(68) NOT NULL,
    image longblob,
    role VARCHAR(10) NOT NULL CHECK (role IN ('user', 'tech', 'web_admin', 'sys_admin'))
);

CREATE TABLE Tickets (
    ticket_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(30) NOT NULL,
    description TEXT NOT NULL,
    room VARCHAR(10) NOT NULL REFERENCES Rooms(room) ON UPDATE CASCADE,
    status VARCHAR(20) NOT NULL CHECK (status IN ('open', 'closed', 'in_progress')),
    emergency INTEGER NOT NULL CHECK (emergency IN (1, 2, 3, 4)),
    creation_date DATE NOT NULL,
    user_login VARCHAR(40) NOT NULL REFERENCES Users(login) ON UPDATE CASCADE,
    ip_address VARCHAR(15) NOT NULL
);

CREATE TABLE Interventions (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    ticket_id INTEGER NOT NULL REFERENCES Tickets(ticket_id),
    tech_login VARCHAR(40) NOT NULL REFERENCES Users(login) ON UPDATE CASCADE,
    end_date DATE
);

CREATE TABLE Connections (
    id_co INTEGER PRIMARY KEY AUTO_INCREMENT,
    ip_address VARCHAR(15) NOT NULL,
    login VARCHAR(40) NOT NULL,
    password VARCHAR(68) NOT NULL,
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

delimiter //
CREATE TRIGGER remove_intervention_for_ticket_re_open AFTER UPDATE ON Tickets
FOR EACH ROW
BEGIN
    IF (NEW.status = 'open') THEN
        DELETE FROM Interventions
        WHERE Interventions.ticket_id = NEW.ticket_id;
    END IF ;
END //
delimiter ;



-- Ajout des utilisateurs demandés dans le sujet
INSERT INTO Users (login, first_name, last_name, password, role) VALUES ('admin', 'sys', 'admin', '6bd8bb4221632a0f5fea05e0bdee4fcbe935e7ec2b5a1fb209336f2d589710e3d593', 'sys_admin');
INSERT INTO Users (login, first_name, last_name, password, role) VALUES ('tec1', 'tec1', 'tec1', '7ed9b51b7f632a0f5fea05e0bdee4fcbe935e7ec2b5a1fb209336f2d589710e3d595', 'tech');
INSERT INTO Users (login, first_name, last_name, password, role) VALUES ('tec2', 'tec2', 'tec2', '7ed9b51b7f632a0f5fea05e0bdee4fcbe935e7ec2b5a1fb209336f2d589710e3d595', 'tech');

-- Ajout des premières salles
INSERT INTO Rooms VALUES ("other"); -- salle par défaut
INSERT INTO Rooms VALUES ("I21"), ("G21"), ("G22"), ("G23"), ("G24"), ("G25"), ("G26"), ("E51");

-- Ajout d'un admin web
INSERT INTO Users (login, first_name, last_name, password, role) VALUES ('webadmin', 'web', 'admin', '6bd8bb4221632a0f5fea05e0bdee4fcbe935e7ec2b5a1fb209336f2d589710e3d593', 'web_admin');

DROP USER IF EXISTS 'ticket_app'@'localhost';
CREATE USER 'ticket_app'@'localhost' IDENTIFIED BY 'ticket_s301';
GRANT SELECT, INSERT, UPDATE ON *.* TO 'ticket_app'@'localhost';
