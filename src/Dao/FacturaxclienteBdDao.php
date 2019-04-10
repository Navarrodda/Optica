<?php

namespace Dao;

use \Modelo\Factura_x_cliente;

class FacturaxclienteBdDao{

	protected $tabla = "facturas_x_clientes";
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


	public function agregar(Factura_x_cliente $facturaxcliente){

		try{

			$sql = ("INSERT INTO $this->tabla (id_cliente, id_factura) VALUES (:id_cliente, :id_factura) ");

			$conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$c = $facturaxcliente->getIdCliente();
			$id_cliente = $c->getId();

			$f = $facturaxcliente->getIdFactura();
			$id_factura = $f->getId();

			$sentencia->bindParam(":id_cliente",$id_cliente);
			$sentencia->bindParam(":id_factura",$id_factura);

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
				$daoCliente = ClienteBdDao::getInstancia();
				$daoFactura = FacturaBdDao::getInstancia();
				$fxc = new Factura_x_cliente
				(
					$daoCliente->traerPorId($p['id_cliente']),
					$daoFactura->traerPorId($p['id_factura'])
				);
				$fxc->setId($p['id_factura_x_cliente']);
				return $fxc;
			}, $dataSet);
		}
	}
}