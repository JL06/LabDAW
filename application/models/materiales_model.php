<?php

class Materiales_model extends Generic_model{

	function get_materiales($filter=""){
		$this->db->select('material.id as id, tipomaterial.nombre as nombre, color.nombre as color');
		$this->db->from('material');
		$this->db->join('tipomaterial', 'tipomaterial.id = material.idTipo');
		$this->db->join('color', 'color.id=material.idColor'); 

		if($filter!="")
			$this->db->where($filter);

		$this->db->distinct();
		$query=$this->db->get();

			return $this->query_to_array($query);


	}	
}
?>