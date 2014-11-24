<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i><?php echo $title;?></h3>
		<div class="row mt">

			<div class="col-lg-12">
				<div class="form-panel">
					<?php $this->load->view("notifications/mensaje"); ?>
					<?php if(!isset($gasto)): ?>
						<form name="gasto-form" class="form-horizontal style-form" method="post" action="<?php echo base_url('gastos/guardar')?>">
						<?php else: ?>
							<form name="gasto-form" class="form-horizontal style-form" method="post" action="<?php echo base_url('gastos/guardar_actual/'.$gasto['id'])?>">

							<?php endif;?>
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label">Tipo</label>
								<div class="col-md-5">
									<select name="idTipoGasto" class="form-control" required >
										<?php foreach($gastos as $g):?>
											<option value="<?php echo $g['id']?>"
												<?php if( isset($gasto) && $gasto['tipo'] == $g['id']):?>
													selected
												<?php endif;?>
												><?php echo $g['nombre'] ?></option>
											<?php endforeach;?>
										</select>
										<span class="help-block">
											<a href="#" id="input-show">+Agregar nuevo tipo</a>
										</span>
									</div>
								</div>
								<div id="input-name" style="display:none">
									<div class="form-group">
										<label class="col-sm-2 control-label"> </label>
										<label class="col-sm-1 control-label">Nombre</label>
										<div class="col-md-4">
											<input type="text" name="nombre" class="form-control" maxlength="20">
										</div>
									</div>							
								</div>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label">Costo</label>
									<div class="col-md-2">
										<input value="<?php if (isset($gasto)) echo $gasto['costo']; ?>" type="number" min="0" name="costo" class="form-control" min="0" maxlength="20">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label">Fecha</label>
									<div class="col-md-4">
										<input name="fecha" value="<?php if (isset($gasto)) echo $gasto['fecha']; else echo date('Y-m-d'); ?>" class="form-control form-control-inline input-medium default-date-picker" required size="16" type="text">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-2" ></label>
									<button type="submit" class="btn btn-round btn-primary">Guardar</button>
									<?php if(isset($gasto)): ?>
										<a href="<?php echo base_url('gastos') ?>" class="btn btn-round btn-default">Cancelar</a>
									<?php endif; ?>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
		</section>
		<script type="text/javascript">
			$(document).ready(function(){

				if ()
				{

				}

				$("#input-show").click(function(){
					if($("#input-name").css("display") == "none"){
						$("#input-show").text("-Elegir tipo existente");
						$("select[name=idTipoGasto]").prop("disabled", true);

						$("select[name=idTipoGasto]").prop("required", false);
						$("input[name=nombre]").prop("required", true);
						$("#unit").html("");

						$("#input-name").slideDown("fast");
					}
					else{

						$("#input-show").text("+Agregar nuevo tipo");

						$("select[name=idTipoGasto]").prop("required", true);
						$("input[name=nombre]").prop("required", false);

						$("select[name=idTipoGasto]").prop("disabled", false);

						$("#input-name").slideUp("fast",function(){
							$("input[name=nombre]").val("");
							$("select[name=idTipoGasto]").change();

						});


					}

				}
				);
			});
		</script>
