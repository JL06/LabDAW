<?php if($this->session->flashdata('mensaje')!=''): ?>
	<div class="col-lg-12">
		<div class="<?php echo $this->session->flashdata('class')?>"><?php echo $this->session->flashdata('mensaje');?></div>
	</div>
<?php endif;?>