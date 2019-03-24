<?php

namespace Dao;

// use Modelo\Cliente; ejemplo

class //nombreBdDao{
	{
	//protected $tabla = "clientes"; ejemplo
	private static $instancia;
    protected $listado;

    public static function getInstancia()
    {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }
}