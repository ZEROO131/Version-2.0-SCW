
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `scw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE `asignacion` (
  `idasig` bigint(10) NOT NULL,
  `idemple` bigint(10) DEFAULT NULL,
  `idsoli` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detsoli`
--

CREATE TABLE `detsoli` (
  `iddetsoli` bigint(10) NOT NULL,
  `idsoli` bigint(10) DEFAULT NULL,
  `idservi` bigint(10) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominio`
--

CREATE TABLE `dominio` (
  `iddom` bigint(10) NOT NULL,
  `nomdom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idemple` bigint(10) NOT NULL,
  `nomemple` varchar(255) DEFAULT NULL,
  `tipdocu` varchar(5) DEFAULT NULL,
  `ndocemple` bigint(10) DEFAULT NULL,
  `emaiemple` varchar(100) DEFAULT NULL,
  `codbal` bigint(10) DEFAULT NULL,
  `idempre` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idemple`, `nomemple`, `tipdocu`, `ndocemple`, `emaiemple`, `codbal`, `idempre`) VALUES
(1, 'Carlos Sánchez', 'CC', 123456789, 'carlos.sanchez@empresa.com', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idempre` bigint(10) NOT NULL,
  `nit` bigint(10) DEFAULT NULL,
  `razsoci` varchar(255) DEFAULT NULL,
  `direempre` varchar(255) DEFAULT NULL,
  `telempre` int(11) DEFAULT NULL,
  `emaiempre` varchar(100) DEFAULT NULL,
  `replegal` varchar(255) DEFAULT NULL,
  `tipempre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idempre`, `nit`, `razsoci`, `direempre`, `telempre`, `emaiempre`, `replegal`, `tipempre`) VALUES
(1, 8001234567, 'Empresa ABC S.A.S.', 'Calle 123 #45-67, Bogotá', 2035462382, 'contacto@empresaabc.com', 'Juan Pérez', 'S.A.S.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina`
--

CREATE TABLE `pagina` (
  `idpag` bigint(10) NOT NULL,
  `nompag` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagina`
--

INSERT INTO `pagina` (`idpag`, `nompag`) VALUES
(1001, 'homeusu\r\n'),
(2001, 'homeemp'),
(3001, 'homempl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `idper` bigint(10) NOT NULL,
  `nomper` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idper`, `nomper`) VALUES
(1, 'usuario'),
(2, 'empresa'),
(3, 'empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perxpag`
--

CREATE TABLE `perxpag` (
  `idperpag` bigint(10) NOT NULL,
  `idpag` bigint(10) DEFAULT NULL,
  `idper` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perxpag`
--

INSERT INTO `perxpag` (`idperpag`, `idpag`, `idper`) VALUES
(1, 1001, 1),
(2, 2001, 2),
(3, 3001, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idservi` bigint(10) NOT NULL,
  `nit` bigint(10) DEFAULT NULL,
  `detservi` varchar(255) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `tipservi` varchar(255) DEFAULT NULL,
  `idempre` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `idsoli` bigint(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `estasoli` varchar(255) DEFAULT NULL,
  `idvehi` bigint(10) DEFAULT NULL,
  `idusu` bigint(10) DEFAULT NULL,
  `idempre` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `codubi` bigint(10) NOT NULL,
  `nomubi` varchar(255) DEFAULT NULL,
  `depubi` varchar(100) DEFAULT NULL,
  `idusu` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusu` bigint(10) NOT NULL,
  `nomusu` varchar(255) DEFAULT NULL,
  `apeusu` varchar(255) DEFAULT NULL,
  `emailusu` varchar(100) DEFAULT NULL,
  `paswusu` varchar(255) DEFAULT NULL,
  `tipdocusu` varchar(5) DEFAULT NULL,
  `ndocusu` bigint(10) DEFAULT NULL,
  `telusu` bigint(11) DEFAULT NULL,
  `codubi` bigint(10) DEFAULT NULL,
  `idper` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusu`, `nomusu`, `apeusu`, `emailusu`, `paswusu`, `tipdocusu`, `ndocusu`, `telusu`, `codubi`, `idper`) VALUES
(1, 'Juan', 'Sanchez', 'juansanchez131jd@gmail.com', '12345', 'CC', 1011322322, 3227254108, NULL, 1),
(2, 'Jhojan Esteban', 'Cancelado', 'Esteban@gmail.com', '123456', 'CC', 123456789, 3214567899, NULL, 2),
(3, 'Deivi Jesus', 'Ojeda Vivanco ', 'ojedavivanco@gmail.com', '123456789', 'CC', 5558892, 3214569877, NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor`
--

CREATE TABLE `valor` (
  `idval` bigint(10) NOT NULL,
  `iddom` bigint(10) DEFAULT NULL,
  `nomval` varchar(100) DEFAULT NULL,
  `idempre` bigint(10) DEFAULT NULL,
  `idservi` bigint(10) DEFAULT NULL,
  `idvehi` bigint(10) DEFAULT NULL,
  `idusu` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `idvehi` bigint(10) NOT NULL,
  `idusu` bigint(10) DEFAULT NULL,
  `placa` varchar(6) DEFAULT NULL,
  `color` text DEFAULT NULL,
  `marca` text DEFAULT NULL,
  `modelo` int(11) DEFAULT NULL,
  `tipvehi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`idasig`),
  ADD KEY `idemple` (`idemple`),
  ADD KEY `idsoli` (`idsoli`);

--
-- Indices de la tabla `detsoli`
--
ALTER TABLE `detsoli`
  ADD PRIMARY KEY (`iddetsoli`),
  ADD KEY `idsoli` (`idsoli`),
  ADD KEY `idservi` (`idservi`);

--
-- Indices de la tabla `dominio`
--
ALTER TABLE `dominio`
  ADD PRIMARY KEY (`iddom`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idemple`),
  ADD KEY `idempre` (`idempre`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idempre`);

--
-- Indices de la tabla `pagina`
--
ALTER TABLE `pagina`
  ADD PRIMARY KEY (`idpag`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idper`);

--
-- Indices de la tabla `perxpag`
--
ALTER TABLE `perxpag`
  ADD PRIMARY KEY (`idperpag`),
  ADD KEY `idpag` (`idpag`),
  ADD KEY `idper` (`idper`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idservi`),
  ADD KEY `idempre` (`idempre`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`idsoli`),
  ADD KEY `idvehi` (`idvehi`),
  ADD KEY `idusu` (`idusu`),
  ADD KEY `idempre` (`idempre`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`codubi`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusu`),
  ADD KEY `codubi` (`codubi`),
  ADD KEY `idper` (`idper`);

--
-- Indices de la tabla `valor`
--
ALTER TABLE `valor`
  ADD PRIMARY KEY (`idval`),
  ADD KEY `iddom` (`iddom`),
  ADD KEY `idempre` (`idempre`),
  ADD KEY `idservi` (`idservi`),
  ADD KEY `idvehi` (`idvehi`),
  ADD KEY `idusu` (`idusu`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`idvehi`),
  ADD KEY `vehiculo_ibfk_1` (`idusu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  MODIFY `idasig` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detsoli`
--
ALTER TABLE `detsoli`
  MODIFY `iddetsoli` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dominio`
--
ALTER TABLE `dominio`
  MODIFY `iddom` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idemple` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idempre` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pagina`
--
ALTER TABLE `pagina`
  MODIFY `idpag` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3002;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idper` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `perxpag`
--
ALTER TABLE `perxpag`
  MODIFY `idperpag` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idservi` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `idsoli` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `codubi` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusu` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `valor`
--
ALTER TABLE `valor`
  MODIFY `idval` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `idvehi` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD CONSTRAINT `asignacion_ibfk_1` FOREIGN KEY (`idemple`) REFERENCES `empleado` (`idemple`),
  ADD CONSTRAINT `asignacion_ibfk_2` FOREIGN KEY (`idsoli`) REFERENCES `solicitud` (`idsoli`);

--
-- Filtros para la tabla `detsoli`
--
ALTER TABLE `detsoli`
  ADD CONSTRAINT `detsoli_ibfk_1` FOREIGN KEY (`idsoli`) REFERENCES `solicitud` (`idsoli`),
  ADD CONSTRAINT `detsoli_ibfk_2` FOREIGN KEY (`idservi`) REFERENCES `servicios` (`idservi`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`idempre`) REFERENCES `empresa` (`idempre`);

--
-- Filtros para la tabla `perxpag`
--
ALTER TABLE `perxpag`
  ADD CONSTRAINT `perxpag_ibfk_1` FOREIGN KEY (`idpag`) REFERENCES `pagina` (`idpag`),
  ADD CONSTRAINT `perxpag_ibfk_2` FOREIGN KEY (`idper`) REFERENCES `perfil` (`idper`);

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`idempre`) REFERENCES `empresa` (`idempre`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`idvehi`) REFERENCES `vehiculo` (`idvehi`),
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`),
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`idempre`) REFERENCES `empresa` (`idempre`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`codubi`) REFERENCES `ubicacion` (`codubi`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idper`) REFERENCES `perfil` (`idper`);

--
-- Filtros para la tabla `valor`
--
ALTER TABLE `valor`
  ADD CONSTRAINT `valor_ibfk_1` FOREIGN KEY (`iddom`) REFERENCES `dominio` (`iddom`),
  ADD CONSTRAINT `valor_ibfk_2` FOREIGN KEY (`idempre`) REFERENCES `empresa` (`idempre`),
  ADD CONSTRAINT `valor_ibfk_3` FOREIGN KEY (`idservi`) REFERENCES `servicios` (`idservi`),
  ADD CONSTRAINT `valor_ibfk_4` FOREIGN KEY (`idvehi`) REFERENCES `vehiculo` (`idvehi`),
  ADD CONSTRAINT `valor_ibfk_5` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`);

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `vehiculo_ibfk_1` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
