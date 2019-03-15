CREATE DATABASE crud_draft; 

USE crud_draft;

CREATE TABLE stories (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    storytitle VARCHAR(100) NOT NULL,
    storytype VARCHAR(50),
    storygenre VARCHAR(50),
    storybrief VARCHAR(700),
    datecreated VARCHAR(30),
    date TIMESTAMP

);