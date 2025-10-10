<?php

class Casilla {

    private $id;
    private $id_partida;
    private $posicion;
    private $tipo_prueba;         
    private $esfuerzo_necesario;
    private $destapada;           
    private $resultado_prueba;    


    public function __construct($id, $id_partida, $posicion, $tipo_prueba, $esfuerzo_necesario, $destapada, $resultado_prueba) {
        $this->id = $id;
        $this->id_partida = $id_partida;
        $this->posicion = $posicion;
        $this->tipo_prueba = $tipo_prueba;
        $this->esfuerzo_necesario = $esfuerzo_necesario;
        $this->destapada = $destapada;
        $this->resultado_prueba = $resultado_prueba;
    }

    public function getId() { return $this->id; }
    public function getIdPartida() { return $this->id_partida; }
    public function getPosicion() { return $this->posicion; }
    public function getTipoPrueba() { return $this->tipo_prueba; }
    public function getEsfuerzoNecesario() { return $this->esfuerzo_necesario; }
    public function getDestapada() { return $this->destapada; }
    public function getResultadoPrueba() { return $this->resultado_prueba; }
    

    public function setPosicion($posicion) { $this->posicion = $posicion; }
    public function setTipoPrueba($tipo_prueba) { $this->tipo_prueba = $tipo_prueba; }
    public function setEsfuerzoNecesario($esfuerzo_necesario) { $this->esfuerzo_necesario = $esfuerzo_necesario; }
    public function setDestapada($destapada) { $this->destapada = $destapada; }
    public function setResultadoPrueba($resultado_prueba) { $this->resultado_prueba = $resultado_prueba; }
}
