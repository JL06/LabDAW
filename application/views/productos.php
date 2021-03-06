<!--wrapper -->
<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i> <?php echo $title?>
			<span class="inline">
				<a href="<?php echo base_url('productos/registrar')?>" class="btn btn-success">
					<span class="glyphicon glyphicon-plus-sign"></span>
					Agregar
				</a>
				<a href="<?php echo base_url('productos/asignaciones')?>" class="btn btn-info">
					<span class="glyphicon glyphicon-plus-sign"></span>
					Asignar
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
									<th>Nombre</th>
									<th>Tipo</th>
									<th>Descripción</th>
									<th class="numeric">Precio</th>
									<th>Cantidad</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php if($productos != NULL): ?>
									<?php foreach($productos as $p): ?>
										<tr>
											<td  class="dropdown-toggle">
												<?php echo $p['nombre'] ?>
											</td>
											<td><?php echo $p['tipo'] ?></td>
											<td><?php echo $p['descripcion'] ?></td>
											<td class="numeric"> $<?php echo $p['precio']?></td>
											<td class="numeric"><?php echo $p['cantidadProducto']?></td>
											<td>
												<div class="pull-right hidden-phone">
													<a href="<?php echo base_url('productos/detalle').'/'.$p['id'] ;?>"><span class="glyphicon glyphicon-eye-open btn btn-theme"></span></a>
													<a class="btn btn-theme03" href="<?php echo base_url('productos/actualizar_producto/'.$p['id'])?>"><i class="fa fa-pencil"></i></a>
													<a class="btn btn-theme04" id="borrar" href="<?php echo base_url('productos/borrar/'.$p['id'])?>"><i class="fa fa-trash-o "></i></a>
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
			if (confirm("¿Deseas eliminar el producto?")) {
				window.location.replace(url);
			};

		});

	} );
</script>
