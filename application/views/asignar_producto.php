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
         <form class="form-horizontal style-form" method="post" action=<?php echo '"' . site_url("/productos/".$link) . '"' ?>>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
            <div class="col-md-5">
              <?php if(isset($usuarios)): ?>
                <select name="vendedor" class="form-control">
                  <?php foreach($usuarios as $user): ?>
                  <option name="vendedor" value="<?php echo $user['id']; ?>"><?php echo $user['nom']; ?></option>
                  <?php endforeach; ?>
                </select>
              <?php endif; ?>
              <?php if(isset($asignacion)): ?>
                <?php echo $asignacion['vendedor']; ?>
                <input name="vendedor" value="<?php echo $asignacion['idv']; ?>"hidden>
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Producto</label>
            <div class="col-md-5">
              <?php if(isset($productos)): ?>
                <select name="producto" class="form-control">
                  <?php foreach($productos as $prod): ?>
                  <option name="producto" value="<?php echo $prod['id']; ?>"><?php echo $prod['nombre']; ?></option>
                  <?php endforeach; ?>
                </select>
              <?php endif; ?>
              <?php if(isset($asignacion)): ?>
                <?php echo $asignacion['producto']; ?>
                <input name="producto" value="<?php echo $asignacion['id']; ?>"hidden>
              <?php endif; ?>
            </div>
          </div>
          
          <div class="form-group">
           <label class="col-sm-2 col-sm-2 control-label">Cantidad</label>
            <div class="col-md-5">
             <input value="<?php if (isset($cantidad)) echo $cantidad; ?>" type="number" name="cantidad" class="form-control" min="1" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
            </div>
          </div>
  
          
          <div class="form-group">
           <label class="col-sm-2 col-sm-2 control-label">&nbsp</label>
           <button type="submit" class="btn btn-round btn-primary">Guardar</button>&nbsp&nbsp&nbsp
           <a class="btn btn-round btn-default" href="<?php echo base_url('productos/asignaciones'); ?>">Cancelar</a>
          </div>
         </form>
        </div>
      </div>
    </div>
  </section>
</section>