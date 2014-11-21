<?php
class Compras_model extends Generic_Model {

	function compra ($id) 
	{
		$this->db->select('compras.id as id, compras.cantidad as cantidad, compras.fecha as fecha, compras.costo as costo, tipomaterial.nombre as material, tipomaterial.unidad as unidad, material.id as matid');
		$this->db->from('compras');
		$this->db->join('material', 'compras.idMaterial = material.id');
		$this->db->join('tipomaterial', 'material.idTipo = tipomaterial.id');
		$this->db->where($id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$compra = $query->row_array();
		} else {
			$compra = NULL;
		}
		return $compra;
	}

	function listar() 
	{
		$this->db->select('compras.id as id, compras.cantidad as cantidad, compras.fecha as fecha, compras.costo as costo, tipomaterial.nombre as material, tipomaterial.unidad as unidad, color.nombre as color');
		$this->db->from('compras');
		$this->db->join('material', 'compras.idMaterial = material.id');
		$this->db->join('tipomaterial', 'material.idTipo = tipomaterial.id');
		$this->db->join('color', 'material.idColor = color.id');
		$query = $this->db->get();
		return $this->query_to_array($query);
	}

	function materiales() {
		$this->db->select('material.id as id, tipomaterial.nombre as nombre, color.nombre as color, tipomaterial.unidad as unidad');
		$this->db->from('material');
		$this->db->join('tipomaterial', 'material.idTipo = tipomaterial.id');
		$this->db->join('color', 'material.idColor = color.id');
		$this->db->order_by("nombre", "asc"); 
		$query = $this->db->get();
		return $this->query_to_array($query);
	}
}
/* End of file compras_model.php */
/* Location: models/compras_model.php */