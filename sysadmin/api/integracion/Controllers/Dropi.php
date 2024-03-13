<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

class Dropi extends Controller
{

	public function index()
	{
		$usuario = 'danielbonilla522@gmail.com';
		$contrasena = 'Mark2demasiado.';

		$token = $this->autentificacion($usuario, $contrasena);


		//echo json_encode($this->departamento($token));

		//echo json_encode($this->ciudades($token, 53));

		//echo json_encode($this->categorias($token));

		echo json_encode($this->productos($token, null, 5));

		//$this->model->login();
	}

	public function departamento($token)
	{
		return $this->model->get_department($token);
	}

	public function ciudades($token, $department_id)
	{
		return $this->model->get_bycity($token, $department_id);
	}

	public function categorias($token)
	{
		return $this->model->get_categories($token);
	}

	public function productos($token, $keywords)
	{
		return $this->model->get_products($token, $keywords);
	}

	public function autentificacion($usuario, $contrasena)
	{
		$existe = $this->model->existe_usuario($usuario);

		if ($existe == 1) {
			//echo 'existe en la base de datos';
			if ($this->model->expiro_token($usuario)) {
				$token = $this->model->actualizar_token($usuario, $contrasena);
				return $token;
			} else {
				$token = $this->model->get_token($usuario);
				return $token;
			}
		} else {
			//echo 'no existe en la base de datos';
			$token = $this->model->guardar_usuario($usuario, $contrasena);
			if (empty($token)) {
				return false;
			}
			return $token;
		}
	}
	public function login()
	{
		if ($_POST["correo"] && $_POST["contrasena"]) {
			$token = $this->autentificacion($_POST["correo"], $_POST["contrasena"]);

			if (empty($token)) {
				$response = array('status' => false, 'msg' => 'Las credenciales ingresadas son incorrectas');
			} else {
				$response = array('status' => true, 'msg' => 'su cuenta ha sido registrada correctamente en nuetro sistema', 'data' => $token);
			}
		}
		echo json_encode($response);
	}

	public function enviar_datos()
	{
		$usuario = $_POST['correo'];
		$contrasena = $_POST['contrasena'];
		$destino_url = "http://" . $_SERVER['HTTP_HOST'] . "/sysadmin/vistas/ajax/crsf_dropi.php";
		$credenciales = array('usuario' => $usuario, 'contrasena' => $contrasena);

		// Configuración de la solicitud cURL para el servicio de destino
		$ch = curl_init($destino_url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($credenciales));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json'
		));
		$response = curl_exec($ch);
		$destino_url = "http://" . $_SERVER['HTTP_HOST'] . "/sysadmin/vistas/ajax/texto_plano.php";
		file_put_contents($destino_url, $credenciales);
		curl_close($ch);
	}
}
