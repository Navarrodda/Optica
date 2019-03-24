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
					
					<input required name="armazon" type="text" class="col-md-12 norightborder btn2" placeholder="Armazon">
					<input required name="armazon_lejos" type="text" class="col-md-6 norightborder btn2" placeholder="Armazon Lejos">
					<input required name="armazon_cerca" type="text" class="col-md-6 norightborder btn2" placeholder="Armazon Cerca">
					<input required name="lejos_od" type="text" class="col-md-6 norightborder btn2" placeholder="Lejos OD">
					<input required name="cerca_od" type="text" class="col-md-6 norightborder btn2" placeholder="Cerca OD">
					<input required name="lejos_oi" type="text" class="col-md-6 norightborder btn2" placeholder="Lejos OI">
					<input required name="cerca_oi" type="text" class="col-md-6 norightborder btn2" placeholder="Cerca OI">
					<input required name="color" type="text" class="col-md-6 norightborder btn2" placeholder="Color">
					<input required name="descripcion" type="text" class="col-md-6 norightborder btn2" placeholder="Descripcion">
					<button type="submit" class="contact submit btn-primary btn-xl pull-right">Cargar</button>
				</form>
			</div>
		</div>
	</div>
</div>