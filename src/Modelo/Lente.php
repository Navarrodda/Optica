<?php

namespace Modelo;

class Lente
{
    private $id;
    private $doctor; 
    private $armazon_lejos;
    private $armazon_cerca; 
    private $lejos_od_esferico; 
    private $lejos_od_cilindrico; 
    private $lejos_od_grados; 
    private $lejos_oi_esferico; 
    private $lejos_oi_cilindrico; 
    private $lejos_oi_grados; 
    private $lejos_color; 
    private $cerca_od_esferico; 
    private $cerca_od_cilindrico; 
    private $cerca_od_grados; 
    private $cerca_oi_esferico; 
    private $cerca_oi_cilindrico; 
    private $cerca_oi_grados; 
    private $cerca_color; 
    private $fecha; 


    /**
     * Class Constructor
     * @param    $doctor   
     * @param    $armazon_lejos   
     * @param    $armazon_cerca   
     * @param    $lejos_od_esferico   
     * @param    $lejos_od_cilindrico   
     * @param    $lejos_od_grados   
     * @param    $lejos_oi_esferico   
     * @param    $lejos_oi_cilindrico   
     * @param    $lejos_oi_grados   
     * @param    $lejos_color   
     * @param    $cerca_od_esferico   
     * @param    $cerca_od_cilindrico   
     * @param    $cerca_od_grados   
     * @param    $cerca_oi_esferico   
     * @param    $cerca_oi_cilindrico   
     * @param    $cerca_oi_grados   
     * @param    $cerca_color   
     * @param    $fecha   
     */
    public function __construct($doctor, $armazon_lejos, $armazon_cerca, $lejos_od_esferico, $lejos_od_cilindrico, $lejos_od_grados, $lejos_oi_esferico, $lejos_oi_cilindrico, $lejos_oi_grados, $lejos_color, $cerca_od_esferico, $cerca_od_cilindrico, $cerca_od_grados, $cerca_oi_esferico, $cerca_oi_cilindrico, $cerca_oi_grados, $cerca_color, $fecha)
    {
        $this->doctor = $doctor;
        $this->armazon_lejos = $armazon_lejos;
        $this->armazon_cerca = $armazon_cerca;
        $this->lejos_od_esferico = $lejos_od_esferico;
        $this->lejos_od_cilindrico = $lejos_od_cilindrico;
        $this->lejos_od_grados = $lejos_od_grados;
        $this->lejos_oi_esferico = $lejos_oi_esferico;
        $this->lejos_oi_cilindrico = $lejos_oi_cilindrico;
        $this->lejos_oi_grados = $lejos_oi_grados;
        $this->lejos_color = $lejos_color;
        $this->cerca_od_esferico = $cerca_od_esferico;
        $this->cerca_od_cilindrico = $cerca_od_cilindrico;
        $this->cerca_od_grados = $cerca_od_grados;
        $this->cerca_oi_esferico = $cerca_oi_esferico;
        $this->cerca_oi_cilindrico = $cerca_oi_cilindrico;
        $this->cerca_oi_grados = $cerca_oi_grados;
        $this->cerca_color = $cerca_color;
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
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * @param mixed $doctor
     *
     * @return self
     */
    public function setDoctor($doctor)
    {
        $this->doctor = $doctor;

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
    public function getLejosOdEsferico()
    {
        return $this->lejos_od_esferico;
    }

    /**
     * @param mixed $lejos_od_esferico
     *
     * @return self
     */
    public function setLejosOdEsferico($lejos_od_esferico)
    {
        $this->lejos_od_esferico = $lejos_od_esferico;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLejosOdCilindrico()
    {
        return $this->lejos_od_cilindrico;
    }

    /**
     * @param mixed $lejos_od_cilindrico
     *
     * @return self
     */
    public function setLejosOdCilindrico($lejos_od_cilindrico)
    {
        $this->lejos_od_cilindrico = $lejos_od_cilindrico;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLejosOdGrados()
    {
        return $this->lejos_od_grados;
    }

    /**
     * @param mixed $lejos_od_grados
     *
     * @return self
     */
    public function setLejosOdGrados($lejos_od_grados)
    {
        $this->lejos_od_grados = $lejos_od_grados;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLejosOiEsferico()
    {
        return $this->lejos_oi_esferico;
    }

    /**
     * @param mixed $lejos_oi_esferico
     *
     * @return self
     */
    public function setLejosOiEsferico($lejos_oi_esferico)
    {
        $this->lejos_oi_esferico = $lejos_oi_esferico;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLejosOiCilindrico()
    {
        return $this->lejos_oi_cilindrico;
    }

    /**
     * @param mixed $lejos_oi_cilindrico
     *
     * @return self
     */
    public function setLejosOiCilindrico($lejos_oi_cilindrico)
    {
        $this->lejos_oi_cilindrico = $lejos_oi_cilindrico;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLejosOiGrados()
    {
        return $this->lejos_oi_grados;
    }

    /**
     * @param mixed $lejos_oi_grados
     *
     * @return self
     */
    public function setLejosOiGrados($lejos_oi_grados)
    {
        $this->lejos_oi_grados = $lejos_oi_grados;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLejosColor()
    {
        return $this->lejos_color;
    }

    /**
     * @param mixed $lejos_color
     *
     * @return self
     */
    public function setLejosColor($lejos_color)
    {
        $this->lejos_color = $lejos_color;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCercaOdEsferico()
    {
        return $this->cerca_od_esferico;
    }

    /**
     * @param mixed $cerca_od_esferico
     *
     * @return self
     */
    public function setCercaOdEsferico($cerca_od_esferico)
    {
        $this->cerca_od_esferico = $cerca_od_esferico;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCercaOdCilindrico()
    {
        return $this->cerca_od_cilindrico;
    }

    /**
     * @param mixed $cerca_od_cilindrico
     *
     * @return self
     */
    public function setCercaOdCilindrico($cerca_od_cilindrico)
    {
        $this->cerca_od_cilindrico = $cerca_od_cilindrico;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCercaOdGrados()
    {
        return $this->cerca_od_grados;
    }

    /**
     * @param mixed $cerca_od_grados
     *
     * @return self
     */
    public function setCercaOdGrados($cerca_od_grados)
    {
        $this->cerca_od_grados = $cerca_od_grados;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCercaOiEsferico()
    {
        return $this->cerca_oi_esferico;
    }

    /**
     * @param mixed $cerca_oi_esferico
     *
     * @return self
     */
    public function setCercaOiEsferico($cerca_oi_esferico)
    {
        $this->cerca_oi_esferico = $cerca_oi_esferico;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCercaOiCilindrico()
    {
        return $this->cerca_oi_cilindrico;
    }

    /**
     * @param mixed $cerca_oi_cilindrico
     *
     * @return self
     */
    public function setCercaOiCilindrico($cerca_oi_cilindrico)
    {
        $this->cerca_oi_cilindrico = $cerca_oi_cilindrico;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCercaOiGrados()
    {
        return $this->cerca_oi_grados;
    }

    /**
     * @param mixed $cerca_oi_grados
     *
     * @return self
     */
    public function setCercaOiGrados($cerca_oi_grados)
    {
        $this->cerca_oi_grados = $cerca_oi_grados;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCercaColor()
    {
        return $this->cerca_color;
    }

    /**
     * @param mixed $cerca_color
     *
     * @return self
     */
    public function setCercaColor($cerca_color)
    {
        $this->cerca_color = $cerca_color;

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