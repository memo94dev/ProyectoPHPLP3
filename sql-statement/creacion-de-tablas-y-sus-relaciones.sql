create table `usuarios` (
	`id_user` int (3),
	`username` varchar (150),
	`name_user` varchar (150),
	`password` varchar (150),
	`email` varchar (150),
	`telefono` varchar (39),
	`foto` varchar (300),
	`permisos_acceso` varchar (300),
	`status` char (27)
); 
insert into `usuarios` (`id_user`, `username`, `name_user`, `password`, `email`, `telefono`, `foto`, `permisos_acceso`, `status`) values('1','memo','Guillermo Barrientos','e10adc3949ba59abbe56e057f20f883e','guille.work.94@gmail.com','0985220116','user-default.png','Super Admin','activo');


CREATE TABLE departamento
(
  id_departamento INTEGER NOT NULL,
  dep_descripcion CHARACTER VARYING(35),
  CONSTRAINT departamento_pkey PRIMARY KEY (id_departamento)
);

CREATE TABLE ciudad
(
  cod_ciudad INT NOT NULL,
  descrip_ciudad CHARACTER VARYING(25),
  id_departamento INT NOT NULL,
  FOREIGN KEY (id_departamento) REFERENCES departamento (id_departamento) ON UPDATE CASCADE ON DELETE NO ACTION,
  PRIMARY KEY (cod_ciudad)
);


CREATE TABLE clientes
(
  id_cliente INTEGER NOT NULL,
  ci_ruc CHARACTER VARYING(10) NOT NULL,
  cli_nombre CHARACTER VARYING(30) NOT NULL,
  cli_apellido CHARACTER VARYING(50) NOT NULL,
  cli_direccion CHARACTER VARYING(50),
  cli_telefono INTEGER,
  cod_ciudad INTEGER,
  CONSTRAINT clientes_pk PRIMARY KEY (id_cliente),
  CONSTRAINT clientes_cod_ciudad_fkey FOREIGN KEY (cod_ciudad)
      REFERENCES ciudad (cod_ciudad) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);



CREATE TABLE deposito
(
  cod_deposito INTEGER NOT NULL,
  descrip CHARACTER VARYING(50) NOT NULL,
  CONSTRAINT deposito_pk PRIMARY KEY (cod_deposito)
);

CREATE TABLE u_medida
(
  id_u_medida INTEGER NOT NULL,
  u_descrip CHARACTER VARYING(20) NOT NULL,
  CONSTRAINT u_medida_pk PRIMARY KEY (id_u_medida)
);

CREATE TABLE tipo_producto
(
  cod_tipo_prod INTEGER NOT NULL,
  t_p_descrip CHARACTER VARYING(50) NOT NULL,
  CONSTRAINT tipo_producto_pk PRIMARY KEY (cod_tipo_prod)
);

CREATE TABLE producto
(
  cod_producto INTEGER NOT NULL,
  cod_tipo_prod INTEGER NOT NULL,
  id_u_medida INTEGER NOT NULL,
  p_descrip CHARACTER VARYING(50) NOT NULL,
  precio INTEGER NOT NULL,
  CONSTRAINT producto_pk PRIMARY KEY (cod_producto),
  CONSTRAINT tipo_producto_producto_fk FOREIGN KEY (cod_tipo_prod)
      REFERENCES tipo_producto (cod_tipo_prod) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT u_medida_producto_fk FOREIGN KEY (id_u_medida)
      REFERENCES u_medida (id_u_medida) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE proveedor
(
  cod_proveedor INTEGER NOT NULL,
  razon_social CHARACTER VARYING(75) NOT NULL,
  ruc CHARACTER VARYING(9) NOT NULL,
  direccion CHARACTER VARYING(50),
  telefono INTEGER NOT NULL,
  CONSTRAINT proveedor_pk PRIMARY KEY (cod_proveedor)
);

CREATE TABLE compra
(
  cod_compra INT NOT NULL,
  cod_proveedor INT NOT NULL,
  nro_factura CHARACTER VARYING(25) NOT NULL,
  fecha DATE NOT NULL,
  estado CHARACTER VARYING(15) NOT NULL,
  cod_deposito INTEGER NOT NULL,
  hora TIME NOT NULL,
  total_compra INT,
  id_user int (11),
  PRIMARY KEY (cod_compra),
  FOREIGN KEY (cod_deposito)
  REFERENCES deposito (cod_deposito) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (cod_proveedor)
  REFERENCES proveedor (cod_proveedor) ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE detalle_compra
(
  cod_producto INTEGER NOT NULL,
  cod_compra INTEGER NOT NULL,
  cod_deposito INTEGER NOT NULL,
  precio INTEGER NOT NULL,
  cantidad INTEGER NOT NULL,
  CONSTRAINT detalle_compra_pk PRIMARY KEY (cod_producto, cod_compra),
  CONSTRAINT compra_detalle_compra_fk FOREIGN KEY (cod_compra)
      REFERENCES compra (cod_compra) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT deposito_detalle_compra_fk FOREIGN KEY (cod_deposito)
      REFERENCES deposito (cod_deposito) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT producto_detalle_compra_fk FOREIGN KEY (cod_producto)
      REFERENCES producto (cod_producto) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE stock
(
  cod_deposito INTEGER NOT NULL,
  cod_producto INTEGER NOT NULL,
  cantidad INTEGER NOT NULL,
  CONSTRAINT stock_pk PRIMARY KEY (cod_deposito, cod_producto),
  CONSTRAINT deposito_stock_fk FOREIGN KEY (cod_deposito)
      REFERENCES deposito (cod_deposito) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT producto_stock_fk FOREIGN KEY (cod_producto)
      REFERENCES producto (cod_producto) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE venta
(
  cod_venta INTEGER NOT NULL,
  id_cliente INTEGER NOT NULL,
  fecha DATE NOT NULL,
  total_venta INTEGER NOT NULL,
  estado CHARACTER VARYING(15) NOT NULL,
  hora TIME NOT NULL,
  nro_factura INTEGER,
  CONSTRAINT venta_pk PRIMARY KEY (cod_venta),
  CONSTRAINT clientes_venta_fk FOREIGN KEY (id_cliente)
      REFERENCES clientes (id_cliente) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE det_venta
(
  cod_producto INTEGER NOT NULL,
  cod_venta INTEGER NOT NULL,
  cod_deposito INTEGER NOT NULL,
  det_precio_unit INTEGER NOT NULL,
  det_cantidad INTEGER NOT NULL,
  CONSTRAINT det_venta_pk PRIMARY KEY (cod_producto, cod_venta),
  CONSTRAINT deposito_det_venta_fk FOREIGN KEY (cod_deposito)
      REFERENCES deposito (cod_deposito) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT producto_det_venta_fk FOREIGN KEY (cod_producto)
      REFERENCES producto (cod_producto) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT venta_det_venta_fk FOREIGN KEY (cod_venta)
      REFERENCES venta (cod_venta) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

create table `tmp` (
	`id_tmp` int (11),
	`id_producto` int (11),
	`cantidad_tmp` int (11),
	`precio_tmp` int(11),
	`session_id` varchar (765)
); 