<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i>Registro de venta</h3>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
          <form class="form-horizontal style-form" method="post" action=<?php echo site_url("/ventas/register_form") ?>>
           <div class="form-group">
             <label class="control-label col-md-3">Producto</label>
             <select name="producto">
               <?php if($productos != NULL):?>
                <?php foreach ($productos as $p):?>
                  <option><?php echo $p['producto'] ?></option>
                <?php endforeach;?>
              <?php endif; ?>

            </select>
          </div>
          <div class="form-group">
           <label class="control-label col-md-3">Cantidad</label>
           <input type="number" min="1">
         </div>
         <div class="form-group">
          <label class="control-label col-md-3">Vendedor</label>
          <select name="vendedor">
           <?php if($vendedor != NULL):?>
            <?php foreach ($vendedor as $v):?>
              <option><?php echo $p['vendedor'] ?></option>
            <?php endforeach;?>
          <?php endif; ?>

        </select>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3">Lugar</label>
        <select name="lugar">
         <?php if($lugar != NULL):?>
          <?php foreach ($lugar as $v):?>
            <option><?php echo $p['lugar'] ?></option>
          <?php endforeach;?>
        <?php endif; ?>

      </select>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3">Fecha</label>
      <div class="col-md-3 col-xs-11">
        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="01-01-2014" class="input-append date dpYears">
        <input class="form-control form-control-inline input-medium default-date-picker" size="16" type="text" value="<?php echo date('d-m-y') ?>" >
        </div>
    </div>
      
    </div>

  </form>
</div>
</div>
</div>
</section>
</section>