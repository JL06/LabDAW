<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i><?php echo $title ?></h3>
    <div class="row mt">
      <div class="col-lg-12">

        <div class="form-panel">
          <?php if($this->session->flashdata('mensaje') != ""): ?>
            <div class="col-lg-12">
              <div class="<?php echo $this->session->flashdata('class');?>">
                <?php echo $this->session->flashdata('mensaje');?>
              </div>
            </div>
          <?php endif;?>
          <?php if ( ! isset($producto)): ?>
            <form id="form-producto" class="form-horizontal style-form" name="producto" method="post" action=<?php echo site_url("/productos/insertar_producto") ?>> 
            <?php else:?>
              <form id="form-producto" class="form-horizontal style-form" name="producto" method="post" action=<?php echo site_url("/productos/actualizar/".$prod_id) ?>>           
              <?php endif;?>
              <div class="form-group" id="nombre-input">
                <label class="control-label col-md-2" for="nombre">Nombre</label>
                <div class="col-md-5">
                  <input type="text" name="nombre" class="form-control" required>
                  <div id="msg"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2" for="idTipo">Tipo</label>
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
                <label class="control-label col-md-2" for="descripcion">Descripción</label>
                <div class="col-md-5">
                  <input type="text" name="descripcion" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2">Materiales</label>
                <div class="col-md-5">
                  <a href="#"data-toggle="modal" data-target="#basicModal"> 
                    <?php if (!isset($producto)):?>
                      + Agregar materiales
                    <?php else: ?>
                      + Editar materiales
                    <?php endif;?>
                  </a>
                  <input type="hidden" name="materiales" id="materiales">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2" for="precio">Precio</label>
                <div class="col-md-2">
                  <input type="number" name="precio" class="form-control" min="0">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2" for="cantidadProducto">Cantidad</label>
                <div class="col-md-2">
                  <input type="number" name="cantidadProducto" class="form-control" min="0" >
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2" for="tiempo">Tiempo de elaboración</label>
                <div class="col-md-2">

                  <input type="number" name="tiempo" class="form-control" min="0" required> 
                </div>
                <span> horas</span>
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

  <?php if (isset($producto)): ?>

    <script type="text/javascript">
      $(document).ready(function(){
        var producto=jQuery.parseJSON('<?php echo $producto; ?>');
        var materiales=jQuery.parseJSON('<?php echo $mat_actuales; ?>');

        $.each(producto,function(key,value){
          $("input[name="+key+"]").val(value);
          $("select[name="+key+"]").find("option[value="+value+"]").prop("selected",true);
        });

        $.each(materiales,function(key,value){
          $("input[type=checkbox]").filter(function(){return this.value==value.id}).prop("checked",true);
          $("input[type=number]").filter(function(){return this.id==value.id}).val(value.cantidad);
          $("input[type=number]").filter(function(){return this.id==value.id}).attr("disabled",false);
        });
      });
    </script>
  <?php endif ?>
