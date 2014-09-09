<?php
class Permission_model extends Generic_model{

	function has_permission($idRole, $permission){
		$perm= $this->leer->('permiso', array('idRol' => $idRole,'permiso' => $permission));

	}
}
?>