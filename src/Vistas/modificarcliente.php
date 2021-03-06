<?php  include(URL_VISTA . 'navbar.php') ; ?>

<?php if(isset($this->mensaje)) {?>
	<div class="container">
		<h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
	</div>
<?php } ?>

<div class="container mh-400" style="margin-top:40px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center">
			<h2 class="section-heading" style="color:black">Modificar Cliente: <?= $cliente->getNombre() ,' ', $cliente->getApellido() ?>  </h2>
			<hr class="primary">
			<p>
				<strong style="color:black">
					Modificar! .
				</strong>
			</p>
			<div class="regularform">
				<div class="done">
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert"></button>
						Your message has been sent. Thank you!
					</div>
				</div>
				<form id="form_r" method="post" action="/administrar/modificarcliente/" id="contactform" class="text-left" autocomplete="off" enctype= 'multipart/form-data'>
					<input  name="id_cliente" type=hidden value="<?= $cliente->getId()?>">
					<input  name="nombre" type="text" class="col-md-12 norightborder btn2" placeholder="Nombre">
					<input  name="apellido" type="text" class="col-md-12 norightborder btn2" placeholder="Apellido">
					<input  name="telefono" type="text" class="col-md-12 norightborder btn2" placeholder="Telefono">
					<button type="submit" class="contact submit btn-primary btn-xl pull-right">Modificar</button>
				</form>
			</div>
		</div>
	</div>
</div>