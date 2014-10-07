<?php
class Productos_model extends Generic_model 
{
	function get_productos($filter="")
	{
		$this->db->select('productos.id, productos.nombre, productos.precio, productos.descripcion, tipoproducto.nombre as tipo,tiempo,cantidadProducto,productos.idTipo');
		$this->db->from('productos');
		$this->db->join('tipoproducto','tipoproducto.id=productos.idTipo');
		if($filter!="")
			$this->db->where($filter);

		$query=$this->db->get();

		return $this->query_to_array($query);
	}

	public function asignar_material($prod_id,$mat) 
	{
		$insertData=array();
		
		foreach ($mat as $m) 
		{
			$m=explode(":", $m);
			$insertData[]=array('idProducto'=>$prod_id,'idMaterial'=>$m[0],'cantidad'=>$m[1]);	
		}
		if($this->db->insert_batch('productomaterial',$insertData))
			return true;

	}
	public function update_materiales($prod_id,$mat)
	{

		$updateData=array();
		
		foreach ($mat as $m) 
		{
			$m=explode(":", $m);
			$updateData[]=array('idProducto'=>$prod_id,'idMaterial'=>$m[0],'cantidad'=>$m[1]);	
		}
		if($this->db->update_batch('productomaterial',$updateData,'idProducto'))
		{
			return true;					
		}
	}
}	
?>
