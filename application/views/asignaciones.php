<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i><?php echo $title; ?>
      <span class="inline">
        <a href="<?php echo base_url('productos/asignar'); ?>" class="btn btn-success">
          <span class="glyphicon glyphicon-plus-sign"></span>
          Agregar
        </a>
      </span>
    </h3>
    <div class="row mt">
      <div class="col-lg-12">
        <div class="col-md-12 mt">
          <div class="content-panel">

            <?php if($this->session->flashdata('mensaje') != ""): ?>
              <div class="col-lg-12">
                <div class="<?php echo $this->session->flashdata('class');?>"><?php echo $this->session->flashdata('mensaje');?></div>
              </div>
            <?php endif;?>

            <table class="table table-hover" id="table-users">
              <h4></h4>
              <thead>
                <tr>
                  <th>Vendedor</th>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Administrador</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php if ($asignaciones != NULL): ?>
                  <?php foreach ($asignaciones as $asig): ?>
                    <tr>
                      <td><?php echo $asig["vendedor"] ?></td>
                      <td><?php echo $asig["producto"] ?></td>
                      <td><?php echo $asig["cantidad"] ?></td>
                      <td><?php echo $asig["admin"] ?></td>
                      <td>
                        <div class="pull-right hidden-phone">
                          <a class="btn btn-theme02" href="<?php echo base_url('productos/quita_asignacion/'.$asig['id'].'/'.$asig['idv'])?>"><i class="glyphicon glyphicon-minus"></i></a>
                          <a class="btn btn-theme03" href="<?php echo base_url('productos/agrega_asignacion/'.$asig['id'].'/'.$asig['idv'])?>"><i class="glyphicon glyphicon-plus"></i></a>
                          <a id="borrar" class="btn btn-theme04" href="<?php echo base_url('productos/borrar_asignacion/'.$asig['id'].'/'.$asig['idv'])?>"><i class="fa fa-trash-o "></i></a>
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
      if (confirm("¿Deseas eliminar la asignacion?")) {
        window.location.replace(url);
      };

    })
  } );
</script>