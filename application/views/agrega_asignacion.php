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
         <form class="form-horizontal style-form" method="post" action=<?php echo '"' . site_url("/productos/suma_asignacion") . '"' ?>>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
            <div class="col-md-5">
              <?php if(isset($asignacion)): ?>
                <?php echo $asignacion['vendedor']; ?>
                <input name="vendedor" value="<?php echo $asignacion['idv']; ?>"hidden>
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Producto</label>
            <div class="col-md-5">
              <?php if(isset($asignacion)): ?>
                <?php echo $asignacion['producto']; ?>
                <input name="producto" value="<?php echo $asignacion['id']; ?>"hidden>
              <?php endif; ?>
            </div>
          </div>
          
          <div class="form-group">
           <label class="col-sm-2 col-sm-2 control-label">Cantidad</label>
           <div class="col-md-1">
            <?php if (isset($cantidad)) echo $cantidad; ?>
           </div>
           <div class="col-md-1">
            <i class="glyphicon glyphicon-plus"></i>
           </div>
            <div class="col-md-2"> 
             <input value="0" type="number" name="cantidad" class="form-control" min="1" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
            </div>
          </div>
  
          
          <div class="form-group">
           <label class="col-sm-2 col-sm-2 control-label">&nbsp</label>
           <button type="submit" class="btn btn-round btn-primary">Agrega</button>&nbsp&nbsp&nbsp
           <a class="btn btn-round btn-default" href="<?php echo base_url('productos/asignaciones'); ?>">Cancelar</a>
          </div>
         </form>
        </div>
      </div>
    </div>
  </section>
</section>