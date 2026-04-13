-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2023 a las 02:03:32
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `control_laboratorios_utec`
--
CREATE DATABASE IF NOT EXISTS `control_laboratorios_utec` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `control_laboratorios_utec`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarCredencialesUsuarios` (IN `Usuario` VARCHAR(255))   BEGIN
SELECT idusuarios, codigousuario, correo, contrasenia, estado_usuario FROM usuarios WHERE (codigousuario=Usuario OR correo=Usuario);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_InicioSesionUsuarios` (IN `Usuario` VARCHAR(255), IN `Pass` VARCHAR(255))   BEGIN
SELECT * FROM usuarios WHERE (codigousuario=Usuario OR correo=Usuario) AND contrasenia=Pass AND estado_usuario="activo";
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE `accesos` (
  `idacceso` int(11) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_cierresesion` datetime NOT NULL,
  `idusuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion_notificaciones`
--

CREATE TABLE `clasificacion_notificaciones` (
  `idclasificacion` int(11) NOT NULL,
  `codigoclasificacion` varchar(50) NOT NULL,
  `descripcionclasificacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesusuarios`
--

CREATE TABLE `detallesusuarios` (
  `iddetalleusuarios` int(11) NOT NULL,
  `telefonoprincipal` varchar(9) NOT NULL,
  `telefonotrabajo` varchar(9) NOT NULL,
  `genero` char(2) NOT NULL,
  `fechanacimiento` datetime NOT NULL,
  `estadocivil` varchar(25) NOT NULL,
  `idusuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manifiestos_plataforma`
--

CREATE TABLE `manifiestos_plataforma` (
  `idmanifiesto` int(11) NOT NULL,
  `idusuarios` int(11) NOT NULL,
  `nombremanifiesto` varchar(255) NOT NULL,
  `descripcionmanifiesto` varchar(700) NOT NULL,
  `fotomanifiesto` varchar(255) NOT NULL,
  `fecharegistro` datetime NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` varchar(25) NOT NULL DEFAULT 'pendiente',
  `comentario_actualizacion` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajeria`
--

CREATE TABLE `mensajeria` (
  `idmensajeria` int(11) NOT NULL,
  `idusuarios` int(11) NOT NULL,
  `nombremensaje` varchar(255) NOT NULL,
  `asuntomensaje` varchar(255) NOT NULL,
  `detallemensaje` text NOT NULL,
  `fechamensaje` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idusuarios_destinatario` int(11) NOT NULL,
  `ocultarmensaje` char(2) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `idnotificaciones` int(11) NOT NULL,
  `idusuarios` int(11) NOT NULL,
  `titulonotificacion` varchar(255) NOT NULL,
  `descripcion_notificacion` varchar(255) NOT NULL,
  `fechanotificacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `idclasificacion` int(11) NOT NULL,
  `ocultarnotificacion` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacion`
--

CREATE TABLE `recuperacion` (
  `idrecuperaciones` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `codigo` int(11) NOT NULL,
  `fechasolicitud` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` varchar(15) NOT NULL DEFAULT 'nousado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idrolusuario` int(11) NOT NULL,
  `nombrerolusuario` varchar(50) NOT NULL,
  `descripcionrolusuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `idrolusuario` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `codigousuario` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `fotoperfil` varchar(255) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `nuevousuario` char(2) NOT NULL DEFAULT 'si',
  `ultimo_cambio_contrasenia` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado_usuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`idacceso`),
  ADD KEY `fk_acceso-usuarios` (`idusuarios`);

--
-- Indices de la tabla `clasificacion_notificaciones`
--
ALTER TABLE `clasificacion_notificaciones`
  ADD PRIMARY KEY (`idclasificacion`);

--
-- Indices de la tabla `detallesusuarios`
--
ALTER TABLE `detallesusuarios`
  ADD PRIMARY KEY (`iddetalleusuarios`),
  ADD KEY `fk_detalleusuarios-usuarios` (`idusuarios`);

--
-- Indices de la tabla `manifiestos_plataforma`
--
ALTER TABLE `manifiestos_plataforma`
  ADD PRIMARY KEY (`idmanifiesto`),
  ADD KEY `fk_manifiestos-usuarios` (`idusuarios`);

--
-- Indices de la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
  ADD PRIMARY KEY (`idmensajeria`),
  ADD KEY `fk_mensajeria_usuarios_destinatariofinal` (`idusuarios`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idnotificaciones`),
  ADD KEY `fk_notificaciones-clasificacionesnotificaciones` (`idclasificacion`),
  ADD KEY `fk_notificaciones-usuarios` (`idusuarios`);

--
-- Indices de la tabla `recuperacion`
--
ALTER TABLE `recuperacion`
  ADD PRIMARY KEY (`idrecuperaciones`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrolusuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`),
  ADD KEY `fk_usuarios-roles` (`idrolusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesos`
--
ALTER TABLE `accesos`
  MODIFY `idacceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clasificacion_notificaciones`
--
ALTER TABLE `clasificacion_notificaciones`
  MODIFY `idclasificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallesusuarios`
--
ALTER TABLE `detallesusuarios`
  MODIFY `iddetalleusuarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `manifiestos_plataforma`
--
ALTER TABLE `manifiestos_plataforma`
  MODIFY `idmanifiesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
  MODIFY `idmensajeria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idnotificaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recuperacion`
--
ALTER TABLE `recuperacion`
  MODIFY `idrecuperaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idrolusuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD CONSTRAINT `fk_acceso-usuarios` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`);

--
-- Filtros para la tabla `detallesusuarios`
--
ALTER TABLE `detallesusuarios`
  ADD CONSTRAINT `fk_detalleusuarios-usuarios` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`);

--
-- Filtros para la tabla `manifiestos_plataforma`
--
ALTER TABLE `manifiestos_plataforma`
  ADD CONSTRAINT `fk_manifiestos-usuarios` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`);

--
-- Filtros para la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
  ADD CONSTRAINT `fk_mensajeria_usuarios_destinatariofinal` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`),
  ADD CONSTRAINT `fk_usuarios_mensajeria_bandejaentrada` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_notificaciones-clasificacionesnotificaciones` FOREIGN KEY (`idclasificacion`) REFERENCES `clasificacion_notificaciones` (`idclasificacion`),
  ADD CONSTRAINT `fk_notificaciones-usuarios` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios-roles` FOREIGN KEY (`idrolusuario`) REFERENCES `roles` (`idrolusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
