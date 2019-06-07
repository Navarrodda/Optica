<?php

include (URL_VISTA . 'navbar.php');
?>
<?php if(isset($this->mensaje)) {?>
    <div class="container">
        <h1> <?= $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo()) ?></h1>
    </div>
<?php } ?>

<div class="container mh-400" style="margin-top:30px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center">
            <h2 class="section-heading">Modificar Cuenta de: <?= $usuario->getNombre(); ?> <?= $usuario->getApellido(); ?> </h2>
            <hr class="primary">
            <div class="regularform">
                <form id="form_r" method="post" action="/administrar/modificarpreousuario/" id="contactform" class="text-left" autocomplete="off">
                    <input  name="id_usuario" type=hidden value="<?= $usuario->getId()?>">
                    <input name="preoridad" type="text" class="col-md-12 norightborder btn2" placeholder="Preoridad">
                    <button type="submit" class="contact submit btn-primary btn-xl pull-right">Modificar</button>
                </form>
            </div>
        </div>
    </div>
</div>