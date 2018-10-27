-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.36-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla cosasporhacer.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL DEFAULT '#448AFF',
  `fecha_creado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla cosasporhacer.categorias: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `nombre`, `color`, `fecha_creado`) VALUES
	(1, 'Estudio', '#448AFF', '2018-10-26 06:36:13'),
	(2, 'Trabajo', '#CDDC39', '2018-10-26 06:36:13'),
	(3, 'Casa', '#FF5722', '2018-10-26 06:36:13');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla cosasporhacer.tareas
CREATE TABLE IF NOT EXISTS `tareas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarea` text NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `realizada` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_creado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`categoria_id`,`usuario_id`),
  KEY `FK_tareas_categorias` (`categoria_id`),
  KEY `FK_tareas_usuarios` (`usuario_id`),
  CONSTRAINT `FK_tareas_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tareas_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla cosasporhacer.tareas: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tareas` DISABLE KEYS */;
INSERT INTO `tareas` (`id`, `tarea`, `categoria_id`, `usuario_id`, `realizada`, `fecha_creado`) VALUES
	(1, 'Ir por leche al supermercado al salir del trabajo', 3, 1, 1, '2018-10-25 22:12:23'),
	(2, 'Estudiar para el parcial de Bases de datos', 1, 1, 0, '2018-10-25 22:12:23'),
	(3, 'Entregar primera parte proyecto MVP', 2, 1, 0, '2018-10-25 22:14:01'),
	(4, 'Llamar a la EPS para una cita', 3, 1, 0, '2018-10-26 06:49:51');
/*!40000 ALTER TABLE `tareas` ENABLE KEYS */;

-- Volcando estructura para tabla cosasporhacer.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla cosasporhacer.usuarios: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`) VALUES
	(1, 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
