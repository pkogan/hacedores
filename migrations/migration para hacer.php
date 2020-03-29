<?php

/* 
ALTER TABLE `institucion` ADD `idCiudad` BIGINT NOT NULL AFTER `logo`, ADD INDEX (`idCiudad`);
ALTER TABLE `pedido` ADD `idInstitucion` INT NOT NULL AFTER `idPedido`, ADD INDEX (`idInstitucion`);
ALTER TABLE `pedido` ADD FOREIGN KEY (`idInstitucion`) REFERENCES `institucion`(`idInstitucion`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `institucion` ADD FOREIGN KEY (`idCiudad`) REFERENCES `ciudad`(`idCiudad`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `entrega` CHANGE `imagen` `observacion` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
ALTER TABLE `entrega` DROP FOREIGN KEY `fk-entrega-institucion`; ALTER TABLE `entrega` ADD CONSTRAINT `fk-entrega-institucion` FOREIGN KEY (`idInstitucion`) REFERENCES `institucion`(`idInstitucion`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `entrega` DROP FOREIGN KEY `fk-entrega-producto`; ALTER TABLE `entrega` ADD CONSTRAINT `fk-entrega-producto` FOREIGN KEY (`idProducto`) REFERENCES `producto`(`idProducto`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `entrega` CHANGE `idInstitucion` `idInstitucion` INT(11) NOT NULL;
ALTER TABLE `entrega` CHANGE `idPedido` `idPedido` INT(11) NOT NULL;

ALTER TABLE `institucion` CHANGE `nombre` `nombre` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

 *  *    */

