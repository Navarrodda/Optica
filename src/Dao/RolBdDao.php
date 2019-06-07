<?php

namespace Dao;

use \Modelo\Rol;

class RolBdDao
{
    protected $tabla = "roles";
    private static $instancia;
    protected $listado;

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

    public function agregar(Rol $rol)
    {
        /** @noinspection SqlResolve */
        $sql = "INSERT INTO $this->tabla (nombre) VALUES (:nombre)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $nombre = $rol->getDescripcion();

        $sentencia->bindParam(":nombre", $nombre);

        $sentencia->execute();

        return $conexion->lastInsertId();
    }

    public function eliminar($id)
    {
        /** @noinspection SqlResolve */
        $sql = "DELETE FROM $this->tabla WHERE nombre = \"$id\" LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function actualizar(Rol $rol)
    {
        $sql = "UPDATE $this->tabla 
        SET nombre = :nombre 
        WHERE id_rol = :idRol";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $idRoles = $rol->getId();

        $sentencia->bindParam(":idRol", $idRoles);

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

       if(!empty($this->listado)){
        return $this->listado;
    }

    return null;
}

public function traerPorId($id_rol)
{
    /** @noinspection SqlResolve */
    $sql = "SELECT * FROM $this->tabla WHERE id_rol = \"$id_rol\" LIMIT 1";

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
public function traerPorIdPreoridad($preoridad)
{
    /** @noinspection SqlResolve */
    $sql = "SELECT * FROM $this->tabla WHERE nombre = \"$preoridad\" LIMIT 1";

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
            $r = new Rol($p['nombre']);
            $r->setId($p['id_rol']);
            return $r;
        }, $dataSet);
    }
}
}