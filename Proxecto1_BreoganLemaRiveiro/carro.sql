CREATE DATABASE IF NOT EXISTS `supermercado`;
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
('Lacteos', False, 'imagenes/categorias/lacteos.jpg');

SELECT codcat,nombre,rutaimagen FROM categorias WHERE Activa=TRUE;


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
) ENGINE=InnoDB DEFAULT CHARSET=LATIN1;

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
) ENGINE=InnoDB DEFAULT CHARSET=LATIN1;



CREATE TABLE IF NOT EXISTS `estadoPedido` (
  `CodEstadoPedido` INT(3) NOT NULL,
  `Descripcion` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`CodEstadoPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=LATIN1;


CREATE TABLE IF NOT EXISTS `productos` (
  `CodProd` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(90) NOT NULL,
  `Precio` float NOT NULL,
  `Stock` int(11) NOT NULL CHECK (Stock >= 0),
  `CodCat` int(11) NOT NULL,
  `CodEstado` INT(11) NOT NULL,
  `RutaImagen` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`CodProd`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`CodCat`) REFERENCES `categorias` (`CodCat`),
  CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`CodEstado`) REFERENCES `estadoProducto` (`CodEstadoProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=LATIN1;


INSERT INTO `productos` (`Nombre`,`Descripcion`,`Precio`,`Stock`,`CodCat`,`CodEstado`,`RutaImagen`) VALUES
('Solomillo', 'Solomillo de cerdo 1kg', 4.00, 50, 1,1,'imagenes/productos/solomillo.jpg'),
('Chorizo', '200g de chorizo', 2.50, 50, 2,1,'imagenes/productos/chorizo.jpg'),
('Salmon', 'Lomo de salmon', 7.95, 50, 3,1,'imagenes/productos/salmon.jpg');

delete from productos;
ALTER TABLE pedidos AUTO_INCREMENT = 1;

SELECT RutaImagen FROM productos WHERE CodProd=1;

UPDATE productos SET Nombre = 'Solomillo', 
                  Precio = 3.50, 
                  Stock = 60, 
                  CodCat = 1, 
                  CodEstado = 1 
                  WHERE CodProd = 1;


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
) ENGINE=InnoDB DEFAULT CHARSET=LATIN1;

INSERT INTO `usuarios` (`Nombre`, `Correo`, `Clave`,`Pais`, `CP`, `Ciudad`, `Direccion`, `Rol`, `Activo`) VALUES
('Breo', 'breo@gmail.com', 'e8dc8ccd5e5f9e3a54f07350ce8a2d3d', 'España', 15270, 'Cee', 'Cee', 1, TRUE),
('Cliente','cliente@gmail.com', 'e8dc8ccd5e5f9e3a54f07350ce8a2d3d', 'España', 15270, 'Cee', 'Cee', 2, TRUE);

DELETE FROM usuarios WHERE CodUsu=;
ALTER TABLE pedidos AUTO_INCREMENT = 1;

SELECT nombre,clave FROM usuarios WHERE Nombre='Breo'&& activo=TRUE;
SELECT * FROM usuarios;
DELETE FROM usuarios WHERE Nombre='Breo';

SELECT usuarios.*, roles.Descripcion AS RolDescripcion FROM usuarios INNER JOIN roles ON roles.CodRol = usuarios.Rol;



CREATE TABLE IF NOT EXISTS `roles` (
  `CodRol` INT(2) NOT NULL,
  `Descripcion` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`CodRol`)
) ENGINE=InnoDB DEFAULT CHARSET=LATIN1;

INSERT INTO `roles` (`CodRol`, `Descripcion`) VALUES
(1,'Administrador'),
(2, 'Cliente');

SELECT descripcion FROM roles;

SELECT roles.Descripcion FROM usuarios,roles WHERE roles.CodRol=usuarios.Rol;



CREATE TABLE IF NOT EXISTS `estadoProducto` (
  `CodEstadoProducto` INT(2) NOT NULL,
  `Descripcion` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`CodEstadoProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=LATIN1;

INSERT INTO `estadoProducto` (`CodEstadoProducto`,`Descripcion`) VALUES
(0,'Desactivo'),(1,'Activo');

UPDATE TABLE estadoproducto SET  Descripcion='Creado' WHERE CodEstadoProducto=1;


SELECT codrol,descripcion FROM roles;


DELETE FROM usuarios WHERE CodUsu =6;

SELECT codusu FROM usuarios WHERE nombre='Breo';

delete FROM pedidos;


SELECT pedidos.CodPed, pedidos.Fecha, estadoPedido.Descripcion AS EstadoPedido, pedidos.PrecioTotal, productos.Nombre AS NombreProducto, productos.Descripcion AS DescripcionProducto,pedidosproductos.Unidades AS Unidades, productos.Precio AS PrecioProducto, productos.RutaImagen AS FotoProducto
FROM pedidos
INNER JOIN estadoPedido ON pedidos.CodEstado = estadoPedido.CodEstadoPedido
INNER JOIN pedidosproductos ON pedidos.CodPed = pedidosproductos.CodPed
INNER JOIN productos ON pedidosproductos.CodProd = productos.CodProd
WHERE pedidos.CodUsuario = '2'
GROUP BY pedidos.CodPed
ORDER BY Fecha DESC;


SELECT pedidos.CodUsuario AS CodigoUsuario, pedidos.CodPed AS CodigoPedido, pedidos.Fecha, estadoPedido.Descripcion AS EstadoPedido, pedidos.PrecioTotal
                                FROM pedidos
                                INNER JOIN estadoPedido ON pedidos.CodEstado = estadoPedido.CodEstadoPedido
                                ORDER BY Fecha DESC;
                                
                                
                                
SELECT pedidos.CodPed AS CodigoPedido, pedidos.Fecha AS Fecha, pedidos.PrecioTotal AS PrecioTotal, usuarios.Nombre AS NombreCliente, usuarios.Correo AS EmailCliente
                FROM pedidos
                INNER JOIN estadoPedido ON pedidos.CodEstado = estadoPedido.CodEstadoPedido
                INNER JOIN usuarios ON pedidos.CodUsuario = usuarios.CodUsu
                WHERE pedidos.CodPed = '1';


UPDATE pedidos SET CodEstado = '1' WHERE CodPed = 3;


SELECT * FROM estadopedido 
INNER JOIN pedidos ON pedidos.CodEstado = estadoPedido.CodEstadoPedido
WHERE pedidos.CodPed=3;


SELECT categorias.CodCat, categorias.Nombre FROM categorias
INNER JOIN productos ON categorias.CodCat=productos.CodCat
WHERE productos.CodProd=1;
