<!--MODAL -->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
     <h4 class="modal-title">Agregar materiales</h4>
   </div>
   <div class="modal-body">
     <h3>¿De qué está hecho el producto?</h3>
     <?php if ($materiales != NULL): ?>
      <form class="form-horizontal style-form" name="materiales-producto"  id="materiales-producto">
       <table class="table table-hover" id="table-materiales">
        <thead>
         <tr>
          <th></th>
          <th>Material</th>
          <th>Color</th>
          <th>Cantidad</th>
          <th>Unidad</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($materiales as $m):?>
         <tr>
          <td>
           <input type="checkbox" value="<?php echo $m['id'] ?>" class="checkbox-inline">
         </td>
         <td><?php echo $m['nombre']?></td>
         <td><?php echo $m['color']?></td>
         <td class="col-md-2">
           <input type="number" id="<?php echo $m['id'] ?>" name="cantidad" class="form-control input-sm" disabled >
         </td>
         <td><?php echo $m['unidad'] ?></td>
       </tr>


       <?php //echo $m['nombre']." ".$m['color'] ?>

     <?php endforeach;?>


   </tbody>
 </table>

</form>
<?php endif;?>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
  <button type="button" class="btn btn-primary" id="guardar-modal" data-dismiss="modal">Guardar</button>
</div>
</div>
</div>
</div>
<!-- END MODAL -->
<script type="text/javascript">
	$(document).ready(function(){

		$("input:checkbox").change(function(){
			$("#" +this.value).attr("disabled", !$(this).attr("checked"));
      $("#" +this.value).val("");
    });

		$("#guardar-modal").click(function(){
			var selMat=[];
			$("input:checked").each(function(){
				var idMaterial=this.value;
				var cantidad=$("#"+idMaterial).val();
				selMat.push(idMaterial+":"+cantidad);

			});

			$("#materiales").val(selMat);
		});
		$("#table-materiales").DataTable();


	});
</script>