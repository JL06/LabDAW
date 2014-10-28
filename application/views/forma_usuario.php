<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i><?php echo $title; ?></h3>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<?php $this->load->view("notifications/mensaje"); ?>

					<form class="form-horizontal style-form" method="post" action=<?php echo '"' . site_url("/usuarios/".$link) . '"' ?>>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Nombre</label>
							<div class="col-md-5">
								<input value="<?php if (isset($nom)) echo $nom; ?>" type="text" name="nombre" class="form-control" maxlength="40" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Correo eléctronico</label>
							<div class="col-md-5">
								<input value="<?php if (isset($email)) echo $email; ?>" type="email" name="correo" class="form-control" maxlength="50" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Contraseña</label>
							<div class="col-md-5">
								<input type="password" name="clave" class="form-control" maxlength="50" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Repite Contraseña</label>
							<div class="col-md-5">
								<input type="password" name="clave2" class="form-control" maxlength="50" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Género</label>
							<div class="radio">
								<label>
									<input type="radio" name="genero" id="optionsRadios1" value="masculino" <?php if (isset($genero)) {if ($genero == "masculino") echo "checked";} else echo "checked"; ?>>
									Masculino
								</label>
							</div> 
							<label class="col-sm-2 col-sm-2 control-label">&nbsp</label>
							<div class="radio">
								<label>
									<input type="radio" name="genero" id="optionsRadios2" value="femenino" <?php if (isset($genero)) if ($genero == "femenino") echo "checked"; ?>>
									Femenino
								</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Teléfono</label>
							<div class="col-md-5">
								<input value="<?php if (isset($telefono)) echo $telefono; ?>" type="text" name="telefono" class="form-control" maxlength="12" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Rol</label>
							<div class="col-md-5">
								<select name="rol" class="form-control">
									<?php foreach ($roles as $rol) :?> 
										<option value="<?php echo $rol['id'] ?>" <?php if (isset($rolid)) if ($rolid == $rol['id']) echo "selected" ?>><?php echo $rol["nombre"] ?></option>
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