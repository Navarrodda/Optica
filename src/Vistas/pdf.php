<?php  include(URL_VISTA . 'navbar.php') ?>

<?php if(isset($this->mensaje)) {?>
	<div class="container">
		<h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
	</div>
<?php } ?>

<div class="container mh-400" style="margin-top:30px;">
	<div class="container lower-box box-primary" style="text-align: center;">
		<?php if($lente!= null ) { ?>
			<h2 class="section-heading" style="color:white">Datos</h2>
			<hr class="primary"> <?php }?>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 texto-chico">
					<div class="table-responsive">
						<table class="table table-hover ta2">
							<?php 
							if($cliente!= null )
							{
								?>
								<tbody>
									<?php 
									if($lente!= null )
									{
										?>
										<tr style="color:white">
											<td colspan="12">Fecha: <?= date('d-m-Y',strtotime($lente->getFecha())); ?>
										</tr>
									</td>
									<?php 
								}
								?>
								<tr style="color:white">

									<td colspan="2">Señor: <?= $nombreapellido ?></td>
									<td colspan="2">Telefono: <?= $cliente->getTelefono(); ?></td>
								</tr>
								<?php 
								if($lente!= null )
									{	?>
										<tr style="color:white">
											<td colspan="2" >Doctor: <?= $lente->getDoctor(); ?></td>
											<td colspan="2">Observación: <?= $lente->getObservacion(); ?></td>
										</tr>
										<?php 
										if($cuenta_saldos != null)
											{?>
												<tr style="color:white">
													<td colspan="2" >A cuenta: <?= $cuenta_saldos->getACuenta(); ?></td>
													<td colspan="2">Saldo: <?= $cuenta_saldos->getSaldo(); ?></td>
												</tr>
												<?php 
											} ?>
											<tr style="color:white"> 
												<td colspan="12">Armazon Lejos: <?= $lente->getArmazonLejos(); ?></td>
											</tr>
											<tr style="color:white"> 
												<td colspan="12">Armazon Cerca: <?= $lente->getArmazonCerca() ?></td>
											</tr style="color:white"> 
											<tr style="color:white">
												<td colspan="2">Lejos O.D.Esf: <?= $lente->getLejosOdEsferico(); ?></td>
												<td colspan="2">Cilindrico: <?= $lente->getLejosOdCilindrico(); ?></td>
												<td colspan="2">Grados°: <?= $lente->getLejosOdGrados(); ?></td>
											</tr >
											<tr style="color:white">
												<td colspan="2">Lejos O.I. Esf: <?= $lente->getLejosOiEsferico(); ?></td>
												<td colspan="2">Cilindrico: <?= $lente->getLejosOiCilindrico(); ?></td>
												<td colspan="2">Grados°: <?= $lente->getLejosOiGrados(); ?></td>
												<td colspan="2">Color: <?= $lente->getLejosColor(); ?></td>
											</tr>
											<tr style="color:white">
												<td colspan="2">Cerca O.D. Esf: <?= $lente->getCercaOdEsferico(); ?></td>
												<td colspan="2">Cilindrico: <?= $lente->getCercaOdCilindrico(); ?></td>
												<td colspan="2">Grados°: <?= $lente->getCercaOdGrados(); ?></td>
											</tr>
											<tr style="color:white">
												<td colspan="2">Cerca O.I. Esf:  <?= $lente->getCercaOiEsferico(); ?></td>
												<td colspan="2">Cilindrico: <?= $lente->getCercaOiCilindrico(); ?></td>
												<td colspan="2">Grados°: <?= $lente->getCercaOiGrados(); ?></td>
												<td colspan="2">Color: <?= $lente->getCercaColor(); ?></td>
											</tr>
											<?php 
										}
										if($factura != null )
											{?>
												<tr style="color:white">
													<td colspan="2">Sub Total: <?= $factura->getSubTotal(); ?></td>
													<td colspan="2">Seña: <?= $factura->getSenia(); ?></td>
													<td colspan="2">Saldo Total: <?= $factura->getSaldoTotal(); ?></td>
												</tr >

												<?php 
											} ?>
											<td colspan="2" style="color:white">.
											</td>
											<?php 
											if($lente != null )
												{?>		
													<td colspan="2" style="color:white">Modificar:
														<a href="/vista/modificaclienterlente/<?= $cliente->getId(); ?>/<?= $lente->getId(); ?>/<?php if($factura != null)
														{
															print_r($factura->getId());
														}
														else
														{
															print_r(-1);
														}
														?>/<?php if($cuenta_saldos != null)
														{
															print_r($cuenta_saldos->getId());
														}
														else
														{
															print_r(-1);
														}
														?>/" class="disabled">
														<span class="glyphicon glyphicon-pencil" title="Modificar"
														data-toggle="tooltip" data-placement="right">
													</span>
												</a>
											</td>
											<td colspan="2" style="color:white">PDF:
												<a href="/pdf/pdfclientelente/<?= $lente->getId(); ?>/<?= $cliente->getId(); ?>/" target="_blank" class="disabled">         
													<span class="glyphicon glyphicon-cloud-upload" title="PDF"
													data-toggle="tooltip" data-placement="right">
												</span>
											</td>
											<?php 
										}
										else{
											?>
											<td colspan="2" style="color:white">Modificar:
												<a href="/vista/modificaclienterlente/<?= $cliente->getId(); ?>/<?= -1 ?>/<?php if($factura != null)
														{
															print_r($factura->getId());
														}
														else
														{
															print_r(-1);
														}
														?>/<?php if($cuenta_saldos != null)
														{
															print_r($cuenta_saldos->getId());
														}
														else
														{
															print_r(-1);
														}
														?>/" class="disabled">
													<span class="glyphicon glyphicon-pencil" title="Modificar"
													data-toggle="tooltip" data-placement="right">
												</span>
											</a>
										</td>
										<td colspan="2" style="color:white">PDF:
											<a href="/pdf/pdfclientelente/<?= -1 ?>/<?= $cliente->getId(); ?>/" target="_blank" class="disabled">         
												<span class="glyphicon glyphicon-cloud-upload" title="PDF"
												data-toggle="tooltip" data-placement="right">
											</span>
										</td>
										<?php 
									}?>
									<?php  
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
