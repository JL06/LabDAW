<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i>Crea un usuario</h3>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
         <h4 class="mb"><i class="fa fa-angle-right"></i>Usuario Nuevo</h4>
         <form class="form-horizontal style-form" method="post" action=<?php echo '"' . site_url("/usuarios/guardar") . '"' ?>>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
            <div class="col-md-5">
              <input type="text" name="nombre" class="form-control" maxlength="40" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Correo eléctronico</label>
            <div class="col-md-5">
              <input type="email" name="correo" class="form-control" maxlength="50" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Contraseña</label>
            <div class="col-md-5">
             <input type="password" name="clave" class="form-control" maxlength="50" required>
             <?php if (isset($errorclave)) echo '<span class="help-block">Error, ambos campos de contraseña deben ser identicos</span>'; ?>
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
            <input type="radio" name="genero" id="optionsRadios1" value="masculino" checked>
            Masculino
          </label>
        </div> <label class="col-sm-2 col-sm-2 control-label">&nbsp</label>
        <div class="radio">
         <label>
          <input type="radio" name="genero" id="optionsRadios2" value="femenino">
          Femenino
        </label>
      </div>
    </div>
    <div class="form-group">
     <label class="col-sm-2 col-sm-2 control-label">Teléfono</label>
     <div class="col-md-5">
      <input type="text" name="telefono" class="form-control" maxlength="12" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-2 col-sm-2 control-label">Rol</label>
    <div class="col-md-5">
      <select name="rol" class="form-control">
        <?php 
        foreach ($roles as $rol) {
          echo "<option value='";
          echo $rol->id;
          echo "'>".$rol->nombre;
          echo "</option>";
        }
        ?>
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