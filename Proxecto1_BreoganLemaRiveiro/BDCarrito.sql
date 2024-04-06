-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.17-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para supermercado
CREATE DATABASE IF NOT EXISTS `supermercado` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `supermercado`;

-- Volcando estructura para tabla supermercado.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `CodCat` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Activa` tinyint(1) NOT NULL,
  `RutaImagen` varchar(100) NOT NULL,
  PRIMARY KEY (`CodCat`),
  UNIQUE KEY `UN_NOM_CAT` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla supermercado.categorias: ~8 rows (aproximadamente)
DELETE FROM `categorias`;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`CodCat`, `Nombre`, `Activa`, `RutaImagen`) VALUES
	(1, 'Carniceria', 1, 'imagenes/categorias/carniceria.jpg'),
	(2, 'Charcutería', 1, 'imagenes/categorias/charcuteria.jpg'),
	(3, 'Pescaderia', 1, 'imagenes/categorias/pescaderia.jpg'),
	(4, 'Fruteria', 1, 'imagenes/categorias/fruteria.jpg'),
	(5, 'Verduleria', 1, 'imagenes/categorias/verduleria.jpg'),
	(6, 'Refrescos', 1, 'imagenes/categorias/refrescos.jpg'),
	(7, 'Licoreria/Cerveceria', 1, 'imagenes/categorias/licoreria.jpg'),
	(8, 'Lacteos', 1, 'imagenes/categorias/lacteos.jpg');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla supermercado.estadopedido
CREATE TABLE IF NOT EXISTS `estadopedido` (
  `CodEstadoPedido` int(3) NOT NULL,
  `Descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`CodEstadoPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla supermercado.estadopedido: ~4 rows (aproximadamente)
DELETE FROM `estadopedido`;
/*!40000 ALTER TABLE `estadopedido` DISABLE KEYS */;
INSERT INTO `estadopedido` (`CodEstadoPedido`, `Descripcion`) VALUES
	(1, 'Creado'),
	(2, 'Enviado'),
	(3, 'Entregado'),
	(4, 'Cancelado');
/*!40000 ALTER TABLE `estadopedido` ENABLE KEYS */;

-- Volcando estructura para tabla supermercado.estadoproducto
CREATE TABLE IF NOT EXISTS `estadoproducto` (
  `CodEstadoProducto` int(2) NOT NULL,
  `Descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`CodEstadoProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla supermercado.estadoproducto: ~2 rows (aproximadamente)
DELETE FROM `estadoproducto`;
/*!40000 ALTER TABLE `estadoproducto` DISABLE KEYS */;
INSERT INTO `estadoproducto` (`CodEstadoProducto`, `Descripcion`) VALUES
	(0, 'Desactivo'),
	(1, 'Activo');
/*!40000 ALTER TABLE `estadoproducto` ENABLE KEYS */;

-- Volcando estructura para tabla supermercado.historialmodificaciones
CREATE TABLE IF NOT EXISTS `historialmodificaciones` (
  `CodModificacion` int(11) NOT NULL AUTO_INCREMENT,
  `CodUsuario` int(11) DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Fecha` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`CodModificacion`),
  KEY `FK_HistorialModificaciones_Usuarios` (`CodUsuario`),
  CONSTRAINT `FK_HistorialModificaciones_Usuarios` FOREIGN KEY (`CodUsuario`) REFERENCES `usuarios` (`CodUsu`),
  CONSTRAINT `historialmodificaciones_ibfk_1` FOREIGN KEY (`CodUsuario`) REFERENCES `usuarios` (`CodUsu`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla supermercado.historialmodificaciones: ~0 rows (aproximadamente)
DELETE FROM `historialmodificaciones`;
/*!40000 ALTER TABLE `historialmodificaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `historialmodificaciones` ENABLE KEYS */;

-- Volcando estructura para tabla supermercado.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `CodPed` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `CodUsuario` int(11) NOT NULL,
  `PrecioTotal` float NOT NULL,
  `CodEstado` int(3) NOT NULL,
  PRIMARY KEY (`CodPed`),
  KEY `CodUsuario` (`CodUsuario`),
  KEY `pedidos_ibfk_2` (`CodEstado`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`CodUsuario`) REFERENCES `usuarios` (`CodUsu`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`CodEstado`) REFERENCES `estadopedido` (`CodEstadoPedido`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla supermercado.pedidos: ~1 rows (aproximadamente)
DELETE FROM `pedidos`;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla supermercado.pedidosproductos
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla supermercado.pedidosproductos: ~1 rows (aproximadamente)
DELETE FROM `pedidosproductos`;
/*!40000 ALTER TABLE `pedidosproductos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidosproductos` ENABLE KEYS */;

-- Volcando estructura para tabla supermercado.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `CodProd` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(90) NOT NULL,
  `Precio` float NOT NULL,
  `Stock` int(11) NOT NULL CHECK (`Stock` >= 0),
  `CodCat` int(11) NOT NULL,
  `CodEstado` int(11) NOT NULL,
  `RutaImagen` varchar(100) NOT NULL,
  PRIMARY KEY (`CodProd`),
  KEY `productos_ibfk_1` (`CodCat`),
  KEY `productos_ibfk_2` (`CodEstado`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`CodCat`) REFERENCES `categorias` (`CodCat`),
  CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`CodEstado`) REFERENCES `estadoproducto` (`CodEstadoProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla supermercado.productos: ~3 rows (aproximadamente)
DELETE FROM `productos`;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`CodProd`, `Nombre`, `Descripcion`, `Precio`, `Stock`, `CodCat`, `CodEstado`, `RutaImagen`) VALUES
	(1, 'Solomillo', 'Solomillo de cerdo 1kg', 4, 40, 1, 1, 'imagenes/productos/solomillo.jpg'),
	(2, 'Chorizo', '200g de chorizo', 2.5, 50, 2, 1, 'imagenes/productos/chorizo.jpg'),
	(3, 'Salmon', 'Lomo de salmon', 7.95, 50, 3, 1, 'imagenes/productos/salmon.jpg');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla supermercado.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `CodRol` int(2) NOT NULL,
  `Descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`CodRol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla supermercado.roles: ~2 rows (aproximadamente)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`CodRol`, `Descripcion`) VALUES
	(1, 'Administrador'),
	(2, 'Cliente');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla supermercado.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `CodUsu` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) NOT NULL,
  `Correo` varchar(90) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `Pais` varchar(45) NOT NULL,
  `CP` int(5) DEFAULT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Rol` int(2) NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`CodUsu`),
  UNIQUE KEY `UN_RES_COR` (`Correo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla supermercado.usuarios: ~3 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`CodUsu`, `Nombre`, `Correo`, `Clave`, `Pais`, `CP`, `Ciudad`, `Direccion`, `Rol`, `Activo`) VALUES
	(1, 'Admin', 'admin@gmail.com', 'e8dc8ccd5e5f9e3a54f07350ce8a2d3d', 'España', 15270, 'Cee', 'Cee', 1, 1),
	(2, 'Cliente', 'breolema13@gmail.com', 'e8dc8ccd5e5f9e3a54f07350ce8a2d3d', 'España', 15270, 'Cee', 'Rua da Escola', 2, 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;