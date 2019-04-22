<?php  include(URL_VISTA . 'navbar.php') ;
?>

<div class="container mh-400" style="margin-top:20px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center">
			<h2 class="section-heading" style="color:black">Factura Simple</h2>
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
						<input required name="fecha" type="date" class="col-md-3.5 norightborder btn2">
					</div>
					<div class="col-md-4.5">
						<label for="entrega" class="col-md-1.5" style="color:white">Sera Entregado el Dia:</label>
						<input required name="entrega" type="date" class="col-md-3.5 norightborder btn2">	
					</div>				
					<input required name="doctor" type="text" class="col-md-3 norightborder btn2" placeholder="Doctor">
					<input required name="observaciones" type="text" class="col-md-3 norightborder btn2" placeholder="Observaciones">
					<input required name="a_cuenta" type="number" class="col-md-3 norightborder btn2" placeholder="$ A Cuenta">
					<input required name="saldo" type="number" class="col-md-3 norightborder btn2" placeholder="$ Saldo">
					<label for="r_fecha" class="col-md-1.5" style="color:white">Receta con Fecha:</label>
					<input required name="entrega" type="date" class="col-md-2.5 norightborder btn2">	
					<label for="entrega" class="col-md-1.5" style="color:white">Sera entregado el dia:</label>
					<input required name="entrega" type="date" class="col-md-2.5 norightborder btn2">
					<input required name="armason_l" type="text" class="col-md-3 norightborder btn2" placeholder="Armazon Lejos">
					<input required name="lejos_pesos" type="number" class="col-md-3 norightborder btn2" placeholder="$">	
					<input required name="armason_l" type="text" class="col-md-3 norightborder btn2" placeholder="Armazon Cerca">
					<input required name="cerca-pesos" type="number" class="col-md-3 norightborder btn2" placeholder="$">	
					<input required name="lejos_od" type="text" class="col-md-3 norightborder btn2" placeholder="Lejos OD EFC">
					<input required name="cilindri_l_od" type="text" class="col-md-3 norightborder btn2" placeholder="Ci l OD">
					<input required name="l_en_grados_od" type="text" class="col-md-3 norightborder btn2" placeholder="En Grados">
					<input required name="l-pesos-od" type="number" class="col-md-3 norightborder btn2" placeholder="$">
					<input required name="lejos_oi" type="text" class="col-md-3 norightborder btn2" placeholder="Lejos OI EFC">
					<input required name="cilindri_l_oi" type="text" class="col-md-3 norightborder btn2" placeholder="Ci l OD">
					<input required name="l_en_grados_oi" type="text" class="col-md-2 norightborder btn2" placeholder="En Grados">
					<input required name="l_color" type="text" class="col-md-2 norightborder btn2" placeholder="Color">
					<input required name="l-pesos-oi" type="number" class="col-md-2 norightborder btn2" placeholder="$">	
					<input required name="cerca_od" type="text" class="col-md-3 norightborder btn2" placeholder="Cerca OD EFC">
					<input required name="c_cerca_od" type="text" class="col-md-3 norightborder btn2" placeholder="Ci c OD">
					<input required name="c_en_grados_od" type="text" class="col-md-3 norightborder btn2" placeholder="En Grados">
					<input required name="c-pesos-od" type="number" class="col-md-3 norightborder btn2" placeholder="$">
					<input required name="cerca_oi" type="text" class="col-md-3 norightborder btn2" placeholder="Cerca OI EFC">
					<input required name="cilindri_c_oi" type="text" class="col-md-3 norightborder btn2" placeholder="Ci c OI">
					<input required name="c_en_grados_oi" type="text" class="col-md-2 norightborder btn2" placeholder="En Grados">
					<input required name="c_color" type="text" class="col-md-2 norightborder btn2" placeholder="Color">
					<input required name="c-pesos-oi" type="number" class="col-md-2 norightborder btn2" placeholder="$">
					<input required name="di" type="text" class="col-md-4 norightborder btn2" placeholder="Di">
					<input required name="calibre" type="text" class="col-md-4 norightborder btn2" placeholder="Calibre">
					<input required name="puente" type="text" class="col-md-4 norightborder btn2" placeholder="Puente">
					<input required name="subtotal" type="number" class="col-md-4 norightborder btn2" placeholder="$ Subtotal">
					<input required name="senia" type="number" class="col-md-4 norightborder btn2" placeholder="$ Seña">
					<input required name="saldo_total" type="number" class="col-md-4 norightborder btn2" placeholder="$ Saldo Total">
					<button type="submit" class="contact submit btn-primary btn-xl pull-right">Cargar</button>
				</form>
			</div>
		</div>
	</div>
</div>