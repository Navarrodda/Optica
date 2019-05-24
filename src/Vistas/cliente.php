<?php  include(URL_VISTA . 'navbar.php') ?>

<?php if(isset($this->mensaje)) {?>
    <div class="container">
      <h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
  </div>
<?php } ?>

<div class="container mh-400" style="margin-top:30px;">
    <div class="container lower-box box-primary" style="text-align: center;">
        <?php if($cliente!= null ) { ?>
            <h2 class="section-heading">Clientes registrados en el Sistema</h2>
            <hr class="primary"> <?php }
            else{ ?>
                <h2 class="section-heading">No hay Clientes cargados en el Sistema</h2>
                <hr class="primary"> <?php } ?>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 texto-chico">
                       <div class="table-responsive">
                         <table class="table table-hover">
                           <?php 
                           if($cliente!= null )
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
                                        Telefono
                                    </th>
                                    <th>
                                        Lentes
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
                                foreach ($cliente as $objeto) {
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
                                            <?= $objeto->getTelefono(); ?>
                                        </td>
                                        <td>
                                            <a href="/vista/lentecliente/<?= $objeto->getId(); ?>" class="disabled">         
                                                <span class="glyphicon glyphicon-list" title="Lentes"
                                                data-toggle="tooltip" data-placement="right">
                                            </span>
                                        </td>
                                        <td>
                                            <a type="submit" method="post"  name="id_cliente"  href="/vista/modificarcliente/<?= $objeto->getId(); ?>" class="disabled">
                                                <span class="glyphicon glyphicon-pencil" title="No implementado..."
                                                data-toggle="tooltip" data-placement="right">
                                            </span>
                                        </a>
                                    </td>
                                    <td>
                                        <a type="submit" method="post"  name="id_cliente" href="/administrar/eliminarcliente/<?= $objeto->getId(); ?>" class="disabled">
                                            <span class="glyphicon glyphicon-trash"  title="Eliminar Cliente"
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
<?php
if(!empty($longitud))
{
if($longitud > 10) {
    ?>
    <div id="navegador">
        <ul>
            <li><a href="#">Siguiente</a></li>
            <?php
            for ($contador = 10; $contador < $longitud; $contador++){
                $limit = $limit + 1;
            ?>
            <li><a href="/vista/clienteslimit/<?= $limit; ?>/<?= $longitud; ?>"><?php print_r($entrada); ?></a></li>
            <?php
            $entrada++;
        }
        ?>
        <li><a href="#">Anterior</a></li>
    </ul>
</div>
<?php
}
}
?>
</div>
</div>
