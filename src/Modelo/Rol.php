<?php

namespace Modelo;

class Rol
{
	private $id_rol;
	private $prioridad;


	/**
	 * Class Constructor
	 * @param    $id_rol   
	 * @param    $prioridad   
	 */
	public function __construct($prioridad)
	{
		$this->prioridad = $prioridad;
	}

    /**
     * @return mixed
     */
    public function getIdRol()
    {
        return $this->id_rol;
    }

    /**
     * @param mixed $id_rol
     *
     * @return self
     */
    public function setIdRol($id_rol)
    {
        $this->id_rol = $id_rol;

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