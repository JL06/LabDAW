<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i><?php echo $title; ?></h3>
		<div class="row mt">
			<?php if($this->session->flashdata('mensaje')!=''): ?>
				<div class="col-lg-12">
					<div class="alert alert-danger"><?php echo $this->session->flashdata('mensaje');?></div>
				</div>
			<?php endif;?>
			<div class="col-lg-12">
				<div class="form-panel">
				 <form class="form-horizontal style-form" method="post" action=<?php echo '"' . site_url("/materiales/".$link) . '"' ?>>
					<div class="form-group">
						<label class="col-sm-2 col-sm-2 control-label">Nombre</label>
						<div class="col-md-5">
							<input value="<?php if (isset($nombre)) echo $nombre; ?>" type="text" name="nombre" class="form-control" maxlength="20" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 col-sm-2 control-label">Unidad</label>
						<div class="col-md-5">
							<input value="<?php if (isset($unidad)) echo $unidad; ?>" type="text" name="unidad" class="form-control" maxlength="20" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 col-sm-2 control-label">Cantidad</label>
						<div class="col-md-5">
						 <input value="<?php if (isset($cantidad)) echo $cantidad; ?>" type="text" name="cantidad" class="form-control" min="0" maxlength="20">
						</div>
					</div>
	
					<div class="form-group">
					 <label class="col-sm-2 col-sm-2 control-label">Color</label>
						<div class="col-md-5">
						 <select name="color" class="form-control">
							<?php foreach ($colores as $color) :?> 
								<option value="<?php echo $color['id'] ?>" <?php if (isset($colorid)) if ($colorid == $color['id']) echo "selected" ?>><?php echo $color["nombre"] ?></option>
							<?php endforeach ?>
						 </select>
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