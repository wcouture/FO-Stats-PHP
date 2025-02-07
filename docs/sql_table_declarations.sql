CREATE DATABASE IF NOT EXISTS faceoff;
USE faceoff;

CREATE TABLE IF NOT EXISTS Player (
    player_id int NOT NULL AUTO_INCREMENT,
    number int NOT NULL,
    name varchar(30) NOT NULL,
    wins int DEFAULT 0,
    losses int DEFAULT 0,
    gbs int DEFAULT 0,
    PRIMARY KEY(player_id)
);

CREATE TABLE IF NOT EXISTS Season (
    season_id int NOT NULL AUTO_INCREMENT,
    year YEAR NOT NULL,
    PRIMARY KEY (season_id)
);

CREATE TABLE IF NOT EXISTS Game (
    game_id int NOT NULL AUTO_INCREMENT,
    date DATE NOT NULL,
    opponent varchar(30) NOT NULL,
    PRIMARY KEY (game_id)
);

CREATE TABLE IF NOT EXISTS Performance (
    performance_id int NOT NULL AUTO_INCREMENT,
    player_id int NOT NULL,
    game_id int NOT NULL,
    wins int DEFAULT 0,
    losses int DEFAULT 0,
    gbs int DEFAULT 0,
    PRIMARY KEY (performance_id),
    FOREIGN KEY (game_id) REFERENCES Game(game_id),
    FOREIGN KEY (player_id) REFERENCES Player(player_id)
);