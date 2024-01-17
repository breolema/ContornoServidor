-- Volcando estructura de base de datos para pedidos
CREATE DATABASE IF NOT EXISTS `pedidos` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `pedidos`;

-- Volcando estructura para tabla pedidos.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `CodCat` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Activa` BOOLEAN NOT NULL,
  PRIMARY KEY (`CodCat`),
  UNIQUE KEY `UN_NOM_CAT` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pedidos.categorias: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`CodCat`, `Nombre`, `Descripcion`) VALUES
	(1, 'Comida', 'Platos e ingredientes'),
	(2, 'Bedidas sin', 'Bebidas sin alcohol'),
	(3, 'Bebidas con', 'Bebidas con alcohol');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `CodPed` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `Enviado` int(11) NOT NULL,
  `Usuario` int(11) NOT NULL,
  PRIMARY KEY (`CodPed`),
  KEY `Usuario` (`Usuario`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`CodUsu`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pedidos.pedidos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` (`CodPed`, `Fecha`, `Enviado`, `Restaurante`) VALUES
	(3, '2022-11-27 19:23:14', 0, 2),
	(4, '2022-11-27 19:24:17', 0, 2),
	(5, '2022-11-27 19:25:39', 0, 2);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.pedidosproductos
CREATE TABLE IF NOT EXISTS `pedidosproductos` (
  `CodPredProd` int(11) NOT NULL AUTO_INCREMENT,
  `CodPed` int(11) NOT NULL,
  `CodProd` int(11) NOT NULL,
  `Unidades` int(11) NOT NULL,
  PRIMARY KEY (`CodPredProd`),
  KEY `CodPed` (`CodPed`),
  KEY `CodProd` (`CodProd`),
  CONSTRAINT `pedidosproductos_ibfk_1` FOREIGN KEY (`CodPed`) REFERENCES `pedidos` (`CodPed`),
  CONSTRAINT `pedidosproductos_ibfk_2` FOREIGN KEY (`CodProd`) REFERENCES `productos` (`CodProd`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pedidos.pedidosproductos: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `pedidosproductos` DISABLE KEYS */;
INSERT INTO `pedidosproductos` (`CodPredProd`, `CodPed`, `CodProd`, `Unidades`) VALUES
	(1, 3, 5, 2),
	(2, 3, 4, 2),
	(3, 4, 5, 2),
	(4, 4, 4, 2),
	(5, 5, 5, 2),
	(6, 5, 4, 2),
	(7, 5, 1, 1);
/*!40000 ALTER TABLE `pedidosproductos` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `CodProd` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(90) NOT NULL,
  `Peso` float NOT NULL,
  `Stock` int(11) NOT NULL,
  `CodCat` int(11) NOT NULL,
  PRIMARY KEY (`CodProd`),
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pedidos.productos: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`CodProd`, `Nombre`, `Descripcion`, `Peso`, `Stock`, `CodCat`) VALUES
	(1, 'Harina', '8 paquetes de 1kg de harina cada uno', 8, 100, 1),
	(2, 'Azúcar', '20 paquetes de 1kg cada uno', 20, 3, 1),
	(3, 'Agua 0.5', '100 botellas de 0.5 litros cada una', 51, 100, 2),
	(4, 'Agua 1.5', '20 botellas de 1.5 litros cada una', 31, 50, 2),
	(5, 'Cerveza Alhambra tercio', '24 botellas de 33cl', 10, 0, 3),
	(6, 'Vino tinto Rioja 0.75', '6 botellas de 0.75 ', 5.5, 10, 3);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.restaurantes
CREATE TABLE IF NOT EXISTS `usuarios` (
  `CodUsu` int(11) NOT NULL AUTO_INCREMENT,
  `Correo` varchar(90) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `Rol` INT(2) NOT NULL,
  `Pais` varchar(45) NOT NULL,
  `CP` int(5) DEFAULT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  PRIMARY KEY (`CodUsu`),
  UNIQUE KEY `UN_RES_COR` (`Correo`),
  CONSTRAINT `codrol_roles` FOREIGN KEY (`Rol`) REFERENCES `roles` (`CodRol`),
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=LATIN1;

-- Volcando datos para la tabla pedidos.restaurantes: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `restaurantes` DISABLE KEYS */;
INSERT INTO `usuarios` (`CodRes`, `Correo`, `Clave`, `CodRol`, `Pais`, `CP`, `Ciudad`, `Direccion`) VALUES
	(1, 'breo', '1234', 'España', 28002, 'Madrid', 'C/ Padre  Claret, 8'),
	(2, 'antonio', '1234', 'España', 11001, 'Cádiz', 'C/ Portales, 2 ');
/*!40000 ALTER TABLE `restaurantes` ENABLE KEYS */;

CREATE TABLE if NOT EXISTS `roles`(
	`CodRol` INT(2) NOT NULL,
	`TipoRol` VARCHAR(20) NOT NULL,
	PRIMARY KEY (`CodRol`),
	UNIQUE KEY `UN_RES_COR` (`TipoRol`)
)ENGINE=InnoDB DEFAULT CHARSET=LATIN1;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
