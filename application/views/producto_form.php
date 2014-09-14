<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i><?php echo $title ?></h3>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
          <form class="form-horizontal style-form" name="producto" method="post" action=<?php echo site_url("/productos/insertar_producto") ?>>

            <div class="form-group">
              <label class="control-label col-md-2">Nombre</label>
              <div class="col-md-5">
                <input type="text" name="nombre" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2">Tipo</label>
              <div class="col-md-5">
                <select name="idTipo" class="form-control">
                  <?php if($tipo != NULL): ?>
                    <?php foreach($tipo as $t): ?>
                      <option value="<?php echo $t['id'] ?>"><?php echo $t['nombre'] ?></option>
                    <?php endforeach ?>
                  <?php endif ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2">Descripción</label>
              <div class="col-md-5">
                <input type="text" name="descripcion" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2">Materiales</label>
              <div class="col-md-5">
                <a href="#"data-toggle="modal" data-target="#basicModal"> + Agregar materiales</a>
                <input type="hidden" name="materiales" id="materiales">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2">Precio</label>
              <div class="col-md-2">
                <input type="number" name="precio" class="form-control" required>
              </div>
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

<?php $this->load->view("modals/agregar_mat");?>