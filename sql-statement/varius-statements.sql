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