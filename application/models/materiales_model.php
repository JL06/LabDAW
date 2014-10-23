<?php
class Materiales_model extends Generic_model {
	function get_materiales($filter="")
	{
		$this->db->select('material.id as id, tipomaterial.nombre as nombre, color.nombre as color, unidad, cantidadMaterial');
		$this->db->from('material');
		$this->db->join('tipomaterial', 'tipomaterial.id = material.idTipo');
		$this->db->join('color', 'color.id=material.idColor'); 

		if($filter!="")
			$this->db->where($filter);

		$this->db->distinct();
		$query=$this->db->get();

		return $this->query_to_array($query);
	}	

	function get_materiales_producto($prodId)
	{
		$this->db->select('material.id as id,cantidad,tipomaterial.nombre as nombre, color.nombre as color, unidad, cantidadMaterial');
		$this->db->from('material');
		$this->db->join('productomaterial', 'material.id = productomaterial.idMaterial');
		$this->db->join('tipomaterial', 'tipomaterial.id = material.idTipo');
		$this->db->join('color', 'color.id=material.idColor'); 
		$this->db->where(array('material.activo'=>1, 'idProducto'=>$prodId));

		$query=$this->db->get();
		
		return $this->query_to_array($query);
	}

	function existe ($nombre) 
	{
		$query = $this->db->get_where('tipomaterial', array('nombre' => $nombre));
		if ($query->num_rows() > 0) {
			$material = $query->row_array();
		} else {
			$material = NULL;
		}
		return $material;
	}

	function material ($id) 
	{
		$this->db->select('material.id as id,tipomaterial.nombre as nombre, color.id as colorid, color.nombre as color, unidad, cantidadMaterial as cantidad');
		$this->db->from('material');
		$this->db->join('tipomaterial', 'tipomaterial.id = material.idTipo');
		$this->db->join('color', 'color.id=material.idColor'); 
		//$this->db->where(array('material.activo'=>1, 'material.id'=>$id));
		$this->db->where(array('material.id'=>$id));

		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			$material = $query->row_array();
		} else {
			$material = NULL;
		}
		return $material;
	}

	function ultimo_comprado ($id)
	{
		$this->db->select("*");
		$this->db->from('compras');
		$this->db->where(array('idMaterial'=>$id));
		$this->db->order_by("fecha", "desc"); 
		$query = $this->db->get();
		return $query->first_row('array');
	}
}
/* End of file materiales_model.php */
/* Location: models/materiales_model.php */
