<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i>Reporte de ventas</h3>
    <!-- page start-->
    <div class="row mt">
      <div class="col-lg-12">
        <div class="content-panel">
          <form class="form-horizontal style-form" method="post">
            <div class="form-group">
              <label class="control-label col-md-2">Ventas por producto
                <input type="radio" name="ventasx" value="producto" checked="checked">
              </label>
              <label class="control-label col-md-2">Ventas por tiempo
                <input type="radio" name="ventasx" value="producto">
              </label>
              <input type="submit" value="Ver" class="btn btn-default">
            </div>

          </form>

        </div><!-- /form-panel -->
        <div class="content-panel">
          <h4>Ventas por producto</h4>
          <div class="panel-body">
            <div id="hero-bar" class="graph"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- page end-->
  </section>
</section>
<script type="text/javascript">
  $(document).ready(function(){
    $("form").submit(function(e){
      e.preventDefault();
      var action= $("input[name=ventasx]:checked").val();
      $(this).attr("action","<?php echo base_url('reportes/ventas');?>"+"/"+action);
      $(this).submit();
    });

    $(function(){
      $('select.styled').customSelect();
    });
  });
</script>
<?php 
echo '<script src="';
echo base_url("files/js/jquery.js") . '"></script>' ;
echo '<script src="';
echo base_url("files/js/jquery-1.8.3.min.js") . '"></script>' ;
echo '<script src="';
echo base_url("files/js/morris-conf.js") . '"></script>' ;
?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
