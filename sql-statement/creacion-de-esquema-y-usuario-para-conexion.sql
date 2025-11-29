/* Crear esquema/database sysweb para el proyecto */
CREATE DATABASE sysweb;

/* Crear usuario memo con todos los privilegios para el esquema sysweb */
CREATE USER 'memo'@'localhost' IDENTIFIED BY '123456';
GRANT ALL PRIVILEGES ON sysweb.* TO 'memo'@'localhost';
FLUSH PRIVILEGES;

/* Verificar todos los usuarios en MySQL */
SELECT User, Host FROM mysql.user;

/* Codigo Hash MD5 */
SELECT md5('123456'); -- e10adc3949ba59abbe56e057f20f883e

GRANT SUPER ON *.* TO 'memo'@'localhost';
FLUSH PRIVILEGES;

