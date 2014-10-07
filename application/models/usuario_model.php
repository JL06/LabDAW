<?php
class Usuario_model extends Generic_Model{
	function listar($filter=""){
		$this->db->select('usuario.id as id,usuario.nombre as nom, rol.nombre as tipo, email, genero, telefono');
		$this->db->from('usuario');
		$this->db->join('rol', 'usuario.idRol = rol.id');
		$this->db->where($filter);
		$query = $this->db->get();
		return $this->query_to_array($query);

	}
}
?>