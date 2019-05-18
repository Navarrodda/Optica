<?php  include(URL_VISTA . 'navbar.php') ?>

<?php if(isset($this->mensaje)) {?>
    <div class="container">
      <h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
  </div>
<?php } ?>

<div class="container mh-400" style="margin-top:30px;">
    <div class="container lower-box box-primary" style="text-align: center;">
        <?php if($lente!= null ) { ?>
            <h2 class="section-heading">Lentes registrados en el Sistema del CLeinte: <?= $cliente->getNombre() ,' ', $cliente->getApellido() ?>  </h2>
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
                                foreach ($lente as $objeto) {
                                    ?>
                                    <tr style="color:white">
                                        <td>
                                            <?= $objeto->getId(); ?>
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                           
                                        </td>
                                        <td>
                                            <a href="#" class="disabled">         
                                                <span class="glyphicon glyphicon-plus" title="Lentes"
                                                data-toggle="tooltip" data-placement="right">
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#" class="disabled">
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
</div>
</div>
