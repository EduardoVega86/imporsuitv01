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

    public function insertarPedido($nombre, $apellido, $principal, $secundaria, $provincia, $ciudad, $codigo_postal, $pais, $telefono, $email, $total, $cantidad, $precio, $sku)
    {
        $ultima_factura_sql = "SELECT MAX(numero_factura) AS factura FROM facturas_cot;";
        $ultima_factura = $this->select($ultima_factura_sql);
        $ultima_factura_numero = $ultima_factura[0]['factura'];
        // Extrae el número actual de la factura y el prefijo
        preg_match('/^COT-(\d+)$/', $ultima_factura_numero, $matches);
        $numero_actual = (int)$matches[1];

        // Incrementa el número actual
        $nuevo_numero = $numero_actual + 1;

        // Formatea el nuevo número con ceros a la izquierda
        $nueva_factura_numero_formateada = sprintf("COT-%08d", $nuevo_numero);

        #$sql_factura_cot = "INSERT INTO facturas_cot ('numero_factura','fecha_factura','id_cliente','id_vendedor','condiciones','monto_factura','estado_factura','id_users_factura','validez','id_sucursal','nombre','telefono','provincia','c_principal','ciudad_cot','c_secundaria','referencia','observacion','guia_enviada','transporte','identificacion','celular','cod','valor_seguro','drogshipin','tienda') VALUES ('$nueva_factura_numero_formateada',NOW(),0,0,'$nueva_factura_numero_formateada','$total','Pendiente',0,'30 días',0,'$nombre $apellido','$telefono','$provincia','$principal','$ciudad','$secundaria','','$email','','','','','','','');";
        $sql_factura_cot = "INSERT INTO facturas_cot ('numero_factura','fecha_factura','id_cliente','id_vendedor','condiciones','monto_factura','estado_factura','id_users_factura','validez','id_sucursal','nombre','telefono','provincia','c_principal','ciudad_cot','c_secundaria','referencia','observacion','guia_enviada','transporte','identificacion','celular','cod','valor_seguro','drogshipin','tienda') VALUES (?, NOW(),0,0,?,?,?,?,?,0,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $factura_data = array($nueva_factura_numero_formateada, 1, $total, 1, 1, 3, $nombre . ' ' . $apellido, $telefono, $provincia, $principal, $ciudad, $secundaria, '', '', '', '', '', '', '', '', '', '', '');

        $sql_detalle_factura_cot = "INSERT INTO detalle_fact_cot ('id_factura','id_producto','cantidad','desc_venta','precio_venta') VALUES (?, ?,?,?,?);";
        $detalle_fac_data = array($nueva_factura_numero_formateada, $sku, $cantidad, '', $precio);

        #$sql_detalle_factura_cot = "INSERT INTO detalle_fact_cot ('id_factura','id_producto','cantidad','desc_venta','precio_venta') VALUES ('$nueva_factura_numero_formateada','$sku','$cantidad','','$precio');";


        $query_factura_cot = $this->insert($sql_factura_cot, $factura_data);
        $query_detalle_factura_cot = $this->insert($sql_detalle_factura_cot, $detalle_fac_data);

        return array($query_factura_cot, $query_detalle_factura_cot);
    }
}
