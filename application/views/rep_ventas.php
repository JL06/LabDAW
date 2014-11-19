<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i>Reporte de ventas</h3>
		<!-- page start-->
		<div class="row mt">
			<div class="col-lg-12">
				<div class="content-panel">
					<form method="POST" class="style-form" action="<?php echo base_url('reportes/reporte_ventas/')?>">
						<div class="col-md-12">							
							<div class="radio">
								<label>
									<input name="criterio" type="radio" value="producto" class="criterio" >Ventas por producto
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="criterio" type="radio" value="tiempo" class="criterio">Ventas por tiempo
								</label>
							</div>	
							<div class="radio">		
								<label >
									<input name="criterio" type="radio" value="usuario" class="criterio">Ventas por vendedor
								</label>
							</div>
						</div>
						<div class="form-group col-md-6">
							<div id="filter"></div>
						</div>
						<div class="form-group col-lg-7">
							<label class="control-label col-md-3">Ver reporte desde</label>
							<div class="input-group input-large">
								<input required type="text" class="datepicker form-control dpd2 default-date-picker" name="from" value="<?php echo $fecha1?>">
								<span class="input-group-addon">hasta</span>
								<input required type="text" class="datepicker form-control dpd2 default-date-picker" name="to" value="<?php echo $fecha2?>">
							</div>
						</div>
						<div class="form-group col-md-5">
							<button type="submit" class="btn btn-info btn-round">Ver</button>
						</div>

					</form>
					<div class="row mt">
						<div class="col-lg-11">						
							<div id="reporte"></div>
						</div>
						
					</div>
				</div>
			</div>

		</div>
	</section>
</section>
<script type="text/javascript">
	criterio = "<?php echo $filter; ?>";
	datos = <?php echo $grafica; ?>;

	$(document).ready(function(){
		
		$("option[value=todos]").click(function(){
			$("select").val("todos");
		});

		$("input[value="+criterio+"]").prop("checked",true);

		$(".criterio").change(function(){

			criterio = $("input[type=radio]:checked").val();
			if (criterio != "tiempo") {
				$("select").prop("disabled",false);
				$.ajax({
					url:"<?php echo base_url('reportes/get_info_ventas')?>",
					type:"POST",
					data: {filter:criterio},
					success: function(data) {
						$("#filter").html("<select multiple name='filtro[]' class='form-control' required><option value='todos' selected>Ver todos</option></select>");
						options=jQuery.parseJSON(data);
						$.each(options,function(i,val){
							$("select").append("<option value='"+val.id+"'>"+val.nombre+"</option>")
						});
						
					}
				});
				
			}
			else{
				$("select").prop("required",false);
				$("select").prop("disabled",true);	
			}
			
		});
		$(".criterio").change();


	});
	if (!jQuery.isEmptyObject(datos)){
		if (criterio == 'producto'){
			Morris.Bar({
				element: 'reporte',
				data:datos,
				xkey: 'producto',
				ykeys: ['cantidadVentas'],
				labels: ['productos vendidos'],
				barColors:['#37bc9b']
			});
		}
		else if(criterio == 'usuario')
		{
			Morris.Bar({
				element: 'reporte',
				data:datos,
				xkey: 'vendedor',
				ykeys: ['importe'],
				labels: ['importe $'],
				barColors:['#37bc9b']

			});
		}
		else
		{
			Morris.Bar({
				element: 'reporte',
				data:<?php echo $grafica; ?>,
				xkey: 'fecha',
				ykeys: ['total'],
				labels: ['total'],
				barColors:['#37bc9b']

			});	
		}

	}
	else
	{
		$("#reporte").html("<div class='well'><p class='text-center'>No hay ventas que mostrar</p>");
	}


</script>