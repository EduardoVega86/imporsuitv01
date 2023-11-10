ALTER TABLE `testimonios` ADD `id_producto` INT NOT NULL AFTER `date_added`;
ALTER TABLE `perfil` ADD `habilitar_proveedor` INT NOT NULL AFTER `flotante`;
ALTER TABLE `productos` ADD `tienda` VARCHAR(500) NOT NULL AFTER `valor4_producto`;
ALTER TABLE `productos` ADD `drogshipin` INT NOT NULL DEFAULT '0' AFTER `tienda`;
ALTER TABLE `productos` ADD `id_producto_origen` INT NULL AFTER `drogshipin`; 