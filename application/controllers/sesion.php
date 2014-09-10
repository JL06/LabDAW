<?php
class Sesion extends CI_Controller {
	public function index()
	{
		$this->load->view('inicio_sesion');
	}

	function iniciar () {
		$mail = $this->input->post('correo');
		$clave = $this->input->post('clave');
		if ($mail != false && $clave != false) {
			$correo['email'] = $mail;
			$res = $this->db->get_where("usuario", $correo);
			if ($res->num_rows() == 0) {
				$red = "Location: " . site_url("/sesion/error");
				header($red);
			}
			foreach ($res->result_array() as $row) {
				$usuario = $row;
			}

			if (password_verify($clave, $usuario['password'])) {

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
		$datos['error'] = true;
		$this->load->view('inicio_sesion', $datos);
	}

	function cerrar() {
		$this->session->sess_destroy();
		$red = "Location: " . site_url("/sesion");
		header($red);
	}
}