<?php

namespace Modelo;

class Cliente
{
	private $id;
	private $nombre;
	private $apellido;
	private $lejos_od;
	private $lejos_oi;
	private $cerca_od;
	private $cerca_oi;
	private $armazon;


	/**
	 * Class Constructor
	 * @param    $id   
	 * @param    $nombre   
	 * @param    $apellido   
	 * @param    $lejos_od   
	 * @param    $lejos_oi   
	 * @param    $cerca_od   
	 * @param    $cerca_oi   
	 * @param    $armazon   
	 */
	public function __construct($nombre, $apellido, $lejos_od, $lejos_oi, $cerca_od, $cerca_oi, $armazon)
	{
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->lejos_od = $lejos_od;
		$this->lejos_oi = $lejos_oi;
		$this->cerca_od = $cerca_od;
		$this->cerca_oi = $cerca_oi;
		$this->armazon = $armazon;
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     *
     * @return self
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getLejosOd()
    {
        return $this->lejos_od;
    }

    /**
     * @param mixed $lejos_od
     *
     * @return self
     */
    public function setLejosOd($lejos_od)
    {
        $this->lejos_od = $lejos_od;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getLejosOi()
    {
        return $this->lejos_oi;
    }

    /**
     * @param mixed $lejos_oi
     *
     * @return self
     */
    public function setLejosOi($lejos_oi)
    {
        $this->lejos_oi = $lejos_oi;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getCercaOd()
    {
        return $this->cerca_od;
    }

    /**
     * @param mixed $cerca_od
     *
     * @return self
     */
    public function setCercaOd($cerca_od)
    {
        $this->cerca_od = $cerca_od;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getCercaOi()
    {
        return $this->cerca_oi;
    }

    /**
     * @param mixed $cerca_oi
     *
     * @return self
     */
    public function setCercaOi($cerca_oi)
    {
        $this->cerca_oi = $cerca_oi;

        return $this;
    }

    

    /**
     * @return mixed
     */
    public function getArmazon()
    {
        return $this->armazon;
    }

    /**
     * @param mixed $armazon
     *
     * @return self
     */
    public function setArmazon($armazon)
    {
        $this->armazon = $armazon;

        return $this;
    }
}