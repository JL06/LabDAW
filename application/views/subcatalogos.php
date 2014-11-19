<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i>Administrar subcatálogos</h3>
		<div class="row">
			
			<div class="col-md-6 col-sm-6 mb">
				<div class="grey-panel pn " >
					<div class="grey-header" id="tipoprod">
						<h5>Tipo de producto</h5>
					</div>	
					<div class="content-panel tipo">	
						<section>
							<table class="table table-condensed table-striped table-hover table-subcatalogo" id="table-tipoproducto">
								<thead>
									<th>Tipo</th>
									<th>Acciones</th>
								</thead>
								<tbody>
									<?php foreach($tipoproducto as $p):?>
										<tr>
											<td><?php echo $p['nombre']?></td>
											<td>
												<a class="btn btn-xs btn-theme03" href="<?php echo base_url('materiales/actualizar/'.$p['id'])?>"><i class="fa fa-pencil"></i></a>
												<a class="btn btn-xs btn-theme04" href="<?php echo base_url('materiales/borrar/'.$p['id'])?>"><i class="fa fa-trash-o"></i></a>

											</td>
										</tr>
									<?php endforeach;?>

								</tbody>
							</table>

						</section>					
					</div>

				</div>
			</div>
			<div class="col-md-6 col-sm-6 mb">
				<div class="grey-panel pn donut-chart">
					<div class="grey-header">
						<h5>Tipo de material</h5>
					</div>	
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-md-6 col-sm-6 mb">
				<div class="grey-panel pn donut-chart">
					<div class="grey-header">
						<h5>Tipo de gasto</h5>
					</div>	
				</div>
			</div>
			<div class="col-md-6 col-sm-6 mb">
				<div class="grey-panel pn donut-chart">
					<div class="grey-header">
						<h5>Colores</h5>
					</div>	
				</div>
			</div>
		</div>
	</section>
</section>
<script type="text/javascript">
	$(document).ready( function () {
		$("#table-tipoproducto").DataTable();
		$(".grey-panel").css("height","41");
		//$(".tipo").hide();

		$(".grey-header").click(function(){

			$(".grey-panel").css("height","auto");
		});
	});
</script>