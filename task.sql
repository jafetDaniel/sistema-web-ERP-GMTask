-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2022 at 07:03 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `archivos_reporte_servicios`
--

CREATE TABLE `archivos_reporte_servicios` (
  `id_archivo` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `archivos_tareas`
--

CREATE TABLE `archivos_tareas` (
  `id_archivo_tarea` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `id_tarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `colaboradores_proyectos`
--

CREATE TABLE `colaboradores_proyectos` (
  `id_colaborador_proyecto` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `colaboradores_tareas`
--

CREATE TABLE `colaboradores_tareas` (
  `id_colaborador` int(11) NOT NULL,
  `id_tarea` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comentarios_servicios`
--

CREATE TABLE `comentarios_servicios` (
  `id_comentario_servicio` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comentarios_tareas`
--

CREATE TABLE `comentarios_tareas` (
  `id_comentario` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` varchar(255) NOT NULL,
  `id_tarea` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `imagenes_perfil`
--

CREATE TABLE `imagenes_perfil` (
  `id_imagen` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `leido` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `id_tarea` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_usuario_receptor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `proyectos`
--

CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo_creador` varchar(255) NOT NULL,
  `privacidad` varchar(50) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `proyectos_tareas`
--

CREATE TABLE `proyectos_tareas` (
  `id_proyecto_tarea` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `id_tarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reporte_servicios`
--

CREATE TABLE `reporte_servicios` (
  `id_servicio` int(11) NOT NULL,
  `planta` varchar(255) NOT NULL,
  `sc_creation_date` varchar(255) DEFAULT NULL,
  `shopping_cart_no` varchar(255) NOT NULL,
  `shipper_no` varchar(255) DEFAULT NULL,
  `sc_description` varchar(255) DEFAULT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `created_by_name` varchar(255) DEFAULT NULL,
  `po_number` varchar(255) DEFAULT NULL,
  `ir` varchar(255) DEFAULT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `product_type_text` varchar(255) DEFAULT NULL,
  `item_net_value` varchar(255) DEFAULT NULL,
  `document_currency` varchar(255) DEFAULT NULL,
  `cost_center` varchar(255) NOT NULL,
  `tarea` varchar(500) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `secciones_proyecto`
--

CREATE TABLE `secciones_proyecto` (
  `id_seccion` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_entrega` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tareas_seccion`
--

CREATE TABLE `tareas_seccion` (
  `id_tareas_seccion` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `id_tarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archivos_reporte_servicios`
--
ALTER TABLE `archivos_reporte_servicios`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `reporte_servicios_id_servicio_archivos_reporte_servicios` (`id_servicio`);

--
-- Indexes for table `archivos_tareas`
--
ALTER TABLE `archivos_tareas`
  ADD PRIMARY KEY (`id_archivo_tarea`),
  ADD KEY `tareas_id_tarea_archivos_tareas` (`id_tarea`);

--
-- Indexes for table `colaboradores_proyectos`
--
ALTER TABLE `colaboradores_proyectos`
  ADD PRIMARY KEY (`id_colaborador_proyecto`),
  ADD KEY `proyectos_id_proyecto_colaboradores_proyectos` (`id_proyecto`),
  ADD KEY `usuarios_id_usuario_colaboradores_proyectos` (`id_usuario`);

--
-- Indexes for table `colaboradores_tareas`
--
ALTER TABLE `colaboradores_tareas`
  ADD PRIMARY KEY (`id_colaborador`),
  ADD KEY `tareas_id_tarea_colaboradores_tareas` (`id_tarea`),
  ADD KEY `usuarios_id_usuario_colaboradores_tareas` (`id_usuario`);

--
-- Indexes for table `comentarios_servicios`
--
ALTER TABLE `comentarios_servicios`
  ADD PRIMARY KEY (`id_comentario_servicio`),
  ADD KEY `reporte_servicios_id_servicio_comentarios_servicios` (`id_servicio`),
  ADD KEY `usuarios_id_usuario_comentarios_servicios` (`id_usuario`);

--
-- Indexes for table `comentarios_tareas`
--
ALTER TABLE `comentarios_tareas`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `tareas_id_tarea_comentarios_tareas` (`id_tarea`),
  ADD KEY `usuarios_id_usuario_comentarios_tareas` (`id_usuario`);

--
-- Indexes for table `imagenes_perfil`
--
ALTER TABLE `imagenes_perfil`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `usuarios_id_usuario_imagenes_perfil` (`id_usuario`);

--
-- Indexes for table `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `usuarios_id_usuario_notificaciones` (`id_usuario`),
  ADD KEY `usuarios_id_usuario_receptor_notificaciones` (`id_usuario_receptor`);

--
-- Indexes for table `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `usuarios_id_usuario_proyectos` (`id_usuario`);

--
-- Indexes for table `proyectos_tareas`
--
ALTER TABLE `proyectos_tareas`
  ADD PRIMARY KEY (`id_proyecto_tarea`),
  ADD KEY `proyectos_id_proyecto_proyectos_tareas` (`id_proyecto`),
  ADD KEY `tareas_id_tarea_proyectos_tareas` (`id_tarea`);

--
-- Indexes for table `reporte_servicios`
--
ALTER TABLE `reporte_servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indexes for table `secciones_proyecto`
--
ALTER TABLE `secciones_proyecto`
  ADD PRIMARY KEY (`id_seccion`),
  ADD KEY `usuarios_id_proyecto_secciones_proyecto` (`id_proyecto`);

--
-- Indexes for table `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `usuarios_id_usuario_tareas` (`id_usuario`);

--
-- Indexes for table `tareas_seccion`
--
ALTER TABLE `tareas_seccion`
  ADD PRIMARY KEY (`id_tareas_seccion`),
  ADD KEY `secciones_proyecto_id_seccion_tareas_seccion` (`id_seccion`),
  ADD KEY `tareas_id_tarea_tareas_seccion` (`id_tarea`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archivos_reporte_servicios`
--
ALTER TABLE `archivos_reporte_servicios`
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archivos_tareas`
--
ALTER TABLE `archivos_tareas`
  MODIFY `id_archivo_tarea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colaboradores_proyectos`
--
ALTER TABLE `colaboradores_proyectos`
  MODIFY `id_colaborador_proyecto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colaboradores_tareas`
--
ALTER TABLE `colaboradores_tareas`
  MODIFY `id_colaborador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comentarios_servicios`
--
ALTER TABLE `comentarios_servicios`
  MODIFY `id_comentario_servicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comentarios_tareas`
--
ALTER TABLE `comentarios_tareas`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imagenes_perfil`
--
ALTER TABLE `imagenes_perfil`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proyectos_tareas`
--
ALTER TABLE `proyectos_tareas`
  MODIFY `id_proyecto_tarea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reporte_servicios`
--
ALTER TABLE `reporte_servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secciones_proyecto`
--
ALTER TABLE `secciones_proyecto`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tareas_seccion`
--
ALTER TABLE `tareas_seccion`
  MODIFY `id_tareas_seccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archivos_reporte_servicios`
--
ALTER TABLE `archivos_reporte_servicios`
  ADD CONSTRAINT `reporte_servicios_id_servicio_archivos_reporte_servicios` FOREIGN KEY (`id_servicio`) REFERENCES `reporte_servicios` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `archivos_tareas`
--
ALTER TABLE `archivos_tareas`
  ADD CONSTRAINT `tareas_id_tarea_archivos_tareas` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id_tarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `colaboradores_proyectos`
--
ALTER TABLE `colaboradores_proyectos`
  ADD CONSTRAINT `proyectos_id_proyecto_colaboradores_proyectos` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_id_usuario_colaboradores_proyectos` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `colaboradores_tareas`
--
ALTER TABLE `colaboradores_tareas`
  ADD CONSTRAINT `tareas_id_tarea_colaboradores_tareas` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id_tarea`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_id_usuario_colaboradores_tareas` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comentarios_servicios`
--
ALTER TABLE `comentarios_servicios`
  ADD CONSTRAINT `reporte_servicios_id_servicio_comentarios_servicios` FOREIGN KEY (`id_servicio`) REFERENCES `reporte_servicios` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_id_usuario_comentarios_servicios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Constraints for table `comentarios_tareas`
--
ALTER TABLE `comentarios_tareas`
  ADD CONSTRAINT `tareas_id_tarea_comentarios_tareas` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id_tarea`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_id_usuario_comentarios_tareas` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `imagenes_perfil`
--
ALTER TABLE `imagenes_perfil`
  ADD CONSTRAINT `usuarios_id_usuario_imagenes_perfil` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `usuarios_id_usuario_notificaciones` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_id_usuario_receptor_notificaciones` FOREIGN KEY (`id_usuario_receptor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `usuarios_id_usuario_proyectos` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `proyectos_tareas`
--
ALTER TABLE `proyectos_tareas`
  ADD CONSTRAINT `proyectos_id_proyecto_proyectos_tareas` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tareas_id_tarea_proyectos_tareas` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id_tarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `secciones_proyecto`
--
ALTER TABLE `secciones_proyecto`
  ADD CONSTRAINT `usuarios_id_proyecto_secciones_proyecto` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `usuarios_id_usuario_tareas` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tareas_seccion`
--
ALTER TABLE `tareas_seccion`
  ADD CONSTRAINT `secciones_proyecto_id_seccion_tareas_seccion` FOREIGN KEY (`id_seccion`) REFERENCES `secciones_proyecto` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tareas_id_tarea_tareas_seccion` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id_tarea`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
