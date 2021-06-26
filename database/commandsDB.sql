CREATE DATABASE IF NOT EXISTS instagram CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';
USE instagram;

CREATE TABLE IF NOT EXISTS users(
id INT(255) auto_increment NOT NULL,
role    VARCHAR(20),
name    VARCHAR(100) NOT NULL,
lastname VARCHAR(200) NOT NULL,
nick    VARCHAR (100),
email   VARCHAR (255)NOT NULL,
password    VARCHAR(255) NOT NULL,
image   VARCHAR(255),
created_at  DATETIME,
updated_at  DATETIME,
remember_token  VARCHAR(255),
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'user', 'Cristian', 'Ramon', 'Chino', 'chinorubikguitar@hotmail.com', '2137', NULL, CURTIME(),CURTIME(),NULL);
INSERT INTO users VALUES(NULL, 'user', 'Marisela', 'Salvador Santos', NULL, 'marycielo@hotmail.com', 'root', NULL, CURTIME(),CURTIME(),NULL);
INSERT INTO users VALUES(NULL, 'user', 'Guillermo', 'Antunez', 'Memo', 'memo@hotmail.com', 'root', NULL, CURTIME(),CURTIME(),NULL);


CREATE TABLE IF NOT EXISTS images(
id  INT(255) auto_increment NOT NULL,
user_id INT(255),
image_path  VARCHAR(255),
description TEXT,
created_at  DATETIME,
updated_at  DATETIME,
CONSTRAINT pk_images PRIMARY KEY(id),
CONSTRAINT fk_user_images FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO images VALUES(NULL,1,'imagen1.png','Mi piano', CURTIME(),CURTIME());
INSERT INTO images VALUES(NULL,1,'imagen2.png','Mi primera guitarra', CURTIME(),CURTIME());
INSERT INTO images VALUES(NULL,2,'imagen3.png','Nuevo gorro a crochet', CURTIME(),CURTIME());
INSERT INTO images VALUES(NULL,3,'imagen4.png','The Betales', CURTIME(),CURTIME());
INSERT INTO images VALUES(NULL,2,'imagen5.png','Perritos chihuahuas', CURTIME(),CURTIME());

CREATE TABLE IF NOT EXISTS comments(
    id INT(255) auto_increment NOT NULL,
    user_id INT(255),
    image_id    INT(255),
    content TEXT,
    created_at  DATETIME,
    updated_at  DATETIME,
    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_user_comments FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_image_comments FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO comments VALUES(NULL,2,1,'¿Cuanto de costo?', CURTIME(),CURTIME());
INSERT INTO comments VALUES(NULL,3,1,'Bonito piano', CURTIME(),CURTIME());
INSERT INTO comments VALUES(NULL,2,2,'Bonita guitarra', CURTIME(),CURTIME());
INSERT INTO comments VALUES(NULL,1,3,'¿Ahora a quien se los vas a regalar', CURTIME(),CURTIME());
INSERT INTO comments VALUES(NULL,1,4,'Se escribe "THE BEATLES"* ', CURTIME(),CURTIME());
INSERT INTO comments VALUES(NULL,3,5,'Quiero mi parte de los perritos si los llegas a vender', CURTIME(),CURTIME());


CREATE TABLE IF NOT EXISTS likes(
    id INT(255) auto_increment NOT NULL,
    user_id INT(255),
    image_id    INT(255),
    created_at  DATETIME,
    updated_at  DATETIME,
    CONSTRAINT pk_likes PRIMARY KEY(id),
    CONSTRAINT fk_user_likes FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_image_likes FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;


INSERT INTO likes VALUES(NULL,2,1, CURTIME(),CURTIME());
INSERT INTO likes VALUES(NULL,3,1,CURTIME(),CURTIME());
INSERT INTO likes VALUES(NULL,2,2, CURTIME(),CURTIME());
INSERT INTO likes VALUES(NULL,1,3, CURTIME(),CURTIME());
INSERT INTO likes VALUES(NULL,1,4, CURTIME(),CURTIME());
INSERT INTO likes VALUES(NULL,3,5, CURTIME(),CURTIME());
