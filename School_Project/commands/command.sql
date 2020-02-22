les differentes tables ici ont été créées dns la base de données "School"


CREATE TABLE list_of_pupils(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR (255) NOT NULL,
    surname VARCHAR (255) NOT NULL,
    birthday DATE TIMESTAMP NOT NULL,
    classe VARCHAR (255) NOT NULL,
    is_responsable INT UNSIGNED,
    sexe VARCHAR (10) NOT NULL,
    parent_phone_number INT UNSIGNED NOT NULL,
    father VARCHAR (255),
    mother VARCHAR (255),
    tutor VARCHAR (255),
    address VARCHAR (255) NOT NULL,
    blame TEXT (500)
)

CREATE TABLE list_of_teachers(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR (255) NOT NULL,
    surname VARCHAR (255) NOT NULL,
    sexe VARCHAR (10) NOT NULL,
    contact INT UNSIGNED NOT NULL,
    classes VARCHAR (100),
    discipline VARCHAR (255) NOT NULL,
    address VARCHAR (255) NOT NULL,
    is_AE INT UNSIGNED,
    blame TEXT (500)
)


CREATE TABLE list_of_classes(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    classe VARCHAR (255) NOT NULL,
    responsable1 VARCHAR (255),
    responsable2 VARCHAR (255),
    teacher_principal VARCHAR (255)

)


CREATE TABLE list_of_disciplines(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    discipline VARCHAR (255) NOT NULL,
    id_AE VARCHAR (255)
)
/*


SELECT t1.interro1, t1.interro2, t1.interro3, t1.devoir1, t1.devoir2, t2.interro1, t2.interro2, t2.interro3, t2.devoir1, t2.devoir2, t3.interro1, t3.interro2, t3.interro3, t3.devoir1, t3.devoir2 FROM (sixieme_t1 t1, sixieme_t2 t2, sixieme_t3 t3) JOIN sixieme tn ON (t1.eleve_id = tn.id AND t2.eleve_id = tn.id AND t3.eleve_id = tn.id) WHERE tn.id = 1 
 */

