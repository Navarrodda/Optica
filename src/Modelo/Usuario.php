<?php

namespace Modelo;

class Usuario
{
	private $id;
	private $nombre;
	private $apellido;
	private $email;
	private $calle;
	private $telefono;
	private $password;


	/**
	 * Class Constructor
	 * @param    $id   
	 * @param    $nombre   
	 * @param    $apellido   
	 * @param    $email   
	 * @param    $calle   
	 * @param    $telefono   
	 * @param    $password   
	 */
	public function __construct($nombre, $apellido, $email, $calle, $telefono, $password)
	{
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->email = $email;
		$this->calle = $calle;
		$this->telefono = $telefono;
		$this->password = $password;
	}




    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     *
     * @return self
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * @param mixed $calle
     *
     * @return self
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     *
     * @return self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param mixed $telefono
     *
     * @return self
     */
}
