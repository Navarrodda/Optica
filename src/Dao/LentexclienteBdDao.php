<?php

namespace Dao;

use Modelo\Lente_x_cliente;

class LentexclienteBdDao{

	protected $tabla = "lentes_x_clientes";
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
		try{

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
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}

	public function agregar(Lente_x_cliente $lentecliente){

		try{

			$sql = ("INSERT INTO $this->tabla ( id_cliente, id_lente) VALUES ( :id_cliente, :id_lente) ");

			$conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$c = $lentecliente->getIdCliente();
			$id_cliente = $c->getId();

			$l = $lentecliente->getIdLente();
			$id_lente = $l->getId();

			$sentencia->bindParam(":id_cliente",$id_cliente);
			$sentencia->bindParam(":id_lente",$id_lente);

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
		try{

		$sql = "SELECT * FROM $this->tabla WHERE id_lente_x_cliente = \"$id\" LIMIT 1";

		$conexion = Conexion::conectar();

		$sentencia = $conexion->prepare($sql);

		$sentencia->execute();

		$dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

		$this->mapear($dataSet);

		if(!empty($this->listado[0])){
			return $this->listado[0];
		}
		return null;
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}

		public function traerPorIdCliente($id)
	{
		try{

			$sql = "SELECT * FROM $this->tabla WHERE id_cliente = \"$id\" ";

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

		public function eliminarPorIdLente($id_lente ){
        try{

            $sql = "DELETE FROM $this->tabla WHERE id_lente = \"$id_lente \"";

            $conexion = Conexion::conectar();

            $sentencia = $conexion->prepare($sql);

            $sentencia->execute();
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }

    public function eliminarPorIdCliente($id_cliente ){
        try{

            $sql = "DELETE FROM $this->tabla WHERE id_cliente = \"$id_cliente \"";

            $conexion = Conexion::conectar();

            $sentencia = $conexion->prepare($sql);

            $sentencia->execute();
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }


	private function mapear($dataSet)
	{
		$dataSet = is_array($dataSet) ? $dataSet : null;

		if(!empty($dataSet[0]))
		{
			$this->listado = array_map( function ($lc){
				$daoCliente = ClienteBdDao::getInstancia();
				$daoLente = LenteBdDao::getInstancia();
				$lentecliente = new Lente_x_cliente(
					$daoCliente->traerPorId($lc['id_cliente']),
					$daoLente->traerPorId($lc['id_lente'])
				);
				$lentecliente->setIdLenteXCliente($lc['id_lente_x_cliente']);
				return $lentecliente; 
			}, $dataSet);
		}
	}

}