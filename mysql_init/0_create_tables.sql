CREATE DATABASE np;
USE np;
CREATE TABLE user (
    email VARCHAR(255),
    first_name VARCHAR(20),
    last_name VARCHAR(20),
    password VARCHAR(20),
    picture_url VARCHAR(255),
    locked BOOLEAN,
    groups BIT(3),
    PRIMARY KEY (email)
);

CREATE TABLE student (
    email VARCHAR(255),
    grade INTEGER,
    department VARCHAR(255),
    PRIMARY KEY (email),
    FOREIGN KEY (email) REFERENCES user(email)
);

CREATE TABLE tutor (
    email VARCHAR(255),
    description VARCHAR(255),
    teachhing_method BINARY,
    PRIMARY KEY (email),
    FOREIGN KEY (email) REFERENCES user(email)
);

CREATE TABLE calender_free (
    calender_id INTEGER,
    email VARCHAR(255),
    from DATETIME,
    to DATETIME,
    weekday INTEGER,
    PRIMARY KEY (calender_id),
    FOREIGN KEY (email) REFERENCES user(email)
);

CREATE TABLE selected_subject(
    subject_id INTEGER,
    email VARCHAR(255),
    PRIMARY KEY (subject_id),
    FOREIGN KEY (email) REFERENCES user(email)
);

CREATE TABLE subject (
    subject_id INTEGER,
    email VARCHAR(255),
    name VARCHAR(20),
    department BIT(3),
    PRIMARY KEY (subject_id),
    FOREIGN KEY (subject_id) REFERENCES selected_subject(subject_id)
);
