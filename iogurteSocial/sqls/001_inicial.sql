CREATE DATABASE iogurteSocial COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT ,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha CHAR(60) NOT NULL ,
    nome VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE table fotos (
	id INT NOT NULL AUTO_INCREMENT,
	usuario_id INT NOT NULL,
	titulo VARCHAR (50) NOT NULL,
	descricao VARCHAR (255) NOT NULL,
    data_up DATETIME NOT NULL,
    hash_fotos varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
	PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
)
ENGINE = InnoDB;