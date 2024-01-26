CREATE DATABASE IF NOT EXISTS `supermercado` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `supermercado`;

CREATE TABLE IF NOT EXISTS `categorias` (
  `CodCat` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Activa` BOOLEAN NOT NULL,
  `RutaImagen` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`CodCat`),
  UNIQUE KEY `UN_NOM_CAT` (`Nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=LATIN1;


INSERT INTO `categorias` (`Nombre`, `Activa`,`RutaImagen`) VALUES
('Carniceria', TRUE, 'imagenes/categorias/carniceria.jpg'),
('Charcutería', TRUE, 'imagenes/categorias/charcuteria.jpg'),
('Pescaderia', TRUE, 'imagenes/categorias/pescaderia.jpg'),
('Fruteria', TRUE, 'imagenes/categorias/fruteria.jpg'),
('Verduleria', TRUE, 'imagenes/categorias/verduleria.jpg'),
('Refrescos', TRUE, 'imagenes/categorias/refrescos.jpg'),
('Licoreria/Cerveceria', TRUE, 'imagenes/categorias/licoreria.jpg'),
('Lacteos', TRUE, 'imagenes/categorias/lacteos.jpg'),
('Cuidado personal', TRUE, 'imagenes/categorias/cuidadopersonal.jpg');


CREATE TABLE IF NOT EXISTS `pedidos` (
  `CodPed` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `CodUsuario` int(11) NOT NULL,
  `PrecioTotal` float NOT NULL,
  `CodEstado` int(3) NOT NULL,
  PRIMARY KEY (`CodPed`),
  KEY `CodUsuario` (`CodUsuario`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`CodUsuario`) REFERENCES `usuarios` (`CodUsu`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`CodEstado`) REFERENCES `estadoPedido` (`CodEstadoPedido`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=LATIN1;

CREATE TABLE IF NOT EXISTS `pedidosproductos` (
  `CodPedProd` int(11) NOT NULL AUTO_INCREMENT,
  `CodPed` int(11) NOT NULL,
  `CodProd` int(11) NOT NULL,
  `Unidades` int(11) NOT NULL,
  `Precio` float NOT NULL,
  PRIMARY KEY (`CodPedProd`),
  KEY `CodPed` (`CodPed`),
  KEY `CodProd` (`CodProd`),
  CONSTRAINT `pedidosproductos_ibfk_1` FOREIGN KEY (`CodPed`) REFERENCES `pedidos` (`CodPed`),
  CONSTRAINT `pedidosproductos_ibfk_2` FOREIGN KEY (`CodProd`) REFERENCES `productos` (`CodProd`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=LATIN1;

CREATE TABLE IF NOT EXISTS `productos` (
  `CodProd` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(90) NOT NULL,
  `Precio` float NOT NULL,
  `Stock` int(11) NOT NULL,
  `CodCat` int(11) NOT NULL,
  `CodEstado` INT(11) NOT NULL,
  PRIMARY KEY (`CodProd`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`CodCat`) REFERENCES `categorias` (`CodCat`),
  CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`CodEstado`) REFERENCES `estadoProducto` (`CodEstadoProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=LATIN1;


INSERT INTO `productos` (`Nombre`,`Descripcion`,`Precio`,`Stock`,`CodCat`,`CodEstado`) VALUES
('Solomillo', 'Solomillo de cerdo 1kg', 4.00, 50, 1,1);

CREATE TABLE IF NOT EXISTS `usuarios` (
  `CodUsu` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(30) NOT NULL,
  `Correo` varchar(90) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `Pais` varchar(45) NOT NULL,
  `CP` int(5) DEFAULT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Rol` INT(2) NOT NULL,
  `Activo` BOOLEAN NOT NULL,
  PRIMARY KEY (`CodUsu`),
  UNIQUE KEY `UN_RES_COR` (`Correo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=LATIN1;

INSERT INTO `usuarios` (`Nombre`, `Correo`, `Clave`,`Pais`, `CP`, `Ciudad`, `Direccion`, `Rol`, `Activo`) VALUES
('Breo', 'breo@gmail.com', 'e8dc8ccd5e5f9e3a54f07350ce8a2d3d', 'España', '15270', 'Cee', 'Cee', 1, TRUE);

SELECT nombre,clave FROM usuarios WHERE Nombre='Breo'&& activo=true;
DELETE FROM usuarios WHERE Nombre='Breo';

CREATE TABLE IF NOT EXISTS `roles` (
  `CodRol` INT(2) NOT NULL,
  `Descripcion` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`CodRol`)
) ENGINE=InnoDB DEFAULT CHARSET=LATIN1;

INSERT INTO `roles` (`CodRol`, `Descripcion`) VALUES
(1,'Administrador'),
(2, 'Cliente');

CREATE TABLE IF NOT EXISTS `estadoProducto` (
  `CodEstadoProducto` INT(2) NOT NULL,
  `Descripcion` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`CodEstadoProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=LATIN1;

INSERT INTO `estadoProducto` (`CodEstadoProducto`,`Descripcion`) VALUES
(1,'Activo'),(2,'Descactivado');

CREATE TABLE IF NOT EXISTS `estadoPedido` (
  `CodEstadoPedido` INT(3) NOT NULL,
  `Descripcion` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`CodEstadoPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=LATIN1;

CREATE TABLE IF NOT EXISTS `historialPedidos` (
  `CodHistorial` int(11) NOT NULL,
  `CodUsu` int(11) NOT NULL,
  `Descripcion` VARCHAR(100) NOT NULL,
  `Fecha` DATE NOT NULL,
  PRIMARY KEY (`CodHistorial`),
  CONSTRAINT `historialPedidos_ibfk_1` FOREIGN KEY (`CodUsu`) REFERENCES `usuarios` (`CodUsu`)
) ENGINE=InnoDB DEFAULT CHARSET=LATIN1;









