<?php

namespace Dao;

use Modelo\Lente

class LenteBdDao{

	protected $tabla = "lentes";
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

	public function agregar(Lente $lente){

		try{

			$sql = ("INSERT INTO $this->tabla (medico, lejos_od, lejos_oi, cerca_od, cerca_oi, cilindrico,  en_grados, distancia, calibre, puente, descripcion, fecha) VALUES (:medico, :lejos_od, :lejos_oi, :cerca_od, :cerca_oi:, :cilindrico, :en_grados, :distancia, :calibre, :puente, :descripcion, :fecha) ");

			$conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$medico = $lente->getMedico();
			$lejos_od = $lente->getLejosOd();
			$lejos_oi = $lente->getLejosOi();
			$cerca_od = $lente->getCercaOd();
			$cerca_oi = $lente->getCercaOi();
			$cilindrico = $lente->getCilindrico();
			$en_grados = $lente->getEnGrados();
			$distancia = $lente->getDistacia();
			$calibre = $lente->getCalibre();
			$puente = $lente->getPuente();
			$descripcion = $lente->getDescripcion();
			$fecha = $lente->getFecha();

			$sentencia->bindParam(":medico",$medico);
			$sentencia->bindParam(":lejos_od",$lejos_od);
			$sentencia->bindParam(":lejos_oi",$lejos_oi);
			$sentencia->bindParam(":cerca_od",$cerca_od);
			$sentencia->bindParam(":cerca_oi",$cerca_oi);
			$sentencia->bindParam(":cilindrico",$cilindrico);
			$sentencia->bindParam(":en_grados",$en_grados);
			$sentencia->bindParam(":distancia",$distancia);
			$sentencia->bindParam(":calibre",$calibre);
			$sentencia->bindParam(":puente",$puente);
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

	private function mapear($dataSet)
	{
		$dataSet = is_array($dataSet) ? $dataSet : null;

		if(!empty($dataSet[0]))
		{
			$this->listado = array_map( function ($l){

				$lente = new Lente(
					$l['medico'],
					$l['lejos_od'],
					$l['lejos_oi'],
					$l['cerca_od'],
					$l['cerca_oi'],
					$l['cilindrico'],
					$l['en_grados'],
					$l['distancia'],
					$l['calibre'],
					$l['puente'],
					$l['descripcion'],
					$l['fecha']);
				$lente->setId($l['id_lente']);
				return $lente; 

			}, $dataSet);
		}
	}
}