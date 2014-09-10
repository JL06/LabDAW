<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i><?php echo $title ?></h3>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
          <form class="form-horizontal style-form" method="post" action=<?php echo site_url("/productos/insertar_producto") ?>>

            <div class="form-group">
              <label class="control-label col-md-3">Nombre</label>
              <input type="text" name="nombre" required>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tipo</label>
              <select name="idTipo">
                <?php if($tipo != NULL): ?>
                  <?php foreach($tipo as $t): ?>
                    <option value="<?php echo $t['id'] ?>"><?php echo $t['nombre'] ?></option>
                  <?php endforeach ?>
                <?php endif ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Descripción</label>
              <input type="text" name="descripcion">
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Precio</label>
              <input type="number" name="precio" required>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">&nbsp;</label>
            <button type="submit" class="btn btn-round btn-primary">Guardar</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
</section>