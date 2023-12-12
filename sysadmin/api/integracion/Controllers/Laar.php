<?php

class Laar extends Controller
{

    public function index()
    {
        $json = file_get_contents('php://input');
        $json_decode = json_decode($json, true);
        $estado_actual_codigo = $json_decode['estadoActualCodigo'];

        $no_guia = $json_decode['noGuia'];
        $this->model->cambiarEstado($no_guia, $estado_actual_codigo);
    }

    public function recibir()
    {
        $json = file_get_contents('php://input');
        echo $json;
    }
}
