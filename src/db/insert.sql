INSERT INTO Users VALUES ('user1', 'user1', 'user1', '7fcfb3597f632a0f5fea05e0bdee4fcbe935e7ec2b5a1fb209336f2d589710e3d592', 'user');
INSERT INTO Users VALUES ('user2', 'user2', 'user2', '7fcfb3597f632a0f5fea05e0bdee4fcbe935e7ec2b5a1fb209336f2d589710e3d592', 'user');
INSERT INTO Users VALUES ('user3', 'user3', 'user3', '7fcfb3597f632a0f5fea05e0bdee4fcbe935e7ec2b5a1fb209336f2d589710e3d592', 'user');
/*
    mpd = user
*/

INSERT INTO Tickets VALUES (1, 'Il pleut sur les PC', 'Il pleut sur les PC lol', 'G26', 'open', 3, '2023-11-20', 'user3', '192.168.0.1');
INSERT INTO Tickets VALUES (2, 'La B fait trop de bruit', 'La B fait trop de bruit lol', 'G21', 'open', 4, '2023-10-15', 'user1', '192.168.0.2');
INSERT INTO Tickets VALUES (3, 'Les PC sont lents', 'Les PC sont lents lol', 'I21', 'open', 1, '2023-05-20', 'user2', '192.168.0.1');
INSERT INTO Tickets VALUES (4, 'La souris marche pas', 'La souris marche pas lol', 'G22', 'open', 2, '2023-08-23', 'user2', '192.168.0.2');
INSERT INTO Tickets VALUES (5, 'Il manque des touches', 'Il manque des touche lol', 'G26', 'open', 1, '2023-10-09', 'user1', '192.168.0.3');
INSERT INTO Tickets VALUES (6, 'Le projecteur marche pas', 'Le projecteur marche pas lol', 'G25', 'open', 2, '2022-05-20', 'user3', '192.168.0.3');
INSERT INTO Tickets VALUES (7, 'L ecran est pété', 'L ecran est pété lol', 'G23', 'open', 4, '2023-12-15', 'user2', '192.168.0.2');
INSERT INTO Tickets VALUES (8, 'J ai plus d idees', 'J ai plus d idees lol', 'G24', 'open', 4, '2023-10-20', 'user1', '192.168.0.3');
INSERT INTO Tickets VALUES (9, 'Le VGA c est dépassé', 'Le VGA c est dépassé lol', 'G23', 'open', 3, '2023-10-22', 'user1', '192.168.0.1');
INSERT INTO Tickets VALUES (10, 'Le HDMI marche pas', 'Le HDMI marche pas lol', 'G21', 'open', 2, '2022-10-20', 'user3', '192.168.0.3');
INSERT INTO Tickets VALUES (11, 'Linux bug', 'Linux bug lol', 'G22', 'open', 4, '2023-10-06', 'user1', '192.168.0.2');
INSERT INTO Tickets VALUES (12, 'Débian probleme', 'Débian probleme lol', 'G24', 'open', 1, '2021-10-20', 'user2', '192.168.0.3');
INSERT INTO Tickets VALUES (13, 'Windows trop bien', 'Windows trop bien lol', 'G26', 'open', 3, '2022-04-20', 'user2', '192.168.0.2');
INSERT INTO Tickets VALUES (14, 'Port SSH cassé', 'Port SSH cassé lol', 'I21', 'open', 3, '2023-03-16', 'user1', '192.168.0.1');
INSERT INTO Tickets VALUES (15, 'Il fait froid', 'Il fait froid lol', 'G26', 'open', 2, '2021-01-04', 'user3', '192.168.0.3');


INSERT INTO Connections VALUES (1, '172.0.0.1', 'admin', '6bd8bb4221632a0f5fea05e0bdee4fcbe935e7ec2b5a1fb209336f2d589710e3d593', true, '2000-01-01 00:00:00');
INSERT INTO Connections VALUES (2, '192.168.3.52', 'tec1', '7ed9b51b7f632a0f5fea05e0bdee4fcbe935e7ec2b5a1fb209336f2d589710e3d595', true, '2004-09-24 23:59:59');
INSERT INTO Connections VALUES (3, '8.8.8.8', 'tec2', '64d3b85f2a302a0f5fea05e0bdee4fcbe935e7ec2b5a1fb209336f2d589710e3d590', false, '2020-02-02 02:02:02');