DROP TABLE IF EXISTS users;

CREATE TABLE users (
  username VARCHAR(50) PRIMARY KEY,
  password VARCHAR(100) NOT NULL
);

INSERT INTO users (username, password) VALUES ('admin', MD5('MyP4$$w0rd'));
