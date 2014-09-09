<!--wrapper -->
<section id="main-content">
  <section class="wrapper site-min-height">
	<h3><i class="fa fa-angle-right"></i> <?php echo $title?></h3>
	<div class="row mt">
		<div class="col-lg-12">
			<div class="content-panel">
				<section id="unseen">
					<table class="table table-bordered table-sthiped table-condensed">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Vendedor</th>
								<th>Lugar</th>
								<th class="numeric">Precio unitario</th>
								<th>Fecha</th>
								<th class="numerc">Cantidad</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							foreach ($ventas as $v):?>
								<tr>
									<td><?php echo $v['producto'] ?></td>
									<td><?php echo $v['usuario'] ?></td>
									<td><?php echo $v['lugar'] ?></td>
									<td class="numeric"><?php echo $v['precio'] ?></td>
									<td><?php echo $v['fecha'] ?></td>
									<td><?php echo $v['cantidad'] ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</section>	
			</div>
		</div>
	</div>
	</section><!--/wrapper -->
</section>

