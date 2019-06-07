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
												Direccion
											</th>
											<th>
												Telefono
											</th>
											<th>
												Preoridad
											</th>
											<th>
												Modificar
											</th>
											<th>
												Eliminar
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($usuario as $objeto) {
											?>
											<tr style="color:white">
												<td>
													<?= $objeto->getId(); ?>
												</td>
												<td>
													<?= $objeto->getNombre(); ?>
												</td>
												<td>
													<?= $objeto->getApellido(); ?>
												</td>
												<td>
													<?= $objeto->getEmail(); ?>
												</td>
												<td>
													<?= $objeto->getCalle(); ?>
												</td>
												<td>
													<?= $objeto->getTelefono(); ?>
												</td>
												<td>
													<?php $preoridad = $objeto->getIdRol();
													echo $preoridad->getPrioridad(); ?>
												</td>
												<td>
													<a type="submit" method="post"  name="id_cliente"  href="/vista/modificarusuario/<?= $objeto->getId(); ?>/" class="disabled">
														<span class="glyphicon glyphicon-pencil" title="No implementado..."
														data-toggle="tooltip" data-placement="right">
													</span>
												</a>
											</td>
											<td>
												<a type="submit" method="post"  name="id_cliente" href="/administrar/eliminarusuario/<?= $objeto->getId(); ?>" class="disabled">
													<span class="glyphicon glyphicon-trash"  title="Eliminar Cliente"
													data-toggle="tooltip" data-placement="right">
												</span>
											</a>
										</td>
									</tr>
									<?php 
								}
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
