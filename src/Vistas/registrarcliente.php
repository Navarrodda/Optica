<?php  include(URL_VISTA . 'navbar.php') ; ?>

<div class="container mh-400" style="margin-top:40px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center">
			<h2 class="section-heading" style="color:black">Registrar Cliente</h2>
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
				<form id="form_r" method="post" action="/registrar/registrarcliente/" id="contactform" class="text-left" autocomplete="off" enctype= 'multipart/form-data'>

					<input required name="nombre" type="text" class="col-md-6 norightborder btn2" placeholder="Ingresa Nombre del Cliente">
					<input required name="apellido" type="text" class="col-md-6 norightborder btn2" placeholder="Apellido">
					<input required name="telefono" type="text" class="col-md-12 norightborder btn2" placeholder="Telefono">
					<button type="submit" class="contact submit btn-primary btn-xl pull-right">Cargar</button>
				</form>
			</div>
		</div>
	</div>
</div>