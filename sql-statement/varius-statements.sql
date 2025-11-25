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
JOIN producto pro ON co.cod_compra = det.cod_compra
JOIN u_medida u ON pro.id_u_medida = u.id_u_medida
JOIN tipo_producto tp ON pro.cod_tipo_prod = tp.cod_tipo_prod);

SELECT * FROM v_det_compra;

