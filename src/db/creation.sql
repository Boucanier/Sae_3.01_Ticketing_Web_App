CREATE DATABASE IF NOT EXISTS ticket_app;
USE ticket_app;

DROP TABLES IF EXISTS Users, Tickets, Interventions;

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