<?php

namespace Modelo;

class Senia
{
	private $id_senia;
	private $senia;
	private $fecha;


	/**
	 * Class Constructor
	 * @param    $id_senia   
	 * @param    $senia   
	 * @param    $fecha   
	 */
	public function __construct($senia, $fecha)
	{
		$this->senia = $senia;
		$this->fecha = $fecha;
	}

    /**
     * @return mixed
     */
    public function getIdSenia()
    {
        return $this->id_senia;
    }

    /**
     * @param mixed $id_senia
     *
     * @return self
     */
    public function setIdSenia($id_senia)
    {
        $this->id_senia = $id_senia;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenia()
    {
        return $this->senia;
    }

    /**
     * @param mixed $senia
     *
     * @return self
     */
    public function setSenia($senia)
    {
        $this->senia = $senia;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     *
     * @return self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }
}