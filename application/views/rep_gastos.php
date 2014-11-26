<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i>Reporte de gastos</h3>
		<!-- page start-->
		<div class="row mt">
			<div class="col-lg-12">
				<div class="content-panel">
					<form method="POST" class="style-form" action="<?php echo base_url('reportes/reporte_gastos/')?>">
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
						<div class="col-md-12">							
							<div class="checkbox">
								<label class="control-label col-md-2">
									<input name="ver[]" type="checkbox" value="compras">Compras
								</label>
								<label class="control-label col-md-2">
									<input name="ver[]" type="checkbox" value="gastos">Gastos
								</label>
							</div>
						</div>

					</form>
					<div class="row mt">
						<div class="col-lg-11">						
							<div id="reporte"></div>
						</div>
						<div class="col-lg-11">
							
							<div id="reporte2"></div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
</section>
<script type="text/javascript">
	
	$(document).ready(function(){
		var compras="";
		var gastos="";

		<?php if (isset($compras)): ?>
		compras = <?php echo $compras?>;
	<?php endif;?>
	<?php if (isset($gastos)):?>
	gastos = <?php echo $gastos?>;

<?php endif;?>


if (gastos != "") 
{
	new Morris.Bar({
		element: 'reporte',
		data: gastos,
		xkey: 'fecha',
		ykeys: ['total'],
		labels: ['total'],
		barColors:['#37bc9b']
	});

}

if (gastos == "" && compras==""){
	$("#reporte").html("<div class='well'><p class='text-center'>No hay gastos que mostrar</p>");

}
var selection = "<?php echo $sel; ?>";
selection = selection.split(",");
for (i=0;i<selection.length;i++)
{
	$("input[value="+selection[i]+"]").prop("checked",true);
}

});
</script>