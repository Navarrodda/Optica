<?php 

include(URL_VISTA . "navbar.php"); 

 if(isset($ir_a_inicio))  
 {
     if(!$ir_a_inicio) // si es FALSE , significa que hubo un error, entonces muestro el mensaje de error
     { 
        /**
            $this->mensaje es un atributo de tipo class Mensaje , donde contiene dos atributos: mensaje y tipo (danger, succes , ...)

            El Mensaje tiene un metodo llamado cartelAlert(Mensaje,  Tipo ) y devuelve un codigo HTML en forma de Alert.
        **/
        echo $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo());

        /**
            El hecho de utilziar THIS, es porque este documento HTML enrealidad esta incluido dentro de una Controladora que tiene un atributo mensaje.
        **/
     }
 }

if(isset($reg_completado)) 
{
    /* si la variable reg_completado esta seteada, significa que el usuario acaba de registrarse y por lo tanto 
        se muestra el mensaje
     */
     echo $this->mensaje->cartelAlert($this->mensaje->getMensaje(),$this->mensaje->getTipo());
}
?>

<div class="container mh-400" style="margin-top:40px; margin-bottom: 40px;">
<div class="row">
    <div class="col-md-8 col-md-offset-2 text-center">
        <h2 class="section-heading" style="color:black">INICIAR SESION</h2>
        <hr class="primary">
        <div class="regularform">
            <form method="post" action="/sesion/logueando" id="contactform" class="text-left" autocomplete="off">

		        <p style="text-align: center;">
		       		<strong style="color:black">
		             	Introduce tu mail y contraseña para iniciar sesion
		             </strong>
		        </p>

		        <input name="mail" type="email" class=" col-md-6 norightborder btn2" placeholder="Nombre de usuario o Email" required />
		        <input name="pwd" type="password" class="col-md-6 norightborder btn2" placeholder="contraseña" required />
                
                <button type="submit" class="contact submit  btn-primary btn-xl pull-right">Iniciar Sesion</button>
            
            </form>
        </div>
    </div>
</div>
</div>
