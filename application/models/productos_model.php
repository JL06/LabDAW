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

		public function asignar_material($prodId,$mat) {
			$insertData=array();
			
			foreach ($mat as $m) {
				$m=explode(":", $m);
				$insertData[]=array('idProducto'=>$prodId,'idMaterial'=>$m[0],'cantidad'=>$m[1]);	
			}
			if($this->db->insert_batch('productomaterial',$insertData))
				return true;

		}
	}
?>