<?php  include(URL_VISTA . 'navbar.php') ?>

<?php if(isset($this->mensaje)) {?>
	<div class="container">
		<h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
	</div>
<?php } ?>

<div class="container mh-400" style="margin-top:30px;">
	<div class="container lower-box box-primary" style="text-align: center;">
		<?php if($usuario!= null ) { ?>
			<h2 class="section-heading">Datos de Cuenta </h2>
			<hr class="primary"> <?php }
			else{ ?>
				<h2 class="section-heading">No hay Cuenta cargada en el Sistema</h2>
				<hr class="primary"> <?php } ?>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-xs-12 texto-chico">
						<div class="table-responsive">
							<table class="table table-hover">
								<?php 
								if($usuario!= null )
								{
									?>
									<thead>
										<tr style="color:white">
											<th>
												id
											</th>
											<th>
												Nombre
											</th>
											<th>
												Apellido
											</th>
											<th>
												Email
											</th>
											<th>
												Password
											</th>
											<th>
												Calle
											</th>
											<th>
												Telefono
											</th>
											<th>
												Modificar
											</th>
										</tr>
									</thead>
									<tbody>
											<tr style="color:white">
												<td>
													<?= $usuario->getId(); ?>
												</td>
												<td>
													<?= $usuario->getNombre(); ?>
												</td>
												<td>
													<?= $usuario->getApellido(); ?>
												</td>
												<td>
													<?= $usuario->getEmail(); ?>
												</td>
												<td>
													<?= $usuario->getPassword(); ?>
												</td>
												<td>
													<?= $usuario->getCalle(); ?>
												</td>
												<td>
													<?= $usuario->getTelefono(); ?>
												</td>
												<td>
													<a type="submit" method="post"  name="id_cliente"  href="/vista/modificarusuario/<?= $usuario->getId(); ?>/" class="disabled">
														<span class="glyphicon glyphicon-pencil" title="No implementado..."
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
