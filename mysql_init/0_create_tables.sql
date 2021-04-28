DROP DATABASE if exists np;
CREATE DATABASE np;
USE np;

CREATE TABLE user (
    email VARCHAR(255),
    first_name VARCHAR(20),
    last_name VARCHAR(20),
    password VARCHAR(20),
    picture_url VARCHAR(255),
    grade INTEGER,
    department VARCHAR(255),
    locked BOOLEAN,
    isAdmin BOOLEAN,
    PRIMARY KEY (email)
);

CREATE TABLE tutor (
    email VARCHAR(255),
    description VARCHAR(255),
    teaching_method BIT(3),
    PRIMARY KEY (email),
    FOREIGN KEY (email) REFERENCES user(email)
    ON DELETE CASCADE
);

CREATE TABLE calender_free (
    calender_id INTEGER NOT NULL AUTO_INCREMENT,
    email VARCHAR(255),
    time_from DATETIME,
    time_to DATETIME,
    weekday VARCHAR(255),
    PRIMARY KEY (calender_id),
    FOREIGN KEY (email) REFERENCES user(email)
    ON DELETE CASCADE
);

CREATE TABLE selected_subject(
    name VARCHAR(20),
    email VARCHAR(255),
    PRIMARY KEY (name),
    FOREIGN KEY (email) REFERENCES user(email)
    ON DELETE CASCADE
);

CREATE TABLE subject (
    name VARCHAR(20),
    email VARCHAR(255),
    department BIT(3),
    minGrade INTEGER,
    PRIMARY KEY (name),
    FOREIGN KEY (name) REFERENCES selected_subject(name)
    ON DELETE CASCADE
);
