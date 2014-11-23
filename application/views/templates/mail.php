<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="description" content="">

 <title>Notificación de cambio</title>

 <?php
 echo link_tag('files/css/bootstrap.css');
 echo link_tag('files/font-awesome/css/font-awesome.css');
 echo link_tag('files/css/datepicker.css');
 echo link_tag('files/js/gritter/css/jquery.gritter.css');
 echo link_tag('files/lineicons/style.css');
 echo link_tag('files/css/style.css');
 echo link_tag('files/css/style-responsive.css');
 echo link_tag('files/css/jquery.dataTables.css');
 echo link_tag('files/css/jquery.dataTables.css');
 echo link_tag('files/css/style2.css');

 echo '<script src="'.base_url("files/js/jquery.js") . '"></script>' ;
 echo'<script src="'.base_url("files/js/bootstrap.min.js") . '"></script>' ;
 echo '<script src="'.base_url("files/js/zabuto_calendar.js") . '"></script>' ;
 echo '<script src="'. base_url("files/js/chart-master/Chart.js") . '"></script>' ;
 
 ?>

 <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.css">
 <script type="text/javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
 <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <![endif]-->
    </head>
    <body>
      <style type="text/css">
        
      </style>


      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <div class="row content-panel">
        <div class="col-lg-7 col-lg-offset-1">
          <div class="invoice-body">
            <div class="pull-left"> 
              <h1>Notificación de cambio</h1>

            </div><!-- /pull-left -->

            <div class="clearfix"></div>
            <br>
            <br>
            <br>
            <div class="row">
              <div class="col-md-9">
                <h5><?php echo $name; ?></h5>
                <address>
                  <p><?php echo $email; ?></p>
                </address>
              </div><! --/col-md-9 -->

            </div><! --/col-lg-10 -->
            <div>
              <p>
                Este correo es una notificación de cambio de venta, realizado por <strong><?php echo $vendedor; ?></strong> el día <?php echo $fecha_cambio;?>. 
                A continuación se muestra la venta original, seguida de la actualización que se hizo. 
              </p>
            </div>
            <div class="row">
              <h3>Venta original</h3>
              <table class="table">
                <thead>
                  <tr>
                    <th class="text-left">Producto</th>
                    <th style="width:90px">Cantidad</th>
                    <th style="width:140px">Punto de venta</th>
                    <th style="width:90px">Fecha</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $venta_original['producto']?></td>
                    <td><?php echo $venta_original['cantidad']?></td>
                    <td><?php echo $venta_original['lugar']?></td>
                    <td><?php echo $venta_original['fecha']?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="row">
              <h3>Cambio</h3>
              <table class="table">
                <thead>
                  <tr>
                    <th class="text-left">Producto</th>
                    <th style="width:90px">Cantidad</th>
                    <th style="width:140px">Punto de venta</th>
                    <th style="width:90px">Fecha</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $venta_cambio['producto']?></td>
                    <td><?php echo $venta_cambio['cantidad']?></td>
                    <td><?php echo $venta_cambio['lugar']?></td>
                    <td><?php echo $venta_cambio['fecha']?></td>
                  </tr>
                </tbody>
              </table>

            </div>

            <br>
            <br>
          </div><!--/col-lg-12 mt -->

          <!--main content end-->
          <?php 
          echo '<script src="'.base_url("files/js/jquery-1.8.3.min.js") . '"></script>' ;

          echo '<script src="'. base_url("files/js/jquery.dcjqaccordion.2.7.js") . '"></script>' ;

          echo '<script src="'.base_url("files/js/jquery.scrollTo.min.js") . '"></script>' ;

          echo '<script src="'.base_url("files/js/jquery.nicescroll.js") . '"></script>' ;

          echo '<script src="'. base_url("files/js/jquery.sparkline.js") . '"></script>' ;

          echo '<script src="'. base_url("files/js/common-scripts.js") . '"></script>' ;

          echo '<script src="'.base_url("files/js/gritter/js/jquery.gritter.js") . '"></script>' ;

          echo '<script src="'.base_url("files/js/gritter-conf.js") . '"></script>' ;

          echo '<script src="'.base_url("files/js/bootstrap-datepicker.js").'"></script>';

          echo '<script src="'.base_url("files/js/advanced-form-components.js").'"></script>';

    //script for this page
          echo '<script src="'. base_url("files/js/sparkline-chart.js") . '"></script>' ;

          echo '<script src="'.base_url("files/js/datatables/jquery.dataTables.js").'"></script>';


          ?>


        </body>
        </html>
