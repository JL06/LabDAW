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
                            <form class="form-horizontal style-form" name="materiales-producto">
	                            <table class="table" id="table-materiales">
		                            <thead>
		                            	<tr>
		                            		<th></th>
		                            		<th>Material</th>
		                            		<th>Color</th>
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
                          <button type="button" class="btn btn-primary" id="guardar-modal">Guardar</button>
                  </div>
              </div>
            </div>
          </div>
          <!-- END MODAL -->
          <script type="text/javascript">
          $(document).ready(function(){
	          $("#guardar-modal").click(function(){
	            var selMat=[];
	              $("input:checked").each(function(){
	                selMat.push(this.value);
	              });
	              $("#materiales").val(selMat);
	          });
          	$("#table-materiales").DataTable();
          });
          </script>