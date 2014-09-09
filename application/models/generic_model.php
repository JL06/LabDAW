<?php

class Generic_model extends CI_Model {
	function create($entity, $param){
		return $this->db->insert($entity,$param);
	}
	
	function read($entity, $param){
		$query = $this->db->get_where($entity,$param);
		foreach ($query->result() as $row)
		{
		   $result[]=$row;
		}
		return $result;
	}

	function list($entity){
		$query = $this->db->get($entity);
		foreach ($query->result() as $row)
		{
		   $result[]=$row;
		}
		return $result;
	}

	function delete($entity,$param){
		return $this->db->delete($entity,$param);
	}

	function update($entity,$param,$new_data){
		return $this->db->update($entity,$new_data,$param);
	}
}
?>