<?php

namespace Modelo;

class Factura
{

    private $id;
    private $id_lente;
    private $sub_total;
    private $senia;
    private $saldo_total;


    /**
     * Class Constructor
     * @param    $id_lente   
     * @param    $sub_total   
     * @param    $senia   
     * @param    $saldo_total   
     */
    public function __construct($id_lente, $sub_total, $senia, $saldo_total)
    {
        $this->id_lente = $id_lente;
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