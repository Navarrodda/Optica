<?php  include(URL_VISTA . 'navbar.php') ; ?>

<div class="container mh-400" style="margin-top:30px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center">
			<?php if($lente != NULL ){ ?>
				<h2 class="section-heading">Modificara el lente del Cliente: <?= $cliente->getNombre() ,' ', $cliente->getApellido()?> </h2>
				<hr class="primary">
				<p>
					<strong style="color:tomato">
						Registrar! .
					</strong>
				</p>
			<?php }
			else {
				?><h2 class="section-heading">No hay Lente Registrado en el Sistema del Cliente: <?= $cliente->getNombre() ,' ', $cliente->getApellido() ?></h2>
				<hr class="primary">
				<p>
					<strong style="color:black">
						Registre un Lente! .
					</strong>
				</p>
			<?php } ?>
			<div class="regularform">
				<div class="done">
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert"></button>
						Your message has been sent. Thank you!
					</div>
				</div>
				<?php 
				if($lente!= NULL)
				{ ?>
					<form id="form_r" method="post" action="/administrar/modificarlente/" id="contactform" class="text-left" autocomplete="off" enctype= 'multipart/form-data'>
						<input  name="id_lente" type=hidden value="<?= $lente->getId()?>">
						<input name="medico" type="text" class="col-md-6 norightborder btn2" placeholder="Medico">
						<input name="fecha" type="date" class="col-md-6 norightborder btn2" placeholder="Fecha">
						<input name="armazon_lejos" type="text" class="col-md-6 norightborder btn2" placeholder="Armazon Lejos">
						<input name="armazon_cerca" type="text" class="col-md-6 norightborder btn2" placeholder="Armazon Cerca">
						<input name="lejos_od" type="text" class="col-md-6 norightborder btn2" placeholder="Lejos OD">
						<input name="cerca_od" type="text" class="col-md-6 norightborder btn2" placeholder="Cerca OD">
						<input name="lejos_oi" type="text" class="col-md-6 norightborder btn2" placeholder="Lejos OI">
						<input name="cerca_oi" type="text" class="col-md-6 norightborder btn2" placeholder="Cerca OI">
						<input name="cilindrico" type="text" class="col-md-6 norightborder btn2" placeholder="Cilindrico">
						<input name="en_grados" type="text" class="col-md-6 norightborder btn2" placeholder="En Grados">
						<input name="color" type="text" class="col-md-6 norightborder btn2" placeholder="Color">
						<input name="distancia" type="text" class="col-md-6 norightborder btn2" placeholder="Distancia">
						<input name="calibre" type="text" class="col-md-6 norightborder btn2" placeholder="Calibre">
						<input name="puente" type="text" class="col-md-6 norightborder btn2" placeholder="Puente">
						<button type="submit" class="contact submit btn-primary btn-xl pull-right">Registrar</button>
					</form>
					<?php 
				}
				?>
			</div>
		</div>
	</div>
</div>