CREATE TABLE ROL_USUARIO(
id_rol INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
codigo_rol VARCHAR(20) NOT NULL, 
nombre_rol VARCHAR(50) NOT NULL, 
descripcion_rol VARCHAR(150) NOT NULL, 
activo BOOLEAN
);

CREATE TABLE METODO_PAGO(
id_metodo_pago INT NOT NULL PRIMARY KEY,
nombre_metodo VARCHAR(40),
descripcion VARCHAR(150),
activo BOOLEAN
);

CREATE TABLE CATEGORIA_PRODUCTO (
id_categoria INT NOT NULL PRIMARY KEY,
nombre_categoria VARCHAR(50) NOT NULL UNIQUE, 
descripcion_categoria VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE PRODUCTO (
id_producto INT NOT NULL PRIMARY KEY,
nombre_producto VARCHAR(80) NOT NULL,
descripcion VARCHAR(200) NOT NULL,
precio DOUBLE NOT NULL, 
disponible BOOLEAN NOT NULL,
url_imagen VARCHAR(200) NOT NULL,
tiempo_preparacion_min INT NOT NULL,
categoria_id INT NOT NULL,
FOREIGN KEY(categoria_id) REFERENCES CATEGORIA_PRODUCTO(id_categoria)
);

CREATE TABLE SUCURSAL (
id_sucursal INT NOT NULL PRIMARY KEY,
nombre_sucursal VARCHAR(50) NOT NULL UNIQUE, 
direccion VARCHAR(150) NOT NULL UNIQUE,
ciudad VARCHAR(20) NOT NULL,
telefono VARCHAR(15) NOT NULL,
horario_apertura VARCHAR(8),
horario_cierre VARCHAR(8),
activa BOOLEAN
);

CREATE TABLE GALERIA(
id_imagen INT NOT NULL PRIMARY KEY,
titulo VARCHAR(120)NOT NULL,
descripcion VARCHAR(200)NOT NULL,
url_imagen VARCHAR(200)NOT NULL,
fecha_publicacion VARCHAR(10)NOT NULL,
activo BOOLEAN NOT NULL,
sucursal_id INT NOT NULL,
FOREIGN KEY(sucursal_id) REFERENCES SUCURSAL (id_sucursal)
);

CREATE TABLE HORARIO_ATENCION(
id_horario INT NOT NULL PRIMARY KEY,
dia_semana VARCHAR(10),
hora_apertura VARCHAR(8),
hora_cierre VARCHAR(8),
sucursal_id INT,
FOREIGN KEY(sucursal_id) REFERENCES SUCURSAL (id_sucursal)
);

CREATE TABLE USUARIO(
id_usuario INT NOT NULL PRIMARY KEY,
tipo_documento VARCHAR(50) NOT NULL,
numero_documento VARCHAR(20) NOT NULL,
nombres VARCHAR(60) NOT NULL,
apellidos VARCHAR(60) NOT NULL,
telefono VARCHAR(15) NOT NULL,
email VARCHAR(100) NOT NULL,
direccion VARCHAR(120) NOT NULL,
ciudad VARCHAR(30) NOT NULL,
fecha_registro VARCHAR(10) NOT NULL,
password_hash VARCHAR(255) NOT NULL,
activo BOOLEAN NOT NULL,
rol_id INT NOT NULL,
FOREIGN KEY(rol_id) REFERENCES ROL_USUARIO (id_rol)
);

CREATE TABLE CLIENTE(
id_cliente INT NOT NULL PRIMARY KEY,
tipo_cliente VARCHAR(20) NOT NULL,
puntos_acumulados INT NOT NULL,
fecha_ultima_compra VARCHAR(8) NOT NULL,
usuario_id INT NOT NULL,
FOREIGN KEY(usuario_id) REFERENCES USUARIO (id_usuario)
);

CREATE TABLE RESERVA(
id_reserva INT NOT NULL PRIMARY KEY,
fecha_reserva VARCHAR(10) NOT NULL,
hora_reserva VARCHAR(8) NOT NULL,
cantidad_personas INT NOT NULL,
estado INT NOT NULL,
obervaciones VARCHAR(200),
cliente_id INT NOT NULL,
sucursal_id INT NOT NULL,
FOREIGN KEY(cliente_id) REFERENCES CLIENTE (id_cliente),
FOREIGN KEY(sucursal_id) REFERENCES SUCURSAL (id_sucursal)
);

CREATE TABLE PEDIDO(
id_pedido INT NOT NULL PRIMARY KEY,
fecha_pedido VARCHAR(10) NOT NULL,
hora_pedido VARCHAR(8) NOT NULL,
total DOUBLE NOT NULL,
estado VARCHAR(20) NOT NULL,
obervaciones VARCHAR(200),
cliente_id INT NOT NULL,
sucursal_id INT NOT NULL,
metodo_pago_id INT NOT NULL,
FOREIGN KEY(cliente_id) REFERENCES CLIENTE (id_cliente),
FOREIGN KEY(sucursal_id) REFERENCES SUCURSAL (id_sucursal),
FOREIGN KEY(metodo_pago_id) REFERENCES METODO_PAGO (id_metodo_pago)
);

CREATE TABLE DETALLE_PEDIDO (
id_detalle INT NOT NULL PRIMARY KEY,
pedido INT NOT NULL, 
producto_id INT NOT NULL,
FOREIGN KEY(producto_id) REFERENCES PRODUCTO (id_producto),
FOREIGN KEY(pedido) REFERENCES PEDIDO(id_pedido)
);