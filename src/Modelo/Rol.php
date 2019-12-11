<?php

namespace Modelo;

class Rol
{
	private $id;
	private $prioridad;


    /**
     * Class Constructor
     * @param    $id   
     * @param    $prioridad   
     */
    public function __construct($prioridad)
    {
        $this->prioridad = $prioridad;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * @param mixed $prioridad
     *
     * @return self
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

        return $this;
    }
}