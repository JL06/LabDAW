<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i>Usuarios</h3>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="col-md-12 mt">
                    <div class="content-panel">

                    <?php if($this->session->flashdata('mensaje') != ""): ?>
                      <div class="col-lg-12">
                        <div class="alert alert-success"><?php echo $this->session->flashdata('mensaje');?></div>
                      </div>
                    <?php endif;?>
                    
                        <table class="table table-hover" id="table-users">
                            <h4></h4>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Genero</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Rol</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if ($usuarios != false): ?>
                                <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                       <td><?php echo $usuario->nom ?></td>
                                       <td><?php echo $usuario->genero ?></td>
                                       <td><?php echo $usuario->email ?></td>
                                       <td><?php echo $usuario->telefono ?></td>
                                       <td><?php echo $usuario->tipo ?></td>
                                       <td>
                                            <div class="pull-right hidden-phone">
                                                <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                            </div>
                                        </td>
                                </tr>
                               <?php endforeach;?>
                            <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
		</div>
	</section>
</section>
<script type="text/javascript">
$(document).ready( function () {
    $("#table-users").DataTable();
} );
</script>