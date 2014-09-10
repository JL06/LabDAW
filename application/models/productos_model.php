<?php

	class Productos_model extends Generic_model
	{
		function get_productos($filter=""){
			$this->db->select('productos.nombre, productos.precio, productos.descripcion, tipoproducto.nombre as tipo');
			$this->db->from('productos');
			$this->db->join('tipoproducto','tipoproducto.id=productos.idTipo');
			if($filter!="")
				$this->db->where($filter);

			$query=$this->db->get();

			return $this->query_to_array($query);
		}
	}
?>