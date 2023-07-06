-- Active: 1685438282071@@127.0.0.1@3306@vente_symfony_project

DROP TABLE IF EXISTS ordre_verre ;

DROP TABLE IF EXISTS ordre ;

DROP TABLE IF EXISTS verre ;

DROP TABLE IF EXISTS shop;

DROP TABLE IF EXISTS monture;

create table
    Monture (
        id INT PRIMARY KEY AUTO_INCREMENT,
        marque VARCHAR(256),
        model VARCHAR(256) not NULL,
        basePrice FLOAT,
        picture VARCHAR(255) NOT NULL
    );

CREATE TABLE
    shop (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR (256) NOT NULL,
        adress VARCHAR(512) NOT NULL
    );

CREATE TABLE
    verre (
        id INT PRIMARY KEY AUTO_INCREMENT,
        Genre VARCHAR (256),
        price FLOAT
    );

CREATE TABLE
    ordre (
        id INT PRIMARY KEY AUTO_INCREMENT,
        createdAt DATETIME,
        customName VARCHAR (256) NOT NULL
    );

CREATE TABLE
    ordre_verre(
        PRIMARY KEY (id_ordre, id_verre),
        id_ordre INT,
        id_verre INT,
        FOREIGN KEY (id_ordre) REFERENCES ordre(id),
        FOREIGN KEY (id_verre) REFERENCES verre(id)
    );

INSERT INTO shop (name, adress)
VALUES (
        'Optic3000',
        '5 rue de la république 38800 Le pont de claix'
    ), (
        'Anatol-optic',
        '6 route de la liberté 73000 Aix les bains'
    ), (
        'AlainOptic',
        ' 3 boulevard des champs  38000 Grenoble'
    ), (
        'Karis-optic',
        '4 avenue girard 7300 Chambery'
    );

INSERT INTO
    monture (
        marque,
        model,
        basePrice,
        picture
    )
VALUES (
        'Trebanne',
        'R18',
        160,
        'https://th.bing.com/th/id/R.45103e85ce06a0ded92ebf2af0ab6562?rik=c1NgMpwBs8tqSA&pid=ImgRaw&r=0'
    ), (
        'Vuplanne',
        'V31',
        200,
        'https://th.bing.com/th/id/R.56c85e5649cf3b10b74442c32d87bd35?rik=Ewm4eyJSYjlewA&pid=ImgRaw&r=0'
    ), (
        'Hugros',
        'H96',
        170,
        'https://th.bing.com/th/id/OIP.F0BnjtQY55chvdeAX9UZGwHaE8?pid=ImgDet&rs=1'
    ), (
        'Montlard',
        'M63',
        310,
        'https://th.bing.com/th/id/OIP.z56dvZghkIyXPHAv19WwEAHaE8?pid=ImgDet&rs=1'
    );

INSERT INTO
    verre (Genre, price)
VALUES ('antireflet', 100), ('protection ecran', 200), ('progressive', 300), ('aminci', 100);

INSERT INTO
    ordre(createdAT, customName)
VALUES ('2022-12-24', 'Alain Deloin'), (
        '2019-07-14',
        'Brigitte Cradaud'
    ), ('2000-01-15', 'Girard Antoit'), ('1989-06-21', 'Rita Masti');