<?php
class LaarModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cambiarEstado($no_guia, $estado_actual_codigo)
    {
        // local
        $this->actualizarTiendaVenta($no_guia, $estado_actual_codigo);
        // proveedor 
        $this->actualizarProveedor($no_guia, $estado_actual_codigo);
        // marketplace
        $this->actualizarMarketplace($no_guia, $estado_actual_codigo);
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
    protected function conectarMarketplace()
    {
        # Conexión a la base de datos de marketplace
        $market_connect = mysqli_connect(MARKETPLACE, MARKETPLACE_USER, MARKETPLACE_PASSWORD, MARKETPLACE_DB);
        if (!$market_connect) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $market_connect;
    }

    public function actualizarTiendaVenta($no_guia, $estado_actual_codigo)
    {
        $tienda_venta = $this->conectarProveedor($this->buscarTiendaVenta($no_guia));
        $sql = "UPDATE guia_laar SET estado_guia ='$estado_actual_codigo' WHERE guia_laar ='$no_guia'";
        $result = mysqli_query($tienda_venta, $sql);
        echo mysqli_error($tienda_venta);
        mysqli_close($tienda_venta);
        return $result;
    }

    public function actualizarProveedor($no_guia, $estado_actual_codigo)
    {

        $proveedor = $this->conectarProveedor($this->buscarProveedor($no_guia));
        $sql = "UPDATE guia_laar SET estado_guia ='$estado_actual_codigo' WHERE guia_laar ='$no_guia'";
        $result = mysqli_query($proveedor, $sql);
        echo mysqli_error($proveedor);
        mysqli_close($proveedor);
        return $result;
    }

    public function actualizarMarketplace($no_guia, $estado_actual_codigo)
    {
        $marketplace = $this->conectarMarketplace();
        $sql = "UPDATE guia_laar SET estado_guia ='$estado_actual_codigo' WHERE guia_laar ='$no_guia'";
        $result = mysqli_query($marketplace, $sql);
        echo mysqli_error($marketplace);
        mysqli_close($marketplace);
        return $result;
    }

    public function buscarProveedor($no_guia)
    {
        $query = "SELECT tienda_proveedor FROM guia_laar WHERE guia_laar = '$no_guia'";
        $query = $this->select($query);

        $dominiotienda = $query[0]['tienda_proveedor'];
        $dominiotienda = str_replace("https://", "", $dominiotienda);
        $dominiotienda = str_replace("http://", "", $dominiotienda);
        $dominiotienda = str_replace(".com", "", $dominiotienda);
        $dominiotienda = str_replace(".imporsuit", "", $dominiotienda);
        $dominiotienda = "imporsuit_" . $dominiotienda;

        return  $dominiotienda;
    }

    public function buscarTiendaVenta($no_guia)
    {
        $query = "SELECT tienda_venta FROM guia_laar WHERE guia_laar = '$no_guia'";
        $query = $this->select($query);

        $dominiotienda = $query[0]['tienda_venta'];
        $dominiotienda = str_replace("https://", "", $dominiotienda);
        $dominiotienda = str_replace("http://", "", $dominiotienda);
        $dominiotienda = str_replace(".com", "", $dominiotienda);
        $dominiotienda = str_replace(".imporsuit", "", $dominiotienda);
        $dominiotienda = "imporsuit_" . $dominiotienda;

        return  $dominiotienda;
    }
}
