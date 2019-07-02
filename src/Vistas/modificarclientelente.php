<?php  include(URL_VISTA . 'navbar.php') ;
?>

<?php if(isset($this->mensaje)) {?>
	<div class="container">
		<h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
	</div>
<?php } ?>

<div class="container mh-400" style="margin-top:30px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center">
			<h2 class="section-heading" style="color:black">Modificar Cliente</h2>
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
					</div>
				</div>
				<form id="form_r" method="post" action="/registrar/registrarclientelente/" target="_blank" id="contactform" class="text-left" autocomplete="off" enctype= 'multipart/form-data'>
					<input required name="nombre" type="text" class="col-md-6 norightborder btn2" placeholder="Nombre">
					<input required name="apellido" type="text" class="col-md-6 norightborder btn2" placeholder="Apellido">
					<input required name="telefono" type="text" class="col-md-4 norightborder btn2" placeholder="Telefono">
					<input required name="doctor" type="text" class="col-md-4 norightborder btn2" placeholder="Doctor">
					<input name="observaciones" type="text" class="col-md-4 norightborder btn2" placeholder="Observaciones">
					<input name="armason_l" type="text" class="col-md-6 norightborder btn2" placeholder="Armazon Lejos">	
					<input name="armason_c" type="text" class="col-md-6 norightborder btn2" placeholder="Armazon Cerca">	
					<input name="lejos_od" type="text" class="col-md-4 norightborder btn2" placeholder="Lejos OD EFC">
					<input name="cilindri_l_od" type="text" class="col-md-4 norightborder btn2" placeholder="Ci l OD">
					<input name="l_en_grados_od" type="text" class="col-md-4 norightborder btn2" placeholder="En Grados">		
					<input name="lejos_oi" type="text" class="col-md-4 norightborder btn2" placeholder="Lejos OI EFC">
					<input name="cilindri_l_oi" type="text" class="col-md-4 norightborder btn2" placeholder="Ci l OD">
					<input name="l_en_grados_oi" type="text" class="col-md-2 norightborder btn2" placeholder="En Grados">
					<input name="l_color" type="text" class="col-md-2 norightborder btn2" placeholder="Color">
					<input type=hidden name="complit" id="NO" value="NO">
					<div>
						<label class="col-md-1 content-input">
							<input type="checkbox" name="complit" id="SI" value="SI">
							<i></i>
						</label>
					</div>
					<div class="col-md-9">
						<p style="background-color:black">Duplicar los campos siguientes: Cilindrico y En Grados</p>
					</div>							
					<input name="cerca_od" type="text" class="col-md-4 norightborder btn2" placeholder="Cerca OD EFC">
					<input name="c_cerca_od" type="text" class="col-md-4 norightborder btn2" placeholder="Ci c OD">
					<input name="c_en_grados_od" type="text" class="col-md-4 norightborder btn2" placeholder="En Grados">

					<input name="cerca_oi" type="text" class="col-md-4 norightborder btn2" placeholder="Cerca OI EFC">
					<input name="cilindri_c_oi" type="text" class="col-md-4 norightborder btn2" placeholder="Ci c OI">
					<input name="c_en_grados_oi" type="text" class="col-md-2 norightborder btn2" placeholder="En Grados">
					<input name="c_color" type="text" class="col-md-2 norightborder btn2" placeholder="Color">
					<input name="subtotal" type="number" class="col-md-6 norightborder btn2" placeholder="$ Subtotal">
					<input name="senia" type="number" class="col-md-6 norightborder btn2" placeholder="$ Seña">
					<button  type="submit" class="contact submit btn-primary btn-xl pull-right">Guardar</button>
				</form>
			</div>
		</div>
	</div>
</div>