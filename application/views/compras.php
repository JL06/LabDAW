<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i><?php echo $title; ?>
      <span class="inline">
        <a href="<?php echo base_url('compras/agregar')?>" class="btn btn-success">
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
                <div class="alert alert-success"><?php echo $this->session->flashdata('mensaje');?></div>
              </div>
            <?php endif;?>

            <table class="table table-hover" id="table">
              <h4></h4>
              <thead>
                <tr>
                  <th>Material</th>
                  <th>Cantidad</th>
                  <th>Costo</th>
                  <th>Fecha</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($compras)): ?>
                  <?php foreach ($compras as $compra): ?>
                    <tr>
                      <td><?php echo $compra["material"]." "; echo $compra['color'];  ?></td>
                      <td><?php echo $compra["cantidad"]." "; echo $compra["unidad"]; ?></td>
                      <td><?php echo $compra["costo"] ?></td>
                      <td><?php echo $compra["fecha"] ?></td>
                      <td>
                        <div class="pull-right hidden-phone">
                          <a class="btn btn-theme03" href="<?php echo base_url('compras/actualizar_compra/'.$compra['id'])?>"><i class="fa fa-pencil"></i></a>
                          <a id="borrar" class="btn btn-theme04" href="<?php echo base_url('compras/borrar/'.$compra['id'])?>"><i class="fa fa-trash-o "></i></a>
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
      if (confirm("¿Deseas eliminar la compra?")) {
        window.location.replace(url);
      };

    });
  } );
</script>