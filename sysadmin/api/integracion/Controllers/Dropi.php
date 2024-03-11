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

		$department = $this->model->get_department($token);
		
		print_r($department);

	}

	public function autentificacion($usuario, $contrasena){
		$existe = $this->model->existe_usuario($usuario);

		if ($existe == 1) {
			//echo 'existe en la base de datos';

			$token = $this->model->actualizar_token($usuario, $contrasena);
			return $token;
		} else {
			//echo 'no existe en la base de datos';
			$token = $this->model->guardar_usuario($usuario, $contrasena);
			return $token;
		}
	}
	public function recibir()
	{
		$json = file_get_contents('php://input');
		$this->model->getJson($json);
	}

	public function testing($tienda)
	{
		$this->model->testing($tienda);
	}
}
