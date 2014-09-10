<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i>Registro de venta</h3>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
                      <form class="form-horizontal style-form" method="post" action=<?php echo site_url("/ventas/register_form") ?>>
                         <div class="form-group">
                         <label class="col-sm-2 col-sm-2 control-label">Producto</label>
                           <select name="producto">
                           <?php if($productos != NULL):?>
                            <?php foreach ($productos as $p):?>
                              <option><?php echo $p['producto'] ?></option>
                            <?php endforeach;?>
                           <?php endif; ?>
                             
                           </select>
                         </div>
                      </form>
                  </div>
			</div>
		</div>
	</section>
</section>