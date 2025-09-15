CREATE DATABASE IF NOT EXISTS jogos_pw2;

USE jogos_pw2;

CREATE TABLE IF NOT EXISTS jogo (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    data_lanc DATE DEFAULT CURRENT_DATE,
    genero VARCHAR(100),
    dev VARCHAR(150),
    data_cad TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO jogo (titulo, data_lanc, genero, dev) VALUES
    ('Red Dead Redemption II','2018-10-26','Mundo Aberto','Rockstar Games'),
    ('Grand Theft Auto - San Andreas','2004-10-26','Mundo Aberto','Rockstar Games'),
    ('Hollow Knight - Silksong','2025-09-04','Metroidvania','Team Cherry');
