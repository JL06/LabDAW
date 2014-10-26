<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i>Balance</h3>
    <!-- page start-->
    <div class="row mt">
      <div class="col-lg-12">
        <div class="content-panel">
          <h4><i class="fa fa-angle-right"></i>Balance de ganancias y gastos</h4>
          <section id="unseen">
            <?php $this->load->view('notifications/mensaje')?>
            
            <div class="row mt">
              <div class="col-lg-12">
                <form method="POST" action="<?php echo base_url('reportes/balance')?>">
                  <div class="form-group">
                    <label class="control-label col-md-2">Ver balance desde</label>
                    <div class="col-md-5">
                      <div class="input-group input-large">
                        <input type="text" class="datepicker form-control dpd2 default-date-picker" name="from" value="<?php echo $fecha1?>">
                        <span class="input-group-addon">hasta</span>
                        <input type="text" class="datepicker form-control dpd2 default-date-picker" name="to" value="<?php echo $fecha2?>">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-default">Cambiar</button>
                  </div>

                </form>
                
              </div>
            </div>

            <div class="row mt">
              <div class="col-sm-6">
                <table class="table table-bordered table-sthiped table-condensed display">
                  <thead>
                    <tr>
                      <th><?php echo $fecha1." - ".$fecha2;?></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Ingresos de ventas:</td>
                      <td>$ <?php echo $sum_importe_ventas ?></td>
                    </tr>
                    <tr>
                      <td>Compras de material:</td>
                      <td class="col-sm-6">$ <?php echo $sum_compras ?></td>
                    </tr>
                    <tr>
                      <td>Gastos:</td>
                      <td>$ <?php echo $sum_gastos ?></td>
                    </tr>
                    <tr>
                      <td><strong>Total: </strong></td>
                      <td><strong>$ <?php echo $sum_importe_ventas-$sum_compras-$sum_gastos ?></strong></td>
                    </tr>
                  </tbody>
                </table>

              </div>
              <div class="row mt">
                <div class="col-lg-12">

                  <div class="col-lg-6">
                    <h4 class="text-center">Ventas</h4>
                    <div id="grafica-ventas"></div>                    
                  </div>
                  <div class="col-lg-6">
                    <h4 class="text-center">Gastos</h4>
                    <div id="grafica-gastos"></div>                    
                  </div>
                </div>
              </div>
            </div>

          </section>
        </div>
      </div>
    </div>

    <!-- page end-->
  </section>
</section>
<?php 
echo '<script src="'. base_url("files/js/jquery.js") . '"></script>' ;
echo '<script src="'. base_url("files/js/jquery-1.8.3.min.js") . '"></script>' ;
?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<?php 
echo '<script src="'. base_url("files/js/morris-conf.js") . '"></script>' ;
?>
<script type="text/javascript">
 ventas = <?php echo $ventas; ?>;
 gastos = <?php echo $gastos; ?>;
 new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'grafica-ventas',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: ventas,
  // The name of the data record attribute that contains x-totals.
  xkey: 'fecha',
  // A list of names of data record attributes that contain y-totals.
  ykeys: ['total'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['total'],

  //resizable
  resize:true
});
 new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'grafica-gastos',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: gastos,
  // The name of the data record attribute that contains x-totals.
  xkey: 'fecha',
  // A list of names of data record attributes that contain y-totals.
  ykeys: ['total'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['total'],

  //resizable
  resize:true,
  lineColors:['#ed5565']
});
</script>