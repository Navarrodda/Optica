<?php

namespace Dao;

use \Modelo\Usuario;

class UsuarioBdDao{

    protected $tabla = "usuarios";
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

    public function traerIdPorMail($mail){
        $sql = "SELECT id_usuario FROM $this->tabla WHERE email = \"$mail\" LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $id = $sentencia->fetch(\PDO::FETCH_ASSOC);

        if(!empty($id))
        {
            return $id['id_usuario'];
        }

        return null;
    }

    public function agregar(Usuario $usuario){
      try{

        /** @noinspection SqlResolve */
        $sql = ("INSERT INTO $this->tabla (id_rol, nombre, apellido, email, pass, calle, telefono ) VALUES (:id_rol, :nombre, :apellido, :email, :pass, :calle, :telefono)");

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $r = $usuario->getIdRol();
        $id_rol = $r->getId();

        $nombre = $usuario->getNombre();
        $apellido = $usuario->getApellido();
        $calle = $usuario->getCalle();
        $telefono = $usuario->getTelefono();
        $email = $usuario->getEmail();
        $pass = $usuario->getPassword();


        $sentencia->bindParam(":id_rol",$id_rol);
        $sentencia->bindParam(":nombre",$nombre);
        $sentencia->bindParam(":apellido",$apellido);
        $sentencia->bindParam(":calle",$calle);
        $sentencia->bindParam(":telefono",$telefono);
        $sentencia->bindParam(":email", $email);
        $sentencia->bindParam(":pass", $pass);

        $sentencia->execute();

        return $conexion->lastInsertId();
    }catch(\PDOException $e){
        echo $e->getMessage();die();
    }catch(\Exception $e){
        echo $e->getMessage();die();
    }
}

public function eliminarPorId($id){

    $sql = "DELETE FROM $this->tabla WHERE id= \"$id\"";

    $conexion = Conexion::conectar();

    $sentencia = $conexion->prepare($sql);

    $sentencia->execute();
}

public function eliminarPorMail($mail){
    /** @noinspection SqlResolve */
    $sql = "DELETE FROM $this->tabla WHERE email = \"$mail\"";

    $conexion = Conexion::conectar();

    $sentencia = $conexion->prepare($sql);

    $sentencia->execute();
}

public function actualizar(Usuario $usuario, $id){

    try{
        $sql = ("UPDATE $this->tabla SET id_rol=:id_rol, nombre=:nombre,  apellido=:apellido, email=:email,pass=:pass, calle=:calle, telefono=:telefono WHERE id_usuario=\"$id\"");

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $r = $usuario->getIdRol();
        $id_rol = $r->getId();

        $nombre = $usuario->getNombre();
        $apellido = $usuario->getApellido();
        $calle = $usuario->getCalle();
        $telefono = $usuario->getTelefono();
        $email = $usuario->getEmail();
        $pass = $usuario->getPassword();

        $sentencia->bindParam(":id_rol",$id_rol);
        $sentencia->bindParam(":nombre",$nombre);
        $sentencia->bindParam(":apellido",$apellido);
        $sentencia->bindParam(":email", $email);
        $sentencia->bindParam(":pass", $pass);
        $sentencia->bindParam(":calle",$calle);
        $sentencia->bindParam(":telefono",$telefono);


        $sentencia->execute();
    }catch(\PDOException $e){
        echo $e->getMessage();die();
    }catch(\Exception $e){
        echo $e->getMessage();die();
    }
}

public function traerTodo(){
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


public function verificarEmail($email){


    $sql = "SELECT * FROM $this->tabla WHERE email = \"$email\" LIMIT 1";
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

public function traerPorId($id)
{   
    try{
        if ($id != null) {
            $sql = ("SELECT * FROM $this->tabla WHERE id_usuario = \"$id\" LIMIT 1" );

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

public function traerPorMail($email){
    try{
        $sql = "SELECT * FROM $this->tabla WHERE email =  \"$email\" LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) {
            return $this->listado[0];
        }

        return null;
    }catch(\PDOException $e){
        echo $e->getMessage();die();
    }catch(\Exception $e){
        echo $e->getMessage();die();
    }
}

public function traerPorNombre($nombre){
    /** @noinspection SqlResolve */
    $sql = "SELECT * FROM $this->tabla WHERE nombre =  \"$nombre\" LIMIT 1";

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

public function mapear($dataSet){
    $dataSet = is_array($dataSet) ? $dataSet : false;
    if($dataSet){
     $this->listado = array_map(function ($p) {
        $daoRol = RolBdDao::getInstancia();
        $usuario = new Usuario
        (
            $p['nombre'],
            $p['apellido'],
            $p['email'],
            $p['calle'],
            $p['telefono'],
            $p['pass'],
            $daoRol->traerPorId($p['id_rol'])
        );
        $usuario->setId($p['id_usuario']);
        return $usuario;
    }, $dataSet);
 }
}
}
