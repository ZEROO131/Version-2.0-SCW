SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `asignacion` (
  `idasig` bigint(10) NOT NULL,
  `idemple` bigint(10) DEFAULT NULL,
  `idsoli` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `detsoli` (
  `iddetsoli` bigint(10) NOT NULL,
  `idsoli` bigint(10) DEFAULT NULL,
  `idservi` bigint(10) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `detsoli` (`iddetsoli`, `idsoli`, `idservi`, `cantidad`) VALUES
(1, 1, 1, 1);

CREATE TABLE `dominio` (
  `iddom` bigint(10) NOT NULL,
  `nomdom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `empleado` (
  `idemple` bigint(10) NOT NULL,
  `nomemple` varchar(255) DEFAULT NULL,
  `tipdocu` varchar(5) DEFAULT NULL,
  `ndocemple` bigint(10) DEFAULT NULL,
  `emaiemple` varchar(100) DEFAULT NULL,
  `codbal` bigint(10) DEFAULT NULL,
  `idempre` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `empleado` (`idemple`, `nomemple`, `tipdocu`, `ndocemple`, `emaiemple`, `codbal`, `idempre`) VALUES
(1, 'Carlos Sánchez', 'CC', 123456789, 'carlos.sanchez@empresa.com', NULL, 1);

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

INSERT INTO `empresa` (`idempre`, `nit`, `razsoci`, `direempre`, `telempre`, `emaiempre`, `replegal`, `tipempre`) VALUES
(1, 8001234567, 'Empresa ABC S.A.S.', 'Calle 123 #45-67, Bogotá', 2035462382, 'contacto@empresaabc.com', 'Juan Pérez', 'S.A.S.');

CREATE TABLE `pagina` (
  `idpag` bigint(10) NOT NULL,
  `titupag` varchar(255) NOT NULL,
  `nompag` varchar(100) DEFAULT NULL,
  `rutpag` varchar(255) NOT NULL,
  `mospag` tinyint(1) NOT NULL,
  `ordpag` int(4) NOT NULL,
  `icopag` varchar(255) NOT NULL,
  `despag` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pagina` (`idpag`, `titupag`, `nompag`, `rutpag`, `mospag`, `ordpag`, `icopag`, `despag`) VALUES
(1001, 'Inicio', 'Inicio', 'views/vusuini.php', 1, 1, 'home-outline', ''),
(1002, 'Datos personales', 'Datos personales', 'views/vusuinf.php', 1, 1, 'id-card', ''),
(2001, '', 'homeemp', 'views/viniemp.php', 1, 1, 'home-outline', ''),
(2002, '', 'vseremp', 'views/vseremp.php', 1, 1, '', ''),
(2003, '', 'vrevehi', 'views/vrevehi.php', 1, 1, '', ''),
(2004, '', 'vassoli', 'views/vassoli.php', 1, 1, '', ''),
(2005, '', 'vhisser', 'views/vhisser.php', 1, 1, '', ''),
(3001, 'Inicio', 'Inicio', 'views/vemple.php', 1, 1, 'hammer-outline', '');

CREATE TABLE `perfil` (
  `idper` bigint(10) NOT NULL,
  `nomper` varchar(255) DEFAULT NULL,
  `pagini` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `perfil` (`idper`, `nomper`, `pagini`) VALUES
(1, 'usuario', 1001),
(2, 'empresa', 2001),
(3, 'empleado', 3001);

CREATE TABLE `perxpag` (
  `idperpag` bigint(10) NOT NULL,
  `idpag` bigint(10) DEFAULT NULL,
  `idper` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `perxpag` (`idperpag`, `idpag`, `idper`) VALUES
(1, 1001, 1),
(2, 2001, 2),
(3, 3001, 3),
(4, 1002, 1),
(5, 2002, 2),
(6, 2003, 2),
(7, 2004, 2),
(8, 2005, 2);

CREATE TABLE `servicios` (
  `idservi` bigint(10) NOT NULL,
  `nit` bigint(10) DEFAULT NULL,
  `detservi` varchar(255) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `tipservi` varchar(255) DEFAULT NULL,
  `idempre` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `servicios` (`idservi`, `nit`, `detservi`, `precio`, `tipservi`, `idempre`) VALUES
(1, 12345, 'Lavado, Secado, Aspirado', 30000, 'Normal', 1);

CREATE TABLE `solicitud` (
  `idsoli` bigint(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `estasoli` varchar(255) DEFAULT NULL,
  `idvehi` bigint(10) DEFAULT NULL,
  `idusu` bigint(10) DEFAULT NULL,
  `idempre` bigint(10) DEFAULT NULL,
  `etasol` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `solicitud` (`idsoli`, `fecha`, `estasoli`, `idvehi`, `idusu`, `idempre`, `etasol`) VALUES
(1, '2024-11-23', '1', 1, 1, 1, 3);

CREATE TABLE `ubicacion` (
  `codubi` bigint(10) NOT NULL,
  `nomubi` varchar(255) DEFAULT NULL,
  `depubi` varchar(100) DEFAULT NULL,
  `idusu` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `idper` bigint(10) DEFAULT NULL,
  `imgusu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuario` (`idusu`, `nomusu`, `apeusu`, `emailusu`, `paswusu`, `tipdocusu`, `ndocusu`, `telusu`, `codubi`, `idper`, `imgusu`) VALUES
(1, 'Juan', 'Sanchez', 'juansanchez131jd@gmail.com', '7519304741a0ee4f24275772d261997179376a4a', 'CC', 1011322322, 3227254108, NULL, 1, ''),
(2, 'Laura', 'alarcon', 'lau@gmail.com', '7519304741a0ee4f24275772d261997179376a4a', 'CC', 123456789, 3214567899, NULL, 2, NULL),
(3, 'Deivi Jesus', 'Ojeda Vivanco ', 'ojedavivanco@gmail.com', '7519304741a0ee4f24275772d261997179376a4a', 'CC', 5558892, 3214569877, NULL, 3, NULL),
(4, 'Juan', 'Pinilla', '2', '7519304741a0ee4f24275772d261997179376a4a', 'CC', 1011, 322, NULL, 2, NULL),
(5, 'Juan', 'David', '3', '7519304741a0ee4f24275772d261997179376a4a', 'CC', 10111, 3222, NULL, 3, NULL);

CREATE TABLE `valor` (
  `idval` bigint(10) NOT NULL,
  `iddom` bigint(10) DEFAULT NULL,
  `nomval` varchar(100) DEFAULT NULL,
  `idempre` bigint(10) DEFAULT NULL,
  `idservi` bigint(10) DEFAULT NULL,
  `idvehi` bigint(10) DEFAULT NULL,
  `idusu` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `vehiculo` (
  `idvehi` bigint(10) NOT NULL,
  `idusu` bigint(10) DEFAULT NULL,
  `placa` varchar(6) DEFAULT NULL,
  `color` text DEFAULT NULL,
  `marca` text DEFAULT NULL,
  `modelvehi` varchar(255) DEFAULT NULL,
  `tipvehi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `vehiculo` (`idvehi`, `idusu`, `placa`, `color`, `marca`, `modelvehi`, `tipvehi`) VALUES
(1, 1, 'BHI993', 'Azul', 'Volkswagen', '1996', 'Carro\r\n'),
(2, NULL, 'JHG 88', 'Blanco', 'AUDI', '2012', 'CARRO');


ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`idasig`),
  ADD KEY `idemple` (`idemple`),
  ADD KEY `idsoli` (`idsoli`);

ALTER TABLE `detsoli`
  ADD PRIMARY KEY (`iddetsoli`),
  ADD KEY `idsoli` (`idsoli`),
  ADD KEY `idservi` (`idservi`);

ALTER TABLE `dominio`
  ADD PRIMARY KEY (`iddom`);

ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idemple`),
  ADD KEY `idempre` (`idempre`);

ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idempre`);

ALTER TABLE `pagina`
  ADD PRIMARY KEY (`idpag`);

ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idper`);

ALTER TABLE `perxpag`
  ADD PRIMARY KEY (`idperpag`),
  ADD KEY `idpag` (`idpag`),
  ADD KEY `idper` (`idper`);

ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idservi`),
  ADD KEY `idempre` (`idempre`);

ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`idsoli`),
  ADD KEY `idvehi` (`idvehi`),
  ADD KEY `idusu` (`idusu`),
  ADD KEY `idempre` (`idempre`);

ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`codubi`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusu`),
  ADD KEY `codubi` (`codubi`),
  ADD KEY `idper` (`idper`);

ALTER TABLE `valor`
  ADD PRIMARY KEY (`idval`),
  ADD KEY `iddom` (`iddom`),
  ADD KEY `idempre` (`idempre`),
  ADD KEY `idservi` (`idservi`),
  ADD KEY `idvehi` (`idvehi`),
  ADD KEY `idusu` (`idusu`);

ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`idvehi`),
  ADD KEY `vehiculo_ibfk_1` (`idusu`);


ALTER TABLE `asignacion`
  MODIFY `idasig` bigint(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `detsoli`
  MODIFY `iddetsoli` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `dominio`
  MODIFY `iddom` bigint(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `empleado`
  MODIFY `idemple` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `empresa`
  MODIFY `idempre` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `pagina`
  MODIFY `idpag` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3002;

ALTER TABLE `perfil`
  MODIFY `idper` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `perxpag`
  MODIFY `idperpag` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `servicios`
  MODIFY `idservi` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `solicitud`
  MODIFY `idsoli` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `ubicacion`
  MODIFY `codubi` bigint(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuario`
  MODIFY `idusu` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

ALTER TABLE `valor`
  MODIFY `idval` bigint(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `vehiculo`
  MODIFY `idvehi` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `asignacion`
  ADD CONSTRAINT `asignacion_ibfk_1` FOREIGN KEY (`idemple`) REFERENCES `empleado` (`idemple`),
  ADD CONSTRAINT `asignacion_ibfk_2` FOREIGN KEY (`idsoli`) REFERENCES `solicitud` (`idsoli`);

ALTER TABLE `detsoli`
  ADD CONSTRAINT `detsoli_ibfk_1` FOREIGN KEY (`idsoli`) REFERENCES `solicitud` (`idsoli`),
  ADD CONSTRAINT `detsoli_ibfk_2` FOREIGN KEY (`idservi`) REFERENCES `servicios` (`idservi`);

ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`idempre`) REFERENCES `empresa` (`idempre`);

ALTER TABLE `perxpag`
  ADD CONSTRAINT `perxpag_ibfk_1` FOREIGN KEY (`idpag`) REFERENCES `pagina` (`idpag`),
  ADD CONSTRAINT `perxpag_ibfk_2` FOREIGN KEY (`idper`) REFERENCES `perfil` (`idper`);

ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`idempre`) REFERENCES `empresa` (`idempre`);

ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`idvehi`) REFERENCES `vehiculo` (`idvehi`),
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`),
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`idempre`) REFERENCES `empresa` (`idempre`);

ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`codubi`) REFERENCES `ubicacion` (`codubi`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idper`) REFERENCES `perfil` (`idper`);

ALTER TABLE `valor`
  ADD CONSTRAINT `valor_ibfk_1` FOREIGN KEY (`iddom`) REFERENCES `dominio` (`iddom`),
  ADD CONSTRAINT `valor_ibfk_2` FOREIGN KEY (`idempre`) REFERENCES `empresa` (`idempre`),
  ADD CONSTRAINT `valor_ibfk_3` FOREIGN KEY (`idservi`) REFERENCES `servicios` (`idservi`),
  ADD CONSTRAINT `valor_ibfk_4` FOREIGN KEY (`idvehi`) REFERENCES `vehiculo` (`idvehi`),
  ADD CONSTRAINT `valor_ibfk_5` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`);

ALTER TABLE `vehiculo`
  ADD CONSTRAINT `vehiculo_ibfk_1` FOREIGN KEY (`idusu`) REFERENCES `usuario` (`idusu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
