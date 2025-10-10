<?php

class Heroe {
    private $id;
    private $id_partida;
    private $nombre;              
    private $capacidad_maxima;    
    private $capacidad_actual;    
    private $estado;      

    public function __construct($id, $id_partida, $nombre, $capacidad_maxima, $capacidad_actual, $estado) {
        $this->id = $id;
        $this->id_partida = $id_partida;
        $this->nombre = $nombre;
        $this->capacidad_maxima = $capacidad_maxima;
        $this->capacidad_actual = $capacidad_actual;
        $this->estado = $estado;
    }

     public function toArray() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'capacidad_maxima' => $this->capacidad_maxima,
            'capacidad_actual' => $this->capacidad_actual,
            'estado' => $this->estado
        ];
     }
    public function getId() { return $this->id; }
    public function getIdPartida() { return $this->id_partida; }
    public function getNombre() { return $this->nombre; }
    public function getCapacidadMaxima() { return $this->capacidad_maxima; }
    public function getCapacidadActual() { return $this->capacidad_actual; }
    public function getEstado() { return $this->estado; }

 
    public function setCapacidadActual($capacidad_actual) { $this->capacidad_actual = $capacidad_actual; }
    public function setEstado($estado) { $this->estado = $estado; }
}
