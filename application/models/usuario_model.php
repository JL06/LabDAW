<?php
class Usuario_model extends Generic_Model {
	function listar($filter = NULL) 
	{
		$this->db->select('usuario.id as id,usuario.nombre as nom, rol.nombre as tipo, email, genero, telefono');
		$this->db->from('usuario');
		$this->db->join('rol', 'usuario.idRol = rol.id');
		if ($filter != NULL)
			$this->db->where($filter);
		$query = $this->db->get();
		return $this->query_to_array($query);

	}

	function usuario ($id) 
	{
		$this->db->select('usuario.id as id,usuario.nombre as nom, rol.nombre as tipo, email, genero, telefono, rol.id as rolid');
		$this->db->from('usuario');
		$this->db->join('rol', 'usuario.idRol = rol.id');
		$this->db->where($id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$usuario = $query->row_array();
		} else {
			$usuario = NULL;
		}
		return $usuario;
	}
}
/* End of file usuarios_model.php */
/* Location: models/usuarios_model.php */