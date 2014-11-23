<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="description" content="">

 <title>Notificación de cambio</title>

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
        @import url(http://fonts.googleapis.com/css?family=Ruda:400,700,900);
        html {
          font-family: sans-serif;
          -webkit-text-size-adjust: 100%;
          -ms-text-size-adjust: 100%;
        }
        .clearfix:before,
        .clearfix:after,
        .container:before,
        .container:after,
        .container-fluid:before,
        .container-fluid:after,
        .row:before,
        .row:after,
        .clearfix:after{
          clear: both;
        }
        .container {
          width: 1170px;
        }
      }
      .row {
        margin-right: -15px;
        margin-left: -15px;
      }
      .table td,
      .table th {
        background-color: #fff !important;
      }
      .btn > .caret,
      .dropup > .btn > .caret {
        border-top-color: #000 !important;
      }
      .label {
        border: 1px solid #000;
      }
      .table {
        border-collapse: collapse !important;
      }
      .table-bordered th,
      .table-bordered td {
        border: 1px solid #ddd !important;
      }
    }
    .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
      position: relative;
      min-height: 1px;
      padding-right: 15px;
      padding-left: 15px;
    }
    table {
      background-color: transparent;
    }
    th {
      text-align: left;
    }
    .table {
      width: 100%;
      max-width: 100%;
      margin-bottom: 20px;
    }
    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
      padding: 8px;
      line-height: 1.42857143;
      vertical-align: top;
      border-top: 1px solid #ddd;
    }
    .table > thead > tr > th {
      vertical-align: bottom;
      border-bottom: 2px solid #ddd;
    }

    table col[class*="col-"] {
      position: static;
      display: table-column;
      float: none;
    }
    table td[class*="col-"],
    table th[class*="col-"] {
      position: static;
      display: table-cell;
      float: none;
    }
    .table > thead > tr > td.active,
    .table > tbody > tr > td.active,
    .table > tfoot > tr > td.active,
    .table > thead > tr > th.active,
    .table > tbody > tr > th.active,
    .table > tfoot > tr > th.active,
    .table > thead > tr.active > td,
    .table > tbody > tr.active > td,
    .table > tfoot > tr.active > td,
    .table > thead > tr.active > th,
    .table > tbody > tr.active > th,
    .table > tfoot > tr.active > th {
      background-color: #f5f5f5;
    }
    
    .table > thead > tr > td.success,
    .table > tbody > tr > td.success,
    .table > tfoot > tr > td.success,
    .table > thead > tr > th.success,
    .table > tbody > tr > th.success,
    .table > tfoot > tr > th.success,
    .table > thead > tr.success > td,
    .table > tbody > tr.success > td,
    .table > tfoot > tr.success > td,
    .table > thead > tr.success > th,
    .table > tbody > tr.success > th,
    .table > tfoot > tr.success > th {
      background-color: #dff0d8;
    }
    .table > thead > tr > td.info,
    .table > tbody > tr > td.info,
    .table > tfoot > tr > td.info,
    .table > thead > tr > th.info,
    .table > tbody > tr > th.info,
    .table > tfoot > tr > th.info,
    .table > thead > tr.info > td,
    .table > tbody > tr.info > td,
    .table > tfoot > tr.info > td,
    .table > thead > tr.info > th,
    .table > tbody > tr.info > th,
    .table > tfoot > tr.info > th {
      background-color: #d9edf7;
    }
    
    .table > thead > tr > td.warning,
    .table > tbody > tr > td.warning,
    .table > tfoot > tr > td.warning,
    .table > thead > tr > th.warning,
    .table > tbody > tr > th.warning,
    .table > tfoot > tr > th.warning,
    .table > thead > tr.warning > td,
    .table > tbody > tr.warning > td,
    .table > tfoot > tr.warning > td,
    .table > thead > tr.warning > th,
    .table > tbody > tr.warning > th,
    .table > tfoot > tr.warning > th {
      background-color: #fcf8e3;
    }
    .pull-left {
      float: left !important;
    }

    /* BASIC THEME CONFIGURATION */
    body {
      color: #797979;
      background: #f2f2f2;
      font-family: 'Ruda', sans-serif;
      padding: 0px !important;
      margin: 0px !important;
      font-size:13px;
    }
    .content-panel {
      background: #ffffff;
      box-shadow: 0px 3px 2px #aab2bd;
      padding: 15px 10px 5px 10px;

    }
    .content-panel h4 {
      margin-left: 10px;
    }
    .col-lg-offset-1 {
      margin-left: 8.33333333%;
    }
    address {
      margin-bottom: 20px;
      font-style: normal;
      line-height: 1.42857143;
    }
    p,
    h2,
    h3 {
      orphans: 3;
      widows: 3;
    }

    .text-left {
      text-align: left;
    }
    .text-right {
      text-align: right;
    }
    .text-center {
      text-align: center;
    }
    .invoice-body{
      padding: 30px;
    }
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .h1,
    .h2,
    .h3,
    .h4,
    .h5,
    .h6 {
      font-family: inherit;
      font-weight: 500;
      line-height: 1.1;
      color: inherit;
    }
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

        </body>
        </html>
