CREATE DATABASE waph;
CREATE USER 'waphuser'@'localhost' IDENTIFIED BY 'StrongP@ss123';
GRANT ALL ON waph.* TO 'waphuser'@'localhost';
