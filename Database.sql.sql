CREATE DATABASE IF NOT EXISTS RedFenix;
use RedFenix;

create table users(
id                  int(255) auto_increment not null,
role                varchar(20),
name                varchar(100),
surname             varchar(200),
nick                varchar(100),
email               varchar(255),
password            varchar(255),
image               varchar(255),
created_at          datetime,
update_at           datetime,
remember_token      varchar(255),

--renstricciones
CONSTRAINT pk_users PRIMARY KEY(id)

)--nos sirve para mantener la integridad referencial todas las claves ajenas apunten a un sitio correcto
ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'user', 'Santiago', 'Ortega', 'sanortecardenas', 'santi@hotmail.com', '1234', null, CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(NULL, 'user', 'Alejandro', 'Macias', 'Anarkia', 'alejo@hotmail.com', 'assdd', null, CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(NULL, 'user', 'Victor', 'Robles', 'Victoris', 'victor@hotmail.com', 'asdwsx', null, CURTIME(), CURTIME(), NULL);


CREATE TABLE IF NOT EXISTS images(
id                  int(255) auto_increment not null, 
user_id             int(255),
image_path          varchar(255),
description         text,
created_at          datetime,
update_at           datetime,

----renstriciones
CONSTRAINT pk_images PRIMARY KEY(id),
CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)
ENGINE=InnoDb;


INSERT INTO images VALUES(NULL,'1','test.jpg','Prueba imaagen 1',CURTIME(),CURTIME() );
INSERT INTO images VALUES(NULL,'3','ichigo.jpg','Prueba imaagen 2',CURTIME(),CURTIME() );
INSERT INTO images VALUES(NULL,'2','volcan.jpg','Prueba imagen 3',CURTIME(),CURTIME() );



CREATE TABLE IF NOT EXISTS comments(
id                  int(255) auto_increment not null,
user_id             int(255),
image_id            int(255),
content             text,
created_at          datetime,
update_at           datetime,

----renstriciones
CONSTRAINT pk_comments PRIMARY KEY(id),
CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)

)
ENGINE=InnoDb;

INSERT INTO comments VALUES(NULL,1,2,'El bankai de ichigo!!',CURTIME(),CURTIME() );
INSERT INTO comments VALUES(NULL,2,1,'Se te bugeo la pagina j3j3j3',CURTIME(),CURTIME() );
INSERT INTO comments VALUES(NULL,3,3,'Ufff si que arde estar hay al lado de la lava we!!',CURTIME(),CURTIME() );



CREATE TABLE IF NOT EXISTS likes(
id                  int(255) auto_increment not null,
user_id             int(255),
image_id            int(255),
created_at          datetime,
update_at           datetime,

----renstriciones
CONSTRAINT pk_likes PRIMARY KEY(id),
CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)

)
ENGINE=InnoDb;


INSERT INTO likes VALUES(NULL,1,3,CURTIME(),CURTIME() );
INSERT INTO likes VALUES(NULL,3,2,CURTIME(),CURTIME() );
INSERT INTO likes VALUES(NULL,2,1,CURTIME(),CURTIME() );
INSERT INTO likes VALUES(NULL,3,3,CURTIME(),CURTIME() );

