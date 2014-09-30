<!--wrapper -->
<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i> <?php echo $title?></h3>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="content-panel">
					<section id="unseen">
						<?php if($this->session->flashdata('mensaje')!=''): ?>
							<div class="col-lg-12">
								<div class="alert alert-success"><?php echo $this->session->flashdata('mensaje');?></div>
							</div>
						<?php endif;?>
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
													<a class="btn btn-primary btn-xs" href="#"><i class="fa fa-pencil"></i></a>
													<a class="btn btn-danger btn-xs" id="borrar" href="#"><i class="fa fa-trash-o "></i></a>
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
