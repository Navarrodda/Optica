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

    public function actualizar(Cliente $cliente, $id){
        try{

            $sql = ("UPDATE $this->tabla SET  nombre=:nombre,  apellido=:apellido,
                telefono=:telefono WHERE id_cliente=\"$id\"");

            $conexion = Conexion::conectar();

            $sentencia = $conexion->prepare($sql);

            $nombre           = $cliente->getNombre();
            $apellido         = $cliente->getApellido();
            $telefono        = $cliente->getTelefono();
            
            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":apellido", $apellido);
            $sentencia->bindParam(":telefono",$telefono);

            $sentencia->execute();
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }

    public function traerPorId($id)
    {   
        try{
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
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }
    
    public function traerTodo()
    {
        try{
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
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }

     public function traerTodoLimit($limit)
    {
        try{
            $sql = "SELECT * FROM $this->tabla LIMIT $limit, 10";

            $conexion = Conexion::conectar();

            $sentencia = $conexion->prepare($sql);

            $sentencia->execute();

            $dataSet = $sentencia->fetchAll(\PDO::FETCH_ASSOC);

            $this->mapear($dataSet);

            if (!empty($this->listado)) {
                return $this->listado;
            }
            return null;
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }

    public function verificarNombre($nombre){

        try{


            $sql = "SELECT * FROM $this->tabla WHERE nombre = \"$nombre\" LIMIT 1";
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute();
            $dataSet = $sentencia->fetch(\PDO::FETCH_ASSOC);

            if(!empty($dataSet))
            {
                return TRUE;
            }

            return FALSE;
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }
    public function verificarApellido($apellido){

        try{
            $sql = "SELECT * FROM $this->tabla WHERE apellido = \"$apellido\" LIMIT 1";
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute();
            $dataSet = $sentencia->fetch(\PDO::FETCH_ASSOC);

            if(!empty($dataSet))
            {
                return TRUE;
            }

            return FALSE;
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }

    public function eliminarPorId($id_cliente ){
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