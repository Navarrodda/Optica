<?php

namespace Dao;

use Modelo\Senias_x_cliente;

class Seniasxcliente
{
    protected $tabla = "senias_x_clientes";
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


    public function agregar(Senias_x_cliente $seniasxlentes)
    {
        try{
            /** @noinspection SqlResolve */
            $sql = ("INSERT INTO $this->tabla (id_cuenta_saldo  , id_cliente ) VALUES (:id_cuenta_saldo, :id_cliente)");

            $conexion = Conexion::conectar();

            $sentencia = $conexion->prepare($sql);

            $l = $seniasxlentes->getIdCuentaSaldo();
            $id_cuenta_saldo = $l->getId();

            $c = $seniasxlentes->getIdCliente();
            $id_cliente = $c->getId();;

            $sentencia->bindParam(":id_cuenta_saldo",$id_cuenta_saldo);
            $sentencia->bindParam(":id_cliente", $id_cliente);

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
        
        $sql = "DELETE FROM $this->tabla WHERE id_senia_x_cliente = \"$id\"";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

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
        $sql = "SELECT * FROM $this->tabla WHERE id_senia_x_cliente =  \"$id\" LIMIT 1";

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
                $daoCuenta_saldo  = CuentasaldosBdDao::getInstancia();
                $daoCliente = ClienteBdDao::getInstancia();
                $sxl = new Senias_x_lentes(
                    $daoLente->traerPorId($p['id_cuenta_saldo']),
                    $daoSenia->traerPorId($p['id_cliente'])
                );
                $sxl->getIdSeniaXLente()($p['id_senia_x_cliente']);
                return $sxl;
            }, $dataSet);
        }
    }
}