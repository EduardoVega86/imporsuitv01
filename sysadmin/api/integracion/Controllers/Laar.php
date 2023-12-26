<?php

class Laar extends Controller
{

    public function index()
    {
        $json = file_get_contents('php://input');
        $json_decode = json_decode($json, true);
        if (count($json_decode['novedades']) > 0) {
            foreach ($json_decode['novedades'] as $novedad) {
                if ($novedad['codigoTipoNovedad'] == 42 || $novedad['codigoTipoNovedad'] == 96) {
                    $estado_actual_codigo = 9;
                    break;
                } else {
                    $estado_actual_codigo = 7;
                }
            }
        } else {
            $estado_actual_codigo = $json_decode['estadoActualCodigo'];
        }

        $no_guia = $json_decode['noGuia'];
        $this->model->cambiarEstado($no_guia, $estado_actual_codigo);
    }

    public function recibir()
    {
        $json = file_get_contents('php://input');
        echo $json;
    }

    public function guias()
    {
        $json = file_get_contents('php://input');
        $json_decode = json_decode($json, true);
        $numero_factura = $json_decode['factura'];
        $this->model->establecer_guia($numero_factura);
    }

    public function devolucion()
    {
        $json = file_get_contents('php://input');
        parse_str($json, $output);
        $guia = $output['guia_laar'];
        $estado = $output['estado'];
        $this->model->devolucion($guia, $estado);
    }
}
