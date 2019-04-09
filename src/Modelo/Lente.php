<?php

namespace Modelo;

class Lente
{
    private $id;
    private $medico; 
    private $lejos_od;
    private $lejos_oi;
    private $cerca_od;
    private $cerca_oi;
    private $descripcion;
    private $fecha;
    private $cilindrico;
    private $en_grados;
    private $distacia;
    private $calibre;
    private $puente;


    /**
     * Class Constructor
     * @param    $medico   
     * @param    $lejos_od   
     * @param    $lejos_oi   
     * @param    $cerca_od   
     * @param    $cerca_oi   
     * @param    $descripcion   
     * @param    $fecha   
     * @param    $cilindrico   
     * @param    $en_grados   
     * @param    $distacia   
     * @param    $calibre   
     * @param    $puente   
     */
    public function __construct($medico, $lejos_od, $lejos_oi, $cerca_od, $cerca_oi, $descripcion, $fecha, $cilindrico, $en_grados, $distacia, $calibre, $puente)
    {
        $this->medico = $medico;
        $this->lejos_od = $lejos_od;
        $this->lejos_oi = $lejos_oi;
        $this->cerca_od = $cerca_od;
        $this->cerca_oi = $cerca_oi;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;
        $this->cilindrico = $cilindrico;
        $this->en_grados = $en_grados;
        $this->distacia = $distacia;
        $this->calibre = $calibre;
        $this->puente = $puente;
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
    public function getMedico()
    {
        return $this->medico;
    }

    /**
     * @param mixed $medico
     *
     * @return self
     */
    public function setMedico($medico)
    {
        $this->medico = $medico;

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
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     *
     * @return self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

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

    /**
     * @return mixed
     */
    public function getCilindrico()
    {
        return $this->cilindrico;
    }

    /**
     * @param mixed $cilindrico
     *
     * @return self
     */
    public function setCilindrico($cilindrico)
    {
        $this->cilindrico = $cilindrico;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnGrados()
    {
        return $this->en_grados;
    }

    /**
     * @param mixed $en_grados
     *
     * @return self
     */
    public function setEnGrados($en_grados)
    {
        $this->en_grados = $en_grados;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDistacia()
    {
        return $this->distacia;
    }

    /**
     * @param mixed $distacia
     *
     * @return self
     */
    public function setDistacia($distacia)
    {
        $this->distacia = $distacia;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCalibre()
    {
        return $this->calibre;
    }

    /**
     * @param mixed $calibre
     *
     * @return self
     */
    public function setCalibre($calibre)
    {
        $this->calibre = $calibre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPuente()
    {
        return $this->puente;
    }

    /**
     * @param mixed $puente
     *
     * @return self
     */
    public function setPuente($puente)
    {
        $this->puente = $puente;

        return $this;
    }
}