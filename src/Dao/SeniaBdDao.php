<?php

namespace Dao;

use \Modelo\Senia;

class SeniaBdDao{

	protected $tabla = "senias";
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


	public function agregar(Senia $senia1){

		try{

			$sql = ("INSERT INTO $this->tabla (senia, fecha) VALUES ( :senia, :fecha) ");

			$conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$senia = $senia1->getSenia();
			$fecha = $senia1->getFecha();

			$sentencia->bindParam(":descripcion",$descripcion);
			$sentencia->bindParam(":fecha",$fecha);

			$sentencia->execute();

			return $conexion->lastInsertId();
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}

	public function actualizar(Senia $senia1){

		try{
			/** @noinspection SqlResolve */

			$id = $senia1->getIdSenia();

			$sql = ("UPDATE $this->tabla SET  senia=:senia,  fecha=:fecha 
				WHERE id_senia=\"$id\"");

			$conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$senia = $senia1->getSenia();
			$fecha = $senia1->getFecha();

			$sentencia->bindParam(":descripcion",$descripcion);
			$sentencia->bindParam(":fecha",$fecha);


			$sentencia->execute();
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

	public function mapear($dataSet)
	{
		$dataSet = is_array($dataSet) ? $dataSet : false;
		if($dataSet){
			$this->listado = array_map(function ($p) {
				$senia1 = new Senia
				(
					$p['senia'],
					$p['fecha']
				);
				$senia1->setIdSenia($p['id_senia']);
				return $senia1;
			}, $dataSet);
		}
	}
}