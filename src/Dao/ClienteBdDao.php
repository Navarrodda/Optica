<?php

namespace Dao;

use Modelo\Cliente;

class ClienteBdDao{
    
	protected $tabla = "clientes";
	private static $instancia;
    protected $listado;

    public static function getInstancia()
    {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function verificarDni($dni)
    {
        $sql = "SELECT * FROM $this->tabla WHERE dni = \"$dni\" LIMIT 1";
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        $dataSet = $sentencia->fetch(\PDO::FETCH_ASSOC);

        if(!empty($dataSet))
        {
            return TRUE;
        }

        return FALSE;
    }

    public function agregar(Cliente $cliente)
    {

        try{
            /** @noinspection SqlResolve */
            $sql = ("INSERT INTO $this->tabla (nombre,apellido,telefono) VALUES (:nombre, :apellido, :telefono)");

            $conexion = Conexion::conectar();

            $sentencia = $conexion->prepare($sql);

            $nombre           = $cliente->getNombre();
            $apellido         = $cliente->getApellido();
            $telefono        = $cliente->getTelefono();

            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":apellido", $apellido);
            $sentencia->bindParam(":telefono",$telefono);

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
        if ($id != null) {
            $sql = ("SELECT * FROM $this->tabla WHERE id_cliente = \"$id\" LIMIT 1" );

            $conexion = Conexion::conectar();

            $sentencia = $conexion->prepare($sql);

            $sentencia->execute();

            $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

            $this->mapear($dataSet);

            if(!empty($this->listado[0])){

                return $this->listado[0];
            }
        }

        return null;
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

    public function mapear($dataSet){
        $dataSet = is_array($dataSet) ? $dataSet : false;
        if($dataSet){
            $this->listado = array_map(function($p){
                $cliente = new Cliente(
                    $p['nombre'],
                    $p['apellido'],
                    $p['telefono']);
                $cliente->setId($p['id_cliente']);
                return $cliente;
            }, $dataSet);
        }
    }
}