<?php  include(URL_VISTA . 'navbar.php') ?>

<?php if(isset($this->mensaje)) {?>
	<div class="container">
		<h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
	</div>
<?php } ?>

<div class="container mh-400" style="margin-top:30px;">
	<div class="container lower-box box-primary" style="text-align: center;">
		<?php if($factura!= null ) { ?>
			<h2 class="section-heading">Costos del lente ID:<?= $lente->getId() ?> del Cliente: <?= $cliente->getNombre() ,' ', $cliente->getApellido() ?>  </h2>
			<hr class="primary"> <?php }
			else{ ?>
				<h2 class="section-heading">No hay Saldos cargados en el Sistema del Cliente: <?= $cliente->getNombre() ,' ', $cliente->getApellido() ?> </h2>
				<hr class="primary"> <?php } ?>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-xs-12 texto-chico">
						<div class="table-responsive">
							<table class="table table-hover">
								<?php 
								if($factura!= null )
								{
									?>
									<thead>
										<tr style="color:white">
											<th>
												id
											</th>
											<th>
												 A Lejos
											</th>
											<th>
												 A Cerca
											</th>
											<th>
												 L OD
											</th>
											<th>
												 L OI
											</th>
											<th>
												 C OD
											</th>
											<th>
												 C OI
											</th>
											<th>
												Sub Total
											</th>
											<th>
												Seña
											</th>
											<th>
												Saldo Total
											</th>
											<th>
												Mod.
											</th>
											<th>
												Eli.
											</th>
										</tr>
									</thead>
									<tbody>
										<tr style="color:white">
											<td>
												<?= $factura->getId(); ?>
											</td>
											<td>
												$<?= $factura->getSaldoArmazoL(); ?>
											</td>
											<td>
												$<?= $factura->getSaldoArmazonC(); ?>
											</td>
											<td>
												$<?= $factura->getSaldoLejosoD(); ?>
											</td>
											<td>
												$<?= $factura->getSaldoLejosoI(); ?>
											</td>
											<td>
												$<?= $factura->getSaldoCercaOd(); ?>
											</td>
											<td>
												$<?= $factura->getSaldoCercaOi(); ?>
											</td>
											<td>
												$<?= $factura->getSubTotal(); ?>
											</td>
											<td> 
												$<?= $factura->getSenia(); ?>
											</td>
											<td>
												$<?= $factura->getSaldoTotal(); ?>
											</td>
											<td>
												<a href="/vista/modificarfactura/<?= $factura->getId(); ?>/<?= $lente->getId(); ?>/<?= $lente->getId(); ?>/" class="disabled">
													<span class="glyphicon glyphicon-pencil" title="Modificar"
													data-toggle="tooltip" data-placement="right">
												</span>
											</a>
										</td>
										<td>
											<a type="submit" method="post" href="/administrar/eliminarfactura/<?= $lente->getId() ?>/<?= $factura->getId() ?> ?>/<?= $cliente->getId() ?>/" class="disabled">
												<span class="glyphicon glyphicon-trash"  title="Eliminar Lente"
												data-toggle="tooltip" data-placement="right">
											</span>
										</a>
									</td>
								</tr>
								<?php
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
