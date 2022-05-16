-- CREATE DATABASE `bd_escuela`;

-- USE `bd_escuela`;


-- CREATE TABLE `tbl_curso` (
--     `id` int(2) NOT NULL PRIMARY KEY AUTO_INCREMENT,
--     `siglas` varchar(10) NOT NULL,
--     `nombre` varchar(75) NOT NULL
-- );

-- CREATE TABLE `tbl_clase` (
--     `id` int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
--     `curso` int(2) NOT NULL
-- );

-- CREATE TABLE `tbl_alumno` (
--     `id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
--     `nombre` varchar(50) NOT NULL,
--     `apellidos` varchar(60) NOT NULL,
--     `correo` varchar(75) NOT NULL,
--     `telefono` char(9) NOT NULL,
--     `foto` varchar(100) NOT NULL,
--     `clase` int(3) NOT NULL
-- );

-- CREATE TABLE `tbl_profesor` (
--     `id` int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
--     `correo` varchar(75) NOT NULL,
--     `password` varchar(100) NOT NULL,
--     `nombre` varchar(50) NOT NULL,
--     `apellidos` varchar(60) NOT NULL,
--     `telefono` char(9) NOT NULL
-- );

-- CREATE TABLE `tbl_asignatura` (
--     `id` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
--     `nombre` varchar(50) NOT NULL,
--     `profesor` int(4) NOT NULL,
--     `clase` int(3) NOT NULL
-- );

-- CREATE TABLE `tbl_administrador` (
--     `id` int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
--     `correo` varchar(75) NOT NULL,
--     `password` varchar(100) NOT NULL
-- );


-- ALTER TABLE `tbl_clase` ADD CONSTRAINT `curso_clase_fk` FOREIGN KEY (`curso`) REFERENCES `tbl_curso` (`id`);
-- ALTER TABLE `tbl_alumno` ADD CONSTRAINT `clase_alumno_fk` FOREIGN KEY (`clase`) REFERENCES `tbl_clase` (`id`);
-- ALTER TABLE `tbl_asignatura` ADD CONSTRAINT `profesor_asignatura_fk` FOREIGN KEY (`profesor`) REFERENCES `tbl_profesor` (`id`);
-- ALTER TABLE `tbl_asignatura` ADD CONSTRAINT `clase_asignatura_fk` FOREIGN KEY (`clase`) REFERENCES `tbl_clase` (`id`);


-- SQL AGNÈS
create database IF NOT EXISTS curs;
use curs;

/* Creació de les taules*/ 


CREATE TABLE IF NOT EXISTS tbl_professor(
	id_professor int(5) NOT NULL AUTO_INCREMENT,
	nom_prof varchar (20) NOT NULL,
	cognoms_prof varchar (20) NULL,
	email_prof varchar(50) NULL,
	telf varchar (5) NULL, /* Son les extensions, per exemple: 32256*/
	dept int(5) NOT NULL,
    contra varchar(20) NOT NULL,
    `admin` boolean NOT NULL,
	constraint pk_professor PRIMARY KEY (id_professor)
);

CREATE TABLE IF NOT EXISTS tbl_classe (
	id_classe int(5) NOT NULL AUTO_INCREMENT,
	codi_classe varchar(5) NOT NULL,
	nom_classe varchar(25) NULL,
	tutor int(5) NOT NULL,
	constraint pk_consta PRIMARY KEY (id_classe)
);

CREATE TABLE IF NOT EXISTS tbl_alumne(
	id_alumne int(10) NOT NULL AUTO_INCREMENT,
	dni_alu varchar(9) NULL,
	nom_alu varchar(20) NOT NULL,
	cognoms_alu varchar(20) NULL,
	telf_alu varchar(9) NULL,
	email_alu varchar(50) NULL,
	classe int(5) NOT NULL,
	constraint pk_alumne PRIMARY KEY (id_alumne)
);

CREATE TABLE IF NOT EXISTS tbl_dept(
	id_dept int(5) NOT NULL AUTO_INCREMENT,
	codi_dept varchar(5) NOT NULL,
	nom_dept varchar(25) NULL,
	constraint pk_imparteix PRIMARY KEY (id_dept)
);

/* Modificacions de les taules per cració de les FK*/

ALTER TABLE tbl_alumne
    ADD CONSTRAINT alumne_classe_fk FOREIGN KEY (classe)
    REFERENCES tbl_classe(id_classe);
	
ALTER TABLE tbl_classe
    ADD CONSTRAINT classe_prof_fk FOREIGN KEY (tutor)
    REFERENCES tbl_professor(id_professor);

ALTER TABLE tbl_professor
    ADD CONSTRAINT prof_dept_fk FOREIGN KEY (dept)
    REFERENCES tbl_dept(id_dept);