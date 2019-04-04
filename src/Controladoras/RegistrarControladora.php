<?php

namespace Controladoras;
    // Modelos

use \Modelo\Rol;
use \Modelo\Usuario;
use \Modelo\Mensaje;

	// Daos
use \Dao\RolBdDao;
use \Dao\UsuarioBdDao;

class RegistrarControladora
{

	protected $daoUsuario;
	protected $daoRol;

	public function __construct(){

		$this->daoUsuario = \Dao\UsuarioBdDao::getInstancia();
		$this->daoRol = \Dao\RolBdDao::getInstancia();

	}


	public function registrarse($id_rol, $nombre, $apellido, $calle, $telefono, $email, $pass)
	{

		try{

			$reg_completado = FALSE;

			$usuario_dao = $this->daoUsuario;
			$rol_dao = $this->daoRol;

			if(!$usuario_dao->verificarEmail($email))
			{
				$usuario = new Usuario($rol_dao->traerPorId($id_rol), $nombre, $apellido, $calle, $telefono,$email,$pass);
				$id_usuario = $usuario_dao->agregar($usuario);
				$usuario->setId($id_usuario);
				$reg_completado = TRUE;

				$this->mensaje = new Mensaje("success", "El Usuario fue registrado con exito!");
			}

			switch ($reg_completado) {
				case TRUE:
				require(URL_VISTA . 'inicio.php');
				break;

				case FALSE:
				require(URL_VISTA . "registrarusuario.php");
				break;
			}

		}catch(\PDOException $pdo_error){
			require(URL_VISTA . "registrarse.php");
		}catch(\Exception $error){
			echo $error->getMessage();die();
		}
	}

	public function registrar_marca($nombre,$nacionalidad)
	{


		try{

		$fileTmp = $_FILES['imag']['tmp_name']; //nombre del archivo temporal
		$fileSize = $_FILES['imag']['size']; //tamaño del archivo
		$fileError = $_FILES['imag']['error']; // tipo de error
		$nom = $_FILES['imag']['name']; //obtengo nombre del archivo
		$fileExt = explode('.' , $nom); // separo el nombre de la extension
		$fileActualExt = strtolower(end($fileExt)); //pongo en minuscula la extension
		$allowed = array('jpg' , 'jpeg', 'gif', 'png' , 'pdf'); //extensiones permitidas


		if(in_array($fileActualExt, $allowed)){
			if($fileError === 0){ //si no hay error (0 = no hay error de archivo)
				if($fileSize < 1000000) //si es menor a 1000000KB
				{

					//indicamos la ruta final del archivo (incluido el nuevo nombre del archivo)
					$fileDestination = '../public_html' .  URL_IMG_USUARIOS . $nom;

					//utilizamos la funcion php para mover el archivo al directorio
					move_uploaded_file($fileTmp, $fileDestination);

					/*
					move_uploaded_file: 

					Esta función intenta asegurarse de que el archivo designado por filename es un archivo subido válido (lo que significa que fue subido mediante el mecanismo de subida HTTP POST de PHP). Si el archivo es válido, será movido al nombre de archivo dado por destination. 

					--Documentacion oficial de PHP
					
					*/

				}else echo 'Es muy pesado'; 
			}else echo 'Error al subir';
		}else echo 'Formato no permitido';

		$reg_completado = FALSE;

		$marca_dao = $this->daoMarca;

		if(!$marca_dao->verificarNombre($nombre))
		{
			$marca = new Marca($nombre,$nacionalidad,$nom);
			$id_marca = $marca_dao->agregar($marca);
			$marca->setId($id_marca);
			$reg_completado = TRUE;
		}

		switch ($reg_completado) {
			case TRUE:
			require(URL_VISTA . 'inicio.php');
			break;
			
			case FALSE:
			require(URL_VISTA . "registrarmarca.php");
			break;
		}

	}catch(\PDOException $pdo_error){
		require(URL_VISTA . "registrarmarca.php");
	}catch(\Exception $error){
		echo $error->getMessage();die();
	}
}

public function registrarvehiculo($nombre,$id_marca,$numero_chasis)
{

	try{

		$reg_completado = FALSE;

		$vehiculo_dao = $this->daoVehiculo;


		if(!$vehiculo_dao->verificarNumero_chasis($numero_chasis))
		{

			$vehiculo = new Vehiculo ($id_marca,$nombre,$numero_chasis);
			$id_vehiculo = $vehiculo_dao->agregar($vehiculo);
			$vehiculo->setId($id_vehiculo);
			$reg_completado = TRUE;

		}

		switch ($reg_completado) {
			case TRUE:
			require(URL_VISTA . 'inicio.php');
			break;

			case FALSE:
			require(URL_VISTA . "registrarvehiculo.php");
			break;
		}

	}catch(\PDOException $pdo_error){
		require(URL_VISTA . "registrarvehiculo.php");
	}catch(\Exception $error){
		echo $error->getMessage();die();
	}
}

public function registrarpatente($numero_patente,$fecha_inscripcion,$id_usuario,$id_vehiculo)
{

	try{

		$reg_completado = FALSE;

		$patente_dao = $this->daoPatente;


		if(!$patente_dao->verificarNumeroPatente($numero_chasis))
		{

			$patente = new Patente ($id_vehiculo,$numero_patente,$fecha_inscripcion,$id_usuario);
			$id_vehiculo = $patente_dao->agregar($patente);
			$patente->setId($id_vehiculo);
			$reg_completado = TRUE;

		}

		switch ($reg_completado) {
			case TRUE:
			require(URL_VISTA . 'inicio.php');
			break;

			case FALSE:
			require(URL_VISTA . "registrarpatente.php");
			break;
		}

	}catch(\PDOException $pdo_error){
		require(URL_VISTA . "registrarpatente.php");
	}catch(\Exception $error){
		echo $error->getMessage();die();
	}
}

}