<?php

class Partida {
    private $id;
    private $id_usuario;
    private $tipo;
    private $casillas_totales;
    private $casillas_destapadas;
    private $casillas_perdidas_seguidas;
    private $estado;
    private $fecha_inicio;
    private $fecha_fin;

    public function __construct($id = null, $id_usuario = null, $tipo = 'estandar', $casillas_totales = 20, $casillas_destapadas = 0, $casillas_perdidas_seguidas = 0, $estado = 'en_curso', $fecha_inicio = null, $fecha_fin = null) {
        $this->id = $id;
        $this->id_usuario = $id_usuario;
        $this->tipo = $tipo;
        $this->casillas_totales = $casillas_totales;
        $this->casillas_destapadas = $casillas_destapadas;
        $this->casillas_perdidas_seguidas = $casillas_perdidas_seguidas;
        $this->estado = $estado;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    public static function crearEstandar($id_usuario) {
        return new self(
            null, $id_usuario, 'estandar', 20, 0, 0, 'en_curso',
            date("Y-m-d H:i:s"), null
        );
    }

    public static function crearPersonalizada($id_usuario, $numCasillas) {
        if ($numCasillas < 10 || $numCasillas > 100) {
            throw new Exception("casillas fuera de rango");
        }
        return new self(
            null, $id_usuario, 'personalizada', $numCasillas, 0, 0, 'en_curso',
            date("Y-m-d H:i:s"), null
        );
    }

    public function registrarExito() {
        $this->casillas_destapadas++;
        $this->casillas_perdidas_seguidas = 0;
    }

    public function registrarFracaso() {
        $this->casillas_destapadas++;
        $this->casillas_perdidas_seguidas++;
    }

    public function resolverPrueba(Casilla $casilla, array $heroes): bool {
        $tipo = $casilla->getTipoPrueba();
        $esfuerzo = $casilla->getEsfuerzoNecesario();

        $mapeoHeroeTipo = [
            'Gandalf' => 'magia',
            'Thorin'  => 'fuerza',
            'Bilbo'   => 'habilidad'
        ];

        $heroe = null;
        foreach ($heroes as $h) {
            $nombre = $h->getNombre();
            if (isset($mapeoHeroeTipo[$nombre]) && $mapeoHeroeTipo[$nombre] === $tipo) {
                $heroe = $h;
                break;
            }
        }

        if (!$heroe || $heroe->getEstado() !== 'activo' || $heroe->getCapacidadActual() <= 0) {
            return false;
        }

        $capacidad = $heroe->getCapacidadActual();
        $probabilidadExito = 50;
        if ($capacidad > $esfuerzo) {
            $probabilidadExito = 90;
        } elseif ($capacidad == $esfuerzo) {
            $probabilidadExito = 70;
        }

        $exito = (random_int(1, 100) <= $probabilidadExito);

        if ($exito) {
            $heroe->setCapacidadActual(max(0, $capacidad - $esfuerzo));
        } else {
            $heroe->setCapacidadActual(0);
            $heroe->setEstado('inactivo');
        }

        return $exito;
    }

    public function verificarEstadoFinal(array $heroes): string {
        if ($this->estado !== 'en_curso') {
            return $this->estado;
        }

        if ($this->casillas_perdidas_seguidas >= 5) {
            return 'perdida';
        }

        $alMenosUnActivo = false;
        foreach ($heroes as $h) {
            if ($h->getEstado() === 'activo' && $h->getCapacidadActual() > 0) {
                $alMenosUnActivo = true;
                break;
            }
        }

        if (!$alMenosUnActivo) {
            return 'perdida';
        }

        if ($this->casillas_destapadas >= ceil($this->casillas_totales / 2)) {
            return 'ganada';
        }

        return 'en_curso';
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'tipo' => $this->tipo,
            'casillas_totales' => $this->casillas_totales,
            'casillas_destapadas' => $this->casillas_destapadas,
            'casillas_perdidas_seguidas' => $this->casillas_perdidas_seguidas,
            'estado' => $this->estado,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin
        ];
    }

    public function getId() { return $this->id; }
    public function getIdUsuario() { return $this->id_usuario; }
    public function getTipo() { return $this->tipo; }
    public function getCasillasTotales() { return $this->casillas_totales; }
    public function getCasillasDestapadas() { return $this->casillas_destapadas; }
    public function getCasillasPerdidasSeguidas() { return $this->casillas_perdidas_seguidas; }
    public function getEstado() { return $this->estado; }
    public function getFechaInicio() { return $this->fecha_inicio; }
    public function getFechaFin() { return $this->fecha_fin; }

    
    public function setId($id) { $this->id = $id; }
    public function setTipo($tipo) { $this->tipo = $tipo; }
    public function setCasillasTotales($casillas) { $this->casillas_totales = $casillas; }
    public function setCasillasDestapadas($num) { $this->casillas_destapadas = $num; }
    public function setCasillasPerdidasSeguidas($num) { $this->casillas_perdidas_seguidas = $num; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setFechaInicio($fecha) { $this->fecha_inicio = $fecha; }
    public function setFechaFin($fecha) { $this->fecha_fin = $fecha; }
}