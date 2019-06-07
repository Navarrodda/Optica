<?php  include(URL_VISTA . 'navbar.php') ?>

<?php if(isset($this->mensaje)) {?>
    <div class="container">
      <h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
  </div>
<?php } ?>

<div class="container mh-400" style="margin-top:30px;">
    <div class="container lower-box box-primary" style="text-align: center;">
        <?php if($lente!= null ) { ?>
            <h2 class="section-heading">Lentes registrados en el Sistema del Cliente: <?= $cliente->getNombre() ,' ', $cliente->getApellido() ?>  </h2>
            <a  class="glyphicon glyphicon-plus" style="color:black" method="post" name="id_cliente" href="/vista/registrlente/<?= $cliente->getId(); ?>">Registrar Lente+</a>
            <hr class="primary"> <?php }
            else{ ?>
                <h2 class="section-heading">No hay Lentes cargados en el Sistema del Cliente: <?= $cliente->getNombre() ,' ', $cliente->getApellido() ?> </h2>
                <a  class="glyphicon glyphicon-plus" style="color:black" method="post" name="id_cliente" href="/vista/registrlente/<?= $cliente->getId(); ?> ">Registrar Lente+</a>
                <hr class="primary"> <?php } ?>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 texto-chico">
                       <div class="table-responsive">
                         <table class="table table-hover">
                           <?php 
                           if($lente!= null )
                           {
                            ?>
                            <thead>
                                <tr style="color:white">
                                    <th>
                                        id
                                    </th>
                                    <th>
                                        Dr.
                                    </th>
                                     <th>
                                        Arm. Lejos
                                    </th>
                                    <th>
                                        Arm. Cerca
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
                                        Cil
                                    </th>
                                    <th>
                                        En G°
                                    </th>
                                    <th>
                                       D.I.
                                   </th>
                                   <th>
                                    Cal.
                                </th>
                                <th>
                                    Pue.
                                </th>
                                <th>
                                    Co.
                                </th>
                                <th>
                                    Fec.
                                </th>
                                <th>
                                    Factura
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
                            <?php
                            foreach ($lente as $objeto) {
                                ?>
                                <tr style="color:white">
                                    <td>
                                        <?= $objeto->getId(); ?>
                                    </td>
                                    <td>
                                        <?= $objeto->getMedico(); ?>
                                    </td>
                                    <td>
                                        <?= $objeto->getArmazonLejos(); ?>
                                    </td>
                                    <td>
                                        <?= $objeto->getArmazonCerca(); ?>
                                    </td>
                                    <td>
                                        <?= $objeto->getLejosOd(); ?>
                                    </td>
                                    <td>
                                        <?= $objeto->getLejosOi(); ?>
                                    </td>
                                    <td>
                                        <?= $objeto->getCercaOd(); ?>
                                    </td>
                                    <td>
                                        <?= $objeto->getCercaOi(); ?>
                                    </td>
                                    <td> 
                                        <?= $objeto->getCilindrico(); ?>
                                    </td>
                                    <td>
                                        <?= $objeto->getEnGrados(); ?>
                                    </td>
                                    <td>
                                        <?= $objeto->getDistancia(); ?>
                                    </td>
                                    <td>
                                        <?= $objeto->getCalibre(); ?>
                                    </td>
                                    <td>
                                        <?= $objeto->getPuente(); ?>
                                    </td>
                                    <td>
                                        <?= $objeto->getColor(); ?>
                                    </td> 
                                    <td>
                                        <?= date('d-m-Y',strtotime($objeto->getFecha())); ?>
                                    </td>
                                    <td>
                                        <a href="/vista/factura/<?= $objeto->getId(); ?>/<?= $cliente->getId()?>" class="disabled">         
                                            <span class="glyphicon glyphicon-list-alt" title="Factura"
                                            data-toggle="tooltip" data-placement="right">
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/vista/modificarlente/<?= $cliente->getId()?>/<?=$objeto->getId(); ?>" class="disabled">
                                            <span class="glyphicon glyphicon-pencil" title="Modificar"
                                            data-toggle="tooltip" data-placement="right">
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <a type="submit" method="post"  name="id_cliente" href="/administrar/eliminarlente/<?= $objeto->getId(); ?>/<?= $cliente->getId(); ?>" class="disabled">
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
