<?php

namespace Modelo;

use\Modelo\Lente;
use\Modelo\Senia;

class Senia_x_lente
{
	private $id_senia_x_lente;
	private $id_senia;
	private $id_Lente;


	/**
	 * Class Constructor
	 * @param    $id_senia_x_cliente   
	 * @param    $id_senia   
	 * @param    $id_cliente   
	 */
	public function __construct(Senia $id_senia,Lente $id_Lente)
	{
		$this->id_senia = $id_senia;
		$this->id_Lente = $id_Lente;
	}

	

    

    /**
     * @return mixed
     */
    public function getIdSeniaXLente()
    {
        return $this->id_senia_x_lente;
    }

    /**
     * @param mixed $id_senia_x_lente
     *
     * @return self
     */
    public function setIdSeniaXLente($id_senia_x_lente)
    {
        $this->id_senia_x_lente = $id_senia_x_lente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdSenia()
    {
        return $this->id_senia;
    }

    /**
     * @param mixed $id_senia
     *
     * @return self
     */
    public function setIdSenia($id_senia)
    {
        $this->id_senia = $id_senia;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdLente()
    {
        return $this->id_Lente;
    }

    /**
     * @param mixed $id_Lente
     *
     * @return self
     */
    public function setIdLente($id_Lente)
    {
        $this->id_Lente = $id_Lente;

        return $this;
    }
}