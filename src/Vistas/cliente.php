<?php  include(URL_VISTA . 'navbar.php') ?>

<div class="container lower-box box-primary" style="margin-top: 30px;text-align: center;">
 <?php 
 if($this->listado!= null )
 {
    ?>
    <h2 class="section-heading">Clientes registrados en el Sistema</h2>
    <?php
}
else{
    ?>
    <h2 class="section-heading">No hay Clientes cargados en el Sistema</h2>
    <?php
}
?>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 texto-chico">
         <div class="table-responsive">
                   <table class="table table-hover">
                 <?php 
                 if($this->listado!= null )
                 {
                    ?>
                    <thead>
                        <tr style="color:white">
                            <th>
                                id
                            </th>
                            <th>
                                Nickname
                            </th>
                            <th>
                                Mail
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
                        foreach ($this->listado as $objeto) {
                            ?>
                            <tr style="color:white">
                                <td>
                                    <?= $objeto->getId(); ?>
                                </td>
                                <td>
                                    <?= $objeto->getNikname(); ?>
                                </td>
                                <td>
                                    <?= $objeto->getEmail(); ?>
                                </td>
                                <td>
                                    <a href="#" class="disabled">
                                        <span class="glyphicon glyphicon-pencil" title="No implementado..."
                                        data-toggle="tooltip" data-placement="right">
                                    </span>
                                </a>
                            </td>
                            <td>
                                <a href="#" class="disabled">
                                    <span class="glyphicon glyphicon-trash" title="No implementado..."
                                    data-toggle="tooltip" data-placement="right">
                                </span>
                            </a>
                        </td>
                    </tr>
                    <?php 
                }
            }
           ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
