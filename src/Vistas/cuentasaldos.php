<?php  include(URL_VISTA . 'navbar.php') ?>

<?php if(isset($this->mensaje)) {?>
	<div class="container">
		<h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
	</div>
<?php } ?>

<div class="container mh-400" style="margin-top:30px;">
	<div class="container lower-box box-primary" style="text-align: center;">
		<?php if($cuentasaldos!= null ) { ?>
			<h2 class="section-heading">Saldos registrados del Cliente es : <?= $cliente->getNombre() ,' ', $cliente->getApellido() ?>  </h2>
						<h3 class="section-heading">El monto total es de: $<?= $monto ?></h3>
			<hr class="primary"> <?php }
			else{ ?>
				<h2 class="section-heading">No ahi saldos registrados del Cliente: <?= $cliente->getNombre() ,' ', $cliente->getApellido() ?> </h2>
				<a  class="glyphicon glyphicon-plus" style="color:black" method="post" name="id_cliente" href="/vista/registrlente/<?= $cliente->getId(); ?> ">Registrar Lente+</a>
				<hr class="primary"> <?php } ?>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-xs-12 texto-chico">
						<div class="table-responsive">
							<table class="table table-hover">
								<?php 
								if($cuentasaldos!= null )
								{
									?>
									<thead>
										<tr style="color:white">
											<th>
												id
											</th>
											<th>
												Seña
											</th>
											<th>
												Saldo
											</th>
											<th>
												Fecha
											</th>
											<th>
												Modificar.
											</th>
											<th>
												Eliminar.
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($cuentasaldos as $objeto) {
											?>
											<tr style="color:white">
												<td>
													<?= $objeto->getId(); ?>
												</td>
												<td>
													$<?= $objeto->getACuenta(); ?>
												</td>
												<td>
													$<?= $objeto->getSaldo(); ?>
												</td>
												<td>
													<?= $objeto->getFecha(); ?>
												</td>
												<td>
													<a href="/" class="disabled">
														<span class="glyphicon glyphicon-pencil" title="Modificar"
														data-toggle="tooltip" data-placement="right">
													</span>
												</a>
											</td>
											<td>
												<a type="submit" method="post"  name="id_cliente" href="/" class="disabled">
													<span class="glyphicon glyphicon-trash"  title="Eliminar Lente"
													data-toggle="tooltip" data-placement="right">
												</span>
											</a>
										</td>
									</tr>
								<?php } 
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
