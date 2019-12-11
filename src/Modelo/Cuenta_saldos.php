<?php

namespace Modelo;

class Cuenta_saldos
{
	private $id;
	private $a_cuenta;
	private $saldo;
    private $fecha; 


    /**
     * Class Constructor
     * @param    $a_cuenta   
     * @param    $saldo   
     * @param    $fecha   
     */
    public function __construct($a_cuenta, $saldo, $fecha)
    {
        $this->a_cuenta = $a_cuenta;
        $this->saldo = $saldo;
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
    public function getACuenta()
    {
        return $this->a_cuenta;
    }

    /**
     * @param mixed $a_cuenta
     *
     * @return self
     */
    public function setACuenta($a_cuenta)
    {
        $this->a_cuenta = $a_cuenta;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * @param mixed $saldo
     *
     * @return self
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;

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