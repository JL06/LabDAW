<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <title><?php echo $title ?></title>

    <?php
    echo link_tag('files/css/bootstrap.css');
    echo link_tag('files/font-awesome/css/font-awesome.css');
    echo link_tag('files/css/zabuto_calendar.css');
    echo link_tag('files/js/gritter/css/jquery.gritter.css');
    echo link_tag('files/lineicons/style.css');
    echo link_tag('files/css/style.css');
    echo link_tag('files/css/style-responsive.css');
    echo link_tag('files/css/jquery.dataTables.css');
    echo link_tag('//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.css');
    echo '<script src="';
    echo base_url("files/js/jquery.js") . '"></script>' ;
    ?>  
    <?php echo '<script src="';
    echo base_url("files/js/chart-master/Chart.js") . '"></script>' ;
    ?>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>Sistema de Administración</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href=<?php echo '"' . site_url("/sesion/cerrar") . '"' ?>>Cerrar Sesión</a></li>
                </ul>
            </div>
        </header>
      <!--header end-->

      
<?php
  $role='admin';
  $this->load->view('sidebars/'.$role);
?>