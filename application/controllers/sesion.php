<?php
class Sesion extends CI_Controller {
	public function index()
	{
		$this->load->view('inicio_sesion');
	}

	function iniciar () {
		if (isset($_POST['correo']) && isset($_POST['clave'])) {
			$correo['email'] = $_POST['correo'];
			$res = $this->db->get_where("usuario", $correo);
			if ($res->num_rows() == 0) {
				$red = "Location: " . site_url("/sesion/error");
				header($red);
			}
			foreach ($res->result_array() as $row) {
				$usuario = $row;
			}

			if (password_verify($_POST['clave'], $usuario['password'])) {

				$info['nombre'] = $usuario['nombre'];
				$info['id'] = $usuario['id'];
				$info['correo'] = $usuario['email'];
				$info['genero'] = $usuario['genero'];
				$this->session->set_userdata($info);

				$red = "Location: " . site_url("/inicio");
				header($red);
			} else {
				$red = "Location: " . site_url("/sesion/error");
				header($red);
			}
		} else {
			$red = "Location: " . site_url("/sesion");
			header($red);
		}
	}

	function error() {
		$datos['error'] = '<span>Usuario o contraseña inválida</span>';
		$this->load->view('inicio_sesion', $datos);
	}

	function cerrar() {
		$this->session->sess_destroy();
		$red = "Location: " . site_url("/sesion");
		header($red);
	}
}