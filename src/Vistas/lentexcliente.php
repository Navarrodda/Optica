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
                                     <tr style="color:white">
                                        <td rowspan="10" valign="middle">ID: <?= $lente->getId(); ?></td>
                                     </tr>
                                     <tr style="color:white">
                                        <td colspan="2" >Doctor: <?= $lente->getDoctor(); ?></td>
                                        <td colspan="2">Observación: <?= $lente->getObservacion(); ?></td>
                                    </tr>
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

                                <tr style="color:white"> 
                                    <td colspan="12">Fecha: <?= date('d-m-Y',strtotime($lente->getFecha())); ?></td>
                                </tr>
                                <td colspan="2" style="color:white">:Factura
                                    <a  href="/vista/factura/<?= $lente->getId(); ?>/<?= $cliente->getId()?>" class="disabled">         
                                        <span class="glyphicon glyphicon-list-alt" title="Factura"
                                        data-toggle="tooltip" data-placement="right">
                                    </span>
                                </td>
                                <td colspan="2" style="color:white">PDF:
                                    <a href="/pdf/pdfclientelente/<?= $lente->getId(); ?>/<?= $cliente->getId(); ?>/" target="_blank" class="disabled">         
                                        <span class="glyphicon glyphicon-cloud-upload" title="PDF"
                                        data-toggle="tooltip" data-placement="right">
                                    </span>
                                </td>
                                <td colspan="2" style="color:white">Modificar:
                                    <a href="/vista/modificarlente/<?= $cliente->getId()?>/<?=$lente->getId(); ?>" class="disabled">
                                        <span class="glyphicon glyphicon-pencil" title="Modificar"
                                        data-toggle="tooltip" data-placement="right">
                                    </span>
                                </a>
                            </td>
                            <td colspan="2" style="color:white">Eliminar:
                                <a type="submit" method="post"  name="id_cliente" href="/administrar/eliminarlente/<?= $lente->getId(); ?>/<?= $cliente->getId(); ?>" class="disabled">
                                    <span class="glyphicon glyphicon-trash"  title="Eliminar Lente"
                                    data-toggle="tooltip" data-placement="right">
                                </span>
                            </a>
                      </td>
                      <?php  
            } ?>
        </tbody>
    </table>
</div>
</div>
</div>
<?php
if(!empty($longitud))
    if($longitud != 1)
        if($longitud > 1)   
       {
        {
            {
                ?>
                <div id="navegador">
                    <ul>
                        <li><a href="/vista/lentesclienteslimit/<?= $cliente->getId(); ?>/<?= -1; ?>/<?= $longitud - 1; ?>/<?= $entrada; ?>/<?= $entrada; ?>/">Siguiente</a></li>
                        <?php
                        for ($contador = 1; $contador < $longitud; $contador++){
                            ?>
                            <li><a href="/vista/lentesclienteslimit/<?= $cliente->getId(); ?>/<?= $pantalla; ?>/<?= $longitud - 1; ?>/<?= $pantalla; ?>/<?= $pantalla; ?>/"><?php print_r($pantalla); ?></a></li>
                            <?php
                            $entrada++;
                            $pantalla++;
                        }
                        ?>
                        <li><a href="/vista/lentesclienteslimit/<?= $cliente->getId(); ?>/<?= -2; ?>/<?= $longitud - 1; ?>/<?= $entrada; ?>/<?= $pantalla; ?>/">Anterior</a></li>
                    </ul>
                </div>
                <?php
            }
        }
    }
    ?>
</div>
</div>
