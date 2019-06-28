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

			$sql = ("UPDATE $this->tabla SET doctor=:doctor, armazon_lejos=:armazon_lejos, armazon_cerca=:armazon_cerca, lejos_od_esferico=:lejos_od_esferico, lejos_od_cilindrico=:lejos_od_cilindrico, lejos_od_grados=:lejos_od_grados, lejos_oi_esferico=:lejos_oi_esferico, cilindrico=:cilindrico, en_grados=:en_grados, distancia=:distancia, calibre=:calibre, puente=:puente, color=:color, fecha=:fecha WHERE id_lente=\"$id\"");

			$conexion = Conexion::conectar();

			$sentencia = $conexion->prepare($sql);

			$medico = $lente->getMedico();
			$armazon_cerca = $lente->getArmazonCerca();
			$armazon_lejos = $lente->getArmazonLejos();
			$lejos_od = $lente->getLejosOd();
			$lejos_oi = $lente->getLejosOi();
			$cerca_od = $lente->getCercaOd();
			$cerca_oi = $lente->getCercaOi();
			$cilindrico = $lente->getCilindrico();
			$en_grados = $lente->getEnGrados();
			$distancia = $lente->getDistancia();
			$calibre = $lente->getCalibre();
			$puente = $lente->getPuente();
			$color = $lente->getColor();
			$fecha = $lente->getFecha();

			$sentencia->bindParam(":medico",$medico);
			$sentencia->bindParam(":armazon_cerca",$armazon_cerca);
			$sentencia->bindParam(":armazon_lejos",$armazon_lejos);
			$sentencia->bindParam(":lejos_od",$lejos_od);
			$sentencia->bindParam(":lejos_oi",$lejos_oi);
			$sentencia->bindParam(":cerca_od",$cerca_od);
			$sentencia->bindParam(":cerca_oi",$cerca_oi);
			$sentencia->bindParam(":cilindrico",$cilindrico);
			$sentencia->bindParam(":en_grados",$en_grados);
			$sentencia->bindParam(":distancia",$distancia);
			$sentencia->bindParam(":calibre",$calibre);
			$sentencia->bindParam(":puente",$puente);
			$sentencia->bindParam(":color",$color);
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
					$l['medico'],
					$l['armazon_cerca'],
					$l['armazon_lejos'],
					$l['lejos_od'],
					$l['lejos_oi'],
					$l['cerca_od'],
					$l['cerca_oi'],
					$l['cilindrico'],
					$l['en_grados'],
					$l['distancia'],
					$l['calibre'],
					$l['puente'],
					$l['color'],
					$l['fecha']);
				$lente->setId($l['id_lente']);
				return $lente; 

			}, $dataSet);
		}
	}
}