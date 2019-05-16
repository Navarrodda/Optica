<?php  include(URL_VISTA . 'navbar.php') ;
?>

<div class="container mh-400" style="margin-top:20px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center">
			<h2 class="section-heading" style="color:black">Factura Normal</h2>
			<hr class="primary">
			<p>
				<strong style="color:black">
					Factura a PDF! .
				</strong>
			</p>
			<div class="regularform">
				<div class="done">
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert"></button>
						Your message has been sent. Thank you!
					</div>
				</div>
				<form id="form_r" method="post" action="/#/" id="contactform" class="text-left" autocomplete="off" enctype= 'multipart/form-data'>
					<div class="col-md-4">
						<label for="fecha" class="col-md-1.5" style="color:white">Fecha:</label>
						<input name="fecha" type="date" class="col-md-3.5 norightborder btn2">
					</div>
					<div class="col-md-4.5">
						<label for="entrega" class="col-md-1.5" style="color:white">Sera Entregado el Dia:</label>
						<input name="entrega" type="date" class="col-md-3.5 norightborder btn2">	
					</div>				
					<input name="doctor" type="text" class="col-md-3 norightborder btn2" placeholder="Doctor">
					<input name="observaciones" type="text" class="col-md-3 norightborder btn2" placeholder="Observaciones">
					<input name="a_cuenta" type="number" class="col-md-3 norightborder btn2" placeholder="$ A Cuenta">
					<input name="saldo" type="number" class="col-md-3 norightborder btn2" placeholder="$ Saldo">
					<label for="r_fecha" class="col-md-1.5" style="color:white">Receta con Fecha:</label>
					<input name="entrega" type="date" class="col-md-2.5 norightborder btn2">	
					<label for="entrega" class="col-md-1.5" style="color:white">Sera entregado el dia:</label>
					<input name="entrega" type="date" class="col-md-2.5 norightborder btn2">
					<input name="armason_l" type="text" class="col-md-3 norightborder btn2" placeholder="Armazon Lejos">
					<input name="lejos_pesos" type="number" class="col-md-3 norightborder btn2" placeholder="$">	
					<input name="armason_l" type="text" class="col-md-3 norightborder btn2" placeholder="Armazon Cerca">
					<input name="cerca-pesos" type="number" class="col-md-3 norightborder btn2" placeholder="$">	
					<input name="lejos_od" type="text" class="col-md-3 norightborder btn2" placeholder="Lejos OD EFC">
					<input name="cilindri_l_od" type="text" class="col-md-3 norightborder btn2" placeholder="Ci l OD">
					<input name="l_en_grados_od" type="text" class="col-md-3 norightborder btn2" placeholder="En Grados">
					<input name="l-pesos-od" type="number" class="col-md-3 norightborder btn2" placeholder="$">
					<input name="lejos_oi" type="text" class="col-md-3 norightborder btn2" placeholder="Lejos OI EFC">
					<input name="cilindri_l_oi" type="text" class="col-md-3 norightborder btn2" placeholder="Ci l OD">
					<input name="l_en_grados_oi" type="text" class="col-md-2 norightborder btn2" placeholder="En Grados">
					<input name="l_color" type="text" class="col-md-2 norightborder btn2" placeholder="Color">
					<input name="l-pesos-oi" type="number" class="col-md-2 norightborder btn2" placeholder="$">	
					<input name="cerca_od" type="text" class="col-md-3 norightborder btn2" placeholder="Cerca OD EFC">
					<input name="c_cerca_od" type="text" class="col-md-3 norightborder btn2" placeholder="Ci c OD">
					<input name="c_en_grados_od" type="text" class="col-md-3 norightborder btn2" placeholder="En Grados">
					<input name="c-pesos-od" type="number" class="col-md-3 norightborder btn2" placeholder="$">
					<input name="cerca_oi" type="text" class="col-md-3 norightborder btn2" placeholder="Cerca OI EFC">
					<input name="cilindri_c_oi" type="text" class="col-md-3 norightborder btn2" placeholder="Ci c OI">
					<input name="c_en_grados_oi" type="text" class="col-md-2 norightborder btn2" placeholder="En Grados">
					<input name="c_color" type="text" class="col-md-2 norightborder btn2" placeholder="Color">
					<input name="c-pesos-oi" type="number" class="col-md-2 norightborder btn2" placeholder="$">
					<input name="di" type="text" class="col-md-4 norightborder btn2" placeholder="Di">
					<input name="calibre" type="text" class="col-md-4 norightborder btn2" placeholder="Calibre">
					<input name="puente" type="text" class="col-md-4 norightborder btn2" placeholder="Puente">
					<input name="subtotal" type="number" class="col-md-4 norightborder btn2" placeholder="$ Subtotal">
					<input name="senia" type="number" class="col-md-4 norightborder btn2" placeholder="$ Seña">
					<input name="saldo_total" type="number" class="col-md-4 norightborder btn2" placeholder="$ Saldo Total">
					<button type="submit" class="contact submit btn-primary btn-xl pull-right">Cargar</button>
				</form>
			</div>
		</div>
	</div>
</div>