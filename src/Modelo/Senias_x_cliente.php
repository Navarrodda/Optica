<?php

namespace Modelo;

use\Modelo\Cuenta_saldos as Cuenta_saldos;
use\Modelo\Cliente as Cliente;

class Senia_x_cliente
{

    private $id_senia_x_cliente 
	private $id_cuenta_saldo; 
	private $id_cliente; 


    /**
     * Class Constructor
     * @param    $id_cuenta_saldo   
     * @param    $id_cliente   
     */
    public function __construct(Cuenta_saldos $id_cuenta_saldo, Cliente $id_cliente)
    {
        $this->id_cuenta_saldo = $id_cuenta_saldo;
        $this->id_cliente = $id_cliente;
    }


    /**
     * @return mixed
     */
    public function getIdSeniaXCliente()
    {
        return $this->id_senia_x_cliente;
    }

    /**
     * @param mixed $id_senia_x_cliente
     *
     * @return self
     */
    public function setIdSeniaXCliente($id_senia_x_cliente)
    {
        $this->id_senia_x_cliente = $id_senia_x_cliente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdCuentaSaldo()
    {
        return $this->id_cuenta_saldo;
    }

    /**
     * @param mixed $id_cuenta_saldo
     *
     * @return self
     */
    public function setIdCuentaSaldo($id_cuenta_saldo)
    {
        $this->id_cuenta_saldo = $id_cuenta_saldo;

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
}