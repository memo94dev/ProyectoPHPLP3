SELECT * FROM usuarios;

SET SQL_SAFE_UPDATES = 0;
DELETE FROM usuarios WHERE id_user = 5;
SET SQL_SAFE_UPDATES = 1;

SELECT * FROM departamento;

SELECT * FROM ciudad;

SELECT c.cod_ciudad, c.descrip_ciudad, d.id_departamento, d.dep_descripcion
FROM ciudad c, departamento d
WHERE c.id_departamento = d.id_departamento;

SELECT c.cod_ciudad, c.descrip_ciudad, d.id_departamento, d.dep_descripcion
FROM ciudad c
JOIN departamento d ON c.id_departamento = d.id_departamento;

SELECT c.cod_ciudad, c.descrip_ciudad, d.id_departamento, d.dep_descripcion
                                        FROM ciudad c   
                                        JOIN departamento d ON c.id_departamento = d.id_departamento
                                        WHERE c.cod_ciudad = 1;
                                        
SELECT * FROM clientes;
INSERT INTO clientes (id_cliente, ci_ruc, cli_nombre, cli_apellido, cli_direccion, cli_telefono, cod_ciudad)
VALUES ('$cod_ciudad', '$descrip_ciudad', '$id_departamento');
UPDATE ciudad SET id_cliente = '', 
ci_ruc = '', 
cli_nombre = '', 
cli_apellido = '', 
cli_direccion = '', 
cli_telefono = '', 
cod_ciudad = ''
WHERE id_cliente = '';

SELECT c.id_cliente, c.ci_ruc, c.cli_nombre, c.cli_apellido, c.cli_direccion, c.cli_telefono, ciu.cod_ciudad, ciu.descrip_ciudad, d.id_departamento, d.dep_descripcion
                                        FROM clientes c                                        
                                        JOIN ciudad ciu ON c.cod_ciudad = ciu.cod_ciudad
                                        JOIN departamento d ON ciu.id_departamento = d.id_departamento
                                        ORDER BY c.id_cliente;
                                        
SELECT c.id_cliente, c.ci_ruc, c.cli_nombre, c.cli_apellido, c.cli_direccion, c.cli_telefono, ciu.descrip_ciudad
                                        FROM clientes c   
                                        JOIN ciudad ciu ON c.cod_ciudad = ciu.cod_ciudad
                                        WHERE c.cod_ciudad = 1;
                                        
CREATE VIEW v_clientes AS (
SELECT c.id_cliente, c.ci_ruc, c.cli_nombre, c.cli_apellido, c.cli_direccion, 
c.cli_telefono, ciu.cod_ciudad, ciu.descrip_ciudad, d.id_departamento, d.dep_descripcion
                                        FROM clientes c                                        
                                        JOIN ciudad ciu ON c.cod_ciudad = ciu.cod_ciudad
                                        JOIN departamento d ON ciu.id_departamento = d.id_departamento
                                        ORDER BY c.id_cliente);
SELECT * FROM v_clientes;

SELECT c.cod_ciudad, dep.id_departamento, c.descrip_ciudad, dep.dep_descripcion
FROM ciudad c
JOIN departamento dep ON c.id_departamento = dep.id_departamento 
ORDER BY dep.id_departamento ASC;
select * from compra;
select * from proveedor;

CREATE VIEW v_compras AS (
SELECT co.cod_compra, pro.cod_proveedor, pro.razon_social, co.nro_factura, co.fecha,
co.hora, dep.cod_deposito, dep.descrip, co.total_compra, usu.id_user, usu.name_user
FROM compra co
JOIN proveedor pro ON co.cod_proveedor = pro.cod_proveedor
JOIN deposito dep ON co.cod_deposito = dep.cod_deposito
JOIN usuarios usu ON co.id_user = usu.id_user);
SELECT * FROM v_compras;

CREATE VIEW v_det_compra AS(
SELECT co.cod_compra, pro.cod_producto, pro.p_descrip, u.u_descrip, tp.t_p_descrip,
det.precio, det.cantidad
FROM detalle_compra det
JOIN compra co ON co.cod_compra = det.cod_compra
JOIN producto pro ON pro.cod_compra = det.cod_compra
JOIN u_medida u ON pro.id_u_medida = u.id_u_medida
JOIN tipo_producto tp ON pro.cod_tipo_prod = tp.cod_tipo_prod);

CREATE OR REPLACE VIEW v_det_compra AS (
SELECT 
    co.cod_compra, 
    pro.cod_producto, 
    pro.p_descrip, 
    u.u_descrip, 
    tp.t_p_descrip,
    det.precio, 
    det.cantidad
FROM detalle_compra det
JOIN compra co ON co.cod_compra = det.cod_compra
JOIN producto pro ON pro.cod_producto = det.cod_producto
JOIN u_medida u ON pro.id_u_medida = u.id_u_medida
JOIN tipo_producto tp ON pro.cod_tipo_prod = tp.cod_tipo_prod);

SELECT * FROM v_det_compra;

SELECT MAX(cod_compra) as id FROM compra;

INSERT INTO detalle_compra(cod_producto, cod_compra, cod_deposito, precio, cantidad) 
VALUES(1, 1, 1, 2, 3000);

/* Trigger */
DELIMITER $$
CREATE
    TRIGGER borrar_temp AFTER INSERT
    ON compra
    FOR EACH ROW BEGIN
   DELETE FROM tmp;
    END$$
DELIMITER ;

DELIMITER $$

CREATE TRIGGER borrar_temp
AFTER INSERT ON compra
FOR EACH ROW
BEGIN
    DELETE FROM tmp;
END$$

DELIMITER ;
DROP TRIGGER borrar_temp;
DELIMITER $$

CREATE TRIGGER borrar_temp
AFTER INSERT ON detalle_compra
FOR EACH ROW
BEGIN
    DELETE FROM tmp;
END$$

DELIMITER ;

SELECT * FROM v_compras WHERE cod_compra = 1;
SELECT * FROM v_det_compra WHERE cod_compra = 1;

/* Crear vista de productos */
CREATE VIEW v_producto AS (
SELECT p.cod_producto, 
p.cod_tipo_prod, t.t_p_descrip, 
p.id_u_medida, u.u_descrip,
p.p_descrip, p.precio
FROM producto p
JOIN tipo_producto t ON p.cod_tipo_prod = t.cod_tipo_prod
JOIN u_medida u ON p.id_u_medida = u.id_u_medida
ORDER BY p.cod_producto);

SELECT * FROM v_producto;

SELECT * FROM sysweb.venta;
CREATE VIEW v_venta AS (
SELECT v.cod_venta, v.id_cliente, c.ci_ruc, c.cli_nombre, c.cli_apellido, 
v.fecha, v.hora, v.nro_factura, v.total_venta
FROM venta v
JOIN clientes c ON v.id_cliente = c.id_cliente);

SELECT * FROM v_venta;

USE sysweb;

CREATE VIEW v_stock AS(
SELECT s.cod_deposito, d.descrip, s.cod_producto, p.p_descrip, s.cantidad,
u.id_u_medida, u.u_descrip, tp.cod_tipo_prod, tp.t_p_descrip
FROM stock s
JOIN deposito d ON s.cod_deposito = d.cod_deposito
JOIN producto p ON s.cod_producto = p.cod_producto
JOIN u_medida u ON p.id_u_medida = u.id_u_medida
JOIN tipo_producto tp ON tp.cod_tipo_prod = p.cod_tipo_prod
ORDER BY s.cod_deposito);

SELECT * FROM v_stock;

SELECT * FROM v_stock WHERE cod_deposito = 3;

SELECT SUM(cantidad) AS cantidad FROM stock;

/* Vista de detalle de venta */
CREATE VIEW v_det_venta AS (
SELECT dv.cod_producto, p.p_descrip, um.u_descrip, dv.cod_venta, 
dv.cod_deposito, d.descrip, tp.t_p_descrip, 
dv.det_cantidad, dv.det_precio_unit,
(dv.det_cantidad * dv.det_precio_unit) AS subtotal
FROM det_venta dv
JOIN deposito d ON dv.cod_deposito = d.cod_deposito
JOIN producto p ON dv.cod_producto = p.cod_producto
JOIN tipo_producto tp ON p.cod_tipo_prod = tp.cod_tipo_prod
JOIN u_medida um ON p.id_u_medida = um.id_u_medida);

SELECT * FROM v_det_venta;

USE sysweb;
ALTER TABLE usuarios ADD UNIQUE (permisos_acceso);
ALTER TABLE usuarios MODIFY permisos_acceso INT;
CREATE TABLE permisos(
	id_permisos INT NOT NULL PRIMARY KEY,
    per_descrip VARCHAR(25),
    FOREIGN KEY (id_permisos) REFERENCES usuarios (permisos_acceso) ON UPDATE CASCADE ON DELETE NO ACTION
);
DROP TABLE permisos;

INSERT INTO permisos 
	(permisos_acceso)
VALUES
	('admin'),
	('compra'),
	('venta');
    
SELECT * FROM permisos;
    
SELECT u.id_user, u.name_user, u.email, u.telefono, u.foto, p.per_descrip, u.status
FROM usuarios u
JOIN permisos p ON u.permisos_acceso = p.id_permisos;

CREATE VIEW v_usuarios AS (
SELECT u.id_user, u.name_user, u.email, u.telefono, u.foto, p.per_descrip, u.status
FROM usuarios u
JOIN permisos p ON u.permisos_acceso = p.id_permisos
ORDER BY u.id_user);
SELECT * FROM v_usuarios;

SELECT * FROM v_usuarios WHERE id_user = 1;

SHOW INDEXES FROM usuarios;
ALTER TABLE usuarios DROP INDEX permisos_acceso;

SELECT CONSTRAINT_NAME, TABLE_NAME 
FROM information_schema.KEY_COLUMN_USAGE 
WHERE TABLE_NAME = 'usuarios';

ALTER TABLE permisos DROP FOREIGN KEY permisos_acceso;
ALTER TABLE permisos DROP FOREIGN KEY permisos_ibfk_1;

ALTER TABLE permisos 
ADD COLUMN permisos_acceso INT;

ALTER TABLE permisos 
ADD CONSTRAINT fk_permisos_acceso 
FOREIGN KEY (permisos_acceso) 
REFERENCES usuarios(permisos_acceso) 
ON UPDATE CASCADE 
ON DELETE NO ACTION;

SELECT * FROM usuarios WHERE (username = 'guille.work.94@gmail.com' OR email = 'guille.work.94@gmail.com')
                                    AND password = md5('1')
                                    AND status='activo';
                                    
SELECT * FROM usuarios WHERE username = 'memo' 
                                    AND password = '1' 
                                    AND status='activo';
                                    
SELECT * FROM usuarios WHERE password = '1';

CREATE TABLE bloqueos(
	id_bloqueo INT NOT NULL PRIMARY KEY,
    bloq_descrip VARCHAR(55)
);

INSERT INTO bloqueos 
	(id_bloqueo, bloq_descrip)
VALUES
	(1, 'Bloqueo Manual Administrativo'),
    (2, 'Bloqueo Aut. por intentos fallidos');
    
SELECT * FROM bloqueos;

CREATE TABLE logs_acceso(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip VARCHAR(45),
    success INT
);
DROP TABLE logs_acceso;

SELECT SUM(success) FROM logs_acceso WHERE id_user = 7;

INSERT INTO logs_acceso (id_user, ip, success) VALUES (3, 333, 1);

SELECT * FROM logs_acceso;

SELECT * FROM logs_acceso ORDER BY fecha DESC;

SELECT COUNT(*) FROM logs_acceso
WHERE id_user =  1
AND success = 1 
AND fecha > (NOW() - INTERVAL 15 MINUTE);

-- Vista de usuarios que incluye la descripcion o tipo de bloqueo
CREATE VIEW v_usuarios2 AS (
SELECT u.id_user, u.name_user, u.email, u.telefono, u.foto, p.per_descrip, u.status, b.tipo
FROM usuarios u
JOIN permisos p ON u.permisos_acceso = p.id_permisos
LEFT JOIN bloqueos b ON u.status = b.id_bloqueo
ORDER BY u.id_user);

SELECT * FROM v_usuarios;
    
    
    
    
    