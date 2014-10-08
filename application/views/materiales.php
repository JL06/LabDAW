<!--wrapper -->
<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i> <?php echo $title?>
			<span class="inline">
				<a href="<?php echo base_url('materiales/agregar')?>" class="btn btn-success">
					<span class="glyphicon glyphicon-plus-sign"></span>
					Agregar
				</a>
			</span>
		</h3>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="content-panel">
					<section id="unseen">
						<?php $this->load->view('notifications/mensaje')?>
						<table class="table table-bordered table-sthiped table-condensed display" id="table-ventas">
							<thead>
								<tr>
									<th>Material</th>
									<th>Color</th>
									<th>Cantidad</th>
									<th>Unidad</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php if($materiales != NULL): ?>
									<?php foreach($materiales as $m): ?>
										<tr>
											<td><?php echo $m['nombre'] ?></td>
											<td> <?php echo $m['color']?></td>
											<td><?php echo $m['cantidadMaterial']?></td>
											<td><?php echo $m['unidad']?></td>
											<td>
												<div class="pull-right hidden-phone">
													<a class="btn btn-theme03" href="<?php echo base_url('materiales/actualizar/'.$m['id'])?>"><i class="fa fa-pencil"></i></a>
													<a class="btn btn-theme04" id="borrar" href="<?php echo base_url('materiales/borrar/'.$m['id'])?>"><i class="fa fa-trash-o "></i></a>
												</div>
											</td>

										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</section>	
				</div>
			</div>
		</div>
	</section>
	<!--/wrapper -->
</section>
<script type="text/javascript">
	$(document).ready( function () {
		$("#table-ventas").DataTable();

		$("a#borrar").click(function(e){
			e.preventDefault();
			var url=$(this).attr("href");
			if (confirm("¿Deseas borrar el material?")) {
				window.location.replace(url);
			};

		})
	} );
</script>
