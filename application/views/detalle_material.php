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
						<div class="panel panel-default">
							<!-- Default panel contents -->
							<div class="panel-heading">Detalles</div>
							<!-- List group -->
							<ul class="list-group">
								<li class="list-group-item">
									<strong>Nombre: </strong>
									<?php echo $producto["nombre"]?>
								</li>
								<li class="list-group-item">
									<strong>Tipo: </strong>
									<?php echo $producto["tipo"]?>

								</li>
								<li class="list-group-item">
									<strong>Descripción: </strong>
									<?php $desc= $producto["descripcion"]=="" ? "Sin descripción":$producto["descripcion"];
									echo $desc;
									?>

								</li>
								<li class="list-group-item">
									<strong>Precio: $</strong>
									<?php echo $producto["precio"]?>

								</li>
								<li class="list-group-item">
									<strong>Tiempo de elaboración: </strong>
									<?php echo $producto["tiempo"]?> horas

								</li>
								
							</ul>
						</div>
						<div class="panel panel-default">
							<!-- Default panel contents -->
							<div class="panel-heading">Materiales</div>
							<!-- List group -->
							<table class="table table-hover" id="table-materiales">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Color</th>
										<th>Cantidad</th>
										<th>Unidad</th>
									</tr>
								</thead>
								<tbody>
									<?php if($materiales != NULL): ?>
										<?php foreach ($materiales as $m):?>
											<tr>
												
												<td><?php echo $m['nombre']?></td>
												<td><?php echo $m['color']?></td>
												<td class="col-md-2"><?php echo $m['cantidad']?></td>
												<td><?php echo $m['unidad'] ?></td>
											</tr>
										<?php endforeach;?>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</section>	
				</div>
			</div>
		</div>
	</section>
	<!--/wrapper -->
</section>
