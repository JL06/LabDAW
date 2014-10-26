<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i>
			<?php if ($this->session->userdata('genero') == 'femenino'):?>
				¡Bienvenida <?php echo $this->session->userdata('nombre'); ?>!
			<?php else: ?>
				¡Bienvenido <?php echo $this->session->userdata('nombre'); ?>!
			<?php endif; ?>
		</h3>
		
	</section>
</section>
