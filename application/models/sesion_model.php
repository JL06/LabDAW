<?php
class Sesion_model extends Generic_Model {

	function existe ($correo) 
	{
		$this->db->select('email, nombre');
		$this->db->from('usuario');
		$this->db->where(array('email' => $correo));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$resultado = TRUE;
		} else {
			$resultado = FALSE;
		}
		return $resultado;
	}

	function agrega ($correo, $token, $fecha)
	{
		$sql = 'INSERT INTO recupera (email, token, fecha)
		VALUES (?, ?, ?)
		ON DUPLICATE KEY UPDATE 
		token=VALUES(token), 
		fecha=VALUES(fecha)';
		$query = $this->db->query($sql, array($correo, $token, $fecha));
	}

	function usuario ($token)
	{
		$this->db->select('usuario.id as id');
		$this->db->from('usuario');
		$this->db->join('recupera', 'usuario.email = recupera.email');
		$this->db->where(array('token' => $token));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$res = $query->first_row();
			$resultado = $res->id;
		} else {
			$resultado = -1;
		}
		return $resultado;
	}

	function fecha ($token)
	{
		$this->db->select('fecha');
		$this->db->from('recupera');
		$this->db->where(array('token' => $token));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$res = $query->first_row();
			$resultado = $res->fecha;
		} else {
			$resultado = -1;
		}
		return $resultado;
	}
}