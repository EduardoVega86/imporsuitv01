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

        #$sql_factura_cot = "INSERT INTO facturas_cot ('numero_factura','fecha_factura','id_cliente','id_vendedor','condiciones','monto_factura','estado_factura','id_users_factura','validez','id_sucursal','nombre','telefono','provincia','c_principal','ciudad_cot','c_secundaria','referencia','observacion','guia_enviada','transporte','identificacion','celular','cod','valor_seguro','drogshipin','tienda') VALUES ('$nueva_factura_numero_formateada',NOW(),0,0,'$nueva_factura_numero_formateada','$total','Pendiente',0,'30 días',0,'$nombre $apellido','$telefono','$provincia','$principal','$ciudad','$secundaria','','$email','','','','','','','');";
        $sql_factura_cot = "INSERT INTO `facturas_cot` (`numero_factura`, `fecha_factura`, `id_cliente`, `id_vendedor`, `condiciones`, `monto_factura`, `estado_factura`, `id_users_factura`, `validez`, `id_sucursal`, `nombre`, `telefono`, `provincia`, `c_principal`, `ciudad_cot`, `c_secundaria`, `referencia`, `observacion`, `guia_enviada`, `transporte`, `identificacion`, `celular`, `cod`, `valor_seguro`, `drogshipin`, `tienda`, `importado`, `plataforma_importa`) VALUES (?,?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

        $factura_data = array($nueva_factura_numero_formateada, $fecha_actual, "1", "1", '1', $total, "1", "1", "3", "1", $nombre . ' ' . $apellido, $telefono, $provincia, $principal, $ciudad, $secundaria, " ", " ", "0", NULL, NULL, NULL, "0", "0", "0", NULL, "1", "Shopify");


        $query_factura_cot = $this->insert($sql_factura_cot, $factura_data);
        foreach ($line_items as $key => $value) {

            $es_drogshipin = $this->buscarProducto($value['sku']);
            $es_drogshipin = $es_drogshipin[0]['drogshipin'];

            $nombre_producto = $value['name'];
            $cantidad = $value['quantity'];
            $precio = $value['price'];
            $sku = $value['sku'];

            if ($es_drogshipin == 1) {
                $this->insertarFacturaMarketplace($nueva_factura_numero_formateada, "INSERT INTO `facturas_cot` (`numero_factura`, `fecha_factura`, `id_cliente`, `id_vendedor`, `condiciones`, `monto_factura`, `estado_factura`, `id_users_factura`, `validez`, `id_sucursal`, `nombre`, `telefono`, `provincia`, `c_principal`, `ciudad_cot`, `c_secundaria`, `referencia`, `observacion`, `guia_enviada`, `transporte`, `identificacion`, `celular`, `cod`, `valor_seguro`, `drogshipin`, `tienda`, `importado`, `plataforma_importa`) VALUES ('$nueva_factura_numero_formateada', NOW(), '1', '1', '1', '$total', '1', '1', '3', '1', '$nombre $apellido', '$telefono', '$provincia', '$principal', '$ciudad', '$secundaria', ' ', ' ', '0', NULL, NULL, NULL, '0', '0', '0', NULL, '1', 'Shopify');");
                $this->insertarPedidoMarketplace($nueva_factura_numero_formateada, $cantidad, $precio, $sku);
            } else {

                $this->insertarDetalleFactura_local($nueva_factura_numero_formateada, $cantidad, $precio, $sku);
            }
        }

        return array($query_factura_cot);
    }

    private function insertarDetalleFactura_local($numero_factura, $cantidad, $precio, $sku)
    {
        $ultima_factura = $this->select("SELECT MAX(id_factura) AS factura FROM facturas_cot;");
        $ultima_factura_numero = $ultima_factura[0]['factura'];
        $sql_detalle_factura_cot = "INSERT INTO `detalle_fact_cot` ( `id_factura`, `numero_factura`, `id_producto`, `cantidad`, `desc_venta`, `precio_venta`, `drogshipin_tmp`, `id_producto_origen`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?);";
        $detalle_fac_data = array($ultima_factura_numero, $numero_factura, $sku, $cantidad, NULL, $precio, NULL, NULL);
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
    public function insertarPedidoMarketplace($numero_factura, $cantidad, $precio, $sku)
    {
        $market_connect = $this->conectarMarketplace();
        $ultima_factura = $this->select("SELECT MAX(id_factura) AS factura FROM facturas_cot;");
        $ultima_factura_numero = $ultima_factura[0]['factura'];
        $sql_detalle_factura_cot = "INSERT INTO `detalle_fact_cot` ( `id_factura`, `numero_factura`, `id_producto`, `cantidad`, `desc_venta`, `precio_venta`, `drogshipin_tmp`, `id_producto_origen`) VALUES ('$ultima_factura_numero', '$numero_factura', '$sku', '$cantidad', NULL, '$precio', NULL, NULL);";

        $query = mysqli_query($market_connect, $sql_detalle_factura_cot);
        echo mysqli_error($market_connect);

        mysqli_close($market_connect);

        return $query;
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
}
