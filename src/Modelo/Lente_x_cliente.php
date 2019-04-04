<?php

namespace Modelo;

use \Modelo\Cliente;
use \Modelo\Lente;

class Lente_x_cliente
{

	private $id_lente_x_cliente;
	private $id_cliente;
	private $id_lente;


	/**
	 * Class Constructor
	 * @param    $id_lente_x_cliente   
	 * @param    $id_cliente   
	 * @param    $id_lente   
	 */
	public function __construct(Cliente $id_cliente,Lente $id_lente)
	{
		$this->id_cliente = $id_cliente;
		$this->id_lente = $id_lente;
	}

    /**
     * @return mixed
     */
    public function getIdLenteXCliente()
    {
    	return $this->id_lente_x_cliente;
    }

    /**
     * @param mixed $id_lente_x_cliente
     *
     * @return self
     */
    public function setIdLenteXCliente($id_lente_x_cliente)
    {
    	$this->id_lente_x_cliente = $id_lente_x_cliente;

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
    public function getIdLente()
    {
    	return $this->id_lente;
    }

    /**
     * @param mixed $id_lente
     *
     * @return self
     */
    public function setIdLente($id_lente)
    {
    	$this->id_lente = $id_lente;

    	return $this;
    }
}