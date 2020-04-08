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

/*
 *
ALTER TABLE `entrega` ADD `receptor` VARCHAR(500) NULL;
ALTER TABLE `entrega` ADD `idEstado` INT NOT NULL DEFAULT '0', ADD INDEX (`idEstado`);
ALTER TABLE `entrega` ADD `idUsuarioValidador` INT NULL, ADD INDEX (`idUsuarioValidador`);

CREATE TABLE `estadoEntrega` ( `idEstado` INT NOT NULL ,  `estado` VARCHAR(100) NOT NULL ,    PRIMARY KEY  (`idEstado`)) ENGINE = InnoDB;
INSERT INTO `estadoEntrega` (`idEstado`, `estado`) VALUES (0, 'En espera'), (1, 'Validada');
ALTER TABLE `entrega` ADD `idCiudad` BIGINT NOT NULL DEFAULT '58035070000' AFTER `idProducto`, ADD INDEX (`idCiudad`);

*TODO ACTUALIZAR CON EL idCiudad del hacedor

update entrega,producto,hacedor set entrega.idCiudad=hacedor.idCiudad
where entrega.idProducto=producto.idProducto and producto.idHacedor=hacedor.idHacedor;

ALTER TABLE `entrega` ADD FOREIGN KEY (`idCiudad`) REFERENCES `ciudad`(`idCiudad`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `entrega` ADD FOREIGN KEY (`idEstado`) REFERENCES `estadoEntrega`(`idEstado`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `entrega` ADD FOREIGN KEY (`idUsuarioValidador`) REFERENCES `usuario`(`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;
 * 


Import Institución
ALTER TABLE `institucion` ADD `idTipologia` INT NOT NULL AFTER `tel`, ADD INDEX (`idTipologia`);
ALTER TABLE `institucion` ADD `idFinanciamiento` INT NOT NULL AFTER `idTipologia`, ADD INDEX (`idFinanciamiento`);
ALTER TABLE `institucion` ADD `siglaTipologia` VARCHAR(10) NOT NULL AFTER `idFinanciamiento`;
ALTER TABLE `institucion` ADD `tipologia` VARCHAR(100) NOT NULL AFTER `siglaTipologia`;
ALTER TABLE `institucion` ADD `idEstablecimiento` BIGINT NULL AFTER `tipologia`;

 * 
 * 
 */

/* agregar id Ciudad en Pedido */

ALTER TABLE `pedido` ADD `idCiudad` BIGINT NOT NULL AFTER `idPedido`, ADD INDEX (`idCiudad`);
UPDATE `pedido`,institucion SET pedido.`idCiudad`=institucion.idCiudad where pedido.idInstitucion=institucion.idInstitucion;
ALTER TABLE `pedido` ADD FOREIGN KEY (`idCiudad`) REFERENCES `ciudad`(`idCiudad`) ON DELETE RESTRICT ON UPDATE RESTRICT;


/*gestor con pedidos*/

ALTER TABLE `producto` ADD `idTipoProducto` INT NOT NULL DEFAULT '1' AFTER `idProducto`, ADD INDEX (`idTipoProducto`);

CREATE TABLE `tipoProducto` ( `idTipoProducto` INT NOT NULL AUTO_INCREMENT ,  `tipo` VARCHAR(50) NOT NULL ,    PRIMARY KEY  (`idTipoProducto`)) ENGINE = InnoDB; 


//insertar hacedores de los usuarios
insert into hacedor(idUsuario,mail,apellidoNombre,idCiudad)
SELECT usuario.idUsuario,nombreUsuario,nombreUsuario,58035070000 FROM `usuario` left outer join hacedor on usuario.idUsuario=hacedor.idUsuario where idHacedor is null