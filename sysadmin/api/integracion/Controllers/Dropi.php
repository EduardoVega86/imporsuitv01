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

		//echo json_encode($this->productos($token, 'carro'));}

		$this->model->login();
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
		$get_data = file_get_contents("php://input");

		$get_data = json_decode($get_data, true);

		if ($get_data["correo"] && $get_data["contrasena"]) {
			$token = $this->autentificacion($get_data["correo"], $get_data["contrasena"]);

			if (empty($token)) {
				$response = array('status' => false, 'msg' => 'Las credenciales ingresadas son incorrectas');
			} else {
				$response = array('status' => true, 'msg' => 'su cuenta ha sido registrada correctamente en nuetro sistema', 'data' => $token);
			}
		}
		echo json_encode($response);
	}
}
