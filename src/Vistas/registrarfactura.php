<?php  include(URL_VISTA . 'navbar.php') ; ?>

?>
<?php if(isset($this->mensaje)) {?>
    <div class="container">
        <h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
    </div>
<?php } ?>

<div class="container mh-400" style="margin-top:40px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center">
			<h2 class="section-heading" style="color:black">Registrar Factura:</h2>
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
				<form id="form_r" method="post" action="/registrar/registrarfactura/" id="contactform" class="text-left" autocomplete="off" enctype= 'multipart/form-data'>
					<input  name="id_lente" type=hidden value="<?= $lente->getId()?>">
					<input  name="id_cliente" type=hidden value="<?= $cliente->getId()?>">
					<input required name="armasonl" type="text" class="col-md-12 norightborder btn2" placeholder="$ Armason lejos">
					<input required name="armazonc" type="text" class="col-md-12 norightborder btn2" placeholder="$ Armazon cerca">
					<input required name="lejos_od" type="text" class="col-md-3 norightborder btn2" placeholder="$ Lejos OD">
					<input required name="lejos_oi" type="text" class="col-md-3 norightborder btn2" placeholder="$ Lejos OI">
					<input required="" name="cerca_od" type="text" class="col-md-3 norightborder btn2" placeholder="$ Cerca OD">
					<input required name="cerca_oi" type="text" class="col-md-3 norightborder btn2" placeholder="$ Cerca OI">
					<input name="senia" type="text" class="col-md-12 norightborder btn2" placeholder="$ Seña">
					<button type="submit" class="contact submit btn-primary btn-xl pull-right">Cargar</button>
				</form>
			</div>
		</div>
	</div>
</div>