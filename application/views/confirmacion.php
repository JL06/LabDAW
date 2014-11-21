<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">

	<title>Recuperar contraseña</title>

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
  			<form class="form-login" >
  				<h2 class="form-login-heading">Revise su correo</h2>
  				<div class="login-wrap">
  					<h4>Se ha enviado una liga de acceso para cambiar la contraseña</h4>
		        </div>
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