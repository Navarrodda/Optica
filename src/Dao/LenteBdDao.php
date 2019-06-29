<?php

namespace Dao;

use Modelo\Lente;

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

	public function agregar(Lente $lente){ 

		try{
			$sql = ("INSERT INTO $this->tabla (doctor, armazon_lejos, armazon_cerca,  lejos_od_esferico, lejos_od_cilindrico, lejos_od_grados, lejos_oi_esferico, lejos_oi_cilindrico, lejos_oi_grados, lejos_color, cerca_od_esferico, cerca_od_cilindrico, cerca_od_grados, cerca_oi_esferico, cerca_oi_cilindrico, cerca_oi_grados, cerca_color, fecha) VALUES (:doctor, :armazon_lejos, :armazon_cerca, :lejos_od_esferico, :lejos_od_cilindrico, :lejos_od_grados, :lejos_oi_esferico, :lejos_oi_cilindrico, :lejos_oi_grados, :lejos_color, :cerca_od_esferico, :cerca_od_cilindrico, :cerca_od_grados, :cerca_oi_esferico,:cerca_oi_cilindrico, :cerca_oi_grados, :cerca_color, :fecha) ");

			$conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$doctor              = $lente->getDoctor();
			$armazon_lejos       = $lente->getArmazonLejos();
			$armazon_cerca       = $lente->getArmazonCerca();
			$lejos_od_esferico   = $lente->getLejosOdEsferico();
			$lejos_od_cilindrico = $lente->getLejosOdCilindrico();
			$lejos_od_grados     = $lente->getLejosOdGrados();
			$lejos_oi_esferico   = $lente->getLejosOiEsferico();
			$lejos_oi_cilindrico = $lente->getLejosOiCilindrico();
			$lejos_oi_grados     = $lente->getLejosOiGrados();
			$lejos_color         = $lente->getLejosColor();
			$cerca_od_esferico   = $lente->getCercaOdEsferico();
			$cerca_od_cilindrico = $lente->getCercaOdCilindrico();
			$cerca_od_grados     = $lente->getCercaOdGrados();
			$cerca_oi_esferico   = $lente->getCercaOiEsferico();
			$cerca_oi_cilindrico = $lente->getCercaOiCilindrico();
			$cerca_oi_grados     = $lente->getCercaOiGrados();
			$cerca_color         = $lente->getCercaColor();
			$fecha               = $lente->getFecha();

			$sentencia->bindParam(":doctor",$doctor);
			$sentencia->bindParam(":armazon_lejos",$armazon_lejos);
			$sentencia->bindParam(":armazon_cerca",$armazon_cerca);
			$sentencia->bindParam(":lejos_od_esferico",$lejos_od_esferico);
			$sentencia->bindParam(":lejos_od_cilindrico",$lejos_od_cilindrico);
			$sentencia->bindParam(":lejos_od_grados",$lejos_od_grados);
			$sentencia->bindParam(":lejos_oi_esferico",$lejos_oi_esferico);
			$sentencia->bindParam(":lejos_oi_cilindrico",$lejos_oi_cilindrico);
			$sentencia->bindParam(":lejos_oi_grados",$lejos_oi_grados);
			$sentencia->bindParam(":lejos_color",$lejos_color);
			$sentencia->bindParam(":cerca_od_esferico",$cerca_od_esferico);
			$sentencia->bindParam(":cerca_od_cilindrico",$cerca_od_cilindrico);
			$sentencia->bindParam(":cerca_od_grados",$cerca_od_grados);
			$sentencia->bindParam(":cerca_oi_esferico",$cerca_oi_esferico);
			$sentencia->bindParam(":cerca_oi_cilindrico",$cerca_oi_cilindrico);
			$sentencia->bindParam(":cerca_oi_grados",$cerca_oi_grados);
			$sentencia->bindParam(":cerca_color",$cerca_color);
			$sentencia->bindParam(":fecha",$fecha);

			$sentencia->execute();

			return $conexion->lastInsertId();
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}

	public function actualizar(Lente $lente, $id){
		try{

			$sql = ("UPDATE $this->tabla SET doctor=:doctor, armazon_lejos=:armazon_lejos, armazon_cerca=:armazon_cerca, lejos_od_esferico=:lejos_od_esferico, lejos_od_cilindrico=:lejos_od_cilindrico, lejos_od_grados=:lejos_od_grados, lejos_oi_esferico=:lejos_oi_esferico, lejos_oi_cilindrico=:lejos_oi_cilindrico, lejos_oi_grados=:lejos_oi_grados, lejos_color=:lejos_color, cerca_od_esferico=:cerca_od_esferico, cerca_od_cilindrico=:cerca_od_cilindrico, cerca_od_grados=:cerca_od_grados, cerca_oi_esferico=:cerca_oi_esferico, cerca_oi_cilindrico=:cerca_oi_cilindrico, cerca_oi_grados=:cerca_oi_grados, cerca_color=:cerca_color, fecha=:fecha WHERE id_lente=\"$id\"");

			$conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$doctor              = $lente->getDoctor();
			$armazon_lejos       = $lente->getArmazonLejos();
			$armazon_cerca       = $lente->getArmazonCerca();
			$lejos_od_esferico   = $lente->getLejosOdEsferico();
			$lejos_od_cilindrico = $lente->getLejosOdCilindrico();
			$lejos_od_grados     = $lente->getLejosOdGrados();
			$lejos_oi_esferico   = $lente->getLejosOiEsferico();
			$lejos_oi_cilindrico = $lente->getLejosOiCilindrico();
			$lejos_oi_grados     = $lente->getLejosOiGrados();
			$lejos_color         = $lente->getLejosColor();
			$cerca_od_esferico   = $lente->getCercaOdEsferico();
			$cerca_od_cilindrico = $lente->getCercaOdCilindrico();
			$cerca_od_grados     = $lente->getCercaOdGrados();
			$cerca_oi_esferico   = $lente->getCercaOiEsferico();
			$cerca_oi_cilindrico = $lente->getCercaOiCilindrico();
			$cerca_oi_grados     = $lente->getCercaOiGrados();
			$cerca_color         = $lente->getCercaColor();
			$fecha               = $lente->getFecha();

			$sentencia->bindParam(":doctor",$doctor);
			$sentencia->bindParam(":armazon_lejos",$armazon_lejos);
			$sentencia->bindParam(":armazon_cerca",$armazon_cerca);
			$sentencia->bindParam(":lejos_od_esferico",$lejos_od_esferico);
			$sentencia->bindParam(":lejos_od_cilindrico",$lejos_od_cilindrico);
			$sentencia->bindParam(":lejos_od_grados",$lejos_od_grados);
			$sentencia->bindParam(":lejos_oi_esferico",$lejos_oi_esferico);
			$sentencia->bindParam(":lejos_oi_cilindrico",$lejos_oi_cilindrico);
			$sentencia->bindParam(":lejos_oi_grados",$lejos_oi_grados);
			$sentencia->bindParam(":lejos_color",$lejos_color);
			$sentencia->bindParam(":cerca_od_esferico",$cerca_od_esferico);
			$sentencia->bindParam(":cerca_od_cilindrico",$cerca_od_cilindrico);
			$sentencia->bindParam(":cerca_od_grados",$cerca_od_grados);
			$sentencia->bindParam(":cerca_oi_esferico",$cerca_oi_esferico);
			$sentencia->bindParam(":cerca_oi_cilindrico",$cerca_oi_cilindrico);
			$sentencia->bindParam(":cerca_oi_grados",$cerca_oi_grados);
			$sentencia->bindParam(":cerca_color",$cerca_color);
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
		try{

			$sql = "SELECT * FROM $this->tabla WHERE id_lente = \"$id\" LIMIT 1";

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
	public function eliminarPorId($id_lente ){
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

	private function mapear($dataSet)
	{
		$dataSet = is_array($dataSet) ? $dataSet : null;

		if(!empty($dataSet[0]))
		{
			$this->listado = array_map( function ($l){
				$lente = new Lente(
					$l['doctor'],
					$l['armazon_lejos'],
					$l['armazon_cerca'],
					$l['lejos_od_esferico'],
					$l['lejos_od_cilindrico'],
					$l['lejos_od_grados'],
					$l['lejos_oi_esferico'],
					$l['lejos_oi_cilindrico'],
					$l['lejos_oi_grados'],
					$l['lejos_color'],
					$l['cerca_od_esferico'],
					$l['cerca_od_cilindrico'],
					$l['cerca_od_grados'],
					$l['cerca_oi_esferico'],
					$l['cerca_oi_cilindrico'],
					$l['cerca_oi_grados'],
					$l['cerca_color'],
					$l['fecha']);
				$lente->setId($l['id_lente']);
				return $lente; 

			}, $dataSet);
		}
	}
}