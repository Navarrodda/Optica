<?php

namespace Modelo;

class Factura
{

    private $id;
    private $id_lente;
    private $saldo_armazo_l;
    private $saldo_armazon_c;
    private $saldo_lejoso_d;
    private $saldo_lejoso_i; 
    private $saldo_cerca_od; 
    private $saldo_cerca_oi; 
    private $sub_total;
    private $senia;
    private $saldo_total;


    /**
     * Class Constructor
     * @param    $id_lente   
     * @param    $saldo_armazo_l   
     * @param    $saldo_armazon_c   
     * @param    $saldo_lejoso_d   
     * @param    $saldo_lejoso_i   
     * @param    $saldo_cerca_od   
     * @param    $saldo_cerca_oi   
     * @param    $sub_total   
     * @param    $senia   
     * @param    $saldo_total   
     */
    public function __construct($saldo_armazo_l, $saldo_armazon_c, $saldo_lejoso_d, $saldo_lejoso_i, $saldo_cerca_od, $saldo_cerca_oi, $sub_total, $senia, $saldo_total,Lente $id_lente)
    {
        $this->id_lente = $id_lente;
        $this->saldo_armazo_l = $saldo_armazo_l;
        $this->saldo_armazon_c = $saldo_armazon_c;
        $this->saldo_lejoso_d = $saldo_lejoso_d;
        $this->saldo_lejoso_i = $saldo_lejoso_i;
        $this->saldo_cerca_od = $saldo_cerca_od;
        $this->saldo_cerca_oi = $saldo_cerca_oi;
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
    public function getSaldoArmazoL()
    {
        return $this->saldo_armazo_l;
    }

    /**
     * @param mixed $saldo_armazo_l
     *
     * @return self
     */
    public function setSaldoArmazoL($saldo_armazo_l)
    {
        $this->saldo_armazo_l = $saldo_armazo_l;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSaldoArmazonC()
    {
        return $this->saldo_armazon_c;
    }

    /**
     * @param mixed $saldo_armazon_c
     *
     * @return self
     */
    public function setSaldoArmazonC($saldo_armazon_c)
    {
        $this->saldo_armazon_c = $saldo_armazon_c;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSaldoLejosoD()
    {
        return $this->saldo_lejoso_d;
    }

    /**
     * @param mixed $saldo_lejoso_d
     *
     * @return self
     */
    public function setSaldoLejosoD($saldo_lejoso_d)
    {
        $this->saldo_lejoso_d = $saldo_lejoso_d;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSaldoLejosoI()
    {
        return $this->saldo_lejoso_i;
    }

    /**
     * @param mixed $saldo_lejoso_i
     *
     * @return self
     */
    public function setSaldoLejosoI($saldo_lejoso_i)
    {
        $this->saldo_lejoso_i = $saldo_lejoso_i;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSaldoCercaOd()
    {
        return $this->saldo_cerca_od;
    }

    /**
     * @param mixed $saldo_cerca_od
     *
     * @return self
     */
    public function setSaldoCercaOd($saldo_cerca_od)
    {
        $this->saldo_cerca_od = $saldo_cerca_od;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSaldoCercaOi()
    {
        return $this->saldo_cerca_oi;
    }

    /**
     * @param mixed $saldo_cerca_oi
     *
     * @return self
     */
    public function setSaldoCercaOi($saldo_cerca_oi)
    {
        $this->saldo_cerca_oi = $saldo_cerca_oi;

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