<?php
class ShopifyModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getJson($json)
    {
        $sql = "INSERT INTO shopify (json) VALUES (?)";
        $data = array($json);
        $query = $this->insert($sql, $data);
        return $query;
    }

    public function insertarPedido($nombre, $apellido, $principal, $secundaria, $provincia, $ciudad, $codigo_postal, $pais, $telefono, $email, $total, $line_items)
    {

        date_default_timezone_set('America/Guayaquil');


        $ultima_factura_sql = "SELECT MAX(numero_factura) AS factura FROM facturas_cot;";
        $ultima_factura = $this->select($ultima_factura_sql);
        $ultima_factura_numero = $ultima_factura[0]['factura'];
        $ciudad = strtoupper($ciudad);
        $ciudad_sql = "SELECT codigo FROM ciudad_laar WHERE nombre = '$ciudad';";

        $ciudad = $this->select($ciudad_sql);
        $ciudad = $ciudad[0]['codigo'];



        $provincia = strtoupper($provincia);
        $provincia_sql = "SELECT codigo_provincia FROM provincia_laar WHERE provincia = '$provincia';";
        $provincia = $this->select($provincia_sql);
        $provincia = $provincia[0]['codigo_provincia'];


        // Extrae el número actual de la factura y el prefijo
        preg_match('/^COT-(\d+)$/', $ultima_factura_numero, $matches);
        $numero_actual = (int)$matches[1];

        // Incrementa el número actual
        $nuevo_numero = $numero_actual + 1;


        // Formatea el nuevo número con ceros a la izquierda
        $nueva_factura_numero_formateada = sprintf("COT-%06d", $nuevo_numero);

        $fecha_actual = date('Y-m-d H:i:s');

        $es_drogshipins = $this->obtenerProveedor($line_items[0]['sku']);

        $drogshiping = 0;
        if ($es_drogshipins) {
            $es_drogshipin = $es_drogshipins;
            $drogshiping = 1;
        } else {
            $es_drogshipin = NULL;
            $drogshiping = 0;
        }

        #$sql_factura_cot = "INSERT INTO facturas_cot ('numero_factura','fecha_factura','id_cliente','id_vendedor','condiciones','monto_factura','estado_factura','id_users_factura','validez','id_sucursal','nombre','telefono','provincia','c_principal','ciudad_cot','c_secundaria','referencia','observacion','guia_enviada','transporte','identificacion','celular','cod','valor_seguro','drogshipin','tienda') VALUES ('$nueva_factura_numero_formateada',NOW(),0,0,'$nueva_factura_numero_formateada','$total','Pendiente',0,'30 días',0,'$nombre $apellido','$telefono','$provincia','$principal','$ciudad','$secundaria','','$email','','','','','','','');";
        $sql_factura_cot = "INSERT INTO `facturas_cot` (`numero_factura`, `fecha_factura`, `id_cliente`, `id_vendedor`, `condiciones`, `monto_factura`, `estado_factura`, `id_users_factura`, `validez`, `id_sucursal`, `nombre`, `telefono`, `provincia`, `c_principal`, `ciudad_cot`, `c_secundaria`, `referencia`, `observacion`, `guia_enviada`, `transporte`, `identificacion`, `celular`, `cod`, `valor_seguro`, `drogshipin`, `tienda`, `importado`, `plataforma_importa`) VALUES (?,?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

        $factura_data = array($nueva_factura_numero_formateada, $fecha_actual, "1", "1", '1', $total, "1", "1", "3", "1", $nombre . ' ' . $apellido, $telefono, $provincia, $principal, $ciudad, $secundaria, " ", " ", "0", NULL, NULL, NULL, "0", "0", $drogshiping, $es_drogshipins, "1", "Shopify");


        $query_factura_cot = $this->insert($sql_factura_cot, $factura_data);
        foreach ($line_items as $key => $value) {

            $es_drogshipin = $this->buscarProducto($value['sku']);
            $es_drogshipin = $es_drogshipin[0]['drogshipin'];

            $nombre_producto = $value['name'];
            $cantidad = $value['quantity'];
            $precio = $value['price'];
            $sku = $value['sku'];

            if ($es_drogshipin == 1) {

                // se obtiene el proveedor
                $proveedor_server = $this->buscarProveedor($sku);

                $producto_proveedor = $this->obtenerProveedor($sku);



                $proveedor_server = $this->conseguirUltimaFactura('localhost', $proveedor_server);
                // se obtiene la ultima factura del marketplace
                $marketplace_server = $this->conseguirUltimaFactura('localhost', 'imporsuit_marketplace');

                // se separa el COT-000001 en COT y 000001
                preg_match('/^COT-(\d+)$/', $proveedor_server, $matches);
                $numero_actual_proveedor = (int)$matches[1];
                $nuevo_numero_proveedor = $numero_actual_proveedor + 1;
                $nueva_factura_numero_formateada_proveedor = sprintf("COT-%06d", $nuevo_numero_proveedor);

                preg_match('/^COT-(\d+)$/', $marketplace_server, $matches);
                $numero_actual_marketplace = (int)$matches[1];
                $nuevo_numero_marketplace = $numero_actual_marketplace + 1;
                $nueva_factura_numero_formateada_marketplace = sprintf("COT-%06d", $nuevo_numero_marketplace);



                $this->insertarFacturaProveedor($nueva_factura_numero_formateada_proveedor, "INSERT INTO `facturas_cot` (`numero_factura`, `fecha_factura`, `id_cliente`, `id_vendedor`, `condiciones`, `monto_factura`, `estado_factura`, `id_users_factura`, `validez`, `id_sucursal`, `nombre`, `telefono`, `provincia`, `c_principal`, `ciudad_cot`, `c_secundaria`, `referencia`, `observacion`, `guia_enviada`, `transporte`, `identificacion`, `celular`, `cod`, `valor_seguro`, `drogshipin`, `tienda`, `importado`, `plataforma_importa`) VALUES ('$nueva_factura_numero_formateada_proveedor', NOW(), '1', '1', '1', '$total', '1', '1', '3', '1', '$nombre $apellido', '$telefono', '$provincia', '$principal', '$ciudad', '$secundaria', ' ', ' ', '0', NULL, NULL, NULL, '0', '0', '$drogshiping', '$producto_proveedor', '1', 'Shopify');", $sku);
                $this->insertarFacturaMarketplace($nueva_factura_numero_formateada_marketplace, "INSERT INTO `facturas_cot` (`numero_factura`, `fecha_factura`, `id_cliente`, `id_vendedor`, `condiciones`, `monto_factura`, `estado_factura`, `id_users_factura`, `validez`, `id_sucursal`, `nombre`, `telefono`, `provincia`, `c_principal`, `ciudad_cot`, `c_secundaria`, `referencia`, `observacion`, `guia_enviada`, `transporte`, `identificacion`, `celular`, `cod`, `valor_seguro`, `drogshipin`, `tienda`, `importado`, `plataforma_importa`) VALUES ('$nueva_factura_numero_formateada_marketplace', NOW(), '1', '1', '1', '$total', '1', '1', '3', '1', '$nombre $apellido', '$telefono', '$provincia', '$principal', '$ciudad', '$secundaria', ' ', ' ', '0', NULL, NULL, NULL, '0', '0', '$drogshiping','$producto_proveedor' , '1', 'Shopify');");
                $this->insertarPedidoMarketplace($nueva_factura_numero_formateada_marketplace, $cantidad, $precio, $sku);
                $this->insertarPedidoProveedor($nueva_factura_numero_formateada_proveedor, $cantidad, $precio, $sku);
            }
            $this->insertarDetalleFactura_local($nueva_factura_numero_formateada, $cantidad, $precio, $sku);
        }
        return array($query_factura_cot);
    }

    private function insertarDetalleFactura_local($numero_factura, $cantidad, $precio, $sku)
    {
        $ultima_factura = $this->select("SELECT MAX(id_factura) AS factura FROM facturas_cot;");
        $ultima_factura_numero = $ultima_factura[0]['factura'];
        $id_producto = $this->select("SELECT id_producto FROM productos WHERE codigo_producto = '$sku';");
        $id_producto = $id_producto[0]['id_producto'];

        $sql_detalle_factura_cot = "INSERT INTO `detalle_fact_cot` ( `id_factura`, `numero_factura`, `id_producto`, `cantidad`, `desc_venta`, `precio_venta`, `drogshipin_tmp`, `id_producto_origen`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?);";
        $detalle_fac_data = array($ultima_factura_numero, $numero_factura, $id_producto, $cantidad, NULL, $precio, NULL, NULL);
        $query_detalle_factura_cot = $this->insert($sql_detalle_factura_cot, $detalle_fac_data);
        return array($query_detalle_factura_cot);
    }

    private function buscarProducto($sku)
    {
        $sql = "SELECT drogshipin FROM productos WHERE id_producto = '$sku';";
        $query = $this->select($sql);
        return $query;
    }

    protected function conectarMarketplace()
    {
        # Conexión a la base de datos de marketplace
        $market_connect = mysqli_connect(MARKETPLACE, MARKETPLACE_USER, MARKETPLACE_PASSWORD, MARKETPLACE_DB);
        if (!$market_connect) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $market_connect;
    }

    protected function conectarProveedor($proveedor)
    {
        $contrasena = $proveedor;
        if ($proveedor == 'imporsuit_imporshop') {
            $contrasena = 'E?c7Iij&885Y';
        }
        $proveedor_connect = mysqli_connect('localhost', $proveedor, $contrasena, $proveedor);
        if (!$proveedor_connect) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $proveedor_connect;
    }

    public function insertarPedidoProveedor($numero_factura, $cantidad, $precio, $sku)
    {
        $proveedor = $this->conectarProveedor($this->buscarProveedor($sku));
        $ultima_factura_sql = "SELECT MAX(id_factura) AS factura FROM facturas_cot;";
        $ultima_factura = mysqli_query($proveedor, $ultima_factura_sql);
        $ultima_factura = mysqli_fetch_assoc($ultima_factura);
        $ultima_factura_numero = $ultima_factura['factura'] + 1;

        $id_producto = $this->select("SELECT id_producto FROM productos WHERE codigo_producto = '$sku';");
        $id_producto = $id_producto[0]['id_producto'];

        $sql_detalle_factura_cot = "INSERT INTO `detalle_fact_cot` ( `id_factura`, `numero_factura`, `id_producto`, `cantidad`, `desc_venta`, `precio_venta`, `drogshipin_tmp`, `id_producto_origen`) VALUES ('$ultima_factura_numero', '$numero_factura', '$id_producto', '$cantidad', NULL, '$precio', NULL, NULL);";

        $query = mysqli_query($proveedor, $sql_detalle_factura_cot);
        echo mysqli_error($proveedor);

        mysqli_close($proveedor);

        return $query;
    }

    public function insertarPedidoMarketplace($numero_factura, $cantidad, $precio, $sku)
    {
        $market_connect = $this->conectarMarketplace();


        $ultima_factura_sql = "SELECT MAX(id_factura) AS factura FROM facturas_cot;";
        $ultima_factura = mysqli_query($market_connect, $ultima_factura_sql);
        $ultima_factura = mysqli_fetch_assoc($ultima_factura);
        $ultima_factura_numero = $ultima_factura['factura'];
        $id_producto = $this->select("SELECT id_producto FROM productos WHERE codigo_producto = '$sku';");
        $id_producto = $id_producto[0]['id_producto'];


        $sql_detalle_factura_cot = "INSERT INTO `detalle_fact_cot` ( `id_factura`, `numero_factura`, `id_producto`, `cantidad`, `desc_venta`, `precio_venta`, `drogshipin_tmp`, `id_producto_origen`) VALUES ('$ultima_factura_numero', '$numero_factura', '$id_producto', '$cantidad', NULL, '$precio', NULL, NULL);";

        $query = mysqli_query($market_connect, $sql_detalle_factura_cot);
        echo mysqli_error($market_connect);

        mysqli_close($market_connect);

        return $query;
    }

    public function insertarFacturaProveedor($ultima_factura, $sql, $sku)
    {
        $proveedor = $this->conectarProveedor($this->buscarProveedor($sku));

        //Verificar si la factura ya existe
        $sql_factura = "SELECT numero_factura FROM facturas_cot WHERE numero_factura = '$ultima_factura';";

        $query_factura = mysqli_query($proveedor, $sql_factura);
        $factura = mysqli_fetch_assoc($query_factura);
        if (!empty($factura)) {
            mysqli_close($proveedor);
            return false;
        } else {
            $query = mysqli_query($proveedor, $sql);
            echo mysqli_error($proveedor);
            mysqli_close($proveedor);
            return $query;
        }
    }

    public function insertarFacturaMarketplace($ultima_factura, $sql)
    {
        $market_connect = $this->conectarMarketplace();
        //Verificar si la factura ya existe
        $sql_factura = "SELECT numero_factura FROM facturas_cot WHERE numero_factura = '$ultima_factura';";

        $query_factura = mysqli_query($market_connect, $sql_factura);
        $factura = mysqli_fetch_assoc($query_factura);
        if (!empty($factura)) {
            mysqli_close($market_connect);
            return false;
        } else {
            $query = mysqli_query($market_connect, $sql);
            echo mysqli_error($market_connect);
            mysqli_close($market_connect);
            return $query;
        }
    }

    public function buscarProveedor($sku)
    {
        $sql = "SELECT tienda FROM productos WHERE id_producto = '$sku';";
        $query = $this->select($sql);
        $dominiotienda = $query[0]['tienda'];
        // quitar el https:// y el .com
        $dominiotienda = str_replace("https://", "", $dominiotienda);
        $dominiotienda = str_replace(".com", "", $dominiotienda);
        $dominiotienda = str_replace(".imporsuit", "", $dominiotienda);
        $dominiotienda = "imporsuit_" . $dominiotienda;
        return $dominiotienda;
    }

    public function obtenerProveedor($sku)
    {

        $sql = "SELECT tienda FROM productos WHERE id_producto = '$sku';";
        $query = $this->select($sql);

        $dominiotienda = $query[0]['tienda'];

        return $dominiotienda;
    }

    public function conseguirUltimaFactura($servidor, $tienda)
    {
        $contrasena = $tienda;
        if ($tienda == 'imporsuit_imporshop') {
            $contrasena = 'E?c7Iij&885Y';
        }
        $sql = "SELECT MAX(numero_factura) AS factura FROM facturas_cot;";

        $Query_con = mysqli_connect($servidor, $tienda, $contrasena, $tienda);

        $query = mysqli_query($Query_con, $sql);
        $factura = mysqli_fetch_assoc($query);
        if (empty($factura['factura'])) {
            $factura['factura'] = 'COT-000001';
        }
        echo mysqli_error($Query_con);
        mysqli_close($Query_con);
        $factura = $factura['factura'];
        return $factura;
    }
}
