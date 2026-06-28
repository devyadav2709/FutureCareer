DROP TABLE IF EXISTS users;

CREATE TABLE users (
    email VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    last_login TIMESTAMP DEFAULT NULL,
    PRIMARY KEY (email)
);