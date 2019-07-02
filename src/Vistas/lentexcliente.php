<?php  include(URL_VISTA . 'navbar.php') ?>

<?php if(isset($this->mensaje)) {?>
    <div class="container">
      <h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
  </div>
<?php } ?>

<div class="container mh-400" style="margin-top:30px;">
    <div class="container lower-box box-primary" style="text-align: center;">
        <?php if($lente!= null ) { ?>
            <h2 class="section-heading">Lentes registrados en el Sistema <?= $contar ?> del Cliente: <?= $cliente->getNombre() ,' ', $cliente->getApellido() ?>  </h2>
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
                        <table class="table table-hover ta1">
                           <?php 
                           if($lente!= null )
                           {
                            ?>
                            <tbody>
                                <?php
                                foreach ($lente as $objeto) {
                                    ?>
                                     <tr style="color:white">
                                        <td rowspan="10" valign="middle">ID: <?= $objeto->getId(); ?></td>
                                     </tr>
                                     <tr style="color:white">
                                        <td colspan="2" >Doctor: <?= $objeto->getDoctor(); ?></td>
                                        <td colspan="2">Observación: <?= $objeto->getObservacion(); ?></td>
                                    </tr>
                                    <tr style="color:white"> 
                                        <td colspan="12">Armazon Lejos: <?= $objeto->getArmazonLejos(); ?></td>
                                    </tr>
                                    <tr style="color:white"> 
                                        <td colspan="12">Armazon Cerca: <?= $objeto->getArmazonCerca() ?></td>
                                    </tr style="color:white"> 
                                    <tr style="color:white">
                                        <td colspan="2">Lejos O.D.Esf: <?= $objeto->getLejosOdEsferico(); ?></td>
                                        <td colspan="2">Cilindrico: <?= $objeto->getLejosOdCilindrico(); ?></td>
                                        <td colspan="2">Grados°: <?= $objeto->getLejosOdGrados(); ?></td>
                                    </tr >
                                    <tr style="color:white">
                                       <td colspan="2">Lejos O.I. Esf: <?= $objeto->getLejosOiEsferico(); ?></td>
                                       <td colspan="2">Cilindrico: <?= $objeto->getLejosOiCilindrico(); ?></td>
                                       <td colspan="2">Grados°: <?= $objeto->getLejosOiGrados(); ?></td>
                                       <td colspan="2">Color: <?= $objeto->getLejosColor(); ?></td>
                                   </tr>
                                   <tr style="color:white">
                                    <td colspan="2">Cerca O.D. Esf: <?= $objeto->getCercaOdEsferico(); ?></td>
                                    <td colspan="2">Cilindrico: <?= $objeto->getCercaOdCilindrico(); ?></td>
                                    <td colspan="2">Grados°: <?= $objeto->getCercaOdGrados(); ?></td>
                                </tr>
                                <tr style="color:white">
                                    <td colspan="2">Cerca O.I. Esf:  <?= $objeto->getCercaOiEsferico(); ?></td>
                                    <td colspan="2">Cilindrico: <?= $objeto->getCercaOiCilindrico(); ?></td>
                                    <td colspan="2">Grados°: <?= $objeto->getCercaOiGrados(); ?></td>
                                    <td colspan="2">Color: <?= $objeto->getCercaColor(); ?></td>
                                </tr>

                                <tr style="color:white"> 
                                    <td colspan="12">Fecha: <?= date('d-m-Y',strtotime($objeto->getFecha())); ?></td>
                                </tr>
                                <td colspan="2" style="color:white">:Factura
                                    <a  href="/vista/factura/<?= $objeto->getId(); ?>/<?= $cliente->getId()?>" class="disabled">         
                                        <span class="glyphicon glyphicon-list-alt" title="Factura"
                                        data-toggle="tooltip" data-placement="right">
                                    </span>
                                </td>
                                <td colspan="2" style="color:white">PDF:
                                    <a href="/pdf/pdfclientelente/<?= $objeto->getId(); ?>/<?= $cliente->getId(); ?>/" target="_blank" class="disabled">         
                                        <span class="glyphicon glyphicon-cloud-upload" title="PDF"
                                        data-toggle="tooltip" data-placement="right">
                                    </span>
                                </td>
                                <td colspan="2" style="color:white">Modificar:
                                    <a href="/vista/modificarlente/<?= $cliente->getId()?>/<?=$objeto->getId(); ?>" class="disabled">
                                        <span class="glyphicon glyphicon-pencil" title="Modificar"
                                        data-toggle="tooltip" data-placement="right">
                                    </span>
                                </a>
                            </td>
                            <td colspan="2" style="color:white">Eliminar:
                                <a type="submit" method="post"  name="id_cliente" href="/administrar/eliminarlente/<?= $objeto->getId(); ?>/<?= $cliente->getId(); ?>" class="disabled">
                                    <span class="glyphicon glyphicon-trash"  title="Eliminar Lente"
                                    data-toggle="tooltip" data-placement="right">
                                </span>
                            </a>
                        </td>
                <?php } 
            } ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>
