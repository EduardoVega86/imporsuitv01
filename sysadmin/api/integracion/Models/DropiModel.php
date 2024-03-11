<?php

class DropiModel extends Query
{

    public function existe_usuario($usuario)
    {
        $existe = $this->select("SELECT usuario FROM dropi WHERE usuario = '$usuario'");
        if (!empty($existe)) {
            $guia = $existe[0];

            if ($guia == '') {
                return false;
                exit;
            } else {
                return true;
            }
        }
    }

    public function expiro_token($usuario){
        $ultima_fecha = $this->select("SELECT usuario FROM dropi WHERE usuario = '$usuario'");

    }

    public function actualizar_token($usuario, $contrasena)
    {
        $datos_login= array('email' => $usuario, 'password' => $contrasena, 'white_brand_id' => 'df3e6b0bb66ceaadca4f84cbc371fd66e04d20fe51fc414da8d1b84d31d178de');
        $response1 = $this -> central('login','POST', $datos_login);

        $token = $response1['token'];

        $sql_cc = "UPDATE `dropi` SET token = ?, update_at = ?";
        date_default_timezone_set('America/Guayaquil');
        $datos = array($token, date('Y-m-d H:i:s'));
        $query_insertar_cc = $this->insert($sql_cc, $datos);

        if ($query_insertar_cc) {
            echo json_encode('ok');
            return $token;
        } else {
            echo json_encode('error');
        }
    }

    public function guardar_usuario($usuario, $contrasena)
    {
        $datos_login= array('email' => $usuario, 'password' => $contrasena, 'white_brand_id' => 'df3e6b0bb66ceaadca4f84cbc371fd66e04d20fe51fc414da8d1b84d31d178de');
        $response1 = $this -> central('login','POST', $datos_login);

        $token = $response1['token'];

        $password_hash = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql_cc = "INSERT INTO `dropi`(`usuario`, `contrasena_hash`, `token`) VALUES (?, ?, ?)";
        $datos = array($usuario, $password_hash, $token);
        $query_insertar_cc = $this->insert($sql_cc, $datos);

        if ($query_insertar_cc) {
            //echo json_encode('ok');
            return $token;
        } else {
            echo json_encode('error');
        }
    }

    public function get_department($token){
        $datos_login= array('token' => $token, 'white_brand_id' => 'df3e6b0bb66ceaadca4f84cbc371fd66e04d20fe51fc414da8d1b84d31d178de');
        $response = $this -> central('department','GET', $datos_login);
        return $response;
    }

    public function central($endpoint, $tipo, $datos){
        $destino_url = "https://api.dropi.ec/api/" . $endpoint;
        // Configuración de la solicitud cURL para el servicio de destino
        $ch = curl_init($destino_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $tipo);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (isset($datos['token'])){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Bearer '. $datos['token']
            ));
        }else{
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
    }


        // Realizar la solicitud cURL al servicio de destino

        $response = curl_exec($ch);


        // Verificar si hubo errores en la solicitud
        if (curl_errno($ch)) {
            echo 'Error en la solicitud cURL para el servicio de destino: ' . curl_error($ch);
            exit();
        }
        curl_close($ch);
        return $response1 = json_decode($response, true);
    }
}
