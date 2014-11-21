<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i> <?php echo $title ?></h3>
		<div class="row">
			<?php $this->load->view('notifications/mensaje')?>
			<div class="col-md-6 col-sm-6 mb">
				<div class="grey-panel pn " >
					<div class="grey-header" id="tipoprod">
						<h5>Tipo de producto</h5>
					</div>	
					<div class="content-panel" id="tipoprod1">	
						<section>
							<table class="table table-condensed table-striped table-hover table-subcatalogo" id="table-tipoproducto">
								<thead>
									<th>Tipo</th>
									<th>Acciones</th>
								</thead>
								<tbody>
									<?php foreach($tipoproducto as $p):?>
										<tr>
											<td><?php echo $p['nombre']?></td>
											<td>
												<a class="btn btn-xs btn-theme03"href="#"data-toggle="modal" data-target="#subModal" id="act-tipoprod-<?php echo $p['id']?>"><i class="fa fa-pencil"></i></a>
												<a class="btn btn-xs btn-theme04" id="borrar" href="<?php echo base_url('productos/borrar_tipo/'.$p['id'])?>"><i class="fa fa-trash-o"></i></a>
											</td>
										</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</section>			
						<br>		
						<a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#subModal" id="modal-producto">
							<span class="glyphicon glyphicon-plus-sign"></span>
							Agregar
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 mb">
				<div class="grey-panel pn donut-chart">
					<div class="grey-header" id="tipomat">
						<h5>Tipo de material</h5>
					</div>	
					<div class="content-panel" id="tipomat1">	
						<section>
							<table class="table table-condensed table-striped table-hover table-subcatalogo" id="table-tipomaterial">
								<thead>
									<th>Tipo</th>
									<th>Unidad</th>
									<th>Acciones</th>
								</thead>
								<tbody>
									<?php foreach($tipomaterial as $m):?>
										<tr>
											<td><?php echo $m['nombre']?></td>
											<td><?php echo $m['unidad']?></td>
											<td>
												<a class="btn btn-xs btn-theme03"href="#"data-toggle="modal" data-target="#subModal" id="act-tipomat-<?php echo $m['id']?>"><i class="fa fa-pencil"></i></a>
												<a class="btn btn-xs btn-theme04" id="borrar" href="<?php echo base_url('materiales/borrar_tipo/'.$m['id'])?>"><i class="fa fa-trash-o"></i></a>
											</td>
										</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</section>					
						<br>		
						<a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#subModal" id="modal-material">
							<span class="glyphicon glyphicon-plus-sign"></span>
							Agregar
						</a>
					</div>					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-6 mb">
				<div class="grey-panel pn donut-chart">
					<div class="grey-header" id="tipogasto">
						<h5>Tipo de gasto</h5>
					</div>	
					<div class="content-panel" id="tipogasto1">	
						<section>
							<table class="table table-condensed table-striped table-hover table-subcatalogo" id="table-tipogasto">
								<thead>
									<th>Tipo</th>
									<th>Acciones</th>
								</thead>
								<tbody>
									<?php foreach($tipogasto as $g):?>
										<tr>
											<td><?php echo $g['nombre']?></td>
											<td>
												<a class="btn btn-xs btn-theme03"href="#"data-toggle="modal" data-target="#subModal" id="act-tipogasto-<?php echo $g['id']?>"><i class="fa fa-pencil"></i></a>
												<a class="btn btn-xs btn-theme04" id="borrar" href="<?php echo base_url('gastos/borrar_tipo/'.$g['id'])?>"><i class="fa fa-trash-o"></i></a>
											</td>
										</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</section>			
						<br>		
						<a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#subModal" id="modal-gasto">
							<span class="glyphicon glyphicon-plus-sign"></span>
							Agregar
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 mb">
				<div class="grey-panel pn donut-chart">
					<div class="grey-header" id="color">
						<h5>Colores</h5>
					</div>	
					<div class="content-panel" id="color1">	
						<section>
							<table class="table table-condensed table-striped table-hover table-subcatalogo" id="table-colores">
								<thead>
									<th>Color</th>
									<th>Acciones</th>
								</thead>
								<tbody>
									<?php foreach($colores as $c):?>
										<tr>
											<td><?php echo $c['nombre']?></td>
											<td>
												<a class="btn btn-xs btn-theme03"href="#"data-toggle="modal" data-target="#subModal" id="act-color-<?php echo $c['id']?>"><i class="fa fa-pencil"></i></a>
												<a class="btn btn-xs btn-theme04" id="borrar" href="<?php echo base_url('materiales/borrar_color/'.$c['id'])?>"><i class="fa fa-trash-o"></i></a>
											</td>
										</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</section>	
						<br>		
						<a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#subModal" id="modal-color">
							<span class="glyphicon glyphicon-plus-sign"></span>
							Agregar
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<form id="form-subcatalogos" method="post" action="" class="hidden">
		<input type="text" id="accion" value="">
		<input type="text" id="nombre" name="nombre" value="">
		<input type="text" id="unidad" name="unidad" value="">
		<button type="button" id="button" ></button>
		<input type="submit" id="submit" >
	</form>
</section>
<?php $this->load->view("modals/agregar_subcatalogo");?>
<script type="text/javascript">
	$(document).ready( function () {
		$("#table-tipoproducto").DataTable();
		$("#table-tipomaterial").DataTable();
		$("#table-tipogasto").DataTable();
		$("#table-colores").DataTable();
		$(".grey-panel").css("height","41");
		$("#tipoprod1").hide();
		$("#tipomat1").hide();
		$("#tipogasto1").hide();
		$("#color1").hide();
		$(".grey-header")
		.mouseover(function(){
			$(this).css('cursor','pointer');
		})
		.mouseout(function(){
			$(this).css('cursor','auto')
		});
		$(".grey-header").click(function(){
			id=($(this).attr("id"));
			if($("#"+id+"1").is(":visible"))
				$("#"+id+"1").slideUp('slow');
			else
				$("#"+id+"1").slideDown('slow');
			$(".grey-panel").css("height","auto");
		});
		$("a#borrar").click(function(e){
			e.preventDefault();
			var url=$(this).attr("href");
			if (confirm("¿Deseas eliminar el registro?")) {
				window.location.replace(url);
			};
		});
		$("#button").click(function(e){
			accion=$("#accion").val();
			accion=accion.split("-");
			id=accion[2];
			accion=accion.splice(0,2).join("-");
			switch(accion){
				case "tipoprod":
				$("#form-subcatalogos").attr("action","<?php echo base_url("productos/insertar_tipo")?>");
				break;
				case "tipomat":
				$("#form-subcatalogos").attr("action","<?php echo base_url("materiales/insertar_tipo")?>");
				break;
				case "tipogasto":
				$("#form-subcatalogos").attr("action","<?php echo base_url("gastos/insertar_tipo")?>");
				break;
				case "color":
				$("#form-subcatalogos").attr("action","<?php echo base_url("materiales/insertar_color")?>");
				break;
				case "act-tipoprod":
				$("#form-subcatalogos").attr("action","<?php echo base_url("productos/actualizar_tipo2")?>"+"/"+id);
				break;
				case "act-tipomat":
				$("#form-subcatalogos").attr("action","<?php echo base_url("materiales/actualizar_tipo2")?>"+"/"+id);
				break;
				case "act-tipogasto":
				$("#form-subcatalogos").attr("action","<?php echo base_url("gastos/actualizar_tipo2")?>"+"/"+id);
				break;
				case "act-color":
				$("#form-subcatalogos").attr("action","<?php echo base_url("materiales/actualizar_color2")?>"+"/"+id);
				break;
			}
			$("#submit").click();
		});
$("a").click(function(e){
	modal=$(this).attr("id");
	console.log(modal);
	if(typeof modal!="undefined"){
		modal=modal.split("-");
		id=modal[2];
		modal=modal.splice(0,2).join("-");
		$("input[name=input-nombre]").val("");
		switch(modal){
			case "modal-color":
			$("#accion").val("color");
			$(".modal-title").html("Agregar color");
			$("#unidad-input").hide();
			break;
			case "modal-material":
			$("#accion").val("tipomat");
			$(".modal-title").html("Agregar tipo de material");
			$("#unidad-input").show();
			break;
			case "modal-producto":
			$("#accion").val("tipoprod");
			$(".modal-title").html("Agregar tipo de producto");
			$("#unidad-input").hide();
			break;
			case "modal-gasto":
			$("#accion").val("tipogasto");
			$(".modal-title").html("Agregar tipo de gasto");
			$("#unidad-input").hide();
			break;
			case "act-color":
			$("#unidad-input").hide();
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('materiales/actualizar_color')?>",
				data: {color_id: id},
				success: function(data){
					$("input[name=input-nombre]").val(data);
				}
			});
			$("#accion").val("act-color-"+id);
			$(".modal-title").html("Actualizar color");
			break;
			case "act-tipomat":
			$("#unidad-input").show();
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('materiales/actualizar_tipo')?>",
				data: {tipo_id: id},
				success: function(data){
					data=jQuery.parseJSON(data);
					$("input[name=input-nombre]").val(data.nombre);
					$("input[name=input-unidad]").val(data.unidad);
				}
			});
			$("#accion").val("act-tipomat-"+id);
			$(".modal-title").html("Actualizar tipo de material");
			break;
			case "act-tipoprod":
			$("#unidad-input").hide();
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('productos/actualizar_tipo')?>",
				data: {tipo_id: id},
				success: function(data){
					$("input[name=input-nombre]").val(data);
				}
			});
			$("#accion").val("act-tipoprod-"+id);
			$(".modal-title").html("Actualizar tipo de producto");
			break;
			case "act-tipogasto":
			$("#unidad-input").hide();
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('gastos/actualizar_tipo')?>",
				data: {tipo_id: id},
				success: function(data){
					$("input[name=input-nombre]").val(data);
				}
			});
			$("#accion").val("act-tipogasto-"+id);
			$(".modal-title").html("Actualizar tipo de gasto");
			break;
		}
	}
});
});
</script>