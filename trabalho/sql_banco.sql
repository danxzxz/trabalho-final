    /* Aula OO - Persistência */
    CREATE DATABASE bebidas;
    USE bebidas;
    CREATE TABLE bebidas (
        id int AUTO_INCREMENT NOT NULL,
        tipo varchar(1) NOT NULL, /*Tipo de cliente: A (Alcoolica) | R (Refrigerante) | S (Suco)*/
        nome varchar(70) ,
        ml varchar(70) NOT NULL,
        sabor varchar(30),
        pctAlcool varchar(70),
        PRIMARY KEY (id)   
    );

    ALTER TABLE bebidas ADD quantidade INT DEFAULT 0;

