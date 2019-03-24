<?php

namespace Modelo;

class Factura
{

private $id;
private $id_cliente;
private $fecha;
private $a_cuenta;
private $saldo;
private $sub_total;
private $senia;
private $saldo_total;


	/**
	 * Class Constructor
	 * @param    $id   
	 * @param    $fecha   
	 * @param    $a_cuenta   
	 * @param    $saldo   
	 * @param    $sub_total   
	 * @param    $senia   
	 * @param    $saldo_total   
	 */
	public function __construct(Cliente $id_cliente, $fecha, $a_cuenta, $saldo, $sub_total, $senia, $saldo_total)
	{
		$this->setCliente($cliente);
		$this->fecha = $fecha;
		$this->a_cuenta = $a_cuenta;
		$this->saldo = $saldo;
		$this->sub_total = $sub_total;
		$this->senia = $senia;
		$this->saldo_total = $saldo_total;
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
    public function getIdCliente()
    {
        return $this->id_cliente;
    }

    /**
     * @param mixed $id_cliente
     *
     * @return self
     */
    public function setIdCliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;

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
    public function getSubTotal()
    {
        return $this->sub_total;
    }

    /**
     * @param mixed $sub_total
     *
     * @return self
     */
    public function setSubTotal($sub_total)
    {
        $this->sub_total = $sub_total;

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
    public function getSaldoTotal()
    {
        return $this->saldo_total;
    }

    /**
     * @param mixed $saldo_total
     *
     * @return self
     */
    public function setSaldoTotal($saldo_total)
    {
        $this->saldo_total = $saldo_total;

        return $this;
    }

}