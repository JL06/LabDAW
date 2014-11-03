<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i><?php echo $title ?></h3>
    <div class="row mt">
      <div class="col-lg-12">
        <div class="col-md-12 mt">
          <div class="content-panel">
            <div class="col-lg-12" id="error"></div>
            <div class="col-lg-12" id="instrucciones">
              <div class="alert alert-info">
                Elige un producto y una cantidad para conocer que necesitas para crearlos
              </div>
            </div>

            <form name="venta" class="form-horizontal style-form" methos="post">
              <a href="#"data-toggle="modal" data-target="#scheduleModal" id="modal-link"></a>
               <div class="form-group">
                 <label class="control-label col-md-2">Producto</label>
                 <div class="col-md-5">
                   <select name="idProducto" class="form-control">

                    <?php if($productos!=NULL): ?>
                      <?php foreach($productos as $p): ?>
                        <option value="<?php echo $p['id'] ?>"><?php echo $p['nombre'] ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>

                  </select>
                 </div>
              </div>
                
              <div class="form-group">
                <label class="control-label col-md-2">Cantidad</label>
                <div class="col-md-2">
                  <input type="number" min="1" name="cantidad" required class="form-control">           
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">&nbsp;</label>
                <button type="submit" class="btn btn-round btn-primary" >Agendar</button>
              </div>
              
            </form>
        </div>
      </div>
    </div>
  </section>
</section>
<?php $this->load->view("modals/calcular_agenda");?>

<script type="text/javascript">
  $(":button").click(function(event){
    event.preventDefault();
    if(!$.isNumeric($("input[name=cantidad]").val())){
      $("#error").html("<div class=\"alert alert-danger\"> Inserta una cantidad válida</div>");
    }else{
      $("#error").html("");
      $.ajax({
        type:"POST",
        url:"<?php echo base_url('productos/calcular_agenda')?>",
        data: {idProducto: $("select[name=idProducto] option:selected").val(), cantidad: $("input[name=cantidad]").val()},
        success: function(data){
         $("#modal-link")[0].click();
         $("#modal-div").html(data);
        }
      });
    }
  });
</script>