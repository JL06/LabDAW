<?php
class Usuarios extends CI_Controller {
	public function index()
	{
		$this->db->select('usuario.nombre as nom, rol.nombre as tipo, email, genero, telefono');
		$this->db->from('usuario');
		$this->db->join('rol', 'usuario.idRol = rol.id');
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$res[] = $row;
		}
		$data['title'] = "Usuarios";
		$data['main_content'] = "usuarios";
		$data['usuarios'] = $res;
		$this->load->view('templates/template',$data);
	}

	function agregar ($error = null) 
	{
		$rol = $this->db->get("rol");
		foreach ($rol->result() as $row) {
			$res[] = $row;
		}

		if ($error == 1) {
			$data['errorclave'] = true;
		}

		$data['title'] = "Nuevo Usuario";
		$data['main_content'] = "crear_usuario";
		$data['roles'] = $res;
		$this->load->view('templates/template',$data);
	}

	function guardar () {
		if (strcmp($_POST['clave'], $_POST['clave2']) != 0) {
			$red = "Location: " . site_url("/usuarios/agregar/1");
			header($red);
			return;
		}
		$data['password'] = password_hash($_POST['clave'], PASSWORD_DEFAULT);
		$data['nombre'] = $_POST['nombre'];
		$data['email'] = $_POST['correo'];
		$data['genero'] = $_POST['genero'];
		$data['idrol'] = $_POST['rol'];
		$data['telefono'] = $_POST['telefono'];
		
		$this->db->insert('usuario',$data);
		$red = "Location: " . site_url("/usuarios");
		header($red);
	}

	private function comprueba_sesion() {
		if ($this->session->userdata('id') === FALSE) {
			$red = "Location: " . site_url("/sesion");
			header($red);
			die();
		}
	}

}