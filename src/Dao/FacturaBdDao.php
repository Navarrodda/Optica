<?php

namespace Dao;

use \Modelo\Factura

class FacturaBdDao{

	protected $tabla = "facturas";
	protected static $instancia;
	protected $listado;

	public static function getInstancia(){

		if(!self::$instancia instanceof self){

			self::$instancia = new self();
		}

		return self::$instancia;
	}

	public function traerTodo()
	{
		$sql = "SELECT * FROM $this->tabla";

		$conexion = Conexion::conectar();

		$sentencia = $conexion->prepare($sql);

		$sentencia->execute();

		$dataSet =  $sentencia->fetchAll(\PDO::FETCH_ASSOC);

		$this->mapear($dataSet);

		if(!empty($this->listado))
		{
			return $this->listado;
		}

		return null;
	}


	public function agregar(Factura $factura){

		try{

			$sql = ("INSERT INTO $this->tabla (nombre, fecha, monto, descripcion ) VALUES ( :nombre, :fecha, :monto, :descripcion  ) ");

			$conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$nombre = $factura->getNombre();
			$fecha = $factura->getFecha();
			$monto = $factura->getMonto();
			$descripcion = $factura->getDescripcion();

			$sentencia->bindParam(":nombre",$nombre);
			$sentencia->bindParam(":fecha",$fecha);
			$sentencia->bindParam(":monto",$monto);
			$sentencia->bindParam(":descripcion",$descripcion);

			$sentencia->execute();

			return $conexion->lastInsertId();
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}

	public function traerPorId($id)
	{
		$sql = "SELECT * FROM $this->tabla WHERE id_tipo_cerveza = \"$id\" LIMIT 1";

		$conexion = Conexion::conectar();

		$sentencia = $conexion->prepare($sql);

		$sentencia->execute();

		$dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

		$this->mapear($dataSet);

		if(!empty($this->listado[0])){
			return $this->listado[0];
		}
		return null;
	}

	public function mapear($dataSet){
    $dataSet = is_array($dataSet) ? $dataSet : false;
    if($dataSet){
       $this->listado = array_map(function ($p) {
        $factura = new Factura
        (
            $p['nombre'],
            $p['fecha'],
            $p['monto'],
            $p['descripcion']
        );
        $factura->setId($p['id_factura']);
        return $factura;
    }, $dataSet);
   }
}
}