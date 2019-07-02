<?php

namespace Dao;

use \Modelo\Factura;

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
			
			$sql = ("INSERT INTO $this->tabla (id_lente, sub_total, senia, saldo_total) VALUES (:id_lente, :sub_total, :senia, :saldo_total) ");

            $conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$l = $factura->getIdLente();
			$id_lente = $l->getId();

			$sub_total = $factura->getSubTotal();
			$senia = $factura->getSenia();
			$saldo_total = $factura->getSaldoTotal();

			$sentencia->bindParam(":id_lente",$id_lente);
			$sentencia->bindParam(":sub_total",$sub_total);
			$sentencia->bindParam(":senia",$senia);
			$sentencia->bindParam(":saldo_total",$saldo_total);

			$sentencia->execute();

			return $conexion->lastInsertId();
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}


	public function actualizar(Factura $factura, $id_factura){

		try{

            $sql = ("UPDATE $this->tabla SET sub_total=:sub_total, senia=:senia, saldo_total=:saldo_total, id_lente=:id_lente WHERE id_factura=\"$id_factura\"");

            $conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$l = $factura->getIdLente();
			$id_lente = $l->getId();

			$sub_total = $factura->getSubTotal();
			$senia = $factura->getSenia();
			$saldo_total = $factura->getSaldoTotal();

			$sentencia->bindParam(":id_lente",$id_lente);
			$sentencia->bindParam(":sub_total",$sub_total);
			$sentencia->bindParam(":senia",$senia);
			$sentencia->bindParam(":saldo_total",$saldo_total);

            $sentencia->execute();
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }

	public function traerPorId($id)
	{
		$sql = "SELECT * FROM $this->tabla WHERE id_factura = \"$id\" LIMIT 1";

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

	public function traerPorIdLente($id_lente)
	{
		try{

			$sql = "SELECT * FROM $this->tabla WHERE id_lente = \"$id_lente\" LIMIT 1";

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
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}

	public function eliminarPorIdLente($id_lente)
	{
		try{

			$sql = "DELETE FROM $this->tabla WHERE id_lente = \"$id_lente\"";

			$conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$sentencia->execute();
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}
	
	public function eliminarPorId($id)
	{
		try{

			$sql = "DELETE FROM $this->tabla WHERE id_senia_x_cliente_lente = \"$id\"";

			$conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$sentencia->execute();
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}

	public function mapear($dataSet){
		$dataSet = is_array($dataSet) ? $dataSet : false;
		if($dataSet){
			$this->listado = array_map(function ($p) {
				$daoLente = LenteBdDao::getInstancia();
				$factura = new Factura
				(
					$p['sub_total'],
					$p['senia'],
					$p['saldo_total'],
					$daoLente->traerPorId($p['id_lente'])
				);
				$factura->setId($p['id_factura']);
				return $factura;
			}, $dataSet);
		}
	}

}