<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i><?php echo $title ?></h3>
    <div class="row mt">
      <div class="col-lg-12">

        <div class="form-panel">
          <?php $this->load->view("notifications/mensaje"); ?>

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
                  <span class="help-block">
                    <a href="#" id="input-show">+Agregar nuevo tipo</a>
                  </span>
                </div>
              </div>

              <div id="input-name" style="display:none">
                <div class="form-group">
                  <label class="col-sm-2 control-label"> </label>
                  <label class="col-sm-1 control-label">Nombre</label>
                  <div class="col-md-4">
                    <input type="text" name="nombre-tipo" class="form-control" maxlength="20">
                  </div>
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
                  <input type="hidden" name="materiales" id="materiales" value="">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2" for="precio">Precio</label>
                <div class="col-md-2">
                  <input type="number" name="precio" class="form-control" min="0" step="any">
                </div>
                <button id="calcula" type="button" class="btn btn-round btn-info col-md-1">Sugerir</button>
              </div>
              <div id="calculo" class="form-group" style="display:none">
                <label class="control-label col-md-1 col-md-offset-2">Costo</label>
                <div class="col-md-2">
                  <input id="costo" type="number" class="form-control" disabled>
                </div>
                <label class="control-label col-md-2">Porcentaje de ganancia</label>
                <div class="col-md-2 input-group">
                  <input id="ganancia" type="number" class="form-control" value="175" min="0">
                  <span class="input-group-addon">%</span>
                </div>
              </div>
              <?php $url = site_url("productos/costo"); ?>

              <div class="form-group">
                <label class="control-label col-md-2" for="cantidadProducto">Cantidad</label>
                <div class="col-md-2">
                  <input type="number" name="cantidadProducto" class="form-control" min="0">
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
                <label class="control-label col-md-2" ></label>

                <button type="submit" class="btn btn-round btn-primary">Guardar</button>
                <?php if(isset($producto)): ?>
                  <a href="<?php echo base_url('productos/listar') ?>" class="btn btn-round btn-default">Cancelar</a>
                <?php endif; ?>

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
        });//1.65+4.37
      });
    </script>
  <?php endif ?>

  <script type="text/javascript">
  $(document).ready(function () {
  //Calcula precio sugerido
    var costo = 0;
    $( "#calcula" ).click(function () {
      $("#calculo").show();
      var materiales = $("#materiales").val();
      var url = <?php echo json_encode($url); ?>;
      $.post(url, {materiales: materiales}).done(function (resultado) {
        $("#costo").val(resultado);
        costo = resultado;
        $("#ganancia").trigger("keyup");
      });
    });

    $("#ganancia").keyup(function () {
      var gan = $(this).val();
      var precio = costo * (gan/100);
      precio = precio.toFixed(2);
      $("input[name='precio']").val(precio);
    });

    $("input[name='precio']").keyup(function () {
      var precio = $("input[name='precio']").val();
      var gan = (precio/costo) * 100;
      gan = gan.toFixed(2);
      $("#ganancia").val(gan);
    });

    $("input[name='precio']").keypress(function(event) {
      if ( event.which == 45 || event.which == 189 ) {
        event.preventDefault();
      }
    });

    $("#ganancia").keypress(function(event) {
      if ( event.which == 45 || event.which == 189 ) {
        event.preventDefault();
      }
    });

    $("#input-show").click(function(){
      if($("#input-name").css("display") == "none"){
        $("#input-show").text("-Elegir tipo existente");
        $("select[name=idTipo]").prop("disabled", true);
        $("input[name=nombre-tipo]").prop("required", true);
        $("#input-name").slideDown("fast");
      }else{
        $("#input-show").text("+Agregar nuevo tipo");
        $("select[name=idTipo]").prop("disabled", false);
        $("input[name=nombre-tipo]").prop("required", false);
        $("#input-name").slideUp("fast", function(){
          $("input[name=nombre-tipo]").val("");
        });
      }
    });

  });
  </script>
