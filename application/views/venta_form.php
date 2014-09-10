<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i>Registro de venta</h3>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
          <form name="venta" class="form-horizontal style-form" method="post" action=<?php echo site_url("ventas/insertar_venta") ?>>
           
           <div class="form-group">
             <label class="control-label col-md-3">Producto</label>
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
           <label class="control-label col-md-3">Cantidad</label>
           <input type="number" min="1" name="cantidad" required>
         </div>
         
         <div class="form-group">
          <label class="control-label col-md-3">Vendedor</label> 
          <select name="idVendedor">
           <?php if($vendedor != NULL):?>
            <?php  foreach ($vendedor as $v):?>
              <option value="<?php echo $v['id'] ?>"><?php echo $v['nombre'] ?></option>
            <?php endforeach;?>
          <?php endif; ?>
        </select>
      </div>
     
      <div class="form-group">
        <label class="control-label col-md-3">Lugar</label>
        <select name="idLugar">
         <?php if($lugar != NULL):?>
          <?php foreach ($lugar as $l):?>
            <option value="<?php echo $l['id'] ?>"><?php echo $l['nombre'] ?></option>
          <?php endforeach;?>
        <?php endif; ?>

      </select>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3">Fecha</label>
      <div class="col-md-3 col-xs-11">
        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="01-01-2014" class="input-append date dpYears">
        <input name="fecha" class="form-control form-control-inline input-medium default-date-picker" required size="16" type="text" value="<?php echo date('d-m-y') ?>" >
        </div>
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