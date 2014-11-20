<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i><?php echo $title ?> </h3>
    <div class="row mt">
      <div class="col-lg-12">
        <div class="form-panel">
          <?php $this->load->view('notifications/mensaje')?>
          <?php if(!isset($venta)): ?>
            <form id="form-venta" name="venta" class="form-horizontal style-form" method="post" action=<?php echo site_url("ventas/insertar_venta") ?>>
            <?php else:?>
              <form id="form-venta" name="venta" class="form-horizontal style-form" method="post" action=<?php echo site_url("ventas/actualizar/".$venta_id) ?>>
              <?php endif;?>
              <div class="form-group">
               <label class="control-label col-md-2">Producto</label>
               <div class="col-md-5">
                 <select name="idProducto" class="form-control">
                   <?php if($productos != NULL):?>
                    <?php foreach ($productos as $p):?>
                      <option value="<?php echo $p['id'] ?>"><?php echo $p['nombre'] ?></option>
                    <?php endforeach;?>
                  <?php endif; ?>

                </select>
              </div>
            </div>

            <div class="form-group">
             <label class="control-label col-md-2">Cantidad</label>
             <div class="col-md-2">
               <input type="number" min="1" name="cantidad" required class="form-control">           
             </div>
             <div id="cantidad-prod"></div>
           </div>

           <div class="form-group">
            <label class="control-label col-md-2">Lugar</label>
            <div class="col-md-5">
              <select name="idLugar" class="form-control">
               <?php if($lugar != NULL):?>
                <?php foreach ($lugar as $l):?>
                  <option value="<?php echo $l['id'] ?>"><?php echo $l['nombre'] ?></option>
                <?php endforeach;?>
              <?php endif; ?>

            </select>

          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Fecha</label>
          <div class="col-md-5 col-xs-11">
            <input name="fecha" class="form-control form-control-inline input-medium default-date-picker" required size="16" type="text" value="<?php echo date('Y-m-d')?>">
          </div>

        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">&nbsp;</label>
          <button type="submit" class="btn btn-round btn-primary">Guardar</button>
          <?php if(isset($venta)): ?>
            <a href="<?php echo base_url('ventas/listar') ?>" class="btn btn-round btn-default">Cancelar</a>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
</section>

<script type="text/javascript">
  $(document).ready(function(){
    $("select[name=idProducto]").change();
    <?php if(isset($venta)): ?>
    var venta=jQuery.parseJSON('<?php echo $venta; ?>');
    $.each(venta, function(key, value){
      $("input[name="+key+"]").val(value);
      $("select[name="+key+"]").find("option[value="+value+"]").prop("selected",true);
    });

  <?php endif; ?>
  $("select[name=idProducto]").change(function(){
    selProd=$("select[name=idProducto]").val();
    $.ajax({
      type:"POST",
      url:"<?php echo base_url('ventas/get_cantidad')?>",
      data:{selProd:selProd},
      success:function(cantidad){
        $("#cantidad-prod").attr("class","col-md-3 alert alert-info");
        $("#cantidad-prod").html("Actualmente cuentas con "+cantidad+" productos de este tipo");
      }
    });
  });
  $("select[name=idProducto]").change();
});
</script>
