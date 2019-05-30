<?php

namespace Dao;

use Modelo\Cuenta_saldos;

class CuentasaldosBdDao{

	protected $tabla = "cuenta_saldos";
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


	public function agregar(Cuenta_saldos $Cuenta){

		try{

			$sql = ("INSERT INTO $this->tabla (a_cuenta, saldo, fecha) VALUES (:a_cuenta, :saldo, :fecha) ");

			$conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$a_cuenta = $Cuenta->getACuenta();
			$saldo = $Cuenta->getSaldo();
			$fecha = $Cuenta->getFecha();

			$sentencia->bindParam(":a_cuenta",$a_cuenta);
			$sentencia->bindParam(":saldo",$saldo);
			$sentencia->bindParam(":fecha",$fecha);

			$sentencia->execute();

			return $conexion->lastInsertId();
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}

	public function actualizar($id_cuenta_saldo){

		try{
			/** @noinspection SqlResolve */

			$id = $senia1->getIdSenia();

			$sql = ("UPDATE $this->tabla SET  a_cuenta=:a_cuenta, saldo=:saldo,  fecha=:fecha 
				WHERE id_cuenta_saldo=\"$id\"");

			$conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$a_cuenta = $Cuentas->getACuenta();
			$saldo = $Cuentas->getSaldo();
			$fecha = $Cuentas->getFecha();

			$sentencia->bindParam(":a_cuenta",$a_cuenta);
			$sentencia->bindParam(":saldo",$saldo);
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
		$sql = "SELECT * FROM $this->tabla WHERE id_cuenta_saldo = \"$id\" LIMIT 1";

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
				$cuentas = new Cuenta_saldos
				(
					$p['a_cuenta'],
					$p['saldo'],
					$p['fecha']
				);
				$cuentas->setId($p['id_cuenta_saldo']);
				return $cuentas;
			}, $dataSet);
		}
	}
}