<?php

namespace Dao;

use Modelo\Senias_x_lentes;

class Seniaxcliente
{
    protected $tabla = "senias_x_lentes";
    protected $listado;
    private static $instancia;

    public static function getInstancia()
    {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    private function __construct()
    {
    }


    public function agregar(Senias_x_lentes $seniasxlentes)
    {
        try{
            /** @noinspection SqlResolve */
            $sql = ("INSERT INTO $this->tabla (id_lente , id_senia) VALUES (:id_lente, :id_senia)");

            $conexion = Conexion::conectar();

            $sentencia = $conexion->prepare($sql);

            $l = $seniasxlentes->getIdLente();
            $id_lente = $l->getId();

            $s = $seniasxlentes->getIdSenia();
            $id_senia = $s->getIdSenia();

            $sentencia->bindParam(":id_lente",$id_lente);
            $sentencia->bindParam(":id_senia", $id_senia);

            $sentencia->execute();

            return $conexion->lastInsertId();
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }

    public function eliminarPorId($id)
    {
        
        $sql = "DELETE FROM $this->tabla WHERE id_cuenta = \"$id\"";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }


    public function actualizar(Cuenta $usuario)
    {
        /** @noinspection SqlResolve */

        $id = $usuario->getId();

        $sql = ("UPDATE $this->tabla SET id_lente=:id_lente,id_senia=:id_senia WHERE senias_x_lentes=\"$id\"");

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $l = $seniasxlentes->getIdLente();
        $id_lente = $l->getId();

        $s = $seniasxlentes->getIdSenia();
        $id_senia = $s->getIdSenia();

        $sentencia->bindParam(":id_lente",$id_lente);
        $sentencia->bindParam(":id_senia", $id_senia);

        $sentencia->execute();
    }

    public function traerTodo()
    {
        $sql = "SELECT * FROM $this->tabla";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet = $sentencia->fetchAll(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado)) {
            return $this->listado;
        }
        return null;
    }

    public function traerPorId($id)
    {

        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla WHERE id_cuenta =  \"$id\" LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) {
            return $this->listado[0];
        }
        return null;
    }

    public function mapear($dataSet)
    {
        $dataSet = is_array($dataSet) ? $dataSet : false;
        if($dataSet){
            $this->listado = array_map(function ($p) {
                $sxl = new Senias_x_lentes(
                    $p['id_lente '],
                    $p['id_senia '],
                );
                $sxl->setId($p['id_senia_x_lente ']);
                return $sxl;
            }, $dataSet);
        }
    }
}
