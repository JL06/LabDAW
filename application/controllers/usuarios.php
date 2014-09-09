<?php
class Usuarios extends CI_Controller {
	public function index()
	{
		//
		echo "usuarios";
	}

	function crear () 
	{
		$rol = $this->db->query("SELECT * FROM rol;");
		foreach ($rol->result() as $row) {
			$res[] = $row;
		}
		$data['main_content'] = "crear_usuario";
		$data['roles'] = $res;
		$this->load->view('template',$data);
	}

	function mostrar () 
	{
		echo "mostrar";
		//
	}

	function guardar () {
		$clave = $this->db->escape($_POST['clave']);
		$clave2 = $this->db->escape($_POST['clave2']);
		if (strcmp($clave, $clave2) != 0) {
			$red = "Location: " . site_url("/usuarios/crear");
			header($red);
			return;
		}
		$data['password'] = $clave;
		$data['nombre'] = $this->db->escape($_POST['nombre']);
		$data['email'] = $this->db->escape($_POST['correo']);
		$data['genero'] = $this->db->escape($_POST['genero']);
		$data['idrol'] = $_POST['rol'];
		$data['telefono'] = $this->db->escape($_POST['telefono']);

		$this->db->insert('usuario',$data);
		$red = "Location: " . site_url("/usuarios/crear");
		header($red);
	}

}