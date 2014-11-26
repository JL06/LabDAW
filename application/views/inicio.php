<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<section id="main-content">
	<section class="wrapper site-min-height">
		<div class="row">

			<div class="col-lg-9 main-chart">
				<h3><i class="fa fa-angle-right"></i>
					<?php if ($usuario['genero'] == 'femenino'):?>
						¡Bienvenida <?php echo $usuario['nom'] ?>!
					<?php else: ?>
						¡Bienvenido <?php echo $usuario['nom'] ?>!
					<?php endif; ?>
				</h3>
				<div class="row">				
					<div class="col-lg-6 col-md-6 mb">
						<div class="green-panel pn">
							<div class="green-header">
								<h5>Mi información</h5>
							</div>
							<p class="text-left">
								<p><span class="glyphicon glyphicon-envelope"></span> <strong>Correo</strong> 
									<p> <?php echo  $usuario['email']?></p>
								</p>
								<p><span class="glyphicon glyphicon-earphone"></span> <strong>Teléfono</strong>
									<p>
										<?php echo  $usuario['telefono']?>
									</p>
								</p>
								<p><span class="glyphicon glyphicon-lock"></span> <strong>Contraseña</strong>

									<p>&#149;&#149;&#149;&#149; <a href="<?php echo base_url('cuenta'); ?>">Cambiar</a></p>								</p>
									
								</p>

							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="darkblue-panel pn">
								<div class="darkblue-header">
									<h5>Mis ventas</h5>
								</div>
								<div class="chart" id="grafica-ventas" style="height:160px"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-12 col-md-12 mb">
								<div class="grey-panel">
									<div class="grey-header" style="margin-bottom:0px">
										<h5>Mis asignaciones</h5>
									</div>
									<?php if( !empty($asignaciones)): ?>
										<div class="content-panel" style="min-height:192px">
											<table class="table">
												<thead class="cf">
													<tr>
														<?php if ($usuario["rolid"] == 1): ?>
															<td>Vendedor</td>
														<?php else: ?>
															<td>Administrador</td>
														<?php endif; ?>
														<td>Producto</td>
														<td>Cantidad</td>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($asignaciones as $a): ?>
														<tr>
															<td>
																<?php if($usuario["rolid"] == 1): ?>
																	<?php echo $a['vendedor']; ?>
																<?php else: ?>
																	<?php echo $a['admin']; ?>

																<?php endif;?>
															</td>
															<td><?php echo $a['nombre']; ?></td>
															<td><?php echo $a['cantidadProducto']; ?></td>
														</tr>
													<?php endforeach;?>

												</tbody>
											</table>
											
										</div>
									<?php else : ?>
										<p>No hay asignaciones que mostrar</p>
									<?php endif;?>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 ds" style="min-height:500px">
					<h3>Historial</h3>
					<?php foreach($historial as $h): ?>
						<div class="desc">
							<div class="thumb">
								<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
							</div>
							<div class="details">
								<p><muted><?php echo $h["fecha"]; ?></muted><br>
									<?php echo $h["accion"];?>
								</p>
							</div>
						</div>

					<?php endforeach; ?>
					<!-- First Action -->


				</div>

			</div>


		</section>
	</section>
	<script type="text/javascript">

		$(document).ready(function(){

			ventas = <?php echo $ventas; ?>;
			new Morris.Line({
				element: 'grafica-ventas',
				data: ventas,
				xkey: 'fecha',
				ykeys: ['total'],
				labels: ['total'],
				lineColors:["#ff865c"],
				gridTextColor: "#fff",
				parseTime: false

			});
		});
	</script>