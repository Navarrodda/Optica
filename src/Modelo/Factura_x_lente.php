<?php

namespace Modelo;

use\Modelo\Factura as Factura;
use\Modelo\Lente as Lente;

class Factura_x_lente
{

	private $id_facturas_x_lentes;
	private $id_factura;
    private $id_lente;


    /**
     * Class Constructor
     * @param    $id_factura   
     * @param    $id_lente   
     */
    public function __construct(Factura $id_factura, Lente $id_lente)
    {
        $this->id_factura = $id_factura;
        $this->id_lente = $id_lente;
    }




    /**
     * @return mixed
     */
    public function getIdFacturasXLentes()
    {
        return $this->id_facturas_x_lentes;
    }

    /**
     * @param mixed $id_facturas_x_lentes
     *
     * @return self
     */
    public function setIdFacturasXLentes($id_facturas_x_lentes)
    {
        $this->id_facturas_x_lentes = $id_facturas_x_lentes;

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