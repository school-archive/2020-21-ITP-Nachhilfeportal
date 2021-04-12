DROP DATABASE if exists np;
CREATE DATABASE np;
USE np;

CREATE TABLE user (
    email VARCHAR(255),
    first_name VARCHAR(20),
    last_name VARCHAR(20),
    password VARCHAR(20),
    picture_url VARCHAR(255),
    locked BOOLEAN,
    types BIT(2),
    PRIMARY KEY (email)
);

CREATE TABLE student (
    email VARCHAR(255),
    grade INTEGER,
    department VARCHAR(255),
    PRIMARY KEY (email),
    FOREIGN KEY (email) REFERENCES user(email)
    ON DELETE CASCADE
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
    calender_id INTEGER,
    email VARCHAR(255),
    time_from DATETIME,
    time_to DATETIME,
    weekday INTEGER,
    PRIMARY KEY (calender_id),
    FOREIGN KEY (email) REFERENCES user(email)
    ON DELETE CASCADE
);

CREATE TABLE selected_subject(
    subject_id INTEGER,
    email VARCHAR(255),
    PRIMARY KEY (subject_id),
    FOREIGN KEY (email) REFERENCES user(email)
    ON DELETE CASCADE
);

CREATE TABLE subject (
    subject_id INTEGER,
    email VARCHAR(255),
    name VARCHAR(20),
    department BIT(3),
    PRIMARY KEY (subject_id),
    FOREIGN KEY (subject_id) REFERENCES selected_subject(subject_id)
    ON DELETE CASCADE
);
