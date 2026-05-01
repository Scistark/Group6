-- Run this command to open your personal database:
-- mysql -u NETID -D NETID -h helmi -p
-- Then run this file / the below commands to set up the colors table

SHOW TABLES;

CREATE TABLE colors (
    id int AUTO_INCREMENT UNIQUE PRIMARY KEY,
    name VARCHAR(20) UNIQUE NOT NULL,
    hex_value VARCHAR(7) UNIQUE NOT NULL
);

INSERT INTO colors VALUES
    (NULL, 'Red', '#FF0000'),
    (NULL, 'Orange', '#FFA500'),
    (NULL, 'Yellow', '#FFFF00'),
    (NULL, 'Green', '#008000'),
    (NULL, 'Blue', '#0000FF'),
    (NULL, 'Purple', '#800080'),
    (NULL, 'Grey', '#808080'),
    (NULL, 'Brown', '#8B4513'),
    (NULL, 'Black', '#000000'),
    (NULL, 'Teal', '#008080');

SELECT * FROM colors;