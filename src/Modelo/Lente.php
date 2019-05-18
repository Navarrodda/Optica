<?php

namespace Modelo;

class Lente
{
    private $id;
    private $medico;
    private $armazon_cerca; 
    private $armazon_lejos;
    private $lejos_od;
    private $lejos_oi;
    private $cerca_od;
    private $cerca_oi;
    private $cilindrico;
    private $en_grados;
    private $distancia;
    private $calibre;
    private $puente;
    private $color;
    private $fecha;

    public function __construct($medico, $armazon_cerca, $armazon_lejos, $lejos_od, $lejos_oi, $cerca_od, $cerca_oi, $cilindrico, $en_grados, $distancia, $calibre, $puente, $color, $fecha)
    {
        $this->medico = $medico;
        $this->armazon_cerca = $armazon_cerca;
        $this->armazon_lejos = $armazon_lejos;
        $this->lejos_od = $lejos_od;
        $this->lejos_oi = $lejos_oi;
        $this->cerca_od = $cerca_od;
        $this->cerca_oi = $cerca_oi;
        $this->cilindrico = $cilindrico;
        $this->en_grados = $en_grados;
        $this->distancia = $distancia;
        $this->calibre = $calibre;
        $this->puente = $puente;
        $this->color = $color;
        $this->fecha = $fecha;
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
    public function getArmazonLejos()
    {
        return $this->armazon_lejos;
    }

    /**
     * @param mixed $armazon_lejos
     *
     * @return self
     */
    public function setArmazonLejos($armazon_lejos)
    {
        $this->armazon_lejos = $armazon_lejos;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArmazonCerca()
    {
        return $this->armazon_cerca;
    }

    /**
     * @param mixed $armazon_cerca
     *
     * @return self
     */
    public function setArmazonCerca($armazon_cerca)
    {
        $this->armazon_cerca = $armazon_cerca;

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
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     *
     * @return self
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDistancia()
    {
        return $this->distancia;
    }

    /**
     * @param mixed $distancia
     *
     * @return self
     */
    public function setDistancia($distancia)
    {
        $this->distancia = $distancia;

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