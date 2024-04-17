<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
//echo 'funciona';
include 'sysadmin/vistas/db.php';
include 'sysadmin/vistas/php_conexion.php';


$tildes = $conexion->query("SET NAMES 'utf8'"); //Para que se inserten las tildes correctamente

mysqli_query($conexion, "ALTER TABLE `testimonios` ADD `id_producto` INT  NULL AFTER `date_added`;");
mysqli_query($conexion, "ALTER TABLE `perfil` ADD `habilitar_proveedor` INT  NULL AFTER `flotante`;");
mysqli_query($conexion, "ALTER TABLE `productos` ADD `tienda` VARCHAR(500)  NULL AFTER `valor4_producto`;");
mysqli_query($conexion, "ALTER TABLE `productos` ADD `drogshipin` INT  NULL DEFAULT '0' AFTER `tienda`;");
mysqli_query($conexion, "ALTER TABLE `productos` ADD `id_producto_origen` INT NULL AFTER `drogshipin`; ");
mysqli_query($conexion, "ALTER TABLE `provincia_laar` CHANGE `id_prov` `id_prov` SERIAL NOT NULL; ");
mysqli_query($conexion, "ALTER TABLE `provincia_laar` ADD `codigo_provincia` VARCHAR(500)  NULL AFTER `provincia`; ");
mysqli_query($conexion, "ALTER TABLE `provincia_laar` ADD `codigo_laar` VARCHAR(500)  NULL AFTER `provincia`;");
mysqli_query($conexion, "CREATE TABLE `ciudad_laar`(
  `id_ciudad` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50)  NULL,
  `nombre` varchar(150) NULL,
  `trayecto` varchar(10)  NULL,
  `provincia` varchar(100)  NULL,
  `codigoProvincia` varchar(100) NULL,
  `codigor` varchar(100) NULL,
  UNIQUE KEY `id_ciudad` (`id_ciudad`)
) ENGINE=InnoDB AUTO_INCREMENT=413 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;");

mysqli_query($conexion, "DELETE FROM `ciudad_laar`");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (20100101901, 'AMBATO', 'TP', 'TUNGURAHUA', '201001019', 16);");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (20100101902, 'BAÑOS DE AGUA SANTA', 'TE', 'TUNGURAHUA', '201001019', 16);");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001001, 'QUITO', 'TP', 'PICHINCHA', '201001001', 1);");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001002, 'CAYAMBE', 'TP', 'PICHINCHA', '201001001', 22);");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001003, 'TABACUNDO', 'TE', 'PICHINCHA', '201001001', 22); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001004, 'SANTO DOMINGO', 'TP', 'SANTO DOMINGO DE LOS TSACHILAS', '201001024', 45); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001005, 'SANGOLQUI', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001006, 'SAN RAFAEL', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001007, 'EL QUINCHE', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001008, 'MACHACHI', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001009, 'CUMBAYA', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001010, 'SAN MIGUEL DE LOS BANCOS', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001011, 'LA CONCORDIA', 'TS', 'SANTO DOMINGO DE LOS TSACHILAS', '201001024', 56); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001012, 'PEDRO V. MALDONADO', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001013, 'PUERTO QUITO', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001014, 'GUAYLLABAMBA', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001018, 'AMAGUAÑA', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001019, 'ALOAG', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001020, 'TUMBACO', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001021, 'MITAD DEL MUNDO', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001022, 'CALACALI', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001024, 'CALDERON', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001025, 'PIFO', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001026, 'PUEMBO', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001027, 'SAN ANTONIO IBARRA', 'TS', 'IMBABURA', '201001011', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001028, 'POMASQUI', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001029, 'NANEGALITO', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001030, 'MARCELINO MARIDUEÑA', 'TE', 'GUAYAS', '201001002', 57);  ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001031, 'ALANGASI', 'TS', 'PICHINCHA', '201001001', 1);  ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001032, '24 DE MAYO', 'TE', 'MANABI', '201001014', 40);  ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001033, 'CONOCOTO', 'TS', 'PICHINCHA', '201001001', 1);  ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001035, 'PEDRO MONCAYO', 'TE', 'PICHINCHA', '201001001', 22);  ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001036, 'PINTAG', 'TS', 'PICHINCHA', '201001001', 1);  ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001037, 'YARUQUI', 'TS', 'PICHINCHA', '201001001', 1);  ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001039, 'VALLE DE LOS CHILLOS', 'TS', 'PICHINCHA', '201001001', 1);  ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001040, 'VALLE HERMOSO', 'TE', 'SANTO DOMINGO DE LOS TSACHILAS', '201001024', 56);  ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001041, 'PUSUQUI', 'TS', 'PICHINCHA', '201001001', 1);  ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001042, 'AYORA', 'TE', 'PICHINCHA', '201001001', 22);  ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001043, 'AZCASUBI VIA AL QUINCHE', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001045, 'JUAN MONTALVO', 'TE', 'PICHINCHA', '201001001', 22); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001046, 'ALOASI', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001047, 'LA ARMENIA', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001048, 'LLANO CHICO', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001049, 'LLANO GRANDE', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001051, 'MIRAVALLE', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001052, 'ORQUIDEAS', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001053, 'SAN ANTONIO DE PICHINCHA', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001054, 'SAN JOSE DE MORAN', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001056, 'TABABELA', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001057, 'UYUMBICHO', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001058, 'ZAMBISA', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001059, 'MONTERREY', 'TE', 'SANTO DOMINGO DE LOS TSACHILAS', '201001024', 56); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001060, 'LAS VILLEGAS', 'TE', 'SANTO DOMINGO DE LOS TSACHILAS', '201001024', 56); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001061, 'CUZUBAMBA', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001062, 'ASCAZUBI', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001063, 'CHECA', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001064, 'Zambiza', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001065, 'Rumipamba', 'TP', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001066, 'RumiÃ±ahui', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001067, 'OtÃ³n', 'TE', 'PICHINCHA', '201001001', 22); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001068, 'Nono', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001069, 'Mejía', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001070, 'Guangopolo', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001001071, 'El Chaupi', 'TE', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002001, 'GUAYAQUIL', 'TP', 'GUAYAS', '201001002', 11); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002002, 'DURAN', 'TS', 'GUAYAS', '201001002', 11); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002003, 'MILAGRO', 'TS', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002004, 'SALINAS', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002005, 'PLAYAS', 'TE', 'GUAYAS', '201001002', 70); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002006, 'YAGUACHI', 'TE', 'GUAYAS', '201001002', 11); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002007, 'EL TRIUNFO', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002009, 'DAULE', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002010, 'SANTA ELENA', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002011, 'EL EMPALME', 'TE', 'LOS RIOS', '201001013', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002013, 'LA LIBERTAD', 'TP', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002014, 'BALAO', 'TE', 'GUAYAS', '201001002', 65); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002015, 'NARANJAL', 'TE', 'GUAYAS', '201001002', 65); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002016, 'BALZAR', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002017, 'TENGUEL', 'TE', 'GUAYAS', '201001002', 65); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002018, 'JUJAN', 'TE', 'GUAYAS', '201001002', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002019, 'SAMBORONDON', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002020, 'PASCUALES', 'TE', 'GUAYAS', '201001002', 11); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002021, 'NOBOL', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002022, 'PALESTINA', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002023, 'SANTA LUCIA', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002024, 'LOMAS DE SARGENTILLO', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002025, 'ISIDRO AYORA', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002027, 'CERECITA', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002028, 'PUERTO INCA', 'TE', 'GUAYAS', '201001002', 65); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002029, 'COLIMES', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002030, 'LAUREL', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002031, 'SALITRE', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002032, 'CHONGON', 'TE', 'GUAYAS', '201001002', 70); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002033, 'NARANJITO', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002034, 'ANCON', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002035, 'POSORJA', 'TE', 'GUAYAS', '201001002', 70); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002036, 'PALENQUE', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002037, 'BUCAY', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002038, 'SIMON BOLIVAR', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002039, 'Km 26 via Duran Tambo', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002040, 'PEDRO CARBO', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002041, 'JULIO ANDRADE', 'TE', 'CARCHI', '201001006', 47); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002042, 'PROGRESO', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002043, 'MONJAS', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002046, 'ANCONCITO', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002048, 'BASE TAURA', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002049, 'EL DESEO', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002050, 'LORENZO DE GARAICOA', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002051, 'MARISCAL SUCRE', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002052, 'ROBERTO ASTUDILLO', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002053, 'MANUEL J. CALLE', 'TS', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002054, 'CHIVERIA', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002055, 'COLORADAL', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002056, 'GENERAL VERNAZA', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002057, 'LA MARAVILLA', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002058, 'LAS ANIMAS', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002059, 'LOS TINTOS', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002060, 'PETRILLO', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002061, 'PUENTE LUCIA', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002062, 'SABANILLA', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002063, 'TARIFA', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002064, 'MATILDE ESTHER', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002065, 'BOCA DE CAÑA', 'TE', 'GUAYAS', '201001002', 11); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002066, 'SAMBORONDON (Pueblo)', 'TE', 'GUAYAS', '201001002', 11); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002067, 'BOLICHE', 'TE', 'GUAYAS', '201001002', 11); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002068, 'Virgen De FÃ¡tima Km 26', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002069, 'Velasco Ibarra (El Empalme)', 'TE', 'GUAYAS', '201001002', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002070, 'San Antonio (Playas)', 'TE', 'GUAYAS', '201001002', 70); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002071, 'limonal', 'TE', 'GUAYAS', '201001002', 66); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002072, 'La Puntilla', 'TE', 'GUAYAS', '201001002', 11); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002073, 'Km 26 Virgen De FÃ¡tima', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002074, 'Ingenio San Carlos', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002075, 'General Villamil (Playas)', 'TE', 'GUAYAS', '201001002', 70); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002076, 'Eloy Alfaro DurÃ¡n', 'TE', 'GUAYAS', '201001002', 11); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002077, 'Data De Playas', 'TE', 'GUAYAS', '201001002', 70); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001002078, 'Cumanda Milagro', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003002, 'GIRON', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003003, 'GUALACEO', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003004, 'PAUTE', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003005, 'SANTA ISABEL', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003006, 'CHORDELEG', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003007, 'SIG SIG', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003008, 'PATATE', 'TE', 'TUNGURAHUA', '201001019', 16); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003009, 'EL TAMBO', 'TE', 'CAÑAR', '201001005', 18); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003011, 'CUENCA', 'TP', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003016, 'CHAULLABAMBA', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003017, 'CUMBE', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003018, 'YUNGUILLA', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003019, 'ZONA FRANCA', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003020, 'RICAURTE CUENCA', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003021, 'Llacao', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003022, 'Nulti', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003023, 'Paccha', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003024, 'San Fernando', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003025, 'San Joaquín', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003026, 'Sidcay', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003027, 'SimÃ³n Bolívar (Cab. en GaÃ±anzol)', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003028, 'Sinincay', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003029, 'Tomebamba', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003030, 'Turi', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003031, 'Victoria del Portete (Irquis)', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003032, 'Zhaglli (Shaglli)', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003033, 'Tarqui Cuenca', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003034, 'San Juan Cuenca', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003035, 'BaÃ±os Cuenca', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003036, 'Checa (Jidcay)', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003037, 'Chiquintad', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003038, 'Sosudel', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003039, 'Firma', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001003040, 'Sayausi', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001004001, 'GUARANDA', 'TP', 'BOLIVAR', '201001004', 29); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001004002, 'ECHEANDIA', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001004003, 'SAN JOSE DE CHIMBO', 'TE', 'BOLIVAR', '201001004', 29); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001004006, 'SAN MIGUEL DE BOLIVAR', 'TE', 'BOLIVAR', '201001004', 29); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001004007, 'CALUMA', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001004008, 'CHAMBO', 'TE', 'CHIMBORAZO', '201001008', 44); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001004011, 'SALINAS DE GUARANDA', 'TE', 'BOLIVAR', '201001004', 29); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001005001, 'AZOGUES', 'TP', 'CAÑAR', '201001005', 18); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001005002, 'LA TRONCAL', 'TE', 'CAÑAR', '201001005', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001005003, 'CAÑAR', 'TP', 'CAÑAR', '201001005', 18); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001005004, 'BIBLIAN', 'TS', 'CAÑAR', '201001005', 18); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001005007, 'COJITAMBO', 'TE', 'CAÑAR', '201001005', 18); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001006001, 'TULCAN', 'TP', 'CARCHI', '201001006', 47); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001006002, 'MIRA', 'TE', 'CARCHI', '201001006', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001006003, 'EL ANGEL', 'TE', 'CARCHI', '201001006', 47); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001006004, 'SAN GABRIEL', 'TE', 'CARCHI', '201001006', 47); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001006005, 'HUACA', 'TE', 'CARCHI', '201001006', 47); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001006006, 'BOLIVAR', 'TE', 'CARCHI', '201001006', 47); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007001, 'LATACUNGA', 'TP', 'COTOPAXI', '201001007', 32); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007002, 'SALCEDO', 'TS', 'COTOPAXI', '201001007', 32); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007003, 'SAQUISILI', 'TE', 'COTOPAXI', '201001007', 32); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007004, 'PUJILI', 'TE', 'COTOPAXI', '201001007', 32); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007005, 'LA MANA', 'TE', 'LOS RIOS', '201001013', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007007, 'LASSO', 'TS', 'COTOPAXI', '201001007', 32); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007008, 'PASTOCALLE', 'TE', 'COTOPAXI', '201001007', 32); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007009, 'GUAYTACAMA', 'TE', 'COTOPAXI', '201001007', 32); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007010, 'MULALO', 'TE', 'COTOPAXI', '201001007', 32); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007011, 'TANICUCHI', 'TE', 'COTOPAXI', '201001007', 32); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007012, 'BELISARIO QUEVEDO', 'TE', 'COTOPAXI', '201001007', 32); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007013, 'SAN BUENAVENTURA BELLAVISTA. ', 'TE', 'COTOPAXI', '201001007', 32); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007014, 'Tanicuchchi', 'TE', 'COTOPAXI', '201001007', 32); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001007015, 'Mulalao', 'TE', 'COTOPAXI', '201001007', 32); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001008001, 'RIOBAMBA', 'TP', 'CHIMBORAZO', '201001008', 44); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001008002, 'ALAUSI', 'TE', 'CHIMBORAZO', '201001008', 44); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001008003, 'CHUNCHI', 'TE', 'CH1008', 44); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001008004, 'GUANO', 'TE', 'CHIMBORAZO', '201001008', 44); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001008005, 'CAJABAMBA', 'TE', 'CHIMBORAZO', '201001008', 44); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001008007, 'GUAMOTE', 'TE', 'CHIMBORAZO', '201001008', 44); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001008008, 'COLTA', 'TE', 'CHIMBORAZO', '201001008', 44); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001008010, 'LICAN', 'TE', 'CHIMBORAZO', '201001008', 44); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001008011, 'YARUQUIES', 'TE', 'CHIMBORAZO', '201001008', 44); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001008012, 'Cumanda Chimborazo', 'TE', 'CHIMBORAZO', '201001008', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009001, 'MACHALA', 'TP', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009002, 'PASAJE', 'TE', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009003, 'PORTOVELO', 'TE', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009004, 'PIÑAS', 'TE', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009005, 'ZARUMA', 'TE', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009006, 'ARENILLAS', 'TE', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009007, 'HUAQUILLAS', 'TE', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009008, 'EL GUABO', 'TE', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009009, 'SANTA ROSA', 'TE', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009010, 'PUERTO BOLIVAR', 'TE', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009011, 'EL CAMBIO', 'TE', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009013, 'PONCE ENRIQUEZ', 'TE', 'AZUAY', '201001003', 65); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009017, 'La PeaÃ±a', 'TE', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009018, 'Loma De Franco', 'TE', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001009019, 'La Avanzada', 'TE', 'EL ORO', '201001009', 36); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001010001, 'ESMERALDAS', 'TP', 'ESMERALDAS', '201001010', 26); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001010003, 'ATACAMES', 'TS', 'ESMERALDAS', '201001010', 26);");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001010004, 'TONSUPA', 'TE', 'ESMERALDAS', '201001010', 26); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001010008, 'QUININDE', 'TP', 'ESMERALDAS', '201001010', 43); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001010009, 'PEDERNALES', 'TE', 'MANABI', '201001014', 39); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001010010, 'CUMANDA', 'TE', 'GUAYAS', '201001002', 57); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001010011, 'LA UNION', 'TE', 'ESMERALDAS', '201001010', 56); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001010013, 'VICHE', 'TE', 'ESMERALDAS', '201001010', 43); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001010016, 'TACHINA', 'TE', 'ESMERALDAS', '201001010', 26); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011001, 'ATUNTAQUI', 'TP', 'IMBABURA', '201001011', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011002, 'OTAVALO', 'TP', 'IMBABURA', '201001011', 38); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011003, 'PIMAMPIRO', 'TE', 'IMBABURA', '201001011', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011004, 'URCUQUI', 'TE', 'IMBABURA', '201001011', 30); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011005, 'IBARRA', 'TP', 'IMBABURA', '201001011', 30); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011006, 'COTACACHI', 'TE', 'IMBABURA', '201001011', 38); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011007, 'SAN PEDRO', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011009, 'ISLA BEJUCAL', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011010, 'SAN PABLO IMBABURA', 'TE', 'IMBABURA', '201001011', 38); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011011, 'SAN ROQUE', 'TE', 'IMBABURA', '201001011', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011012, 'GONZALEZ SUAREZ', 'TE', 'IMBABURA', '201001011', 38); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011013, 'PEGUCHE', 'TE', 'IMBABURA', '201001011', 38); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011014, 'QUIROGA', 'TE', 'IMBABURA', '201001011', 38); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011018, 'CARANQUI', 'TE', 'IMBABURA', '201001011', 30); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011019, 'YAGUARCOCHA', 'TS', 'IMBABURA', '201001011', 30); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011020, 'CHORLAVI', 'TS', 'IMBABURA', '201001011', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011021, 'ANDRADE MARIN', 'TS', 'IMBABURA', '201001011', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011022, 'ANTONIO ANTE', 'TS', 'IMBABURA', '201001011', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011023, 'CHALTURA', 'TS', 'IMBABURA', '201001011', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011025, 'NATABUELA', 'TS', 'IMBABURA', '201001011', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011026, 'SAN JOSE', 'TS', 'IMBABURA', '201001011', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011027, 'SAN LUIS', 'TS', 'IMBABURA', '201001011', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011028, 'SANTA BERTHA', 'TS', 'IMBABURA', '201001011', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011029, 'TIERRA BLANCA', 'TS', 'IMBABURA', '201001011', 67); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011030, 'PERUGACHI', 'TE', 'IMBABURA', '201001011', 38); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011031, 'San Miguel de Ibarra', 'TE', 'IMBABURA', '201001011', 30); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001011032, 'Quiroga Otavalo', 'TE', 'IMBABURA', '201001011', 38); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012001, 'LOJA', 'TP', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012002, 'CATAMAYO', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012003, 'CATARAMA', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012004, 'CARIAMANGA', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012005, 'CATACOCHA', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012006, 'MALACATOS', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012007, 'VILCABAMBA', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012009, 'SARAGURO', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012010, 'GONZANAMA', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012011, 'CELICA', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012013, 'San Pedro de Vilcabamba', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012014, 'San Pedro de La Bendita', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012015, 'San Lucas', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012016, 'Paltas', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001012017, 'Calvas', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013001, 'BABAHOYO', 'TP', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013002, 'QUEVEDO', 'TP', 'LOS RIOS', '201001013', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013003, 'VENTANAS', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013004, 'VALENCIA', 'TE', 'LOS RIOS', '201001013', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013005, 'BUENA FE', 'TE', 'LOS RIOS', '201001013', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013006, 'VINCES', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013007, 'MOCACHE', 'TE', 'LOS RIOS', '201001013', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013008, 'SAN JUAN', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013009, 'MONTALVO', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013010, 'PATRICIA PILAR', 'TS', 'LOS RIOS', '201001013', 45); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013012, 'PUEBLO VIEJO', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013013, 'BABA', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013014, 'SAN CAMILO', 'TE', 'LOS RIOS', '201001013', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013015, 'SAN CARLOS', 'TE', 'LOS RIOS', '201001013', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013016, 'RICAURTE LOS RIOS', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013019, 'QUINSALOMA', 'TE', 'LOS RIOS', '201001013', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013020, 'TRES POSTES', 'TE', 'GUAYAS', '201001002', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013021, 'ISLA DE BEJUCAL', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013022, 'San Juan Babahoyo', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013023, 'San Jacinto de Buena Fe', 'TE', 'LOS RIOS', '201001013', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013024, 'La UniÃ³n (Valencia)', 'TE', 'LOS RIOS', '201001013', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013025, 'La Julia', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013026, 'La Esperanza', 'TE', 'LOS RIOS', '201001013', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001013027, 'Guare', 'TE', 'LOS RIOS', '201001013', 19); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014001, 'MANTA', 'TP', 'MANABI', '201001014', 37); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014002, 'PORTOVIEJO', 'TP', 'MANABI', '201001014', 40); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014003, 'BAHIA DE CARAQUEZ', 'TP', 'MANABI', '201001014', 20); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014004, 'CHONE', 'TS', 'MANABI', '201001014', 23); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014005, 'EL CARMEN', 'TP', 'MANABI', '201001014', 24); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014006, 'JIPIJAPA', 'TP', 'MANABI', '201001014', 60); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014007, 'PICHINCHA MANABI', 'TE', 'MANABI', '201001014', 42); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014008, 'SANTA ANA', 'TE', 'MANABI', '201001014', 40); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014009, 'JUNIN', 'TE', 'MANABI', '201001014', 23); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014010, 'CRUCITA', 'TE', 'MANABI', '201001014', 40); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014011, 'COLON', 'TE', 'MANABI', '201001014', 40); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014012, 'ROCAFUERTE', 'TE', 'MANABI', '201001014', 40); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014013, 'JARAMIJO', 'TE', 'MANABI', '201001014', 37); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014014, 'PAJAN', 'TE', 'MANABI', '201001014', 60); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014015, 'CHARAPOTO', 'TE', 'MANABI', '201001014', 40); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014016, 'CALCETA', 'TE', 'MANABI', '201001014', 23); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014017, 'TOSAGUA', 'TE', 'MANABI', '201001014', 23); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014018, 'SAN VICENTE', 'TE', 'MANABI', '201001014', 20); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014019, 'OLMEDO', 'TE', 'MANABI', '201001014', 40); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014020, 'MONTECRISTI', 'TE', 'MANABI', '201001014', 37); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014021, 'FLAVIO ALFARO', 'TE', 'MANABI', '201001014', 23); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014022, 'PUERTO LOPEZ', 'TE', 'MANABI', '201001014', 60); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014023, 'BALLENITA', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014024, 'JAMA', 'TE', 'MANABI', '201001014', 20); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014025, 'SAN JACINTO', 'TE', 'MANABI', '201001014', 11); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014026, 'TARQUI', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014027, 'LEONIDAS PLAZA', 'TE', 'MANABI', '201001014', 20); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014029, 'PUERTO CAYO', 'TE', 'MANABI', '201001014', 60); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014031, 'CALDERON DE PORTOVIEJO', 'TE', 'MANABI', '201001014', 40); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014032, 'CANUTO', 'TE', 'MANABI', '201001014', 23); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014033, 'ESTANCILLA', 'TE', 'MANABI', '201001014', 23); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014034, 'SAN ANTONIO DE CHONE', 'TE', 'MANABI', '201001014', 23); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014035, 'LA DELICIA KM. 29', 'TE', 'MANABI', '201001014', 24); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014036, 'ALAHUELA', 'TE', 'MANABI', '201001014', 40); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014037, 'PICOAZA (DENTRO DEL PERIMETRO URBANO)', 'TE', 'MANABI', '201001014', 40); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014038, 'SAN PLACIDO (DENTRO DEL PERIMETRO URBANO)', 'TE', 'MANABI', '201001014', 40); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014039, 'RIO CHICO (DENTRO DEL PERIMETRO URBANO)', 'TE', 'MANABI', '201001014', 40); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014040, 'RICAURTE MANABI', 'TE', 'MANABI', '201001014', 23); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014041, 'Tarqui Manabi', 'TE', 'MANABI', '201001014', 37); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014042, 'Sucre', 'TE', 'MANABI', '201001014', 20); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014043, 'Quiroga Chone', 'TE', 'MANABI', '201001014', 23); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001014044, 'colorado', 'TE', 'MANABI', '201001014', 37); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001015001, 'MACAS', 'TO', 'MORONA SANTIAGO', '201001015', 35); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001015002, 'GUALAQUIZA', 'TO', 'MORONA SANTIAGO', '201001015', 48); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001015003, 'YANTZAZA', 'TO', 'ZAMORA CHINCHIPE', '201001021', 48); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001016001, 'TENA', 'TO', 'NAPO', '201001016', 46); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001016002, 'OÑA', 'TE', 'AZUAY', '201001003', 15); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001016003, 'ARCHIDONA', 'TO', 'NAPO', '201001016', 46); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001016004, 'PTO. NAPO', 'TO', 'NAPO', '201001016', 46); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001016005, 'MISAHUALLI', 'TO', 'NAPO', '201001016', 46); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001016006, 'AROSEMENA TOLA', 'TO', 'NAPO', '201001016', 46); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001016007, 'Puerto Napo', 'TO', 'NAPO', '201001016', 46); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001016008, 'Carlos Julio Arosemena Tola', 'TO', 'NAPO', '201001016', 46); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001016009, 'Carlos Julio Arosemena', 'TO', 'NAPO', '201001016', 46); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001017001, 'FRANCISCO DE ORELLANA', 'TO', 'ORELLANA', '201001017', 25); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001017002, 'EL COCA', 'TO', 'ORELLANA', '201001017', 25); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001017003, 'LAGO AGRIO', 'TO', 'SUCUMBIOS', '201001022', 31); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001017004, 'SHELL', 'TO', 'PASTAZA', '201001018', 41); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001017006, 'LA JOYA DE LOS SACHAS', 'TO', 'ORELLANA', '201001017', 25); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001017007, 'SUCUA', 'TO', 'MORONA SANTIAGO', '201001015', 35); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001017009, 'NUEVO ISRAEL', 'TE', 'MANABI', '201001014', 24); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001017012, 'EL CHACO', 'TP', 'NAPO', '201001016', 71);");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001017016, 'LORETO', 'TO', 'ORELLANA', '201001017', 25); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001018001, 'PUYO', 'TO', 'PASTAZA', '201001018', 41);");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001019003, 'MACARA', 'TE', 'LOJA', '201001012', 34); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001019004, 'PELILEO', 'TE', 'TUNGURAHUA', '201001019', 16); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001019005, 'CEVALLOS', 'TE', 'TUNGURAHUA', '201001019', 16); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001019006, 'PILLARO', 'TE', 'TUNGURAHUA', '201001019', 16); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001019007, 'MOCHA', 'TE', 'TUNGURAHUA', '201001019', 16); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001019008, 'QUERO', 'TE', 'TUNGURAHUA', '201001019', 16); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001019009, 'TISALEO', 'TE', 'TUNGURAHUA', '201001019', 16); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001019011, 'HUAMBALO', 'TE', 'TUNGURAHUA', '201001019', 16); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001019012, 'Ulba', 'TE', 'TUNGURAHUA', '201001019', 16); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001019013, 'San Pedro De Pelileo', 'TE', 'TUNGURAHUA', '201001019', 16); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001019014, 'Betínez (Pachanlica)', 'TE', 'TUNGURAHUA', '201001019', 16); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001020001, 'PUERTO BAQUERIZO MORENO', 'TG', 'GALAPAGOS', '201001020', 27); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001020002, 'SANTA CRUZ', 'TG', 'GALAPAGOS', '201001020', 28); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001020003, 'SAN CRISTOBAL', 'TG', 'GALAPAGOS', '201001020', 27); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001021001, 'ZAMORA', 'TO', 'ZAMORA CHINCHIPE', '201001021', 48); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001021003, 'TAMBILLO', 'TS', 'PICHINCHA', '201001001', 1); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001021005, 'PANGUI', 'TO', 'ZAMORA CHINCHIPE', '201001021', 48); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001021006, 'CENTINELA DEL CONDOR', 'TO', 'ZAMORA CHINCHIPE', '201001021', 48); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001022001, 'NUEVA LOJA', 'TO', 'SUCUMBIOS', '201001022', 31); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001022002, 'SHUSHUFINDI', 'TO', 'SUCUMBIOS', '201001022', 31); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023001, 'PUNTA CARNERO', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023002, 'PUNTA BLANCA', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023003, 'MONTAÑITA', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023004, 'MAR BRAVO', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023005, 'MUEY', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023006, 'OLON', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023007, 'PUERTO SANTA ROSA', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023008, 'CADEATE', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023009, 'CAPAES', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023010, 'LIBERTADOR BOLIVAR', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023011, 'MANGLARALTO', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023012, 'MONTEVERDE', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023013, 'PALMAR', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023014, 'PROSPERIDAD', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023015, 'PUNTA BARANDUA', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023016, 'VALDIVIA', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023017, 'SAN PABLO SANTA ELENA', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023018, 'AYANGUE', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023019, 'Punta Centinela', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023020, 'El Tambo Santa Elena', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001023021, 'SANTA ROSA SANTA ELENA', 'TE', 'SANTA ELENA', '201001023', 33); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001024004, 'KM 14 QUEVEDO', 'TS', 'SANTO DOMINGO DE LOS TSACHILAS', '201001024', 45); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001024005, 'KM 24 QUEVEDO', 'TS', 'SANTO DOMINGO DE LOS TSACHILAS', '201001024', 45); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001024006, 'KM 38.5 QUEVEDO', 'TS', 'SANTO DOMINGO DE LOS TSACHILAS', '201001024', 45); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001024007, 'KM 41 QUEVEDO', 'TS', 'SANTO DOMINGO DE LOS TSACHILAS', '201001024', 45); ");
mysqli_query($conexion, "INSERT INTO ciudad_laar (codigo, nombre, trayecto, provincia, codigoProvincia, codigor) VALUES (201001024008, 'LUZ DE AMERICA', 'TS', 'SANTO DOMINGO DE LOS TSACHILAS', '201001024', 45); ");
mysqli_query($conexion, "DELETE FROM `provincia_laar`;");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('TUNGURAHUA', '201001019'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('PICHINCHA', '201001001'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('SANTO DOMINGO DE LOS TSACHILAS', '201001024'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('IMBABURA', '201001011'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('GUAYAS', '201001002'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('MANABI', '201001014'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('SANTA ELENA', '201001023'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('LOS RIOS', '201001013'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('CARCHI', '201001006'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('AZUAY', '201001003'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('CAÑAR', '201001005'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('BOLIVAR', '201001004'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('CHIMBORAZO', '201001008'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('COTOPAXI', '201001007'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('EL ORO', '201001009'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('ESMERALDAS', '201001010'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('LOJA', '201001012'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('MORONA SANTIAGO', '201001015'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('ZAMORA CHINCHIPE', '201001021'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('NAPO', '201001016'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('ORELLANA', '201001017'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('SUCUMBIOS', '201001022'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('PASTAZA', '201001018'); ");
mysqli_query($conexion, "INSERT INTO provincia_laar (provincia, codigo_provincia) VALUES ('GALAPAGOS', '201001020'); ");


mysqli_query($conexion, "ALTER TABLE `ciudad_laar` ADD `tipo` VARCHAR(100)  NULL AFTER `codigor`, ADD `costo` DOUBLE  NULL AFTER `tipo`, ADD `precio` DOUBLE  NULL AFTER `costo`; ");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001019007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001019005';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001019008';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='20100101902';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001019004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003008';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001019009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001019011';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001019006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001019014';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001019013';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001019012';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001001002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001035';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001042';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001045';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001007001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001007002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001007003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001007007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001007009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001007008';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001007010';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001007011';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001007012';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001007004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001007015';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001007014';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001006001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001006004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001006003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002041';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001006006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001006005';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001011005';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001011018';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001011004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001011031';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001011001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001011021';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001011023';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001011027';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001011028';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001011029';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001011026';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001011025';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001011022';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001006002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001011003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001011011';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001011020';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001004001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001004011';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001004003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001004006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001010001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001010003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001010004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001010016';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001008001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001008004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001008005';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001008003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001008010';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001008002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001008007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001008008';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001004008';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001008011';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001008012';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001001004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001024008';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001013010';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001010009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001011002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001011006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001011010';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001011032';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001011012';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001011030';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001011013';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001001001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001031';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001019';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001046';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001018';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001033';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001014';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001047';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001048';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001049';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001008';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001051';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001021';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001002043';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001052';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001025';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001036';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001028';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001026';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001041';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001063';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001053';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001054';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001024';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001005';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001056';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001021003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001020';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001057';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001039';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001037';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001058';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001013';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001012';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001010';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001029';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001022';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001061';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001071';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001070';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001069';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001068';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001067';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001066';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001065';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001064';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001017012';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001001011';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001010011';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001059';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001040';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001014005';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001017009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014035';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001010008';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001010013';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001017006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001017016';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001016001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001016003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001016005';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001016006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001016009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001016008';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001016007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001022002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001018001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001017004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001015001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001017007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001005001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001005004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001005003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001013001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002018';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002036';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013020';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001011009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013013';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001004002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001004007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001012003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013012';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013016';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013022';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013027';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013025';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001014004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001014016';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001014032';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001014033';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001014021';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001014040';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001014034';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001014009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001014017';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='SECUNDARIO', costo=3.5, precio=5.5 where codigo='201001014043';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001003011';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003016';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003019';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003017';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003033';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003018';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003005';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001016002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003021';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003022';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003023';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003024';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003025';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003026';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003027';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003028';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003029';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003030';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003031';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003032';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003034';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003036';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003037';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003040';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003039';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001003038';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001002001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002072';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001010010';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002066';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002065';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002021';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002025';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002024';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002040';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002022';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002023';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002016';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002030';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002031';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002019';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002054';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002060';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002061';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002055';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002056';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002057';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002058';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002059';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002062';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002063';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002071';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002005';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002027';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002032';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002035';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002042';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002077';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002075';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002048';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002049';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002064';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002039';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002037';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002067';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002078';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002052';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002033';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001005002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001030';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002053';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002038';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002051';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002050';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002074';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002068';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002015';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002014';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002017';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009013';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002028';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001002013';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002010';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014023';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023005';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002034';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002046';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023014';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023011';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023017';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023008';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023010';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023012';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023013';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023015';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001011007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023016';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023018';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023020';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001023019';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001012001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001012007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001012002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001012011';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001012009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001012006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001012010';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001019003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001012017';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001012016';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001012015';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001012014';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001012013';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001009001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009005';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009010';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009019';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009009';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009017';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009011';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009008';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001009018';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001014003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014027';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014018';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014024';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014042';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001014001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014020';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014013';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014044';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001014002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014036';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014031';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014015';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014010';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014037';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014038';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014039';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014012';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001001032';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014019';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014008';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014011';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014029';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014022';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001014014';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='201001013002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013014';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013005';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002011';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001007005';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013004';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013007';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013019';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013015';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001002069';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013026';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013024';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ESPECIAL', costo=3.5, precio=5.5 where codigo='201001013023';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001021001';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001015003';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001021006';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='ORIENTE', costo=3.5, precio=5.5 where codigo='201001015002';");
mysqli_query($conexion, "UPDATE ciudad_laar SET tipo='PRINCIPAL', costo=2.8, precio=4.5 where codigo='20100101901';");
mysqli_query($conexion, "CREATE TABLE `origen_laar` (
  `id_origen` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(100) NOT NULL,
  `provinciaO` varchar(100) NULL,
  `ciudadO` varchar(100) NULL,
  `nombreO` varchar(100)  NULL,
  `direccion` varchar(1200) NULL,
  `referencia` varchar(1200) NULL,
  `numeroCasa` varchar(100)  NULL,
  `postal` varchar(100) NULL,
  `telefono` varchar(15) NULL,
  `celular` varchar(15) NULL,
  UNIQUE KEY `id_origen` (`id_origen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;");
mysqli_query($conexion, "INSERT INTO `origen_laar` (`id_origen`, `identificacion`, `provinciaO`, `ciudadO`, `nombreO`, `direccion`, `referencia`, `numeroCasa`, `postal`, `telefono`, `celular`) VALUES ('1', '99999999999', '201001001', '201001001001', 'Imporsuit', 'Biloxi', 'Biloxi', 's2556', '', '0999999998', '0999999999');");
mysqli_query($conexion, "ALTER TABLE `facturas_cot` ADD `guia_enviada` INT NULL DEFAULT '0' ; ");
mysqli_query($conexion, "ALTER TABLE `facturas_cot` ADD `transporte` VARCHAR(100) NULL AFTER `guia_enviada`; ");
mysqli_query($conexion, "CREATE TABLE `guia_laar`(
  `id_guia` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tienda` varchar(400)  NULL,
  `guia_sistema` varchar(400)  NULL,
  `guia_laar` varchar(400)  NULL,
  `fecha` datetime  NULL,
  `zpl` longtext  NULL,
    UNIQUE KEY `id_guia` (`id_guia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;");
mysqli_query($conexion, "ALTER TABLE `guia_laar` CHANGE `tienda` `tienda_venta` VARCHAR(400) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL; ");
mysqli_query($conexion, "ALTER TABLE `guia_laar` ADD `tienda_proveedor` VARCHAR(500) NULL AFTER `zpl`; ");
mysqli_query($conexion, "ALTER TABLE `guia_laar` ADD `url_guia` VARCHAR(400) NULL AFTER `tienda_proveedor`; ");
mysqli_query($conexion, "ALTER TABLE `guia_laar` ADD `id_pedido` INT  NULL AFTER `url_guia`; ");
mysqli_query($conexion, "ALTER TABLE `productos` CHANGE `stock_producto` `stock_producto` DOUBLE NULL; ");
mysqli_query($conexion, "ALTER TABLE `horizontal` ADD `posicion` INT NULL AFTER `estado`; ");
mysqli_query($conexion, "ALTER TABLE `detalle_fact_cot` CHANGE `desc_venta` `desc_venta` INT NULL; ");
mysqli_query($conexion, "ALTER TABLE `facturas_cot` ADD `identificacion` VARCHAR(20) NULL AFTER `transporte`, ADD `celular` VARCHAR(20) NULL AFTER `identificacion`, ADD `cod` BOOLEAN NULL AFTER `celular`, ADD `valor_seguro` DOUBLE NULL AFTER `cod`; ");

mysqli_query($conexion, "ALTER TABLE `users` ADD `token_act` VARCHAR(400) NULL AFTER `comision_users`, ADD `estado_token` INT NULL AFTER `token_act`, ADD `fecha_actualizacion` DATETIME NULL AFTER `estado_token`");

mysqli_query($conexion, "ALTER TABLE `tmp_ventas` ADD `drogshipin_tmp` INT NULL AFTER `session_id`");
mysqli_query($conexion, "ALTER TABLE `facturas_cot` ADD `drogshipin` INT NULL AFTER `valor_seguro`");
mysqli_query($conexion, "ALTER TABLE `facturas_cot` ADD `tienda` VARCHAR(500) NULL AFTER `drogshipin`");
mysqli_query($conexion, "ALTER TABLE `detalle_fact_cot` ADD `drogshipin_tmp` INT NULL AFTER `precio_venta`");
mysqli_query($conexion, "ALTER TABLE `detalle_fact_cot` ADD `id_producto_origen` INT NULL AFTER `drogshipin_tmp`");
mysqli_query($conexion, " ALTER TABLE `productos` ADD `id_marketplace` INT NULL AFTER `id_producto_origen`");

mysqli_query($conexion, "UPDATE `user_group` SET `permission` = 'Inicio,1,1,1;Productos,1,1,1;Proveedores,1,1,1;Clientes,1,1,1;Reportes,1,1,1;Configuracion,1,1,1;Usuarios,1,1,1;Permisos,1,1,1;Categorias,1,1,1;Ventas,1,1,1;Compras,1,1,1;Pedidos,1,1,1;Integraciones,1,1,1;Dominios,1,1,1;' WHERE `user_group`.`user_group_id` = 1;");

mysqli_query($conexion, "ALTER TABLE `perfil` ADD `favicon` TEXT NULL AFTER `habilitar_proveedor`;");

mysqli_query($conexion, "ALTER TABLE `guia_laar` ADD `identificacionO` VARCHAR(500) NULL AFTER `id_pedido`, ADD `ciudadO` VARCHAR(500) NULL AFTER `identificacionO`, ADD `nombreO` VARCHAR(500) NULL AFTER `ciudadO`, ADD `direccionO` VARCHAR(500) NULL AFTER `nombreO`, ADD `referenciaO` VARCHAR(500) NULL AFTER `direccionO`, ADD `numeroCasaO` VARCHAR(500) NULL AFTER `referenciaO`, ADD `postalO` VARCHAR(500) NULL AFTER `numeroCasaO`, ADD `telefonoO` VARCHAR(500) NULL AFTER `postalO`, ADD `celularO` VARCHAR(500) NULL AFTER `telefonoO`, ADD `identificacionD` VARCHAR(500) NULL AFTER `celularO`");
mysqli_query($conexion, "ALTER TABLE `guia_laar` ADD `ciudadD` VARCHAR(500) NULL AFTER `identificacionD`, ADD `nombreD` VARCHAR(500) NULL AFTER `ciudadD`, ADD `direccionD` VARCHAR(500) NULL AFTER `nombreD`, ADD `referenciaD` VARCHAR(500) NULL AFTER `direccionD`, ADD `numeroCasaD` VARCHAR(500) NULL AFTER `referenciaD`, ADD `postalD` VARCHAR(500)  NULL AFTER `numeroCasaD`, ADD `telefonoD` VARCHAR(500) NULL AFTER `postalD`, ADD `celularD` VARCHAR(500) NULL AFTER `telefonoD`, ADD `tipoServicio` VARCHAR(500) NULL AFTER `celularD`, ADD `noPiezas` INT NULL AFTER `tipoServicio`, ADD `peso` DOUBLE NULL AFTER `noPiezas`, ADD `valorDeclarado` DOUBLE NULL AFTER `peso`, ADD `contiene` VARCHAR(500) NULL AFTER `valorDeclarado`, ADD `cod` BOOLEAN NULL AFTER `contiene`, ADD `costoflete` DOUBLE NULL AFTER `cod`, ADD `costoproducto` DOUBLE NULL AFTER `costoflete`, ADD `tipocobro` VARCHAR(500) NULL AFTER `costoproducto`, ADD `comentario` VARCHAR(500)  NULL AFTER `tipocobro`");
mysqli_query($conexion, "ALTER TABLE `guia_laar` ADD `estado_guia` INT NOT NULL AFTER `comentario`");
mysqli_query($conexion, "CREATE TABLE `estado_courier` (
  `id_estado` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` int(11) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `alias` varchar(500) DEFAULT NULL,
  UNIQUE KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci");
mysqli_query($conexion, "DELETE FROM `estado_courier`");

mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (1, '1', 'Envío listo para despachar', 'Pendiente')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (2, '1', 'Envío creado por procesar', 'Por Recolectar')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (3, '1', 'Envío Recolectado', 'Recolectado')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (4, '1', 'Ingreso en Bodega', 'En Bodega')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (5, '1', 'En proceso operativo', 'En Tránsito')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (6, '1', 'En zona para entrega al destino', 'Zona de Entrega')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (7, '1', 'Entregado', 'Entregado')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (8, '1', 'Anulacion de Guía', 'Anulado')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (9, '1', 'Devolucion al Cliente', 'Devolución/Entrega')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (10, '1', 'Facturado', 'Facturado')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (11, '1', 'En Ruta Regional/Confir. de Salida Confirmación de Salida', 'En Tránsito')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (12, '1', 'En Ruta Regional/Confir. de Llegada Confirmación de Llegada', 'En Tránsito')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (13, '1', 'Confirmación en Transito', 'En Tránsito')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (14, '1', 'En zona para entrega al destino/Novedad', 'Con Novedad')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (15, '1', 'Ingreso en Bodega / Por no entrega', 'Zona de Entrega')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (16, '1', 'Eliminacion Novedad', 'Zona de Entrega')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (17, '1', 'Envio Provicionalmente en Bodega', 'En Bodega')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (18, '1', 'Facturado', 'Facturado')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (19, '1', 'Confirmación de Llegada Automática por Zona', 'Zona de Entrega')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (20, '1', 'Guía sin la Confirmación de Salida De Regional por no pesar', 'En Tránsito')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (21, '1', 'Guía sin la Confirmación de Llegada De Regional por no pesar', 'En Tránsito')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (22, '1', 'Guía sin pesar electronicamente y sin registrar en manifiesto de zona', 'Zona de Entrega')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (23, '1', 'Guía Borrada del Manifiesto de Zona', 'Zona de Entrega')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (24, '1', 'Guía que no fue Registrada en Bodega', 'Zona de Entrega')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (25, '1', 'Liberado Aduana', 'Aduana')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (26, '1', 'No Liberado Aduana', 'Aduana')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (27, '1', 'Devolución Regional', 'Devolución Regional')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (28, '1', 'Registro en Zona por el Courier de Limites de Intentos', 'Zona de Entrega/Registro Limite')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (29, '1', 'Eliminacion Novedad Devolución', 'Reversa de Devolución')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (30, '1', 'Registro de Devolución en Zona de Entrega', 'Zona de Entrega/Registro Devolución')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (31, '1', 'Registro de Usuario que modifico POD PE', 'Digitación')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (32, '1', 'Registro de Usuario que modifico POD GC', 'Digitación')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (33, '1', 'Registro de Usuario que Elimino POD GC', 'Digitación')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (34, '1', 'Registro de Observacion Guia Retorno', 'Digitacion')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (35, '1', 'Registro del Cierre de COD Cartera para el Pago al Cliente', 'COD')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (36, '1', 'Registro del Cierre de COD Facturación para Cobro al Cliente', 'COD')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (37, '1', 'Registro de Usuario que Elimino POD UTILITARIO', 'Digitación')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (38, '1', 'Envío No Recolectado', 'No Recolectado')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (39, '1', 'Envío No Recolectado Cerrado', 'Cierre No Recolección')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (40, '1', 'Registro del Usuario que Ingreso la Devolución', 'Registro(Devolucion)')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (41, '1', 'Registro del Usuario que Ingreso los Datos Acutalizados', 'Registro(Actualizacion)')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (42, '1', 'Registro del Usuario que Ingreso el Mal Direccionado', 'Registro(Mal Direccionado)')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (43, '1', 'Registro del Usuario que Ingreso el Cambio Trayecto', 'Registro(Cambio Trayecto)')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (44, '1', 'Registro de Actualizacion de Guia Cliente (Dev, Actualizacion o Cambio Trayecto)', 'Registro(Dev-CTray-Act)')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (45, '1', 'Registro de Excepcion de un Cod por falta de pago', 'COD')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (46, '1', 'Registro de Deposito de COD', 'COD')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (47, '1', 'Registro Entregas Sabado/Feriado', 'SAC')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (48, '1', 'Registro de Novedad de COD x Inventario', 'COD')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (49, '1', 'Eliminacion COD', 'COD')");
mysqli_query($conexion, "INSERT INTO estado_courier (codigo, id_servicio, descripcion, alias) VALUES (50, '1', 'Actualizacion Valor COD', 'COD')");
mysqli_query($conexion, "INSERT INTO `currencies` (`id`, `name`, `symbol`, `precision`, `thousand_separator`, `decimal_separator`, `code`) VALUES (33, 'Sol', 'S/.', '2', ',', '.', 'PEN')");
mysqli_query($conexion, "UPDATE `currencies` SET `symbol` = 'COP$' WHERE `currencies`.`id` = 30;");

mysqli_query($conexion, "ALTER TABLE `facturas_cot` ADD `importado` INT NULL DEFAULT '0' AFTER `tienda`");
mysqli_query($conexion, "ALTER TABLE `facturas_cot` ADD `plataforma_importa` VARCHAR(500) NULL  AFTER `importado`");
mysqli_query($conexion, "CREATE TABLE `estado_guia_sistema` (
  `id_estado` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `estado` varchar(100) DEFAULT NULL,
  UNIQUE KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci");
mysqli_query($conexion, "INSERT INTO `estado_guia_sistema` (`id_estado`, `estado`) VALUES (1, 'Confirmar'), (2, 'Pick y Pack '), (3, 'Despachado'), (4, 'Zona de entrega '), (5, 'Cobrado'), (6, 'Pagado '), (7, 'Liquidado'), (8, 'Anulado')");
//mysqli_query($conexion, "ALTER TABLE `facturas_cot` CHANGE `estado_factura` `estado_factura` INT(1) NOT NULL");
mysqli_query($conexion, "ALTER TABLE `facturas_cot` ADD `estado_guia_sistema` INT NULL AFTER `plataforma_importa`");
mysqli_query($conexion, "ALTER TABLE `guia_laar` ADD `valor_costo` DOUBLE  NULL AFTER `costoproducto`");
mysqli_query($conexion, "ALTER TABLE `facturas_cot` ADD `id_factura_origen` INT NULL AFTER `estado_guia_sistema`");
mysqli_query($conexion, "ALTER TABLE `tmp_cotizacion` ADD `drogshipin_tmp` INT NULL AFTER `session_id`, ADD `id_origen` INT NULL AFTER `drogshipin_tmp`, ADD `id_marketplace` INT NULL AFTER `id_origen`");
mysqli_query($conexion, "ALTER TABLE `guia_laar` CHANGE `cod` `cod` INT NULL DEFAULT NULL");
mysqli_query($conexion, "ALTER TABLE `tmp_ventas` DROP `id_marketplace`");
mysqli_query($conexion, "ALTER TABLE `tmp_ventas` DROP `id_origen`");
mysqli_query($conexion, "ALTER TABLE `tmp_cotizacion` DROP `id_marketplace`");
mysqli_query($conexion, "ALTER TABLE `tmp_cotizacion` DROP `id_origen`");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `precio` = '3.5' WHERE `codigo` = '201001001001'");

mysqli_query($conexion, "UPDATE `user_group` SET `permission` = 'Inicio,1,1,1;Productos,1,1,1;Proveedores,1,1,1;Clientes,1,1,1;Reportes,1,1,1;Configuracion,1,1,1;Usuarios,1,1,1;Permisos,1,1,1;Categorias,1,1,1;Ventas,1,1,1;Compras,1,1,1;Pedidos,1,1,1;Integraciones,1,1,1;Dominios,1,1,1;Wallets,1,1,1;' WHERE `user_group`.`user_group_id` = 1;");

mysqli_query($conexion, "CREATE TABLE `cabecera_cuenta_cobrar` (
  `id_cabecera` int(11) NOT NULL,
  `numero_factura` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `cliente` varchar(100) DEFAULT NULL,
  `tienda` varchar(100) DEFAULT NULL,
  `estado_guia` int(11) DEFAULT NULL,
  `estado_pedido` int(11) DEFAULT NULL,
  `total_venta` double DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `precio_envio` double DEFAULT NULL,
  `monto_recibir` double DEFAULT NULL,
  `valor_cobrado` double DEFAULT 0,
  `valor_pendiente` double DEFAULT 0
)");

mysqli_query($conexion, "ALTER TABLE `cabecera_cuenta_cobrar`
ADD PRIMARY KEY (`id_cabecera`);");

mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001001027';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001001043';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001001060';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001001062';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001002020';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001002029';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001002070';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001002073';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001002076';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001003020';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001003035';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001005007';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001007013';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001011014';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001011019';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001012004';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001012005';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001013008';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001013021';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001014007';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001014025';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001014026';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001014041';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001016004';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001017001';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001017002';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001017003';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001020001';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001020002';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001020003';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001021005';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001022001';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001023021';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001024004';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001024005';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001024006';");
mysqli_query($conexion, "UPDATE `ciudad_laar` SET `costo`='3.5',`precio`='5.5' WHERE codigo='201001024007';");

mysqli_query($conexion, "UPDATE `user_group` SET `permission` = 'Inicio,1,1,1;Productos,1,1,1;Proveedores,1,1,1;Clientes,1,1,1;Reportes,1,1,1;Configuracion,1,1,1;Usuarios,1,1,1;Permisos,1,1,1;Categorias,1,1,1;Ventas,1,1,1;Compras,1,1,1;Pedidos,1,1,1;Integraciones,1,1,1;Dominios,1,1,1;Wallets,1,1,1;Datos,1,1,1;' WHERE `user_group`.`user_group_id` = 1;");

mysqli_query($conexion, "ALTER TABLE cabecera_cuenta_cobrar RENAME TO cabecera_cuenta_pagar;");

mysqli_query($conexion, "CREATE TABLE detalle_cuenta_cobrar( id_detalle_cpp int PRIMARY KEY AUTO_INCREMENT, valor double, id_cabecera_cpp int, signo varchar(2), metodo_pago varchar(50), id_pago int, FOREIGN KEY (id_cabecera_cpp) REFERENCES cabecera_cuenta_pagar(id_cabecera), FOREIGN KEY (id_pago) REFERENCES pagos(id_pago) );");

mysqli_query($conexion, "ALTER TABLE `provincia_laar` ADD `id_pais` INT NOT NULL DEFAULT '1' AFTER `codigo_provincia`;");
mysqli_query($conexion, " ALTER TABLE `perfil` ADD `pais` INT NOT NULL DEFAULT '1' AFTER `fiscal_empresa`;");
mysqli_query($conexion, "DELETE FROM `ciudad_laar` where pais=2");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Chachapoyas','0101',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Bagua','0102',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Bongará','0103',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Condorcanqui','0104',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Luya','0105',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Rodríguez de Mendoza','0106',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Utcubamba','0107',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huaraz','0201',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Aija','0202',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Antonio Raymondi','0203',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Asunción','0204',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Bolognesi','0205',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Carhuaz','0206',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Carlos Fermín Fitzcarrald','0207',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Casma','0208',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Corongo','0209',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huari','0210',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huarmey','0211',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huaylas','0212',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Mariscal Luzuriaga','0213',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Ocros','0214',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Pallasca','0215',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Pomabamba','0216',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Recuay','0217',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Santa','0218',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Sihuas','0219',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Yungay','0220',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Abancay','0301',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Andahuaylas','0302',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Antabamba','0303',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Aymaraes','0304',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Cotabambas','0305',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Chincheros','0306',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Grau','0307',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Arequipa','0401',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Camaná','0402',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Caravelí','0403',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Castilla','0404',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Caylloma','0405',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Condesuyos','0406',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Islay','0407',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('La Uniòn','0408',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huamanga','0501',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Cangallo','0502',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huanca Sancos','0503',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huanta','0504',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('La Mar','0505',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Lucanas','0506',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Parinacochas','0507',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Pàucar del Sara Sara','0508',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Sucre','0509',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Víctor Fajardo','0510',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Vilcas Huamán','0511',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Cajamarca','0601',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Cajabamba','0602',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Celendín','0603',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Chota','0604',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Contumazá','0605',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Cutervo','0606',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Hualgayoc','0607',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Jaén','0608',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('San Ignacio','0609',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('San Marcos','0610',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('San Miguel','0611',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('San Pablo','0612',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Santa Cruz','0613',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Prov. Const. del Callao','0701',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Cusco','0801',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Acomayo','0802',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Anta','0803',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Calca','0804',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Canas','0805',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Canchis','0806',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Chumbivilcas','0807',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Espinar','0808',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('La Convención','0809',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Paruro','0810',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Paucartambo','0811',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Quispicanchi','0812',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Urubamba','0813',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huancavelica','0901',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Acobamba','0902',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Angaraes','0903',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Castrovirreyna','0904',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Churcampa','0905',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huaytará','0906',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Tayacaja','0907',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huánuco','1001',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Ambo','1002',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Dos de Mayo','1003',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huacaybamba','1004',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huamalíes','1005',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Leoncio Prado','1006',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Marañón','1007',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Pachitea','1008',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Puerto Inca','1009',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Lauricocha ','1010',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Yarowilca ','1011',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Ica ','1101',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Chincha ','1102',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Nazca ','1103',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Palpa ','1104',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Pisco ','1105',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huancayo ','1201',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Concepción ','1202',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Chanchamayo ','1203',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Jauja ','1204',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Junín ','1205',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Satipo ','1206',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Tarma ','1207',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Yauli ','1208',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Chupaca ','1209',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Trujillo ','1301',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Ascope ','1302',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Bolívar ','1303',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Chepén ','1304',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Julcán ','1305',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Otuzco ','1306',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Pacasmayo ','1307',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Pataz ','1308',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Sánchez Carrión ','1309',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Santiago de Chuco ','1310',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Gran Chimú ','1311',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Virú ','1312',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Chiclayo ','1401',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Ferreñafe ','1402',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Lambayeque ','1403',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Lima ','1501',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Barranca ','1502',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Cajatambo ','1503',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Canta ','1504',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Cañete ','1505',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huaral ','1506',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huarochirí ','1507',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huaura ','1508',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Oyón ','1509',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Yauyos ','1510',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Maynas ','1601',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Alto Amazonas ','1602',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Loreto ','1603',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Mariscal Ramón Castilla ','1604',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Requena ','1605',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Ucayali ','1606',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Datem del Marañón ','1607',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Putumayo','1608',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Tambopata ','1701',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Manu ','1702',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Tahuamanu ','1703',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Mariscal Nieto ','1801',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('General Sánchez Cerro ','1802',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Ilo ','1803',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Pasco ','1901',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Daniel Alcides Carrión ','1902',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Oxapampa ','1903',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Piura ','2001',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Ayabaca ','2002',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huancabamba ','2003',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Morropón ','2004',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Paita ','2005',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Sullana ','2006',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Talara ','2007',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Sechura ','2008',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Puno ','2101',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Azángaro ','2102',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Carabaya ','2103',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Chucuito ','2104',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('El Collao ','2105',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huancané ','2106',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Lampa ','2107',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Melgar ','2108',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Moho ','2109',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('San Antonio de Putina ','2110',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('San Román ','2111',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Sandia ','2112',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Yunguyo ','2113',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Moyobamba ','2201',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Bellavista ','2202',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('El Dorado ','2203',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huallaga ','2204',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Lamas ','2205',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Mariscal Cáceres ','2206',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Picota ','2207',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Rioja ','2208',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('San Martín ','2209',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Tocache ','2210',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Tacna ','2301',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Candarave ','2302',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Jorge Basadre ','2303',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Tarata ','2304',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Tumbes ','2401',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Contralmirante Villar ','2402',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Zarumilla ','2403',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Coronel Portillo ','2501',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Atalaya ','2502',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Padre Abad ','2503',2); ");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Purús','2504',2); ");

mysqli_query($conexion, "ALTER TABLE `facturas_cot` ADD `impreso` TINYINT NULL AFTER `id_factura_origen`;");
mysqli_query($conexion, "ALTER TABLE `guia_laar` ADD `id_transporte` INT NOT NULL DEFAULT '1' AFTER `estado_guia`;");
mysqli_query($conexion, "CREATE TABLE `caracteristicas_tienda` (  `id` int(11) NOT NULL AUTO_INCREMENT,   `id_producto` int(11) DEFAULT 0,  `texto` varchar(255) DEFAULT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci");

mysqli_query($conexion, "UPDATE `user_group` SET `permission` = 'Inicio,1,1,1;Productos,1,1,1;Proveedores,1,1,1;Clientes,1,1,1;Reportes,1,1,1;Configuracion,1,1,1;Usuarios,1,1,1;Permisos,1,1,1;Categorias,1,1,1;Ventas,1,1,1;Compras,1,1,1;Pedidos,1,1,1;Integraciones,1,1,1;Dominios,1,1,1;Wallets,1,1,1;Datos,1,1,1;Referidos,1,1,1;' WHERE `user_group`.`user_group_id` = 1;");
mysqli_query($conexion, "ALTER TABLE `perfil` ADD `nodevolucion` TINYINT NOT NULL DEFAULT '0'");
mysqli_query($conexion, "CREATE TABLE motorizado_guia ( id int NOT NULL PRIMARY KEY AUTO_INCREMENT, empleado_id int NOT NULL, guia_fast varchar(400) NOT NULL );");
mysqli_query($conexion, "CREATE TABLE `empresa_envio` (`id` int NOT NULL AUTO_INCREMENT, `nombre` varchar(20) UNIQUE DEFAULT NULL,  PRIMARY KEY (`id`)) ");
mysqli_query($conexion, "CREATE TABLE `trabajadores_envio` ( `id` int NOT NULL AUTO_INCREMENT, `nombre` varchar(20) DEFAULT NULL, `contacto` varchar(13) DEFAULT NULL, `placa` varchar(10) DEFAULT NULL, `empresa` int NOT NULL, `estado` tinyint DEFAULT '1', PRIMARY KEY (`id`), KEY `empresa` (`empresa`), CONSTRAINT `trabajadores_envio_ibfk_1` FOREIGN KEY (`empresa`) REFERENCES `empresa_envio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) ");

mysqli_query($conexion, "INSERT INTO `empresa_envio` (`id`, `nombre`) VALUES (1, 'Laar Courier'), (2, 'Speed'), (3, 'Speed');");

mysqli_query($conexion, "DELETE FROM `ciudad_laar` where pais=2");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Antioquia','5','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Boyacá','15','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Córdoba','23','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Chocó','27','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Nariño','52','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Santander','68','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Meta','50','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Atlántico','8','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Bolívar','13','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Caldas','17','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Caquetá','18','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Cauca','19','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Cesar','20','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Cundinamarca','25','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Huila','41','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('La Guajira','44','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Magdalena','47','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Quindío','63','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Risaralda','66','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Sucre','70','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Tolima','73','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Arauca','81','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Casanare','85','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Putumayo','86','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Amazonas','91','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Guainía','94','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Vaupés','97','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Vichada','99','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Guaviare','95','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Archipiélago de San Andrés, Providencia y Santa Catalina','88','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Bogotá D.C.','11','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Norte de Santander','54','3');");
mysqli_query($conexion, "INSERT INTO `provincia_laar` (`provincia`,  `codigo_provincia`, `id_pais`) VALUES ('Valle del Cauca','76','3');");

mysqli_query($conexion, "ALTER TABLE `perfil` ADD `texto_slider` TEXT  NULL AFTER `nodevolucion`;");
mysqli_query($conexion, "ALTER TABLE `perfil` ADD `texto_btn_slider` TEXT NULL AFTER `texto_slider`;");
mysqli_query($conexion, "ALTER TABLE `perfil` ADD `enlace_btn_slider` TEXT NOT NULL AFTER `texto_btn_slider`;");
mysqli_query($conexion, "ALTER TABLE `perfil` ADD `titulo_slider` TEXT NULL AFTER `enlace_btn_slider`;");
mysqli_query($conexion, "ALTER TABLE `perfil` ADD `alineacion_slider` INT NOT NULL AFTER `titulo_slider`;");
mysqli_query($conexion, "CREATE TABLE `banner_adicional` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fondo_banner` text DEFAULT NULL,
  `titulo` text DEFAULT NULL,
  `texto_banner` text DEFAULT NULL,
  `texto_boton` text DEFAULT NULL,
  `enlace_boton` text DEFAULT NULL,
  `alineacion` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

mysqli_query($conexion, "UPDATE `perfil` SET `nodevolucion` = '1' WHERE `perfil`.`id_perfil` = 1;");


$conexion_tienda  = mysqli_connect("localhost", "imporsuit_marketplace", "imporsuit_marketplace", "imporsuit_marketplace");
$url = $_SERVER['HTTP_HOST'];

$data = mysqli_query($conexion_tienda, "SELECT * from plataformas where url_imporsuit like '%$url%' ");
$plataforma = mysqli_fetch_assoc($data);
$id = $plataforma["id_plataforma"];


mysqli_query($conexion, "ALTER TABLE `perfil` ADD `id_plataforma` INT NULL AFTER `alineacion_slider`;");

mysqli_query($conexion, "UPDATE `perfil` SET `id_plataforma` = '$id' WHERE `perfil`.`id_perfil` = 1;");

mysqli_query($conexion, "ALTER TABLE `clientes` DROP INDEX `codigo_producto`;");

mysqli_close($conexion_tienda);


mysqli_query($conexion, "ALTER TABLE `productos` ADD `aplica_iva` INT NULL DEFAULT '0' AFTER `id_marketplace`;");

mysqli_query($conexion, "create table dropi (
	id_dropi int not null auto_increment primary key,
	usuario varchar(200) not null unique,
	contrasena_hash varchar(250) not null,
	token text default null,
	create_at datetime default current_timestamp(),
	update_at datetime default current_timestamp(),
	pais_id int not null
);");

mysqli_query($conexion, "ALTER TABLE `facturas_cot` ADD `facturada` INT NULL DEFAULT '0' AFTER `impreso`;");

mysqli_query($conexion, "ALTER TABLE `facturas_cot` ADD `factura_numero` INT NULL AFTER `facturada`;");

mysqli_query($conexion, "ALTER TABLE `perfil` ADD `caracteristicas_home` INT DEFAULT '0' NULL;");

mysqli_query($conexion, "ALTER TABLE `productos` ADD `destacado` INT DEFAULT '0' NULL;");

mysqli_query($conexion, "ALTER TABLE `caracteristicas_tienda` ADD `icon_text` varchar(100) NULL;");

mysqli_query($conexion, "ALTER TABLE `caracteristicas_tienda` ADD `enlace_icon` varchar(100) NULL;");

mysqli_query($conexion, "ALTER TABLE `caracteristicas_tienda` ADD `subtexto_icon` varchar(100) NULL;");

mysqli_query($conexion, "ALTER TABLE `caracteristicas_tienda` ADD `accion` INT DEFAULT 0 NULL;");


mysqli_query($conexion, "INSERT INTO `caracteristicas_tienda` (`id`,`id_producto`,  `texto`, `icon_text`, `subtexto_icon`, `accion`) VALUES (20,'0','Envío Gratis a todo el País','fa-truck','Llegamos a todo el País','1');");
mysqli_query($conexion, "INSERT INTO `caracteristicas_tienda` (`id`,`id_producto`,  `texto`, `icon_text`, `subtexto_icon`, `accion`) VALUES (21,'0','Pago Contra Entrega','fa-lock','Paga cuando recibes el producto','2');");
mysqli_query($conexion, "INSERT INTO `caracteristicas_tienda` (`id`,`id_producto`,  `texto`, `icon_text`, `subtexto_icon`, `accion`) VALUES (22,'0','Atención al cliente','fa-headset','Soporte 100% garantizado','2');");

mysqli_query($conexion, "ALTER TABLE `perfil` ADD `banner_opacidad` DOUBLE NULL DEFAULT '0.5' AFTER `caracteristicas_home`, ADD `banner_color_filtro` TEXT NULL AFTER `banner_opacidad`;");

mysqli_query($conexion, "TRUNCATE TABLE `ciudad_cotizacion`;");

mysqli_query($conexion, "CREATE TABLE ciudad_cotizacion (
  `id_cotizacion` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `provincia` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `cobertura_servientrega` tinyint(4) DEFAULT 0,
  `cobertura_laar` tinyint(4) DEFAULT 0,
  `cobertura_gintracom` tinyint(4) DEFAULT 0,
  `trayecto_servientrega` varchar(10) DEFAULT NULL,
  `trayecto_laar` varchar(10) DEFAULT NULL,
  `trayecto_gintracom` varchar(10) DEFAULT NULL,
  `codigo_provincia_servientrega` varchar(100) DEFAULT NULL,
  `codigo_provincia_laar` varchar(100) DEFAULT NULL,
  `codigo_ciudad_laar` varchar(100) DEFAULT NULL,
  `codigo_provincia_gintracom` varchar(100) DEFAULT NULL,
  `codigo_ciudad_gintracom` varchar(100) DEFAULT NULL,
  `codigo_ciudad_servientrega` varchar(100) DEFAULT NULL
)");

mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (769,'AZUAY','BANOS',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','694'),
	 (770,'AZUAY','CHAULLABAMBA',0,1,0,NULL,NULL,NULL,'','','','','','0'),
	 (771,'AZUAY','Checa',0,1,0,NULL,NULL,NULL,'','','','','','0'),
	 (772,'AZUAY','CHILCAPAMBA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (773,'AZUAY','Chiquintad',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (774,'AZUAY','CHORDELEG',1,1,0,NULL,NULL,NULL,'0','201001003','201001003006','0','0','221'),
	 (775,'AZUAY','CUENCA',1,1,1,NULL,NULL,NULL,'0','201001003','201001003011','1022','56247','4'),
	 (776,'AZUAY','CUMBE',1,1,0,NULL,NULL,NULL,'0','201001003','201001003017','0','0','498'),
	 (777,'AZUAY','EL PAN',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','497'),
	 (778,'AZUAY','Firma',0,1,0,NULL,NULL,NULL,'','','','','','');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (779,'AZUAY','GIRON',1,1,0,NULL,NULL,NULL,'0','201001003','201001003002','0','0','34'),
	 (780,'AZUAY','GUACHAPALA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','501'),
	 (781,'AZUAY','GUALACEO',1,1,0,NULL,NULL,NULL,'0','201001003','201001003003','0','0','19'),
	 (782,'AZUAY','LA UNION',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (783,'AZUAY','Llacao',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (784,'AZUAY','NABON',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (785,'AZUAY','Nulti',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (786,'AZUAY','ONA',1,1,0,NULL,NULL,NULL,'0','201001003','201001016002','0','0','0'),
	 (787,'AZUAY','PACCHA ',0,1,1,NULL,NULL,NULL,'0','201001003','201001003023','1022','59059','0'),
	 (788,'BOLIVAR','1ERO DE MAYO',1,0,1,NULL,NULL,NULL,'0','0','0','0','0','499');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (789,'BOLIVAR','4 ESQUINAS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','689'),
	 (790,'BOLIVAR','ASUNCION',1,0,1,NULL,NULL,NULL,'0','0','0','1023','57672','696'),
	 (791,'BOLIVAR','BALZAPAMBA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','507'),
	 (792,'BOLIVAR','CALUMA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','72'),
	 (793,'BOLIVAR','CHILLANES',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','110'),
	 (794,'BOLIVAR','CHIMBO',1,0,1,NULL,NULL,NULL,'0','0','0','1023','56261','286'),
	 (795,'BOLIVAR','ECHEANDIA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','382'),
	 (796,'BOLIVAR','GUARANDA',1,0,1,NULL,NULL,NULL,'0','201001004','201001004001','1023','56264','44'),
	 (797,'BOLIVAR','LA MAGDALENA',1,0,1,NULL,NULL,NULL,'0','0','0','1023','57674','697'),
	 (798,'BOLIVAR','LAS NAVES',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','768');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (799,'BOLIVAR','PISAGUA ALTO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','508'),
	 (800,'BOLIVAR','PISAGUA BAJO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','509'),
	 (801,'BOLIVAR','RECINTO 24 DE MAYO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','698'),
	 (802,'BOLIVAR','RECINTO EL PALMAR',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','699'),
	 (803,'BOLIVAR','RECINTO LA MARITZA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','700'),
	 (804,'BOLIVAR','SALINAS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (805,'BOLIVAR','SALINAS DE GUARANDA',0,1,0,NULL,NULL,NULL,'0','201001004','201001004011','0','0','0'),
	 (806,'BOLIVAR','SAN JOSE DE CHIMBO',1,1,1,NULL,NULL,NULL,'0','201001004','201001004003','1023','57681','500'),
	 (807,'BOLIVAR','SAN LORENZO',1,0,1,NULL,NULL,NULL,'0','0','0','1023','59063','771'),
	 (808,'BOLIVAR','SAN MIGUEL',0,0,1,NULL,NULL,NULL,'0','0','0','1023','56266','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (809,'BOLIVAR','SAN MIGUEL DE BOLIVAR',1,1,0,NULL,NULL,NULL,'0','201001004','201001004006','0','0','287'),
	 (810,'BOLIVAR','SAN PABLO DE ATENAS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','128'),
	 (811,'BOLIVAR','SAN PEDRO DE GUANUJO',1,0,1,NULL,NULL,NULL,'0','0','0','1023','57683','285'),
	 (812,'BOLIVAR','SAN SIMON',1,0,1,NULL,NULL,NULL,'0','0','0','1023','57684','511'),
	 (813,'BOLIVAR','SAN SIMON (YACOTO)',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','511'),
	 (814,'BOLIVAR','SANTA FE',1,0,1,NULL,NULL,NULL,'0','0','0','1023','57685','512'),
	 (815,'BOLIVAR','VINCHOA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','702'),
	 (816,'CANAR','AZOGUES',1,1,1,NULL,NULL,NULL,'0','201001005','201001005001','1024','56277','99'),
	 (817,'CANAR','BIBLIAN',1,1,1,NULL,NULL,NULL,'0','201001005','201001005004','1024','56278','392'),
	 (818,'CARCHI','BOLIVAR',1,1,0,NULL,NULL,NULL,'0','201001006','201001006006','0','0','271');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (819,'CANAR','CAÑAR',1,1,1,NULL,NULL,NULL,'0','201001005','201001005003','1024','56279','81'),
	 (820,'CANAR','CHARCAY',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (821,'CARCHI','CHITAN DE NAVARRETES',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','703'),
	 (822,'CANAR','CHONTAMARCA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (823,'CANAR','COCHANCAY',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','513'),
	 (824,'CANAR','COJITAMBO',1,0,1,NULL,NULL,NULL,'0','201001005','201001005007','1024','57688','692'),
	 (825,'CARCHI','CRISTOBAL COLON',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','272'),
	 (826,'CARCHI','CUESACA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','704'),
	 (827,'CANAR','DELEG',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','679'),
	 (828,'CANAR','DUCUR',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','514');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (829,'CARCHI','EL ANGEL',1,1,0,NULL,NULL,NULL,'0','201001006','201001006003','0','0','273'),
	 (830,'CARCHI','GARCIA MORENO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','279'),
	 (831,'CANAR','GUAPAN',1,0,1,NULL,NULL,NULL,'0','0','0','1024','57690','515'),
	 (832,'CARCHI','HUACA',1,1,0,NULL,NULL,NULL,'0','201001006','201001006005','0','0','274'),
	 (833,'CANAR','INGAPIRCA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','516'),
	 (834,'CANAR','JAVIER LOYOLA',1,0,1,NULL,NULL,NULL,'0','0','0','1024','57692','517'),
	 (835,'CANAR','JAVIN',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (836,'CARCHI','JULIO ANDRADE',1,1,0,NULL,NULL,NULL,'0','201001006','201001002041','0','0','275'),
	 (837,'CANAR','LA DOLOROSA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (838,'CARCHI','LA PAZ',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','276');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (839,'CANAR','LA PUNTILLA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','502'),
	 (840,'CANAR','LA TRONCAL',1,0,1,NULL,NULL,NULL,'0','201001005','201001005002','1024','56282','52'),
	 (841,'CANAR','LAS LAJAS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (842,'CANAR','LUIS CORDERO',0,0,1,NULL,NULL,NULL,'0','0','0','1024','59065','0'),
	 (843,'CANAR','MANUEL J. CALLE',0,0,1,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (844,'CARCHI','MIRA',1,0,0,NULL,NULL,NULL,'0','201001006','201001006002','0','0','251'),
	 (845,'CARCHI','PIOTER',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','124'),
	 (846,'CARCHI','SAN GABRIEL',1,1,0,NULL,NULL,NULL,'0','201001006','201001006004','0','0','51'),
	 (847,'CARCHI','SAN ISIDRO CARCHI SAN GABRIEL',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (848,'CANAR','SAN MIGUEL',0,0,1,NULL,NULL,NULL,'0','0','0','1024','59152','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (849,'CARCHI','SANDIAL',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','705'),
	 (850,'CARCHI','SANTA MARTHA DE CUBA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','132'),
	 (851,'CANAR','SUSCAL',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','393'),
	 (852,'CANAR','TAMBO',1,1,1,NULL,NULL,NULL,'0','0','0','0','0','394'),
	 (853,'CARCHI','TULCAN',1,1,1,NULL,NULL,NULL,'0','201001006','201001006001','1025','56289','39'),
	 (854,'CANAR','VOLUNTAD DE DIOS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','506'),
	 (855,'CANAR','ZHUD',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (856,'CHIMBORAZO','ALAUSI',1,1,0,NULL,NULL,NULL,'','','','','','91'),
	 (857,'CHIMBORAZO','CAJABAMBA',1,1,0,NULL,NULL,NULL,'0','201001008','201001008005','0','0','678'),
	 (858,'CHIMBORAZO','CHAMBO',1,1,0,NULL,NULL,NULL,'0','201001008','201001004008','0','0','241');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (859,'CHIMBORAZO','CHUNCHI',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','248'),
	 (860,'CHIMBORAZO','COLTA',1,1,0,NULL,NULL,NULL,'0','201001008','201001008008','0','0','242'),
	 (861,'CHIMBORAZO','CUMANDA',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','469'),
	 (862,'CHIMBORAZO','EL GUANO',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','244'),
	 (863,'CHIMBORAZO','FLORES',0,0,1,NULL,NULL,NULL,'0','0','0','1026','59068','0'),
	 (864,'CHIMBORAZO','GUAMOTE',1,1,0,NULL,NULL,NULL,'0','201001008','201001008007','0','0','243'),
	 (865,'CHIMBORAZO','GUANO',0,1,1,NULL,NULL,NULL,'','','','','',''),
	 (866,'CHIMBORAZO','ILAPO',0,0,1,NULL,NULL,NULL,'0','0','0','1026','59069','0'),
	 (867,'CHIMBORAZO','LICAN',1,1,1,NULL,NULL,NULL,'0','201001008','201001008010','1026','57708','518'),
	 (868,'CHIMBORAZO','LICTO',0,0,1,NULL,NULL,NULL,'0','0','0','1026','59070','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (869,'CHIMBORAZO','PALLATANGA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','467'),
	 (870,'CHIMBORAZO','PENIPE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','246'),
	 (871,'CHIMBORAZO','PUNGALA',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (872,'CHIMBORAZO','PUNIN',0,0,1,NULL,NULL,NULL,'0','0','0','1026','59071','0'),
	 (873,'CHIMBORAZO','RECINTO EL BATAN',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (874,'CHIMBORAZO','RECINTO EL ROSARIO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (875,'CHIMBORAZO','RECINTO SAN PEDRO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (876,'CHIMBORAZO','RECITNO EL CHAGUE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (877,'CHIMBORAZO','RECITNO FORTUNA BAJA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (878,'CHIMBORAZO','RIOBAMBA',1,1,1,NULL,NULL,NULL,'0','201001008','201001008001','1026','56276','43');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (879,'CHIMBORAZO','SAN ANDRES',1,0,1,NULL,NULL,NULL,'0','0','0','1026','57709','677'),
	 (880,'CHIMBORAZO','SAN JUAN',0,0,1,NULL,NULL,NULL,'0','0','0','1026','59072','0'),
	 (881,'CHIMBORAZO','SAN LUIS (CHIMBORAZO)',1,0,1,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (882,'COTOPAXI','11 DE NOVIEMBRE (ILINCHISI)',0,0,1,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (883,'COTOPAXI','ALAQUES (ALAQUEZ) ',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (884,'COTOPAXI','ANCHILIVI',1,0,0,NULL,NULL,NULL,'','','','','','709'),
	 (885,'COTOPAXI','BELISARIO QUEVEDO',1,1,1,NULL,NULL,NULL,'0','201001007','201001007012','1027','57713','521'),
	 (886,'COTOPAXI','CHIPUALO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','522'),
	 (887,'COTOPAXI','EL CARMEN ',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (888,'COTOPAXI','EL CORAZON',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','706');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (889,'COTOPAXI','EL MORAL',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (890,'COTOPAXI','GUAYTACAMA',1,1,1,NULL,NULL,NULL,'0','201001007','201001007009','1027','57716','523'),
	 (891,'COTOPAXI','LA MANA',1,1,1,NULL,NULL,NULL,'0','0','0','1027','56291','228'),
	 (892,'COTOPAXI','LA VICTORIA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','711'),
	 (893,'COTOPAXI','LASSO',1,1,1,NULL,NULL,NULL,'0','201001007','201001007007','1027','57717','257'),
	 (894,'COTOPAXI','LATACUNGA',1,1,1,NULL,NULL,NULL,'0','201001007','201001007001','1027','56290','41'),
	 (895,'COTOPAXI','MORASPUNGO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','712'),
	 (896,'COTOPAXI','MULALAO',1,1,1,NULL,NULL,NULL,'0','201001007','201001007015','1027','57719','524'),
	 (897,'COTOPAXI','MULALILLO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','525'),
	 (898,'COTOPAXI','MULALO',0,1,0,NULL,NULL,NULL,'0','201001007','201001007010','0','0','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (899,'COTOPAXI','MULLIQUINDIL',0,0,1,NULL,NULL,NULL,'0','0','0','1027','59074','0'),
	 (900,'COTOPAXI','PANGUA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','707'),
	 (901,'COTOPAXI','PANZALEO',1,0,1,NULL,NULL,NULL,'0','0','0','1027','57721','526'),
	 (902,'COTOPAXI','PASTOCALLE',1,1,1,NULL,NULL,NULL,'0','201001007','201001007008','1027','57722','527'),
	 (903,'COTOPAXI','PATAIN',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','528'),
	 (904,'COTOPAXI','POALO',1,0,1,NULL,NULL,NULL,'0','0','0','1027','57724','710'),
	 (905,'COTOPAXI','PUJILI',1,1,1,NULL,NULL,NULL,'0','201001007','201001007004','1027','56293','258'),
	 (906,'COTOPAXI','RUMIPAMBA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','529'),
	 (907,'COTOPAXI','SALCEDO',1,1,1,NULL,NULL,NULL,'0','201001007','201001007002','1027','56295','66'),
	 (908,'COTOPAXI','SAN BUENAVENTURA -BELLAVISTA.',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (909,'COTOPAXI','SAN MARCOS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','530'),
	 (910,'COTOPAXI','SAN MIGUEL',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (911,'COTOPAXI','SANTA ANA COTOPAXI',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (912,'COTOPAXI','SAQUISILI',1,1,1,NULL,NULL,NULL,'0','201001007','201001007003','1027','56296','256'),
	 (913,'COTOPAXI','SIGCHOS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','708'),
	 (914,'COTOPAXI','TANICUCHCHI',0,1,0,NULL,NULL,NULL,'0','201001007','201001007014','0','0','0'),
	 (915,'COTOPAXI','TANICUCHI',1,1,1,NULL,NULL,NULL,'0','201001007','201001007011','1027','57728','531'),
	 (916,'COTOPAXI','TOACASO',1,0,1,NULL,NULL,NULL,'0','0','0','1027','57729','532'),
	 (917,'COTOPAXI','YANAYACU',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','533'),
	 (918,'EL ORO','3 CERRITOS PASAJE',1,0,0,NULL,NULL,NULL,'','','','','','534');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (919,'EL ORO','ARENILLAS',1,1,0,NULL,NULL,NULL,'','','','','','65'),
	 (920,'EL ORO','BARBONES',0,0,1,NULL,NULL,NULL,'','','','','',''),
	 (921,'EL ORO','BELLAVISTA',0,0,1,NULL,NULL,NULL,'0','0','0','1028','59076','0'),
	 (922,'EL ORO','BUENA VISTA',1,0,1,NULL,NULL,NULL,'0','0','0','1028','57736','365'),
	 (923,'EL ORO','CANA QUEMADA',1,0,1,NULL,NULL,NULL,'0','0','0','1028','57737','538'),
	 (924,'EL ORO','EL CAMBIO',1,1,1,NULL,NULL,NULL,'0','201001009','201001009011','1028','57738','351'),
	 (925,'EL ORO','EL GUABO',1,1,1,NULL,NULL,NULL,'0','201001009','201001009008','1028','56301','58'),
	 (926,'EL ORO','EL PACHE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','540'),
	 (927,'EL ORO','EL PORTON',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','541'),
	 (928,'EL ORO','EL RETIRO',0,0,1,NULL,NULL,NULL,'0','0','0','1028','59077','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (929,'EL ORO','HUAQUILLAS',1,1,1,NULL,NULL,NULL,'0','201001009','201001009007','1028','56302','35'),
	 (930,'EL ORO','LA AVANZADA',1,1,1,NULL,NULL,NULL,'0','201001009','201001009019','1028','57741','355'),
	 (931,'EL ORO','LA IBERIA',1,1,1,NULL,NULL,NULL,'0','0','0','1028','57742','542'),
	 (932,'EL ORO','LA PEANA',1,1,1,NULL,NULL,NULL,'0','0','0','1028','57743','366'),
	 (933,'EL ORO','LA VICTORIA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (934,'EL ORO','LOMA DE FRANCO',1,1,0,NULL,NULL,NULL,'0','201001009','201001009018','0','0','368'),
	 (935,'EL ORO','MACHALA',1,0,1,NULL,NULL,NULL,'0','201001009','201001009001','1028','56304','7'),
	 (936,'EL ORO','MARCABELI',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','488'),
	 (937,'EL ORO','PACCHA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','759'),
	 (938,'EL ORO','PASAJE',1,1,1,NULL,NULL,NULL,'0','201001009','201001009002','1028','56306','36');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (939,'EL ORO','PINAS',1,1,0,NULL,NULL,NULL,'0','201001009','201001009004','0','0','50'),
	 (940,'EL ORO','PORTOVELO',1,1,0,NULL,NULL,NULL,'0','201001009','201001009003','0','0','358'),
	 (941,'EL ORO','PUERTO BOLIVAR',1,1,1,NULL,NULL,NULL,'0','201001009','201001009010','1028','55747','352'),
	 (942,'EL ORO','PUERTO HUALTACO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','371'),
	 (943,'EL ORO','PUERTO JELI',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','544'),
	 (944,'EL ORO','RIO BONITO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','545'),
	 (945,'EL ORO','SAN ANTONIO EL ORO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (946,'EL ORO','SAN VICENTE DEL JOBO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','547'),
	 (947,'ESMERALDAS','ATACAMES',1,1,1,NULL,NULL,NULL,'0','201001010','201001010003','1029','56311','23'),
	 (948,'ESMERALDAS','BORBON',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','549');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (949,'ESMERALDAS','ESMERALDAS',1,1,1,NULL,NULL,NULL,'0','201001010','201001010001','1029','56313','10'),
	 (950,'ESMERALDAS','LA CONCORDIA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','69'),
	 (951,'ESMERALDAS','LA INDEPENDENCIA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','236'),
	 (952,'ESMERALDAS','LA UNION',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (953,'ESMERALDAS','LA Y DE CALDERON',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','716'),
	 (954,'ESMERALDAS','LAGARTO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','714'),
	 (955,'ESMERALDAS','LAS PENAS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','717'),
	 (956,'ESMERALDAS','MUISNE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','119'),
	 (957,'ESMERALDAS','QUININDE',1,1,1,NULL,NULL,NULL,'0','201001010','201001010008','1029','56315','96'),
	 (958,'ESMERALDAS','RIO VERDE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','715');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (959,'ESMERALDAS','SAME',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','266'),
	 (960,'ESMERALDAS','SAN LORENZO',1,0,1,NULL,NULL,NULL,'0','0','0','1029','56317','490'),
	 (961,'ESMERALDAS','SAN MATEO',0,0,1,NULL,NULL,NULL,'0','0','0','1029','59080','0'),
	 (962,'ESMERALDAS','SUA',1,0,1,NULL,NULL,NULL,'0','0','0','1029','57662','267'),
	 (963,'ESMERALDAS','TABIAZO',0,0,1,NULL,NULL,NULL,'0','0','0','1029','59081','0'),
	 (964,'ESMERALDAS','TACHINA',1,1,1,NULL,NULL,NULL,'0','201001010','201001010016','1029','57761','269'),
	 (965,'ESMERALDAS','TONCHIGUE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','550'),
	 (966,'ESMERALDAS','TONSUPA',1,1,1,NULL,NULL,NULL,'0','201001010','201001010004','1029','57661','268'),
	 (967,'ESMERALDAS','VICHE',1,1,0,NULL,NULL,NULL,'0','201001010','201001010013','0','0','496'),
	 (968,'ESMERALDAS','VUELTA LARGA',0,0,1,NULL,NULL,NULL,'0','0','0','1029','59082','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (969,'GALAPAGOS','ISABELA',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (970,'GALAPAGOS','SAN CRISTOBAL',1,1,0,NULL,NULL,NULL,'0','201001020','201001020003','0','0','49'),
	 (971,'GALAPAGOS','SANTA CRUZ',1,1,0,NULL,NULL,NULL,'0','201001020','201001020002','0','0','468'),
	 (972,'GUAYAS','3 POSTES',1,0,0,NULL,NULL,NULL,'','201001002','','1031','','567'),
	 (973,'GUAYAS','5 DE JUNIO MILAGRO',1,0,0,NULL,NULL,NULL,'','201001002','','1031','','6'),
	 (974,'GUAYAS','ALFREDO BAQUERIZO MORENO',1,1,1,NULL,NULL,NULL,'','201001002','','1031','56321','718'),
	 (975,'GUAYAS','BALAO',0,1,0,NULL,NULL,NULL,'0','201001002','201001002014','0','0','337'),
	 (976,'GUAYAS','BALZAR',1,0,1,NULL,NULL,NULL,'','201001002','201001002016','1031','','45'),
	 (977,'GUAYAS','BASE TAURA',0,1,0,NULL,NULL,NULL,'0','201001002','201001002048','0','0','331'),
	 (978,'GUAYAS','BOCA DE CANA',1,0,1,NULL,NULL,NULL,'','201001002','201001002065','1031','','568');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (979,'GUAYAS','BOLICHE',1,1,1,NULL,NULL,NULL,'','201001002','2010010012067','1031','57768','569'),
	 (980,'GUAYAS','BUCAY',1,0,1,NULL,NULL,NULL,'','201001002','201001002037','1031','','68'),
	 (981,'GUAYAS','CERECITA',1,0,1,NULL,NULL,NULL,'','201001002','201001002027','1031','','323'),
	 (982,'GUAYAS','CHIVERIA',1,0,1,NULL,NULL,NULL,'','201001002','201001002054','1031','','682'),
	 (983,'GUAYAS','CHOBO',0,0,1,NULL,NULL,NULL,'0','0','0','1031','59083','0'),
	 (984,'GUAYAS','CHONGON',1,0,1,NULL,NULL,NULL,'','201001002','201001002032','1031','','223'),
	 (985,'GUAYAS','CHURUTE',1,0,0,NULL,NULL,NULL,'','201001002','201001009006','1031','','779'),
	 (986,'GUAYAS','COLIMES',1,0,0,NULL,NULL,NULL,'','201001002','201001002029','1031','','316'),
	 (987,'GUAYAS','COLORADAL',1,0,1,NULL,NULL,NULL,'','201001002','201001002055','1031','','572'),
	 (988,'GUAYAS','CONSUELO',1,0,0,NULL,NULL,NULL,'','201001002','','1031','','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (989,'GUAYAS','CUMANDA',0,1,0,NULL,NULL,NULL,'0','201001002','201001010010','0','0','0'),
	 (990,'GUAYAS','CUMANDA MILAGRO',0,1,0,NULL,NULL,NULL,'0','201001002','201001002078','0','0','0'),
	 (991,'GUAYAS','DATA DE PLAYAS',1,0,1,NULL,NULL,NULL,'','201001002','201001002077','1031','','573'),
	 (992,'GUAYAS','DAULE',1,1,1,NULL,NULL,NULL,'','201001002','201001002009','1031','56326','25'),
	 (993,'GUAYAS','DURAN',1,1,1,NULL,NULL,NULL,'','201001002','201001002002','1031','56327','24'),
	 (994,'GUAYAS','EL DESEO',1,0,1,NULL,NULL,NULL,'','201001002','201001002049','1031','','726'),
	 (995,'GUAYAS','EL EMPALME',1,1,1,NULL,NULL,NULL,'','201001002','','1031','56328','767'),
	 (996,'GUAYAS','EL MORRO',1,0,0,NULL,NULL,NULL,'','201001002','','1031','','118'),
	 (997,'GUAYAS','EL TRIUNFO',1,1,1,NULL,NULL,NULL,'','201001002','201001002007','1031','56329','26'),
	 (998,'GUAYAS','ELOY ALFARO - DURÁN',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','719');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (999,'GUAYAS','ENGABAO',1,0,0,NULL,NULL,NULL,'','201001002','','1031','','554'),
	 (1000,'GUAYAS','GENERAL ANTONIO ELIZALDE',1,0,0,NULL,NULL,NULL,'','201001002','','1031','','720'),
	 (1001,'GUAYAS','GENERAL VERNAZA',1,0,1,NULL,NULL,NULL,'','201001002','201001002056','1031','','111'),
	 (1002,'GUAYAS','GENERAL VILLAMIL',0,1,0,NULL,NULL,NULL,'0','201001002','201001002075','0','0','0'),
	 (1003,'GUAYAS','GUAYAQUIL',1,1,1,NULL,NULL,NULL,'','201001002','201001002001','1031','56331','1'),
	 (1004,'GUAYAS','GUAYAS',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1005,'GUAYAS','INGENIO SAN CARLOS',1,0,1,NULL,NULL,NULL,'','201001002','201001002074','1031','','727'),
	 (1006,'GUAYAS','ISIDRO AYORA',1,0,1,NULL,NULL,NULL,'','201001002','201001002025','1031','','321'),
	 (1007,'GUAYAS','JESUS MARIA',1,0,0,NULL,NULL,NULL,'','201001002','','1031','','783'),
	 (1008,'GUAYAS','JUJAN',1,0,1,NULL,NULL,NULL,'','201001002','201001002018','1031','57784','376');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1009,'GUAYAS','JUNQUILLAL',1,0,0,NULL,NULL,NULL,'','201001002','','1031','','784'),
	 (1010,'GUAYAS','KM 26 - VIRGEN DE FÁTIMA',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1011,'GUAYAS','KM 26 VIA DURAN TAMBO',0,1,0,NULL,NULL,NULL,'0','201001002','201001002039','0','0','0'),
	 (1012,'GUAYAS','LA AURORA',1,0,0,NULL,NULL,NULL,'','201001002','','1031','','0'),
	 (1013,'GUAYAS','LA MARAVILLA',1,0,1,NULL,NULL,NULL,'','201001002','201001002057','1031','','553'),
	 (1014,'GUAYAS','LA PUNTILLA',1,1,1,NULL,NULL,NULL,'','201001002','201001002072','1031','57787','18'),
	 (1015,'GUAYAS','LA T DE SALITRE',1,0,0,NULL,NULL,NULL,'','201001002','','1031','','555'),
	 (1016,'GUAYAS','LA TOMA',1,1,1,NULL,NULL,NULL,'0','201001002','201001002030','1031','59084','556'),
	 (1017,'GUAYAS','LA VICTORIA',1,1,0,NULL,NULL,NULL,'0','201001002','201001002024','0','0','0'),
	 (1018,'GUAYAS','LAS ANIMAS',1,1,0,NULL,NULL,NULL,'0','201001002','201001002050','0','0','557');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1019,'GUAYAS','LAUREL',0,1,1,NULL,NULL,NULL,'','','','','',''),
	 (1020,'GUAYAS','LIMONAL',0,1,1,NULL,NULL,NULL,'0','201001002','201001002071','1031','59085','0'),
	 (1021,'GUAYAS','LOS TINTOS',1,1,1,NULL,NULL,NULL,'0','201001002','201001002059','1031','57795','304'),
	 (1022,'GUAYAS','MANUEL J CALLE',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','769'),
	 (1023,'GUAYAS','MARCELINO MARIDUENA',1,1,0,NULL,NULL,NULL,'0','201001002','201001001030','0','0','344'),
	 (1024,'GUAYAS','MARISCAL SUCRE',1,1,1,NULL,NULL,NULL,'0','201001002','201001002051','1031','57797','346'),
	 (1025,'GUAYAS','MATILDE ESTHER',1,1,0,NULL,NULL,NULL,'0','201001002','201001002064','0','0','560'),
	 (1026,'GUAYAS','MILAGRO',1,1,1,NULL,NULL,NULL,'0','201001002','201001002003','1031','56334','6'),
	 (1027,'GUAYAS','NARANJAL',1,1,1,NULL,NULL,NULL,'0','201001002','201001002015','1031','56336','20'),
	 (1028,'GUAYAS','NARANJITO',1,1,1,NULL,NULL,NULL,'0','201001002','201001002033','1031','56337','345');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1029,'GUAYAS','NOBOL',1,1,0,NULL,NULL,NULL,'0','201001002','201001002021','0','0','317'),
	 (1030,'GUAYAS','PALESTINA',1,1,0,NULL,NULL,NULL,'0','201001002','201001002022','0','0','315'),
	 (1031,'GUAYAS','PEDRO CARBO',1,1,0,NULL,NULL,NULL,'0','201001002','201001002040','0','0','61'),
	 (1032,'GUAYAS','PETRILLO',1,1,0,NULL,NULL,NULL,'0','201001002','201001002060','0','0','318'),
	 (1033,'GUAYAS','PLAYAS',1,1,0,NULL,NULL,NULL,'0','201001002','201001002005','0','0','21'),
	 (1034,'GUAYAS','POSORJA',1,1,0,NULL,NULL,NULL,'0','201001002','201001002035','0','0','327'),
	 (1035,'GUAYAS','PROGRESO',1,1,0,NULL,NULL,NULL,'0','201001002','201001002042','0','0','326'),
	 (1036,'GUAYAS','PUENTE LUCIA',1,1,0,NULL,NULL,NULL,'0','201001002','201001002061','0','0','561'),
	 (1037,'GUAYAS','PUERTO DEL ENGABAO',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','562'),
	 (1038,'GUAYAS','PUERTO INCA',1,1,0,NULL,NULL,NULL,'0','201001002','201001002028','0','0','332');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1039,'GUAYAS','ROBERTO ASTUDILLO',1,1,1,NULL,NULL,NULL,'0','201001002','201001002052','1031','57806','343'),
	 (1040,'GUAYAS','SABANILLA (PEDRO CARBO)',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1041,'GUAYAS','SALITRE',1,1,0,NULL,NULL,NULL,'0','201001002','201001002031','0','0','305'),
	 (1042,'GUAYAS','SAMBORONDON',1,1,1,NULL,NULL,NULL,'0','201001002','201001002019','1031','56343','60'),
	 (1043,'GUAYAS','SAN ANTONIO PLAYAS',1,0,0,NULL,NULL,NULL,'0','201001002','201001002070','0','0','0'),
	 (1044,'GUAYAS','SAN ISIDRO GUAYAS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1045,'GUAYAS','SANTA LUCIA',1,1,0,NULL,NULL,NULL,'0','201001002','201001002023','0','0','314'),
	 (1046,'GUAYAS','SIMON BOLIVAR',1,1,0,NULL,NULL,NULL,'0','201001002','201001002038','0','0','479'),
	 (1047,'GUAYAS','TARIFA',1,1,0,NULL,NULL,NULL,'0','201001002','201001002063','0','0','301'),
	 (1048,'GUAYAS','TAURA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','775');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1049,'GUAYAS','TENGUEL',1,1,0,NULL,NULL,NULL,'0','201001002','201001002017','0','0','336'),
	 (1050,'LOJA','12 DE DICIEMBRE',1,0,0,NULL,NULL,NULL,'','201001012','','','','0'),
	 (1051,'IMBABURA','ADUANA',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','575'),
	 (1052,'LOJA','ALAMOR',1,0,0,NULL,NULL,NULL,'','201001012','','','','433'),
	 (1053,'LOJA','ALGARROBILLO',1,0,0,NULL,NULL,NULL,'','201001012','','','','763'),
	 (1054,'IMBABURA','ALPACHACA',1,0,1,NULL,NULL,NULL,'0','0','0','1032','57818','101'),
	 (1055,'LOJA','AMALUZA',1,0,0,NULL,NULL,NULL,'','201001012','','','','748'),
	 (1056,'IMBABURA','ANDRADE MARIN',1,1,1,NULL,NULL,NULL,'0','201001011','201001011021','1032','57819','102'),
	 (1057,'IMBABURA','ANTONIO ANTE',0,0,1,NULL,NULL,NULL,'0','201001011','201001011022','1032','56346','728'),
	 (1058,'IMBABURA','ATUNTAQUI',1,1,1,NULL,NULL,NULL,'0','201001011','201001011001','1032','57820','54');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1059,'LOJA','CALVAS',0,1,0,NULL,NULL,NULL,'0','201001012','201001012017','0','0','0'),
	 (1060,'IMBABURA','CANVALLE-MILAGRO',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1061,'IMBABURA','CARANQUI',1,1,1,NULL,NULL,NULL,'0','201001011','201001011018','1032','57821','107'),
	 (1062,'LOJA','CARIAMANGA',1,1,0,NULL,NULL,NULL,'','201001012','201001012004','','','432'),
	 (1063,'LOJA','CATACOCHA',1,1,0,NULL,NULL,NULL,'','201001012','201001012005','','','471'),
	 (1064,'LOJA','CATAMAYO',1,1,0,NULL,NULL,NULL,'','201001012','201001012002','','','429'),
	 (1065,'LOJA','CELICA',1,1,0,NULL,NULL,NULL,'','201001012','201001012011','','','584'),
	 (1066,'LOJA','CHAGUARPAMBA',1,0,0,NULL,NULL,NULL,'','201001012','','','','585'),
	 (1067,'IMBABURA','CHALTURA',1,1,1,NULL,NULL,NULL,'0','201001011','201001011023','1032','57822','108'),
	 (1068,'IMBABURA','CHORLAVI',1,1,1,NULL,NULL,NULL,'0','201001011','201001011020','1032','57823','576');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1069,'IMBABURA','COTACACHI',1,1,1,NULL,NULL,NULL,'0','201001011','201001011006','1032','56347','255'),
	 (1070,'LOJA','CRUZPAMBA',1,0,0,NULL,NULL,NULL,'','201001012','','','','764'),
	 (1071,'LOJA','EL CISNE',1,0,0,NULL,NULL,NULL,'','201001012','','','','0'),
	 (1072,'LOJA','EL EMPALME',1,1,0,NULL,NULL,NULL,'','201001012','201001002011','','','767'),
	 (1073,'LOJA','EL INGENIO',1,0,0,NULL,NULL,NULL,'','201001012','','','','754'),
	 (1074,'LOJA','EL LUCERO',1,0,0,NULL,NULL,NULL,'','201001012','','','','756'),
	 (1075,'IMBABURA','EL OLIVO',1,0,1,NULL,NULL,NULL,'0','0','0','1032','57824','577'),
	 (1076,'IMBABURA','EL RETORNO',1,0,1,NULL,NULL,NULL,'0','0','0','1032','57825','578'),
	 (1077,'LOJA','EL TAMBO',1,0,0,NULL,NULL,NULL,'','201001012','201001003009','','','0'),
	 (1078,'IMBABURA','EUGENIO ESPEJO (CALPAQUI) ',0,0,1,NULL,NULL,NULL,'0','0','0','1032','59086','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1079,'IMBABURA','GONZALEZ SUAREZ',0,1,0,NULL,NULL,NULL,'0','201001011','201001011012','0','0','0'),
	 (1080,'LOJA','GONZANAMA',1,1,0,NULL,NULL,NULL,'','201001012','201001012010','','','112'),
	 (1081,'IMBABURA','IBARRA',1,1,1,NULL,NULL,NULL,'0','201001011','201001011005','1032','56348','40'),
	 (1082,'IMBABURA','IMANTAG',0,0,1,NULL,NULL,NULL,'0','0','0','1032','59088','0'),
	 (1083,'IMBABURA','IMBAYA (SAN LUIS DE COBUENDO) ',0,0,1,NULL,NULL,NULL,'0','0','0','1032','59089','0'),
	 (1084,'LOJA','LA CEIBA',1,0,0,NULL,NULL,NULL,'','201001012','','','','762'),
	 (1085,'IMBABURA','LA ESPERANZA',0,0,1,NULL,NULL,NULL,'0','0','0','1032','59153','0'),
	 (1086,'LOJA','LOJA',1,1,1,NULL,NULL,NULL,'','201001012','201001012001','','','15'),
	 (1087,'LOJA','MACARA',1,1,0,NULL,NULL,NULL,'','201001012','201001019003','','','434'),
	 (1088,'LOJA','MALACATOS',1,1,0,NULL,NULL,NULL,'','201001012','201001012006','','','586');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1089,'LOJA','MERCADILLO',1,0,0,NULL,NULL,NULL,'','201001012','','','','0'),
	 (1090,'IMBABURA','MIRA',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1091,'IMBABURA','NATABUELA',1,1,1,NULL,NULL,NULL,'0','201001011','201001011025','1032','57826','122'),
	 (1092,'LOJA','OLMEDO',1,1,0,NULL,NULL,NULL,'','201001012','201001014019','','','732'),
	 (1093,'IMBABURA','OTAVALO',1,1,1,NULL,NULL,NULL,'0','201001011','201001011002','1032','56349','56'),
	 (1094,'LOJA','PALTAS',1,0,0,NULL,NULL,NULL,'','201001012','','','','758'),
	 (1095,'IMBABURA','PEGUCHE',0,1,1,NULL,NULL,NULL,'0','201001011','201001011013','1032','59091','0'),
	 (1096,'SANTA ELENA','ANCON',1,1,1,NULL,NULL,NULL,'0','201001023','201001002034','4125','57980','483'),
	 (1097,'SANTA ELENA','ANCONCITO',1,1,1,NULL,NULL,NULL,'0','201001023','201001002046','4125','57981','482'),
	 (1098,'SANTA ELENA','ATAHUALPA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1099,'SANTA ELENA','AYANGUE',1,1,0,NULL,NULL,NULL,'0','201001023','201001023018','0','0','0'),
	 (1100,'SANTA ELENA','BALLENITA',1,1,1,NULL,NULL,NULL,'0','201001023','201001014023','4125','57984','63'),
	 (1101,'SANTA ELENA','BARCELONA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1102,'SANTA ELENA','CADEATE',1,1,0,NULL,NULL,NULL,'0','201001023','201001023008','0','0','649'),
	 (1103,'IMBABURA','PERUGACHI',0,1,0,NULL,NULL,NULL,'0','201001011','201001011030','0','0','0'),
	 (1104,'SANTA ELENA','CAPAES',1,1,0,NULL,NULL,NULL,'0','201001023','201001023009','0','0','650'),
	 (1105,'IMBABURA','PIMAMPIRO',1,1,0,NULL,NULL,NULL,'0','201001011','201001011003','0','0','252'),
	 (1106,'LOJA','PINDAL',1,0,0,NULL,NULL,NULL,'','201001012','','','','459'),
	 (1107,'IMBABURA','PINSAQUI',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','579'),
	 (1108,'LOJA','POZUL',1,0,0,NULL,NULL,NULL,'','','','','','587');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1109,'SANTA ELENA','CHANDUY',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1110,'SANTA ELENA','CURIA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1111,'SANTA ELENA','EL TAMBO',1,0,0,NULL,NULL,NULL,'0','201001023','201001023020','0','0','651'),
	 (1112,'IMBABURA','PUERTO LAGO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','580'),
	 (1113,'SANTA ELENA','JAMBELI MONTEVERDE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','654'),
	 (1114,'SANTA ELENA','LA ENTRADA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1115,'LOS RIOS','BABA',1,1,1,NULL,NULL,NULL,'0','201001013','201001013013','1034','56368','374'),
	 (1116,'LOS RIOS','BABAHOYO',1,1,1,NULL,NULL,NULL,'0','201001013','201001013001','1034','56370','8'),
	 (1117,'LOS RIOS','BUENA FE',1,1,1,NULL,NULL,NULL,'0','201001013','201001013005','1034','56369','46'),
	 (1118,'LOS RIOS','CALUMA',0,1,0,NULL,NULL,NULL,'0','201001013','201001004007','0','0','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1119,'LOS RIOS','CARACOL',1,0,1,NULL,NULL,NULL,'0','0','0','1034','57854','589'),
	 (1120,'LOS RIOS','CATARAMA',1,1,0,NULL,NULL,NULL,'0','201001013','201001012003','0','0','385'),
	 (1121,'LOS RIOS','ECHEANDIA',0,1,0,NULL,NULL,NULL,'0','201001013','201001004002','0','0','0'),
	 (1122,'LOS RIOS','EL EMPALME',0,1,0,NULL,NULL,NULL,'0','201001013','201001002011','0','0','227'),
	 (1123,'LOS RIOS','ENTRADA DE SAN JUAN',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','590'),
	 (1124,'LOS RIOS','FEBRES CORDERO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1125,'LOS RIOS','FUMISA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','591'),
	 (1126,'LOS RIOS','GUARE',0,1,0,NULL,NULL,NULL,'0','201001013','201001013027','0','0','0'),
	 (1127,'LOS RIOS','GUARE DE BABA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1128,'LOS RIOS','ISLA DE BEJUCAL',1,1,0,NULL,NULL,NULL,'0','201001013','201001013021','0','0','375');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1129,'LOS RIOS','LA 14 VIA EL PARAISO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','734'),
	 (1130,'LOS RIOS','LA CARMELA - GUARE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1131,'LOS RIOS','LA ESMERALDA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1132,'LOS RIOS','LA ESPERANZA',1,1,0,NULL,NULL,NULL,'0','201001013','201001013026','0','0','593'),
	 (1133,'LOS RIOS','LA JULIA',1,1,0,NULL,NULL,NULL,'0','201001013','201001013025','0','0','594'),
	 (1134,'LOS RIOS','LA UNION BABAHOYO',1,0,1,NULL,NULL,NULL,'0','0','0','1034','57866','0'),
	 (1135,'LOS RIOS','LA UNION VALENCIA',1,1,1,NULL,NULL,NULL,'0','0','0','1034','57867','0'),
	 (1136,'LOS RIOS','MATA DE CACAO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','380'),
	 (1137,'LOS RIOS','MOCACHE',1,1,1,NULL,NULL,NULL,'0','201001013','201001013007','1034','56371','232'),
	 (1138,'LOS RIOS','MONTALVO',1,1,0,NULL,NULL,NULL,'0','201001013','201001013009','0','0','377');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1139,'LOS RIOS','NUEVA UNION (LOS RIOS)',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1140,'LOS RIOS','PALENQUE',1,1,0,NULL,NULL,NULL,'0','201001013','201001002036','0','0','378'),
	 (1141,'LOS RIOS','PALMISA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','597'),
	 (1142,'LOS RIOS','PATRICIA PILAR',1,0,0,NULL,NULL,NULL,'0','201001013','201001013010','0','0','280'),
	 (1143,'LOS RIOS','PIMOCHA',1,0,1,NULL,NULL,NULL,'0','0','0','1034','57873','0'),
	 (1144,'LOS RIOS','PROGRESO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1145,'LOS RIOS','PUEBLO NUEVO LOS RIOS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1146,'LOS RIOS','PUEBLO VIEJO',1,1,1,NULL,NULL,NULL,'0','201001013','201001013012','1034','56374','384'),
	 (1147,'LOS RIOS','QUEVEDO',1,1,1,NULL,NULL,NULL,'0','201001013','201001013002','1034','56375','9'),
	 (1148,'LOS RIOS','QUINSALOMA',1,1,0,NULL,NULL,NULL,'0','201001013','201001013019','0','0','71');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1149,'LOS RIOS','RECINTO 3 MARIAS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1150,'LOS RIOS','RICAURTE',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','387'),
	 (1151,'LOS RIOS','SAN CAMILO',1,1,1,NULL,NULL,NULL,'0','201001013','201001013014','1034','57876','55'),
	 (1152,'LOS RIOS','SAN CARLOS',0,1,1,NULL,NULL,NULL,'0','201001013','201001013015','1034','57877','233'),
	 (1153,'LOS RIOS','SAN CARLOS (LOS RIOS)',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','233'),
	 (1154,'LOS RIOS','SAN JACINTO DE BUENA FE',0,1,0,NULL,NULL,NULL,'0','201001013','201001013023','0','0','0'),
	 (1155,'LOS RIOS','SAN JOSE DEL TAMBO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1156,'LOS RIOS','SAN JUAN',1,0,0,NULL,NULL,NULL,'0','201001013','201001013008','0','0','386'),
	 (1157,'LOS RIOS','SAN JUAN BABAHOYO',0,1,0,NULL,NULL,NULL,'0','201001013','201001013022','0','0','386'),
	 (1158,'LOS RIOS','SAN LUIS DE PAMBIL',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','735');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1159,'LOS RIOS','TRES POSTES',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1160,'LOS RIOS','URDANETA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','133'),
	 (1161,'LOS RIOS','VALENCIA',1,1,1,NULL,NULL,NULL,'0','201001013','201001013004','1034','56377','181'),
	 (1162,'LOS RIOS','VENTANAS',1,1,1,NULL,NULL,NULL,'0','201001013','201001013003','1034','56378','12'),
	 (1163,'LOS RIOS','VINCES',1,1,1,NULL,NULL,NULL,'0','201001013','201001013006','1034','56379','57'),
	 (1164,'LOS RIOS','ZAPOTAL',0,0,1,NULL,NULL,NULL,'0','0','0','1034','57881','134'),
	 (1165,'LOS RIOS','ZAPOTAL (LOS RIOS)',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','134'),
	 (1166,'LOS RIOS','ZULEMA',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','774'),
	 (1167,'MANABI','ABDON CALDERON (SAN FRANCISCO)',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1168,'MANABI','ALHAJUELA',1,1,1,NULL,NULL,NULL,'0','0','0','1035','57883','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1169,'MANABI','ARENALES',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','601'),
	 (1170,'MANABI','ATAHUALPA MANABI',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','602'),
	 (1171,'MANABI','AYACUCHO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1172,'MANABI','AYAMPE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1173,'MANABI','BACHILLERO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','103'),
	 (1174,'MANABI','BAHIA DE CARAQUEZ',1,1,0,NULL,NULL,NULL,'0','201001014','201001014003','0','0','30'),
	 (1175,'MANABI','BASE NAVAL JARAMIJO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1176,'MANABI','BELLAVISTA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','105'),
	 (1177,'MANABI','CALCETA',1,1,1,NULL,NULL,NULL,'0','201001014','201001014016','1035','57890','53'),
	 (1178,'MANABI','CALDERON (MANABI)',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1179,'MANABI','CANITAS',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','606'),
	 (1180,'MANABI','CANOA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','424'),
	 (1181,'MANABI','CANUTO',1,1,1,NULL,NULL,NULL,'0','201001014','201001014032','1035','57894','106'),
	 (1182,'MANABI','CASCOL',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','427'),
	 (1183,'MANABI','CERECITO (VIA CRUCITA)',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1184,'MANABI','CHARAPOTO',1,1,0,NULL,NULL,NULL,'0','201001014','201001014015','0','0','417'),
	 (1185,'MANABI','CHEVE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','607'),
	 (1186,'MANABI','CHONE',1,1,1,NULL,NULL,NULL,'0','201001014','201001014004','1035','56381','95'),
	 (1187,'MANABI','CIUDAD ALFARO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','608'),
	 (1188,'MANABI','COAQUE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','609');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1189,'MANABI','COJIMIES',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','610'),
	 (1190,'MANABI','COLON',1,1,0,NULL,NULL,NULL,'0','201001014','201001014011','0','0','399'),
	 (1191,'MANABI','COLORADO',1,1,0,NULL,NULL,NULL,'0','201001014','201001014044','0','0','684'),
	 (1192,'MANABI','COSTA AZUL',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1193,'MANABI','CRUCITA',1,1,1,NULL,NULL,NULL,'0','201001014','201001014010','1035','57903','400'),
	 (1194,'MANABI','DON JUAN',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','611'),
	 (1195,'MANABI','EL CARMEN',1,1,1,NULL,NULL,NULL,'0','201001014','201001014005','1035','56382','74'),
	 (1196,'MANABI','EL MATAL',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','612'),
	 (1197,'MANABI','EL NARANJO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1198,'MANABI','EL RODEO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','613');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1199,'MANABI','ESTANCILLA',0,1,0,NULL,NULL,NULL,'0','201001014','201001014033','0','0','0'),
	 (1200,'MANABI','FLAVIO ALFARO',1,1,0,NULL,NULL,NULL,'0','201001014','201001014021','0','0','413'),
	 (1201,'MANABI','HIGUERON (VIA CRUCITA)',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1202,'MANABI','JAMA',1,1,0,NULL,NULL,NULL,'0','201001014','201001014024','0','0','421'),
	 (1203,'MANABI','JARAMIJO',1,1,1,NULL,NULL,NULL,'0','201001014','201001014013','1035','56387','409'),
	 (1204,'MANABI','JIPIJAPA',1,1,0,NULL,NULL,NULL,'0','201001014','201001014006','0','0','97'),
	 (1205,'MANABI','JUNIN',1,1,0,NULL,NULL,NULL,'0','201001014','201001014009','0','0','414'),
	 (1206,'MANABI','LA CHORRERA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','739'),
	 (1207,'MANABI','LA DELICIA KM. 29',0,1,0,NULL,NULL,NULL,'0','201001014','201001014035','0','0','0'),
	 (1208,'MANABI','LA ESTANCILLA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','412');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1209,'MANABI','LA SEGUA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1210,'MANABI','LA SEQUITA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1211,'MANABI','LAS TUNAS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1212,'MANABI','LEONIDAS PLAZA',1,1,0,NULL,NULL,NULL,'0','201001014','201001014027','0','0','415'),
	 (1213,'MANABI','LODANA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','614'),
	 (1214,'MANABI','LOS BAJOS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','615'),
	 (1215,'MANABI','MACHALILLA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','117'),
	 (1216,'MANABI','MANTA',1,1,1,NULL,NULL,NULL,'0','201001014','201001014001','1035','56388','13'),
	 (1217,'MANABI','MEJIA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1218,'MANABI','MONTECRISTI',1,1,1,NULL,NULL,NULL,'0','201001014','201001014020','1035','56389','90');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1219,'MANABI','NUEVO BRICENO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','617'),
	 (1220,'MANABI','NUEVO ISRAEL',0,1,0,NULL,NULL,NULL,'0','201001014','201001017009','0','0','0'),
	 (1221,'MANABI','OLMEDO (MANABI)',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1222,'MANABI','PAJAN',1,1,0,NULL,NULL,NULL,'0','201001014','201001014014','0','0','425'),
	 (1223,'MANABI','PAQUISHA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1224,'MANABI','PAVON',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1225,'MANABI','PEDERNALES',1,1,0,NULL,NULL,NULL,'0','201001014','201001010009','0','0','70'),
	 (1226,'MANABI','PICHINCHA',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','234'),
	 (1227,'MANABI','PICOAZA DENTRO DEL PERIMETRO URBANO',0,1,0,NULL,NULL,NULL,'0','201001014','201001014037','0','0','0'),
	 (1228,'MANABI','PLAYA PRIETA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','740');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1229,'MANABI','PORTOVIEJO',1,1,1,NULL,NULL,NULL,'0','201001014','201001014002','1035','56395','3'),
	 (1230,'MANABI','PUEBLO NUEVO',1,0,1,NULL,NULL,NULL,'0','0','0','1035','57874','126'),
	 (1231,'MANABI','PUEBLO NUEVO /  MANABI',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','126'),
	 (1232,'MANABI','PUERTO CAYO',1,1,0,NULL,NULL,NULL,'0','201001014','201001014029','0','0','0'),
	 (1233,'MANABI','PUERTO CHICO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1234,'MANABI','PUERTO LOPEZ',1,1,0,NULL,NULL,NULL,'0','201001014','201001014022','0','0','426'),
	 (1235,'MANABI','QUIROGA CHONE',0,1,0,NULL,NULL,NULL,'0','201001014','201001014043','0','0','0'),
	 (1236,'MANABI','RESBALON',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1237,'MANABI','RICAURTE',1,1,1,NULL,NULL,NULL,'0','0','0','1035','59150','737'),
	 (1238,'MANABI','RIO CHICO',1,1,1,NULL,NULL,NULL,'0','0','0','1035','57921','599');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1239,'MANABI','ROCAFUERTE',1,1,1,NULL,NULL,NULL,'0','201001014','201001014012','1035','56396','401'),
	 (1240,'MANABI','SALAITE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1241,'MANABI','SALANGO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1242,'MANABI','SAN ANTONIO / MANABI',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1243,'MANABI','SAN ANTONIO DE CHONE',0,1,0,NULL,NULL,NULL,'0','201001014','201001014034','0','0','0'),
	 (1244,'MANABI','SAN CLEMENTE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','618'),
	 (1245,'MANABI','SAN IGNACIO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1246,'MANABI','SAN ISIDRO / BAHIA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1247,'MANABI','SAN JACINTO',1,0,0,NULL,NULL,NULL,'0','201001014','201001014025','0','0','419'),
	 (1248,'MANABI','SAN PEDRO DE SUMA',0,0,1,NULL,NULL,NULL,'0','0','0','1035','59099','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1249,'MANABI','SAN PLACIDO',1,1,1,NULL,NULL,NULL,'0','0','0','1035','57927','619'),
	 (1250,'MANABI','SAN VICENTE',1,1,0,NULL,NULL,NULL,'0','201001014','201001014018','0','0','416'),
	 (1251,'MANABI','SANCAN',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','620'),
	 (1252,'MANABI','SANTA ANA / MANABI',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1253,'MANABI','SANTA RITA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1254,'MANABI','SESME',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1255,'MANABI','SOSOTE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','622'),
	 (1256,'MANABI','SUCRE',0,1,0,NULL,NULL,NULL,'0','201001014','201001014042','0','0','0'),
	 (1257,'MANABI','SUCRE BAHIA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','736'),
	 (1258,'MANABI','TARQUI MANABÍ',0,1,0,NULL,NULL,NULL,'0','201001014','201001014041','0','0','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1259,'MANABI','TOSAGUA',1,1,1,NULL,NULL,NULL,'0','201001014','201001014017','1035','56400','73'),
	 (1260,'MANABI','VALDEZ',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1261,'MANABI','ZAPALLO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1262,'MORONA SANTIAGO','GENERAL PROAÑO',0,0,1,NULL,NULL,NULL,'0','0','0','1036','59100','0'),
	 (1263,'MORONA SANTIAGO','GUALAQUIZA',1,0,0,NULL,NULL,NULL,'0','201001015','201001015002','0','0','33'),
	 (1264,'MORONA SANTIAGO','HUAMBOYA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1265,'MORONA SANTIAGO','LIMON INDANZA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','494'),
	 (1266,'MORONA SANTIAGO','LOGRONO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1267,'MORONA SANTIAGO','MACAS',1,1,1,NULL,NULL,NULL,'0','201001015','201001015001','1036','57932','85'),
	 (1268,'MORONA SANTIAGO','MENDEZ',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','495');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1269,'MORONA SANTIAGO','PABLO SEXTO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1270,'MORONA SANTIAGO','PALORA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','297'),
	 (1271,'MORONA SANTIAGO','RIO BLANCO',0,0,1,NULL,NULL,NULL,'0','0','0','1036','59101','0'),
	 (1272,'MORONA SANTIAGO','SAN ISIDRO',0,0,1,NULL,NULL,NULL,'0','0','0','1036','59102','0'),
	 (1273,'MORONA SANTIAGO','SEVILLA DON BOSCO',0,0,1,NULL,NULL,NULL,'0','0','0','1036','59103','0'),
	 (1274,'MORONA SANTIAGO','SUCUA',1,1,0,NULL,NULL,NULL,'0','201001015','201001017007','0','0','773'),
	 (1275,'MORONA SANTIAGO','TIWINTZA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1276,'NAPO','ARCHIDONA',1,1,1,NULL,NULL,NULL,'0','201001016','201001016003','1037','56413','624'),
	 (1277,'NAPO','AROSEMENA TOLA',1,1,0,NULL,NULL,NULL,'0','201001016','201001016006','0','0','298'),
	 (1278,'NAPO','BAEZA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','489');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1279,'NAPO','BORJA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','492'),
	 (1280,'NAPO','CARLOS JULIO AROSEMENA',0,1,0,NULL,NULL,NULL,'0','201001016','201001016009','0','0','0'),
	 (1281,'NAPO','CARLOS JULIO AROSEMENA TOLA',0,1,0,NULL,NULL,NULL,'0','201001016','201001016008','0','0','0'),
	 (1282,'NAPO','COTUNDO',1,0,1,NULL,NULL,NULL,'0','0','0','1037','57938','741'),
	 (1283,'NAPO','EL CHACO',1,1,0,NULL,NULL,NULL,'0','201001016','201001017012','0','0','491'),
	 (1284,'NAPO','GONZALO PIZARRO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','625'),
	 (1285,'NAPO','MISAHUALLI',0,1,0,NULL,NULL,NULL,'0','201001016','201001016005','0','0','0'),
	 (1286,'NAPO','NUEVA ESPERANZA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','626'),
	 (1287,'NAPO','PANO ',0,0,1,NULL,NULL,NULL,'0','0','0','1037','59104','0'),
	 (1288,'NAPO','PUERTO MISAHUALLI',0,0,1,NULL,NULL,NULL,'0','0','0','1037','59105','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1289,'NAPO','PUERTO NAPO',1,1,1,NULL,NULL,NULL,'0','201001016','201001016007','1037','57941','627'),
	 (1290,'NAPO','SAN PABLO DE USHPAYACU',0,0,1,NULL,NULL,NULL,'0','0','0','1037','59106','0'),
	 (1291,'NAPO','TAZAYACU',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','742'),
	 (1292,'NAPO','TENA',1,1,1,NULL,NULL,NULL,'0','201001016','201001016001','1037','56417','78'),
	 (1293,'ORELLANA','EL COCA',1,0,1,NULL,NULL,NULL,'0','201001017','201001017002','1038','57943','38'),
	 (1294,'ORELLANA','JOYA DE LOS SACHAS',1,1,1,NULL,NULL,NULL,'0','0','0','1038','56420','291'),
	 (1295,'ORELLANA','LORETO',1,1,0,NULL,NULL,NULL,'0','201001017','201001017016','0','0','116'),
	 (1296,'ORELLANA','FRANCISCO DE ORELLANA EL COCA',0,1,1,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1297,'ORELLANA','PUERTO FRANCISCO DE ORELLANA (EL COCA)',0,0,1,NULL,NULL,NULL,'0','0','0','1038','57318','0'),
	 (1298,'ORELLANA','FRANCISCO DE ORELLANA',0,0,1,NULL,NULL,NULL,'0','201001017','201001017001','1038','56419','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1299,'ORELLANA','ENOKANQUI ',0,0,1,NULL,NULL,NULL,'0','0','0','1038','59107','0'),
	 (1300,'ORELLANA','SAN CARLOS',0,0,1,NULL,NULL,NULL,'0','0','0','1038','59109','0'),
	 (1301,'ORELLANA','SAN SEBASTIAN DEL COCA',0,0,1,NULL,NULL,NULL,'0','0','0','1038','59110','0'),
	 (1302,'ORELLANA','LAGO SAN PEDRO',0,0,1,NULL,NULL,NULL,'0','0','0','1038','59108','0'),
	 (1303,'ORELLANA','UNION MILAGREÑA',0,0,1,NULL,NULL,NULL,'0','0','0','1038','59111','0'),
	 (1304,'PASTAZA','10 DE AGOSTO',1,0,1,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1305,'PASTAZA','AMERICAS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1306,'PASTAZA','ARAJUNO ',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1307,'PASTAZA','EL CAPRICHO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1308,'PASTAZA','EL TRIUNFO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1309,'PASTAZA','MERA',1,0,1,NULL,NULL,NULL,'0','0','0','1039','56423','296'),
	 (1310,'PASTAZA','PUYO',1,1,1,NULL,NULL,NULL,'0','201001018','201001018001','1039','57319','22'),
	 (1311,'PASTAZA','SAN JOSE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1312,'PASTAZA','SANTA CLARA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','293'),
	 (1313,'PASTAZA','SHELL (EL PUYO)',1,0,1,NULL,NULL,NULL,'0','0','0','0','0','295'),
	 (1314,'PASTAZA','TNT HUGO ORTIZ',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1315,'PASTAZA','SHELL ',0,1,1,NULL,NULL,NULL,'0','201001018','201001017004','1039','57660','295'),
	 (1316,'PASTAZA','FATIMA',0,0,1,NULL,NULL,NULL,'0','0','0','1039','59113','292'),
	 (1317,'PICHINCHA','ALANGASI',1,1,1,NULL,NULL,NULL,'0','201001001','201001001031','1040','57944','628'),
	 (1318,'PICHINCHA','ALOAG',1,1,0,NULL,NULL,NULL,'0','201001001','201001001019','0','0','441');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1319,'PICHINCHA','ALOASI',1,1,0,NULL,NULL,NULL,'0','201001001','201001001046','0','0','629'),
	 (1320,'PICHINCHA','AMAGUANA',1,1,1,NULL,NULL,NULL,'0','201001001','201001001018','1040','57947','442'),
	 (1321,'PICHINCHA','ASCAZUBI ',0,1,0,NULL,NULL,NULL,'0','201001001','201001001062','0','0','0'),
	 (1322,'PICHINCHA','AYORA',1,1,1,NULL,NULL,NULL,'0','201001001','201001001042','1040','57948','630'),
	 (1323,'PICHINCHA','BICENTENARIO - REPLICA MONTUFAR',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1324,'PICHINCHA','CAJAS',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1325,'PICHINCHA','CALACALI',1,1,0,NULL,NULL,NULL,'0','201001001','201001001022','0','0','631'),
	 (1326,'PICHINCHA','CALDERON',1,1,1,NULL,NULL,NULL,'0','201001001','201001001024','1040','57891','632'),
	 (1327,'PICHINCHA','CAYAMBE',1,1,1,NULL,NULL,NULL,'0','201001001','201001001002','1040','56426','48'),
	 (1328,'PICHINCHA','CHECA',0,1,0,NULL,NULL,NULL,'0','201001001','201001001063','0','0','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1329,'PICHINCHA','COLINAS DEL NORTE',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1330,'PICHINCHA','CONOCOTO',1,1,1,NULL,NULL,NULL,'0','201001001','201001001033','1040','57951','444'),
	 (1331,'PICHINCHA','COTOGCHOA',0,0,1,NULL,NULL,NULL,'0','0','0','1040','59114','0'),
	 (1332,'PICHINCHA','CUMBAYA',1,1,1,NULL,NULL,NULL,'0','201001001','201001001009','1040','57952','47'),
	 (1333,'PICHINCHA','CUSUBAMBA',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','633'),
	 (1334,'PICHINCHA','EL CHAUPI',0,1,0,NULL,NULL,NULL,'0','201001001','201001001071','0','0','0'),
	 (1335,'PICHINCHA','EL QUINCHE',0,1,0,NULL,NULL,NULL,'0','201001001','201001001007','0','0','0'),
	 (1336,'PICHINCHA','GOLONDRINAS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1337,'PICHINCHA','GUANGOPOLO',0,1,1,NULL,NULL,NULL,'0','201001001','201001001070','1040','59115','0'),
	 (1338,'PICHINCHA','GUAYLLABAMBA',1,1,0,NULL,NULL,NULL,'0','201001001','201001001014','0','0','445');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1339,'PICHINCHA','JUAN MONTALVO',1,1,0,NULL,NULL,NULL,'0','201001001','201001001045','0','0','635'),
	 (1340,'PICHINCHA','LA ARMENIA',1,1,1,NULL,NULL,NULL,'0','201001001','201001001047','1040','57957','636'),
	 (1341,'PICHINCHA','LA ESPERANZA',0,1,1,NULL,NULL,NULL,'0','0','0','1040','59154','0'),
	 (1342,'PICHINCHA','LA MERCED',0,0,1,NULL,NULL,NULL,'0','0','0','1040','59117','113'),
	 (1343,'PICHINCHA','LA ROLDOS',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1344,'PICHINCHA','LA SEXTA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1345,'PICHINCHA','LLANO CHICO',1,1,1,NULL,NULL,NULL,'0','201001001','201001001048','1040','57958','637'),
	 (1346,'PICHINCHA','LLANO GRANDE',1,1,1,NULL,NULL,NULL,'0','201001001','201001001049','1040','57959','686'),
	 (1347,'PICHINCHA','MACHACHI',1,1,0,NULL,NULL,NULL,'0','201001001','201001001008','0','0','455'),
	 (1348,'PICHINCHA','MEJIA',1,1,0,NULL,NULL,NULL,'0','201001001','201001001069','0','0','743');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1349,'PICHINCHA','MIRAVALLE',1,1,1,NULL,NULL,NULL,'0','201001001','201001001051','1040','57961','687'),
	 (1350,'PICHINCHA','MITAD DEL MUNDO',0,1,0,NULL,NULL,NULL,'0','201001001','201001001021','0','0','29'),
	 (1351,'PICHINCHA','MONJAS',1,1,0,NULL,NULL,NULL,'0','201001001','201001002043','0','0','639'),
	 (1352,'PICHINCHA','NANEGALITO',1,1,0,NULL,NULL,NULL,'0','201001001','201001001029','0','0','121'),
	 (1353,'PICHINCHA','NAYON ',0,0,1,NULL,NULL,NULL,'0','0','0','1040','59155','0'),
	 (1354,'PICHINCHA','NONO',0,1,0,NULL,NULL,NULL,'0','201001001','201001001068','0','0','0'),
	 (1355,'PICHINCHA','OLMEDO (PESILLO)',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1356,'PICHINCHA','ORQUIDEAS',0,1,0,NULL,NULL,NULL,'0','201001001','201001001052','0','0','0'),
	 (1357,'PICHINCHA','OTON',0,1,1,NULL,NULL,NULL,'0','0','0','1040','59156','0'),
	 (1358,'PICHINCHA','PEDRO MONCAYO',0,1,1,NULL,NULL,NULL,'0','201001001','201001001035','1040','56428','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1359,'PICHINCHA','PEDRO VICENTE MALDONADO',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','451'),
	 (1360,'PICHINCHA','PIFO',1,1,1,NULL,NULL,NULL,'0','201001001','201001001025','1040','57964','448'),
	 (1361,'PICHINCHA','PINTAG',1,1,1,NULL,NULL,NULL,'0','201001001','201001001036','1040','57965','641'),
	 (1362,'PICHINCHA','PISULI',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1363,'PICHINCHA','PLANADA',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1364,'PICHINCHA','POMASQUI',1,1,1,NULL,NULL,NULL,'0','201001001','201001001028','1040','57966','130'),
	 (1365,'PICHINCHA','PUEMBO',1,1,1,NULL,NULL,NULL,'0','201001001','201001001026','1040','57967','449'),
	 (1366,'PICHINCHA','PUERTO QUITO',1,1,0,NULL,NULL,NULL,'0','201001001','201001001013','0','0','452'),
	 (1367,'PICHINCHA','PUSUQUI',1,1,1,NULL,NULL,NULL,'0','201001001','201001001041','1040','57968','463'),
	 (1368,'PICHINCHA','QUINCHE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','450');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1369,'PICHINCHA','QUITO',1,1,1,NULL,NULL,NULL,'0','201001001','201001001001','1040','56431','2'),
	 (1370,'PICHINCHA','RUMIÑAHUI',0,1,1,NULL,NULL,NULL,'0','0','0','1040','56432','0'),
	 (1371,'PICHINCHA','RUMIPAMBA',0,1,0,NULL,NULL,NULL,'0','201001001','201001001065','0','0','0'),
	 (1372,'PICHINCHA','SAN ANTONIO DE PICHINCHA',1,1,1,NULL,NULL,NULL,'0','201001001','201001001053','1040','57970','642'),
	 (1373,'PICHINCHA','SAN JOSE DE MORAN',1,1,1,NULL,NULL,NULL,'0','201001001','201001001054','1040','57971','643'),
	 (1374,'PICHINCHA','SAN JUAN DE CALDERON',1,0,1,NULL,NULL,NULL,'0','0','0','1040','57972','644'),
	 (1375,'PICHINCHA','SAN MIGUEL DE LOS BANCOS',1,1,0,NULL,NULL,NULL,'0','201001001','201001001010','0','0','645'),
	 (1376,'PICHINCHA','SAN MIGUEL DE OYACOTO',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1377,'PICHINCHA','SAN RAFAEL',1,1,1,NULL,NULL,NULL,'0','201001001','201001001006','1040','59094','27'),
	 (1378,'PICHINCHA','SANGOLQUI',1,1,1,NULL,NULL,NULL,'0','201001001','201001001005','1040','57974','28');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1379,'PICHINCHA','TABABELA',1,1,1,NULL,NULL,NULL,'0','201001001','201001001056','1040','57975','646'),
	 (1380,'PICHINCHA','TABACUNDO',1,1,1,NULL,NULL,NULL,'0','201001001','201001001003','1040','57976','454'),
	 (1381,'PICHINCHA','TAMBILLO',1,1,0,NULL,NULL,NULL,'0','201001001','201001021003','0','0','456'),
	 (1382,'PICHINCHA','TOCACHI',0,0,1,NULL,NULL,NULL,'0','0','0','1040','59157','0'),
	 (1383,'PICHINCHA','TUMBACO',1,1,1,NULL,NULL,NULL,'0','201001001','201001001020','1040','59158','31'),
	 (1384,'PICHINCHA','TUPIGACHI',0,1,1,NULL,NULL,NULL,'0','0','0','1040','59159','0'),
	 (1385,'PICHINCHA','UYUMBICHO',1,1,0,NULL,NULL,NULL,'0','201001001','201001001057','0','0','647'),
	 (1386,'PICHINCHA','VALLE DE LOS CHILLOS',0,1,0,NULL,NULL,NULL,'0','201001001','201001001039','0','0','0'),
	 (1387,'PICHINCHA','YARUQUI',0,1,1,NULL,NULL,NULL,'0','201001001','201001001037','1040','59160','453'),
	 (1388,'PICHINCHA','ZAMBISA',0,1,0,NULL,NULL,NULL,'0','201001001','201001001058','0','0','648');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1389,'SANTA ELENA','LA LIBERTAD',1,0,1,NULL,NULL,NULL,'0','201001023','201001002013','4125','56435','14'),
	 (1390,'SANTA ELENA','LIBERTADOR BOLIVAR',1,1,0,NULL,NULL,NULL,'0','201001023','201001023010','0','0','653'),
	 (1391,'LOJA','QUILANGA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','755'),
	 (1392,'IMBABURA','QUIROGA',1,1,1,NULL,NULL,NULL,'0','201001011','201001011014','1032','57829','127'),
	 (1393,'IMBABURA','QUIROGA OTAVALO',0,1,0,NULL,NULL,NULL,'0','201001011','201001011032','0','0','127'),
	 (1394,'SANTA ELENA','MANGLARALTO',1,1,0,NULL,NULL,NULL,'0','201001023','201001023011','0','0','480'),
	 (1395,'SANTA ELENA','MAR BRAVA',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (1396,'SANTA ELENA','MONTANITA',1,1,0,NULL,NULL,NULL,'0','201001023','201001023003','0','0','62'),
	 (1397,'SANTA ELENA','MONTEVERDE',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (1398,'SANTA ELENA','MUEY',1,1,1,NULL,NULL,NULL,'0','201001023','201001023005','4125','57996','342');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1399,'SANTA ELENA','OLON',1,1,0,NULL,NULL,NULL,'0','201001023','201001023006','0','0','655'),
	 (1400,'SANTA ELENA','OLONCITO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','655'),
	 (1401,'SANTA ELENA','PALMAR',1,1,0,NULL,NULL,NULL,'0','201001023','201001023013','0','0','477'),
	 (1402,'LOJA','RIO PLAYAS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','765'),
	 (1403,'SANTA ELENA','PROSPERIDAD',1,1,0,NULL,NULL,NULL,'0','201001023','201001023014','0','0','656'),
	 (1404,'SANTA ELENA','PUERTE SANTA ROSA',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (1405,'SANTA ELENA','PUNTA BARANDUA',1,1,0,NULL,NULL,NULL,'0','201001023','201001023015','0','0','657'),
	 (1406,'SANTA ELENA','PUNTA BLANCA',1,1,0,NULL,NULL,NULL,'0','201001023','201001023002','0','0','474'),
	 (1407,'SANTA ELENA','PUNTA CARNERO',1,1,0,NULL,NULL,NULL,'0','201001023','201001023001','0','0','658'),
	 (1408,'SANTA ELENA','PUNTA CENTINELA',1,1,0,NULL,NULL,NULL,'0','201001023','201001023019','0','0','475');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1409,'LOJA','ROBLONES',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','761'),
	 (1410,'LOJA','SABANILLA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','760'),
	 (1411,'LOJA','SABIANGO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1412,'IMBABURA','SAN ANTONIO ',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1413,'IMBABURA','SAN ANTONIO DE IBARRA',1,1,1,NULL,NULL,NULL,'0','0','0','1032','57830','250'),
	 (1414,'SANTA ELENA','SALINAS',0,0,1,NULL,NULL,NULL,'0','201001023','201001002004','4125','57680','5'),
	 (1415,'SANTA ELENA','SALINAS / SANTA ELENA',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','5'),
	 (1416,'IMBABURA','SAN BLAS',0,0,1,NULL,NULL,NULL,'0','0','0','1032','59092','0'),
	 (1417,'SANTA ELENA','SAN JOSE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1418,'IMBABURA','SAN FRANCISCO DE NATABUELA',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1419,'SANTA ELENA','SAN PABLO / SANTA ELENA',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1420,'IMBABURA','SAN JOSE',0,1,0,NULL,NULL,NULL,'0','201001011','201001011026','0','0','581'),
	 (1421,'SANTA ELENA','SAN PEDRO',1,1,0,NULL,NULL,NULL,'0','201001023','201001011007','0','0','481'),
	 (1422,'LOJA','SAN JOSE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1423,'IMBABURA','SAN JUAN DE ILUMAN',0,0,1,NULL,NULL,NULL,'0','0','0','1032','59093','0'),
	 (1424,'SANTO DOMINGO','ABRAHAM CALAZACÓN ',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1425,'SANTO DOMINGO','ALLURIQUIN',1,0,1,NULL,NULL,NULL,'0','0','0','0','0','282'),
	 (1426,'SANTO DOMINGO','BOMBOLI',0,0,1,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1427,'SANTO DOMINGO','CHIGUILPE ',0,0,1,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1428,'SANTO DOMINGO','KM 14 QUEVEDO',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','659');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1429,'SANTO DOMINGO','KM 24 QUEVEDO',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','660'),
	 (1430,'SANTO DOMINGO','KM 38.5 VIA QUEVEDO',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','661'),
	 (1431,'SANTO DOMINGO','KM 41 VIA QUEVEDO',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','662'),
	 (1432,'SANTO DOMINGO','LA CONCORDIA',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1433,'SANTO DOMINGO','LA UNION',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1434,'SANTO DOMINGO','LAS DELICIAS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','688'),
	 (1435,'SANTO DOMINGO','LUZ DE AMERICA',1,1,1,NULL,NULL,NULL,'0','0','0','0','0','663'),
	 (1436,'SANTO DOMINGO','MONTERREY',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1437,'SANTO DOMINGO','NUEVO ISRAEL',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','664'),
	 (1438,'SANTO DOMINGO','PATRICIA PILAR',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1439,'SANTO DOMINGO','PUERTO LIMON',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','744'),
	 (1440,'SANTO DOMINGO','RÍO TOACHI ',0,0,1,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1441,'SANTO DOMINGO','SAN JACINTO DEL BUA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','745'),
	 (1442,'SANTO DOMINGO','SANTO DOMINGO',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','11'),
	 (1443,'SANTO DOMINGO','SANTO DOMINGO DE LOS COLORADOS',0,0,1,NULL,NULL,NULL,'0','0','0','0','0','11'),
	 (1444,'SANTO DOMINGO','VALLE HERMOSO',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','665'),
	 (1445,'SANTO DOMINGO','VILLEGAS',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1446,'SUCUMBIOS','7 DE JULIO',1,0,1,NULL,NULL,NULL,'0','0','0','1041','58022','666'),
	 (1447,'SUCUMBIOS','CASCALES',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','667'),
	 (1448,'SUCUMBIOS','EL ENO',0,0,1,NULL,NULL,NULL,'0','0','0','1041','59129','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1449,'SUCUMBIOS','GENERAL FARFAN',0,0,1,NULL,NULL,NULL,'0','0','0','1041','59130','0'),
	 (1450,'SUCUMBIOS','JAMBELI',0,0,1,NULL,NULL,NULL,'0','0','0','1041','59131','0'),
	 (1451,'SUCUMBIOS','JIVINO VERDE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','668'),
	 (1452,'SUCUMBIOS','LAGO AGRIO',1,1,1,NULL,NULL,NULL,'0','201001022','201001017003','1041','56441','17'),
	 (1453,'SUCUMBIOS','LUMBAQUI',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','670'),
	 (1454,'SUCUMBIOS','NUEVA LOJA',0,1,1,NULL,NULL,NULL,'0','201001022','201001022001','0','0','0'),
	 (1455,'SUCUMBIOS','PACAYACU',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1456,'SUCUMBIOS','SAN PEDRO DE LOS COFANES',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1457,'SUCUMBIOS','SANTA CECILIA',1,0,1,NULL,NULL,NULL,'0','0','0','1041','58027','672'),
	 (1458,'SUCUMBIOS','SHUSHUFINDI',1,1,1,NULL,NULL,NULL,'0','201001022','201001022002','1041','56443','289');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1459,'SUCUMBIOS','TARAPOA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1460,'TUNGURAHUA','AMBATILLO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1461,'TUNGURAHUA','AMBATO',1,1,1,NULL,NULL,NULL,'0','201001019','20100101901','1042','56445','42'),
	 (1462,'TUNGURAHUA','ATAHUALPA / CHISALATA',0,0,1,NULL,NULL,NULL,'0','0','0','1042','59134','0'),
	 (1463,'TUNGURAHUA','BANOS DE AGUA SANTA',1,1,0,NULL,NULL,NULL,'0','201001019','20100101902','0','0','79'),
	 (1464,'TUNGURAHUA','BETÍNEZ / PACHANLICA',0,1,0,NULL,NULL,NULL,'0','201001019','201001019014','0','0','0'),
	 (1465,'TUNGURAHUA','CEVALLOS',1,1,1,NULL,NULL,NULL,'0','201001019','201001019005','1042','56447','265'),
	 (1466,'TUNGURAHUA','CUNCHIBAMBA',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1467,'TUNGURAHUA','HUACHI GRANDE',0,0,1,NULL,NULL,NULL,'0','0','0','1042','59166','0'),
	 (1468,'TUNGURAHUA','HUAMBALO',1,1,0,NULL,NULL,NULL,'0','201001019','201001019011','0','0','746');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1469,'TUNGURAHUA','IZAMBA',0,0,1,NULL,NULL,NULL,'0','0','0','1042','59167','0'),
	 (1470,'TUNGURAHUA','LAQUIGO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1471,'TUNGURAHUA','MARTINEZ',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1472,'TUNGURAHUA','MOCHA',0,1,0,NULL,NULL,NULL,'0','201001019','201001019007','0','0','262'),
	 (1473,'TUNGURAHUA','MONTALVO',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1474,'TUNGURAHUA','MUNDUGLEO',0,0,1,NULL,NULL,NULL,'0','0','0','1042','59168','0'),
	 (1475,'TUNGURAHUA','PATATE',1,1,0,NULL,NULL,NULL,'0','201001019','201001003008','0','0','261'),
	 (1476,'TUNGURAHUA','PELILEO',1,1,1,NULL,NULL,NULL,'0','201001019','201001019004','1042','56450','259'),
	 (1477,'TUNGURAHUA','PICAIGUA',0,0,1,NULL,NULL,NULL,'0','0','0','1042','59169','0'),
	 (1478,'TUNGURAHUA','PILLARO',1,1,0,NULL,NULL,NULL,'0','201001019','201001019006','0','0','260');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1479,'TUNGURAHUA','PINLLO',1,0,1,NULL,NULL,NULL,'0','0','0','1042','59170','0'),
	 (1480,'TUNGURAHUA','QUERO',1,1,1,NULL,NULL,NULL,'0','201001019','201001019008','1042','56452','263'),
	 (1481,'TUNGURAHUA','QUINCHICOTO',0,0,1,NULL,NULL,NULL,'0','0','0','1042','59171','0'),
	 (1482,'TUNGURAHUA','QUISAPINCHA',1,0,1,NULL,NULL,NULL,'0','0','0','1042','58031','0'),
	 (1483,'TUNGURAHUA','SALASACA',0,0,1,NULL,NULL,NULL,'0','0','0','1042','59172','0'),
	 (1484,'TUNGURAHUA','SAN PEDRO DE PELILEO',0,1,0,NULL,NULL,NULL,'0','201001019','201001019013','0','0','0'),
	 (1485,'TUNGURAHUA','SANTA ROSA (AMBATO)',1,0,1,NULL,NULL,NULL,'0','0','0','1042','58032','0'),
	 (1486,'TUNGURAHUA','TISALEO',1,1,1,NULL,NULL,NULL,'0','201001019','201001019009','1042','56453','264'),
	 (1487,'TUNGURAHUA','TOTORAS',0,0,1,NULL,NULL,NULL,'0','0','0','1042','59173','0'),
	 (1488,'TUNGURAHUA','ULBA',0,1,0,NULL,NULL,NULL,'0','201001019','201001019012','0','0','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1489,'TUNGURAHUA','UNAMUNCHO',0,0,1,NULL,NULL,NULL,'0','0','0','1042','59174','0'),
	 (1490,'ZAMORA','28 DE MAYO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1491,'ZAMORA','CENTINELA DEL CONDOR',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1492,'ZAMORA','CHAMICO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','751'),
	 (1493,'ZAMORA','CHICAÑA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1494,'ZAMORA','CHIMBUTZA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1495,'ZAMORA','CHUCHUMBLETZA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1496,'ZAMORA','CUMBARATZA',1,0,1,NULL,NULL,NULL,'0','','0','1043','58035','757'),
	 (1497,'ZAMORA','EL PADMI',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1498,'ZAMORA','EL PANGUI',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','747');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1499,'ZAMORA','GUADALUPE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','753'),
	 (1500,'ZAMORA','GUALAQUIZA',0,1,0,NULL,NULL,NULL,'0','201001015','201001015002','0','0','0'),
	 (1501,'ZAMORA','GUAYZIMI',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1502,'ZAMORA','LOS ENCUENTROS',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1503,'ZAMORA','NAMIREZ',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','749'),
	 (1504,'ZAMORA','PACHICUTZA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1505,'ZAMORA','PALANDA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','675'),
	 (1506,'ZAMORA','PANGUINTZA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1507,'ZAMORA','PAQUIZHA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','750'),
	 (1508,'ZAMORA','PIUNTZA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','752');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1509,'ZAMORA','SAN ROQUE',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1510,'ZAMORA','TIMBARA',0,0,1,NULL,NULL,NULL,'0','0','0','1043','59147','0'),
	 (1511,'ZAMORA','TUNDAYME',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1512,'ZAMORA','WUISMI',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1513,'ZAMORA','YANTZAZA',1,1,0,NULL,NULL,NULL,'0','201001021','201001015003','0','0','440'),
	 (1514,'ZAMORA','ZAMORA',1,1,1,NULL,NULL,NULL,'0','201001021','201001021001','1043','56461','16'),
	 (1515,'ZAMORA','ZUMBA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','676'),
	 (1516,'ZAMORA','ZUMBI',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1517,'AZUAY','PAUTE',1,1,0,NULL,NULL,NULL,'0','201001003','201001003004','0','0','460'),
	 (1518,'AZUAY','PONCE ENRIQUEZ',1,1,0,NULL,NULL,NULL,'0','201001003','201001009013','0','0','770');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1519,'AZUAY','PUCARA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1520,'AZUAY','RICAURTE',1,1,1,NULL,NULL,NULL,'0','0','0','1022','59148','695'),
	 (1521,'AZUAY','SAN FERNANDO',1,1,0,NULL,NULL,NULL,'0','201001003','201001003024','0','0','37'),
	 (1522,'AZUAY','SAN JOAQUIN',0,1,1,NULL,NULL,NULL,'0','201001003','201001003025','1022','59149','0'),
	 (1523,'AZUAY','San Juan Cuenca',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (1524,'AZUAY','SANTA ISABEL',1,1,0,NULL,NULL,NULL,'0','201001003','201001003005','0','0','64'),
	 (1525,'AZUAY','SARAGURO',0,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1526,'AZUAY','SAYUASI',1,1,1,NULL,NULL,NULL,'0','0','0','1022','57668','0'),
	 (1527,'AZUAY','SEVILLA DE ORO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','504'),
	 (1528,'AZUAY','SIDCAY',0,1,1,NULL,NULL,NULL,'0','201001003','201001003026','1022','59062','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1529,'AZUAY','SIGSIG',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','391'),
	 (1530,'AZUAY','Simón Bolívar',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (1531,'AZUAY','Sinincay',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (1532,'AZUAY','Sosudel',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (1533,'AZUAY','TARQUI',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1534,'AZUAY','Tomebamba',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (1535,'AZUAY','Turi',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (1536,'AZUAY','Victoria del Portete',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (1537,'AZUAY','YUNGUILLA',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (1538,'AZUAY','Zhaglli',0,1,0,NULL,NULL,NULL,'','','','','','');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1539,'AZUAY','ZONA FRANCA',0,1,0,NULL,NULL,NULL,'','','','','',''),
	 (1540,'CHIMBORAZO','SANTA ROSA DE AGUA CLARA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1541,'CHIMBORAZO','YARUQUIES',1,1,1,NULL,NULL,NULL,'0','201001008','201001008011','1026','57711','680'),
	 (1542,'EL ORO','SANTA ROSA',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1543,'GUAYAS','VELASCO IBARRA (EL EMPALME)',0,1,0,NULL,NULL,NULL,'0','201001002','201001002069','0','0','0'),
	 (1544,'GUAYAS','VILLA NUEVA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','565'),
	 (1545,'GUAYAS','VIRGEN DE FATIMA KM 26',1,1,0,NULL,NULL,NULL,'0','0','0','0','0','566'),
	 (1546,'GUAYAS','YAGUACHI',0,1,1,NULL,NULL,NULL,'0','201001002','201001002006','1031','56345','182'),
	 (1547,'LOJA','SAN LUCAS',1,0,0,NULL,NULL,NULL,'0','201001012','201001012015','0','0','588'),
	 (1548,'SANTA ELENA','SANTA ELENA / SANTA ELENA',1,1,1,NULL,NULL,NULL,'0','201001023','201001002010','4125','56436','59');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1549,'SANTA ELENA','SANTA ROSA (SANTA ELENA)',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1550,'IMBABURA','SAN LUIS ',0,1,0,NULL,NULL,NULL,'0','201001011','201001011027','0','0','730'),
	 (1551,'IMBABURA','SAN MIGUEL DE IBARRA',0,1,0,NULL,NULL,NULL,'0','201001011','201001011031','0','0','0'),
	 (1552,'SANTA ELENA','SINCHAL',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1553,'IMBABURA','SAN PABLO DEL LAGO',1,0,1,NULL,NULL,NULL,'0','0','0','1032','57832','254'),
	 (1554,'IMBABURA','SAN PABLO IMBABURA',0,1,0,NULL,NULL,NULL,'0','201001011','201001011010','0','0','0'),
	 (1555,'SANTA ELENA','VALDIVIA',1,1,0,NULL,NULL,NULL,'0','201001023','201001023016','0','0','478'),
	 (1556,'LOJA','SAN PEDRO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1557,'LOJA','SAN PEDRO DE LA BENDITA',0,1,0,NULL,NULL,NULL,'0','201001012','201001012014','0','0','0'),
	 (1558,'LOJA','SAN PEDRO DE VILCABAMBA',0,1,0,NULL,NULL,NULL,'0','201001012','201001012013','0','0','0');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1559,'COTOPAXI','ZUMBAHUA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1560,'EL ORO','SHUMIRAL',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','548'),
	 (1561,'EL ORO','TORATA',0,0,1,NULL,NULL,NULL,'0','0','0','1028','59078','0'),
	 (1562,'EL ORO','VEITORIA',0,0,1,NULL,NULL,NULL,'0','0','0','1028','59079','0'),
	 (1563,'EL ORO','ZARUMA',1,1,0,NULL,NULL,NULL,'0','201001009','201001009005','0','0','67'),
	 (1564,'IMBABURA','SAN RAFAEL',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1565,'IMBABURA','SAN ROQUE',1,1,1,NULL,NULL,NULL,'0','201001011','201001011011','1032','57833','129'),
	 (1566,'LOJA','SAN SEBASTIÁN ',0,0,1,NULL,NULL,NULL,'0','0','0','1033','59097','0'),
	 (1567,'IMBABURA','SANTA BERTHA',0,1,0,NULL,NULL,NULL,'0','201001011','201001011028','0','0','0'),
	 (1568,'LOJA','SANTIAGO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','683');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1569,'LOJA','SARAGURO',1,0,0,NULL,NULL,NULL,'0','201001012','201001012009','0','0','430'),
	 (1570,'LOJA','SOZORANGA',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','131'),
	 (1571,'LOJA','SUCRE',0,0,1,NULL,NULL,NULL,'0','0','0','1033','59098','0'),
	 (1572,'IMBABURA','TIERRA BLANCA',0,1,0,NULL,NULL,NULL,'0','201001011','201001011029','0','0','0'),
	 (1573,'IMBABURA','TUMBACO',0,0,0,NULL,NULL,NULL,'0','0','0','0','0','0'),
	 (1574,'IMBABURA','URCUQUI',1,1,1,NULL,NULL,NULL,'0','201001011','201001011004','1032','59096','729'),
	 (1575,'LOJA','VILCABAMBA',0,1,0,NULL,NULL,NULL,'0','201001012','201001012007','0','0','431'),
	 (1576,'IMBABURA','YACHAY',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','731'),
	 (1577,'IMBABURA','YAGUARCOCHA',1,0,1,NULL,NULL,NULL,'0','201001011','201001011019','1032','57836','583'),
	 (1578,'LOJA','ZAPOTILLO',1,0,0,NULL,NULL,NULL,'0','0','0','0','0','437');");
mysqli_query($conexion, "INSERT INTO ciudad_cotizacion (id_cotizacion,provincia,ciudad,cobertura_servientrega,cobertura_laar,cobertura_gintracom,trayecto_servientrega,trayecto_laar,trayecto_gintracom,codigo_provincia_servientrega,codigo_provincia_laar,codigo_ciudad_laar,codigo_provincia_gintracom,codigo_ciudad_gintracom,codigo_ciudad_servientrega) VALUES
	 (1579,'MANABI','10 DE AGOSTO',1,0,0,NULL,NULL,NULL,'','201001014','','','','600'),
	 (1580,'MANABI','24 DE MAYO',1,1,0,NULL,NULL,NULL,'','201001014','201001001032','','','396');");



mysqli_query($conexion, "CREATE TABLE `cobertura_servientrega` (
  `id_cobertura` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tipo_cobertura` varchar(20) NOT NULL,
  `costo` double DEFAULT NULL,
  `precio` double DEFAULT NULL
  );");

mysqli_query($conexion, "INSERT INTO cobertura_servientrega (id_cobertura,tipo_cobertura,costo,precio) VALUES
(1,'TL',2.04,4.75),
(2,'TC',3.15,4.75),
(3,'TP',3.48,5.0),
(4,'TR',3.86,5.3),
(5,'TE',4.66,5.8);
");

mysqli_query($conexion, "CREATE TABLE `cobertura_laar` (
	`id_cobertura` bigint UNSIGNED NOT NULL PRIMARY KEY,
	`tipo_cobertura` varchar(100) NOT NULL,
	`costo` double NOT NULL,
	`precio` double NOT NULL
  );");

mysqli_query($conexion, "INSERT INTO `cobertura_laar` (`id_cobertura`, `tipo_cobertura`, `costo`, `precio`) VALUES
(1, 'TP', 2.8, 4.5),
(2, 'TE', 3.5, 5.5),
(3, 'TL', 2.8, 3.5),
(4, 'TS', 3.5, 5.5),
(5, 'TO', 3.5, 5.5);");

mysqli_query($conexion, "UPDATE `ciudad_cotizacion` SET `trayecto_laar` = 'TP', `trayecto_gintracom` = 'TN' WHERE `ciudad_cotizacion`.`id_cotizacion` = 239;");
mysqli_query($conexion, "ALTER TABLE `dropi` CHANGE `pais_id` `pais_id` INT NOT NULL DEFAULT '0';");

mysqli_query($conexion, "ALTER TABLE `perfil` ADD `whatsapp_flotante` INT DEFAULT 0 NOT NULL;");
mysqli_query($conexion, "ALTER TABLE `perfil` ADD `boton_compra_flotante` INT DEFAULT 0 NOT NULL;");
mysqli_query($conexion, "UPDATE `ciudad_cotizacion` SET `trayecto_laar` = 'TP', `cobertura_laar` = '1' WHERE `ciudad_cotizacion`.`id_cotizacion` = 190;");
mysqli_query($conexion, "UPDATE `ciudad_cotizacion` SET `trayecto_laar` = 'TL' WHERE `ciudad_cotizacion`.`id_cotizacion` = 618;");
mysqli_query($conexion, "UPDATE `ciudad_cotizacion` SET `cobertura_laar` = '1', `trayecto_laar`= 'TP' WHERE `ciudad_cotizacion`.`id_cotizacion` = 115;");
mysqli_query($conexion, "UPDATE `ciudad_cotizacion` SET `trayecto_laar` = 'TE' WHERE `ciudad_cotizacion`.`id_cotizacion` = 230;");
mysqli_query($conexion, "ALTER TABLE `users` ADD `cedula_facturacion` VARCHAR(13) NOT NULL AFTER `fecha_actualizacion`, ADD `correo_facturacion` VARCHAR(150) NOT NULL AFTER `cedula_facturacion`, ADD `direccion_facturacion` VARCHAR(200) NOT NULL AFTER `correo_facturacion`;");

mysqli_query($conexion, "CREATE TABLE `cobertura_gintracom` (
	`id_cobertura` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`trayecto` varchar(10) NOT NULL,
	`precio` float NOT NULL
  );");

mysqli_query($conexion, "INSERT INTO `cobertura_gintracom` (`id_cobertura`, `trayecto`, `precio`) VALUES
	(1, 'TN', 5),
	(2, 'TE', 6)
	;");

mysqli_query($conexion, "ALTER TABLE `tmp_ventas` ADD `descripcion` TEXT NULL AFTER `id_producto`;");

mysqli_query($conexion, "CREATE TABLE `cobertura_gintracom` (
	`id_cobertura` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`trayecto` varchar(10) NOT NULL,
	`precio` float NOT NULL
  );");

mysqli_query($conexion, "INSERT INTO `cobertura_gintracom` (`id_cobertura`, `trayecto`, `precio`) VALUES
	(1, 'TN', 5),
	(2, 'TE', 6)
	;");

mysqli_query($conexion, "ALTER TABLE `tmp_ventas` ADD `iva_tmp` INT NULL DEFAULT '0' AFTER `drogshipin_tmp`;");

mysqli_query($conexion, "UPDATE `ciudad_cotizacion` SET `cobertura_servientrega` = '1', `cobertura_laar`='1', `trayecto_laar` ='TE', `trayecto_servientrega`='TE' WHERE `ciudad_cotizacion`.`id_cotizacion` = 674;");

mysqli_query($conexion, "ALTER TABLE `users` CHANGE `cedula_facturacion` `cedula_facturacion` VARCHAR(13) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL, CHANGE `correo_facturacion` `correo_facturacion` VARCHAR(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL, CHANGE `direccion_facturacion` `direccion_facturacion` VARCHAR(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL;");

mysqli_query($conexion, "UPDATE `ciudad_cotizacion` SET `trayecto_laar` = 'TP' WHERE `ciudad_cotizacion`.`id_cotizacion` = 35;");

mysqli_close($conexion); // Cerramos la link con la base de datos

echo json_encode("ok");
