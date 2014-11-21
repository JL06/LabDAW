<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i><?php echo $title; ?></h3>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<?php $this->load->view("notifications/mensaje"); ?>

					<form class="form-horizontal style-form" method="post" action=<?php echo '"' . site_url("/lugares/".$link) . '"' ?>>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Nombre</label>
							<div class="col-md-5">
								<input value="<?php if (isset($nombre)) echo $nombre; ?>" type="text" name="nombre" class="form-control" maxlength="30" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">&nbsp</label>&nbsp&nbsp&nbsp
							<button type="submit" class="btn btn-round btn-primary">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>