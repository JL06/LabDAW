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
	function get_usuarios($filter = NULL)
	{
		$this->db->select('usuario.id as id,usuario.nombre   nombre, rol.nombre as tipo, email, genero, telefono');
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
		$this->db->where('usuario.id ='. $id);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$usuario = $query->row_array();
		} else {
			$usuario = NULL;
		}
		return $usuario;
	}


	function usuario_completo ($id) 
	{
		$this->db->select('usuario.id as id,usuario.nombre as nom, rol.nombre as tipo, email, genero, telefono, password, rol.id as rolid');
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
	function get_log($user_id)
	{
		$this->db->limit(8);
		$this->db->order_by("hora","desc");
		return $this->query_to_array($this->db->get("log"));
	}
	function get_asignaciones($rol,$id)
	{
		$query = "SELECT administrador.nombre as admin, vendedor.nombre as vendedor, productos.nombre as producto, cantidad, fecha
		FROM asignacion, usuario as administrador, usuario as vendedor, productos ";
		if ($rol == 1)
			$query.= " WHERE administrador.id = asignacion.idAdmin AND vendedor.id = asignacion.idVendedor
		AND asignacion.idProducto = productos.id AND administrador.id=".$this->db->escape($id);
		else
			$query.= " WHERE administrador.id = asignacion.idAdmin AND vendedor.id = asignacion.idVendedor
		AND asignacion.idProducto = productos.id and vendedor.id=".$this->db->escape($id);
		
		$query.="ORDER BY fecha DESC LIMIT 10";
		$q = $this->db->query($query);
		return $this->query_to_array($q);
	}
}
/* End of file usuarios_model.php */
/* Location: models/usuarios_model.php */
