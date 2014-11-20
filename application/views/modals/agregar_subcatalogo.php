<!--MODAL -->
<div class="modal fade" id="subModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
     <h4 class="modal-title"></h4>
   </div>
   <div class="modal-body">
    <div class="col-lg-12" id="error"></div>
    <form class="form-horizontal style-form" id="agregar-subcatalogo" name="agregar-subcatalogo">
      <div class="form-group" id="nombre-input">
        <div class="col-md-2"></div>
        <label class="control-label col-md-2" for="input-nombre">Nombre</label>
        <div class="col-md-5">
          <input type="text" name="input-nombre" class="form-control" required>
        </div>
      </div>
      <div class="form-group" id="unidad-input">
        <div class="col-md-2"></div>
        <label class="control-label col-md-2" for="input-unidad">Unidad</label>
        <div class="col-md-5">
          <input type="text" name="input-unidad" class="form-control" required>
        </div>
      </div>
    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="guardar-modal">Guardar</button>
  </div>
</div>
</div>
</div>
<!-- END MODAL -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#unidad-input").hide();

    $("#guardar-modal").click(function(){
      if($("#accion").val()=="tipomat" || $("#accion").val().indexOf("act-tipomat")>-1){
        unidad=$("input[name=input-unidad]").val();
        if(unidad!=""){
          $("#unidad").val(unidad);
        }else{
          $("#error").html("<div class=\"alert alert-danger\"> Inserta una unidad</div>");
          return;
        }
      }
      nombre = $("input[name=input-nombre]").val();
      if(nombre!=""){
        $("#nombre").val(nombre);
        $("#button").click();
      }else{
        $("#error").html("<div class=\"alert alert-danger\"> Inserta un nombre</div>");
      }
    });
  });
</script>