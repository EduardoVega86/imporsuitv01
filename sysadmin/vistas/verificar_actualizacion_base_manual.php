ALTER TABLE `testimonios` ADD `id_producto` INT  NULL AFTER `date_added`;
ALTER TABLE `perfil` ADD `habilitar_proveedor` INT  NULL AFTER `flotante`;
ALTER TABLE `productos` ADD `tienda` VARCHAR(500)  NULL AFTER `valor4_producto`;
ALTER TABLE `productos` ADD `drogshipin` INT  NULL DEFAULT '0' AFTER `tienda`;
ALTER TABLE `productos` ADD `id_producto_origen` INT NULL AFTER `drogshipin`; 