<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i><?php echo $title; ?>
      <span class="inline">
        <a href="<?php echo base_url('lugares/agregar')?>" class="btn btn-success">
          <span class="glyphicon glyphicon-plus-sign"></span>
          Agregar
        </a>
      </span>
    </h3>
    <div class="row mt">
      <div class="col-lg-12">
        <div class="col-md-12 mt">
          <div class="content-panel">

            <?php $this->load->view("notifications/mensaje"); ?>

            <table class="table table-hover" id="table">
              <h4></h4>
              <thead>
                <tr>
                  <th>Lugar</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($lugares)): ?>
                  <?php foreach ($lugares as $lugar): ?>
                    <tr>
                      <td><?php echo $lugar["nombre"] ?></td>
                      <td>
                        <div class="pull-right hidden-phone">
                          <a class="btn btn-theme03" href="<?php echo base_url('lugares/actualizar/'.$lugar['id'])?>"><i class="fa fa-pencil"></i></a>
                          <a id="borrar" class="btn btn-theme04" href="<?php echo base_url('lugares/borrar/'.$lugar['id'])?>"><i class="fa fa-trash-o "></i></a>
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
    $("#table").DataTable();

    $("a#borrar").click(function(e){
      e.preventDefault();
      var url=$(this).attr("href");
      if (confirm("¿Deseas eliminar al usuario?")) {
        window.location.replace(url);
      };

    });
  } );
</script>