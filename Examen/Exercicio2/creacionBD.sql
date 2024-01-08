CREATE DATABASE clasificacion;
USE clasificacion;

CREATE TABLE clasificacion
(
id_partido INT PRIMARY KEY AUTO_INCREMENT,
equipoLocal VARCHAR(20),
equipoVisitante VARCHAR(20) UNIQUE,
golesLocal INT NOT NULL,
golesVisitante INT NOT NULL
);