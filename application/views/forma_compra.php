<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i><?php echo $title; ?></h3>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<?php $this->load->view("notifications/mensaje"); ?>

					<form class="form-horizontal style-form" method="post" action=<?php echo '"' . site_url("/compras/".$link) . '"' ?>>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Material</label>
							<div class="col-md-5">
								<select name="material" class="form-control">
									<?php foreach ($materiales as $material) :?> 
										<option value="<?php echo $material['id'] ?>" <?php if (isset($matid)) if ($matid == $material['id']) echo "selected" ?>><?php echo $material["nombre"]." ".$material["color"]." en ".$material['unidad']; ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Cantidad</label>
							<div class="col-md-5">
								<div class="input-group">
									<input value="<?php if (isset($cantidad)) echo $cantidad; ?>" type="number" name="cantidad" class="form-control" min="1" required>
									<?php if (isset($unidad)): ?>
									<div class="input-group-addon"><?php echo $unidad; ?></div>
									<?php else: ?>
									<div class="input-group-addon">unidad</div>
									<?php endif;?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Costo</label>
							<div class="col-md-5">
								<div class="input-group">
									<div class="input-group-addon">$</div>
									<input value="<?php if (isset($costo)) echo $costo; ?>" type="number" name="costo" class="form-control" min="0" required>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Fecha</label>
							<div class="col-md-5 col-xs-11">
								<input name="fecha" class="form-control form-control-inline input-medium default-date-picker" required size="16" type="text" value="<?php if (isset($fecha)) echo $fecha; else echo date('Y-m-d'); ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">&nbsp</label>
							<button type="submit" class="btn btn-round btn-primary">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>