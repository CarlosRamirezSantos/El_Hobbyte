<?php

class Usuario {
    
    private $id;
    private $nombre_usuario;
    private $email;
    private $clave;
    private $rol;
    private $fecha_creacion;

    public function __construct( $id = null, $nombre_usuario, $email, $clave, $rol = 'jugador', $fecha_creacion = null) {
        $this->id = $id;
        $this->nombre_usuario = $nombre_usuario;
        $this->email = $email;
        $this->clave = $clave;
        $this->rol = $rol;
        $this->fecha_creacion = $fecha_creacion;
    }

    // GETTERS
    public function getId() {
        return $this->id;
    }

    public function getNombreUsuario() {
        return $this->nombre_usuario;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    // SETTERS
    public function setId($id) {
        $this->id = $id;
    }

    public function setNombreUsuario($nombre_usuario) {
        $this->nombre_usuario = $nombre_usuario;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function setRol($rol) {

            $this->rol = $rol;
        
    }

    public function setFechaCreacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }
}