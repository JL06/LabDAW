<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i><?php echo $title ?></h3>
		<div class="row mt">

			<div class="col-lg-12">
				<div class="form-panel">
					<?php $this->load->view("notifications/mensaje"); ?>

					<form name="forma-material" class="form-horizontal style-form" method="post" action=<?php echo '"' . site_url("/materiales/".$link) . '"' ?>>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Tipo</label>
							<div class="col-md-5">
								<select name="idMaterial" class="form-control" required>
									<?php foreach($materiales as $m):?>
										<option value="<?php echo $m['id']?>"><?php echo $m['nombre'] ?> 
											<?php echo set_select('idMaterial', $m['id']);?>
										</option>
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

							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<label class="col-sm-1 control-label">Unidad</label>
								<div class="col-md-4">
									<?php if ($unidades !=NULL): ?>
										<select id="unidad-select" class="form-control">
											<?php foreach($unidades as $u):?>
												<option value="<?php echo $u['unidad']?>"
													<?php echo set_select('unidad-select', $u['unidad']);?>>
													<?php echo $u['unidad'];?>
												</option>
											<?php endforeach;?>
										</select>
										<span class="help-block"></span>
									<?php endif ?>
									<input type="text" id="unidad-input" class="form-control" maxlength="20" readonly>
									<input type="hidden" name="unidad">
								</div>
							</div>

						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Cantidad</label>
							<div class="col-md-2">
								<?php if (isset($cantidad)):?>
									<input value="<?php echo $cantidad;?>" type="number" name="cantidad" class="form-control" min="0" maxlength="20">
								<?php else:?>
									<input value="<?php set_value('cantidad') ?>" type="number" name="cantidad" class="form-control" min="0" maxlength="20">

								<?php endif; ?>
							</div>
							<span id="unit"></span>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Color</label>
							<div class="col-md-5">
								<select name="color" class="form-control">
									<?php foreach ($colores as $color) :?> 
										<option value="<?php echo $color['id'] ?>" 
											<?php if (isset($colorid)) if ($colorid == $color['id']) echo "selected" ?>
											<?php echo set_select('color',$color['id']);?>
											>
											<?php echo $color["nombre"] ?>
										</option>
									<?php endforeach ?>
								</select>
								<span class="help-block">
									<a href="#" id="color-show" data-toggle="modal" data-target="#colorModal">+Agregar nuevo color</a>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2" ></label>
							<button type="submit" class="btn btn-round btn-primary" id="guardar">Guardar</button>
							<?php if(isset($nombre)): ?>
								<a href="<?php echo base_url('materiales') ?>" class="btn btn-round btn-default">Cancelar</a>
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
		var idTipo = '<?php if(isset($idTipo)){ echo $idTipo;} ?>';
		if(idTipo !="")
			$("select[name=idMaterial]").find("option[value="+idTipo+"]").prop("selected",true);

		$("#guardar").click(function(event){
			event.preventDefault();
			if($("#unidad-input").val() == "")
				$("input[name=unidad]").val($("#unidad-select").val());
			else
				$("input[name=unidad]").val($("#unidad-input").val());
			$("form").submit();

		});
		var material=$("select[name=idMaterial]").val();

		$("select[name=idMaterial]").change(function(){
			material=$("select[name=idMaterial]").val();
			<?php if($link =="guardar"): ?>
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('materiales/get_unidad')?>",
				data:{selMat:material},
				success:function(unidad){
					$("#unit").html(unidad);
				}
			});
		<?php endif;?>

	});
		$("select[name=idMaterial]").change();

		$("#input-show").click(function(){

			if($("#input-name").css("display") == "none"){
				$("#input-show").text("-Elegir tipo existente");
				$("select[name=idMaterial]").prop("disabled", true);

				$("select[name=idMaterial]").prop("required", false);
				$("input[name=nombre]").prop("required", true);
				$("input[name=unidad]").prop("required", true);
				$("#unit").html("");
				$("#unidad-input").click(function(){
					$(this).prop("readonly",false);
					$("#unidad-select").prop("required",false);
					$(this).prop("required",true);

					$("#unidad-select").attr("class","form-control disabled");
				});

				$("#unidad-select").click(function(){
					$("#unidad-input").prop("readonly",true);
					$(this).prop("required",true);
					$("#unidad-input").prop("required",false);
					$("#unidad-input").val("");
					$(this).attr("class","form-control");			
				});
				$("#input-name").slideDown("fast");
			}
			else{

				$("#input-show").text("+Agregar nuevo tipo");

				$("select[name=idMaterial]").prop("required", true);
				$("#unidad-input").prop("required", false);
				$("input[name=nombre]").prop("required", false);

				$("select[name=idMaterial]").prop("disabled", false);

				$("#input-name").slideUp("fast",function(){
					$("input[name=nombre]").val("");
					$("#unidad-input").val("");
					$("select[name=idMaterial]").change();

				});

			}

		}


		);
});
</script>
<?php $this->load->view("modals/agregar_color")?>