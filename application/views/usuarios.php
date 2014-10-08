<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i>Usuarios
      <span class="inline">
        <a href="<?php echo base_url('usuarios/agregar')?>" class="btn btn-success">
          <span class="glyphicon glyphicon-plus-sign"></span>
          Agregar
        </a>
      </span>
    </h3>

    <div class="row mt">
      <?php $this->load->view('notifications/mensaje')?>
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
                      <td><?php echo $usuario["nom"] ?></td>
                      <td><?php echo $usuario["genero"] ?></td>
                      <td><?php echo $usuario["email"] ?></td>
                      <td><?php echo $usuario["telefono"] ?></td>
                      <td><?php echo $usuario["tipo"] ?></td>
                      <td>
                        <div class="pull-right hidden-phone">
                          <a class="btn btn-theme03" href="<?php echo base_url('usuarios/actualizar/'.$usuario['id'])?>"><i class="fa fa-pencil"></i></a>
                          <a id="borrar" class="btn btn-theme04" href="<?php echo base_url('usuarios/borrar/'.$usuario['id'])?>"><i class="fa fa-trash-o "></i></a>
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

    $("a#borrar").click(function(e){
      e.preventDefault();
      var url=$(this).attr("href");
      if (confirm("¿Deseas eliminar al usuario?")) {
        window.location.replace(url);
      };

    })
  } );
</script>