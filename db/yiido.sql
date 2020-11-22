ALTER DATABASE yiidoo SET datestyle TO 'ISO, european';

CREATE EXTENSION pgcrypto;

DROP TABLE IF EXISTS users CASCADE;

CREATE TABLE users (
    id bigserial PRIMARY KEY,
    username varchar(255) NOT NULL UNIQUE,
    email varchar(255) NOT NULL UNIQUE,
    auth_key varchar(255),
    password varchar(255) NOT NULL
);

DROP TABLE IF EXISTS tasks CASCADE;

CREATE TABLE tasks (
    id bigserial PRIMARY KEY,
    user_id bigint REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    title varchar(255) NOT NULL,
    deadline date NOT NULL,
    description text,
    completed boolean NOT NULL DEFAULT FALSE
);

DROP TABLE IF EXISTS tags CASCADE;

CREATE TABLE tags (
    id bigserial PRIMARY KEY,
    task_id bigserial REFERENCES tasks (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    title varchar(255) NOT NULL
);

INSERT INTO users (username, PASSWORD, email)
    VALUES ('pepe', crypt('pepe', gen_salt('bf', 11)), 'pepe@pepe.pep'), ('juan', crypt('juan', gen_salt('bf', 11)), 'juan@juan.jua');

INSERT INTO tasks (user_id, deadline, title)
    VALUES (1, '2020-11-29', 'Clean room');

INSERT INTO tags (title, task_id)
    VALUES ('clean', 1);
