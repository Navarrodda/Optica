<?php  include(URL_VISTA . 'navbar.php') ;
?>

<div class="container mh-400" style="margin-top:30px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center">
			<h2 class="section-heading" style="color:black">Registrar el Lente del Cliente</h2>
			<hr class="primary">
			<p>
				<strong style="color:black">
					Registrar! .
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
					<input required name="lejos_od" type="text" class="col-md-3 norightborder btn2" placeholder="Lejos OD">
					<input required name="cerca_od" type="text" class="col-md-3 norightborder btn2" placeholder="Cerca OD">
					<input required name="lejos_oi" type="text" class="col-md-6 norightborder btn2" placeholder="Lejos OI">
					<input required name="cerca_oi" type="text" class="col-md-6 norightborder btn2" placeholder="Cerca OI">
					<input required name="cilindrico" type="text" class="col-md-6 norightborder btn2" placeholder="Cilindrico">
					<input required name="en_grados" type="text" class="col-md-6 norightborder btn2" placeholder="En Grados">
					<input required name="color" type="text" class="col-md-6 norightborder btn2" placeholder="Color">
					<input required name="descripcion" type="text" class="col-md-6 norightborder btn2" placeholder="Descripcion">
					<button type="submit" class="contact submit btn-primary btn-xl pull-right">Enviar</button>
				</form>
			</div>
		</div>
	</div>
</div>