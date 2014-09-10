<!--wrapper -->
<section id="main-content">
  <section class="wrapper site-min-height">
	<h3><i class="fa fa-angle-right"></i> <?php echo $title?></h3>
	<div class="row mt">
		<div class="col-lg-12">
			<div class="content-panel">
				<section id="unseen">
					<table class="table table-bordered table-sthiped table-condensed display" id="table-ventas">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Tipo</th>
								<th>Descripción</th>
								<th class="numeric">Precio</th>
							</tr>
						</thead>
						<tbody>
						<?php if($productos != NULL): ?>
							<?php foreach($productos as $p): ?>
								<tr>
									<td><?php echo $p['nombre'] ?></td>
									<td><?php echo $p['tipo'] ?></td>
									<td><?php echo $p['descripcion'] ?></td>
									<td class="numeric"><?php echo $p['precio'] ?></td>
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
} );
</script>
