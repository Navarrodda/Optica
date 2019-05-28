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
            <h2 class="section-heading">Modificar Cuenta</h2>
            <hr class="primary">
            <div class="regularform">
                <form id="form_r" method="post" action="/administrar/modificarusuario/" id="contactform" class="text-left" autocomplete="off">
                    <input  name="id_usuario" type=hidden value="<?= $usuario->getId()?>">
                    <input name="nombre" type="text" class="col-md-6 norightborder btn2" placeholder="Nombre">
                    <input name="apellido" type="text" class="col-md-6 norightborder btn2" placeholder="Apellido">
                    <input name="calle" type="text" class="col-md-6 btn2" placeholder="Calle">
                    <input name="telefono" type="text" class="col-md-6 btn2" placeholder="Telefono">
                    <input name="email" type="email" class="col-md-6 btn2" placeholder="Correo electronico">
                    <input name="pass" autocomplete="off" type="password" class="col-md-6 norightborder btn2" placeholder="Contraseña">


                    <button type="submit" class="contact submit btn-primary btn-xl pull-right">Modificar</button>
                </form>
            </div>
        </div>
    </div>
</div>