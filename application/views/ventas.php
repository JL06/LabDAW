<!--wrapper -->
<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i> <?php echo $title?>
			<span class="inline">
				<a href="<?php echo base_url('ventas/registrar')?>" class="btn btn-success">
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
									<th>Producto</th>
									<th>Tipo</th>
									<th>Vendedor</th>
									<th>Punto de venta</th>
									<th class="numeric">Precio unitario</th>
									<th class="numerc">Cantidad</th>
									<th class="numeric">Total</th>
									<th>Fecha</th>
								</tr>
							</thead>
							<tbody>
								<?php if($ventas != NULL): ?>
									<?php foreach ($ventas as $v):?>
										<tr>
											<td><?php echo $v['producto'] ?></td>
											<td><?php echo $v['tipo'] ?></td>
											<td><?php echo $v['usuario'] ?></td>
											<td><?php echo $v['lugar'] ?></td>
											<td class="numeric">$ <?php echo $v['precio'] ?></td>
											<td><?php echo $v['cantidad'] ?></td>
											<td class="numeric">$ <?php echo $v['total'] ?></td>
											<td><?php echo $v['fecha'] ?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</section>	
				</div>
				
			</div>
		</div>
	</section><!--/wrapper -->
</section>
<script type="text/javascript">
	$(document).ready( function () {
		$("#table-ventas").DataTable();
	} );
</script>
