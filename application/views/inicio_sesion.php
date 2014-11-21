<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">

	<title>Inicio Sesión</title>

	<?php
	echo link_tag('files/css/bootstrap.css');
	echo link_tag('files/font-awesome/css/font-awesome.css');
	echo link_tag('files/css/style.css');
	echo link_tag('files/css/style-responsive.css');
	?>
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
  </head>
  <body>

  	<div id="login-page">
  		<div class="container">
  			<?php $this->load->view("notifications/mensaje"); ?>
  			<form class="form-login" method="post" action=<?php echo '"' . site_url("/sesion/iniciar") . '"' ?>>
  				<h2 class="form-login-heading">Inicia Sesión</h2>
  				<div class="login-wrap">
  					<input type="email" name="correo" class="form-control" placeholder="Correo eléctronico" required autofocus>
  					<br>
  					<input type="password" name="clave" class="form-control" placeholder="Contraseña" required>
  					<label class="checkbox">
		                 <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal">¿Olvidaste tu contrseña?</a>

		                </span> 
		            </label>
		            <button class="btn btn-theme btn-block" type="submit">Iniciar</button>
		        </div>
		        
		         
		          
		      </form>	 
		      <form method="post" action=<?php echo '"' . site_url("/sesion/recupera") . '"' ?>>
		       <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">¿Olvidaste tu contraseña?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Ingresa tu correo eléctronico registrado para crear una nueva contraseña</p>
		                          <input type="email" name="mail" placeholder="Correo eléctronico" autocomplete="off" class="form-control placeholder-no-fix" required>
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
		                          <button class="btn btn-theme" type="submit">Enviar</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!--  modal --> 	
		      </form>
		  </div>
		</div>





		<?php 
		echo '<script src="';
		echo base_url("files/js/jquery.js") . '"></script>' ;
		echo '<script src="';
		echo base_url("files/js/bootstrap.min.js") . '"></script>' ;
		echo '<script src="';
		echo base_url("files/js/jquery.backstretch.min.js") . '"></script>' ;
		?>
		<script>
			$.backstretch("assets/img/login-bg.jpg", {speed: 500});
		</script>

	</body>
	</html>