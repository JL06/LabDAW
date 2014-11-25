<?php
class Lugares_model extends Generic_Model {

	function lugar ($id) 
	{
		$this->db->select('*');
		$this->db->from('lugar');
		$this->db->where($id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$lugar = $query->row_array();
		} else {
			$lugar = NULL;
		}
		return $lugar;
	}

	function repetido($nombre)
	{
		$this->db->select("*");
		$this->db->from("lugar");
		$this->db->where($nombre);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$lugar = TRUE;
		} else {
			$lugar = FALSE;
		}
		return $lugar;
	}

		function activo($nombre)
	{
		$this->db->select("*");
		$this->db->from("lugar");
		$this->db->where($nombre);
		$this->db->where(array('activo' => 1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$lugar = TRUE;
		} else {
			$lugar = FALSE;
		}
		return $lugar;
	}
}
/* End of file lugares_model.php */
/* Location: models/lugares_model.php */