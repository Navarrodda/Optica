<?php

namespace Modelo;

/**
 * Esta clase fue creada para crear y mostrar mensajes por pantalla.
 * Esta clase no es óptima ya que esta acoplada a bootstrap.
 *
 * Class Mensaje
 * @package Controladoras
 */
class Mensaje
{

    private $tipo;
    private $mensaje;

    public function __construct($tipo, $mensaje)
    {
        $this->tipo = $tipo;
        $this->mensaje = $mensaje;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }


    /** METODO **/

    public function pdoLimpiar1062($mensaje){
        /**
        
        El error de PDO1062 ocurre cuando se produce una Excepcion cuando hay una columna de una TABLA que se califica como UNIQUE y detecta que se quiere introducir un mismo valor, es decir, un valor duplicado.
    
        */

        $text_error = str_replace("Duplicate entry","",$mensaje); //Quito el texto que viene por defecto en el error de PDO
        $array_error = explode("for key", $text_error); //cuando encuentra la palabra "for key" la elimina y separa el contenido en dos, array_error ahora es un arreglo de dos elementos.
        $array_error = str_replace("'","",$array_error); //el error PDO indica el nombre de la constraaint con comillas simples, ej: 'unq_email', lo que se hice fue eliminar esas comillas.

        $array_error[0] = trim($array_error[0]); //elimino si hay espacios al inicio y/o final de la cadena en la posicion 0 
        $array_error[1] = trim($array_error[1]); //lo mismo pero en la posicion 1

        return $array_error;

    }

    public function cartelAlert($msj,$tipo)
    {
        $html = "
            <div class='container' style='margin-top:50px; margin-bottom: 30px;'>
                <div class='row'> 
                    <div class='col-sm-8 col-md-offset-2'>
                         <div class='alert alert-" . $tipo . "  alert-dismissable' style='text-align: center;'>
                            <a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a>
                 " . $msj . "
                        </div>
                    </div>
                </div>
            </div>

        ";

        return $html;
    }
}
