<?php

namespace Modelo;

use\Modelo\Cliente;
use\Modelo\Factura;

class Factura_x_cliente
{

	private $id_factura_x_cliente;
	private $id_cliente;
	private $id_factura;


	/**
	 * Class Constructor
	 * @param    $id_factura_x_cliente   
	 * @param    $id_cliente   
	 * @param    $id_factura   
	 */
	public function __construct(Cliente $id_cliente,Factura $id_factura)
	{
		$this->id_cliente = $id_cliente;
		$this->id_factura = $id_factura;
	}




    /**
     * @return mixed
     */
    public function getIdFacturaXCliente()
    {
    	return $this->id_factura_x_cliente;
    }

    /**
     * @param mixed $id_factura_x_cliente
     *
     * @return self
     */
    public function setIdFacturaXCliente($id_factura_x_cliente)
    {
    	$this->id_factura_x_cliente = $id_factura_x_cliente;

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
    public function getIdFactura()
    {
    	return $this->id_factura;
    }

    /**
     * @param mixed $id_factura
     *
     * @return self
     */
    public function setIdFactura($id_factura)
    {
    	$this->id_factura = $id_factura;

    	return $this;
    }
}