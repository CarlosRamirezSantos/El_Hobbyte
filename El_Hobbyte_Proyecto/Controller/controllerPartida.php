<?php
require_once __DIR__ . '/../Model/partida.php';
require_once __DIR__ . '/../Model/casilla.php';
require_once __DIR__ . '/../Model/heroe.php';
require_once __DIR__ . '/../Database/partidaDAO.php';
require_once __DIR__ . '/../Database/casillaDAO.php';
require_once __DIR__ . '/../Database/heroeDAO.php';

class PartidaController {
    private $usuario;

    public function __construct($usuario) {
        $this->usuario = $usuario;
    }

    public function crearPartida() {
        $input = json_decode(file_get_contents("php://input"), true) ?: [];
        $tipo = $input['tipo'] ?? 'estandar';
        $numCasillas = (int)($input['casillas_totales'] ?? 20);

        try {
            $partidasAbiertas = PartidaDAO::getPartidasAbiertasByUsuario($this->usuario->getId());
            if (count($partidasAbiertas) >= 2) {
                http_response_code(400);
                echo json_encode(['error' => 'Máximo de 2 partidas abiertas alcanzado']);
                return;
            }

            if ($tipo === 'personalizada') {
                if ($numCasillas < 10 || $numCasillas > 100) {
                    http_response_code(400);
                    echo json_encode(['error' => 'Casillas totales deben estar entre 10 y 100']);
                    return;
                }
                $partida = Partida::crearPersonalizada($this->usuario->getId(), $numCasillas);
            } else {
                $partida = Partida::crearEstandar($this->usuario->getId());
            }

            if (!PartidaDAO::crearPartida($partida)) {
                throw new Exception("Falló la creación de la partida en la base de datos");
            }

            $idPartida = $partida->getId();

            // Crear casillas
            $tiposPrueba = ['magia', 'fuerza', 'habilidad'];
            for ($pos = 1; $pos <= $partida->getCasillasTotales(); $pos++) {
                $tipoPrueba = $tiposPrueba[array_rand($tiposPrueba)];
                $esfuerzo = (rand(1, 10)) * 5;
                $casilla = new Casilla(null, $idPartida, $pos, $tipoPrueba, $esfuerzo, 0, null);
                CasillaDAO::crear($casilla);
            }

            
            HeroeDAO::borrarHeroesPartida($idPartida);
            foreach (['Gandalf', 'Thorin', 'Bilbo'] as $nombre) {
                $heroe = new Heroe(null, $idPartida, $nombre, 50, 50, 'activo');
                HeroeDAO::crear($heroe);
            }

            http_response_code(201);
            echo json_encode(['mensaje' => 'Partida creada con éxito']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function getPartidasUsuario() {
        $partidas = PartidaDAO::getPartidasByUsuario($this->usuario->getId());
        $resultado = array_map(fn($p) => $p->toArray(), $partidas);
        echo json_encode($resultado);
    }

    public function getEstadoPartida($id) {
        $partida = PartidaDAO::getPartidaById($id);
        if (!$partida || $partida->getIdUsuario() !== $this->usuario->getId()) {
            http_response_code(404);
            echo json_encode(['error' => 'Partida no encontrada']);
            return;
        }

        $casillas = CasillaDAO::getCasillasPartida($partida->getId());
        $heroes = HeroeDAO::getHeroesPartida($partida->getId());

        $response = $partida->toArray();
        $response['casillas'] = array_map(fn($c) => $c->toArray(), $casillas);
        $response['heroes'] = array_map(fn($h) => $h->toArray(), $heroes);

        echo json_encode($response);
    }

    public function destaparCasilla($idPartida, $posicionCasilla) {
        try {
            $partida = PartidaDAO::getPartidaById($idPartida);
            if (!$partida || $partida->getIdUsuario() !== $this->usuario->getId()) {
                http_response_code(404);
                echo json_encode(['error' => 'Partida no encontrada o sin permisos']);
                return;
            }
            if ($partida->getEstado() !== 'en_curso') {
                http_response_code(400);
                echo json_encode(['error' => 'La partida ya ha finalizado']);
                return;
            }

            $casillas = CasillaDAO::getCasillasPartida($idPartida);
            $casilla = null;
            foreach ($casillas as $c) {
                if ($c->getPosicion() == $posicionCasilla) {
                    $casilla = $c;
                    break;
                }
            }
            if (!$casilla) {
                http_response_code(404);
                echo json_encode(['error' => 'Casilla no encontrada']);
                return;
            }
            if ($casilla->getDestapada()) {
                http_response_code(400);
                echo json_encode(['error' => 'Casilla ya fue destapada']);
                return;
            }

            $heroes = HeroeDAO::getHeroesPartida($idPartida);

        
            $exito = $partida->resolverPrueba($casilla, $heroes);

            
            $casilla->setDestapada(1);
            $casilla->setResultadoPrueba($exito ? 'exito' : 'fracaso');
            CasillaDAO::actualizar($casilla);

            
            if ($exito) {
                $partida->registrarExito();
            } else {
                $partida->registrarFracaso();
            }

        
            $nuevoEstado = $partida->verificarEstadoFinal($heroes);
            $partida->setEstado($nuevoEstado);

            
            PartidaDAO::actualizarPartida($partida);
            foreach ($heroes as $heroe) {
                HeroeDAO::actualizar($heroe);
            }

            
            http_response_code(200);
            echo json_encode([
                'resultado' => $exito ? 'exito' : 'fracaso',
                'partida' => $partida->toArray(),
                'casilla' => $casilla->toArray(),
                'heroes' => array_map(fn($h) => $h->toArray(), $heroes)
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function rendirse($idPartida) {
        try {
            $partida = PartidaDAO::getPartidaById($idPartida);
            if (!$partida || $partida->getIdUsuario() !== $this->usuario->getId()) {
                http_response_code(404);
                echo json_encode(['error' => 'Partida no encontrada o sin permisos']);
                return;
            }
            if ($partida->getEstado() !== 'en_curso') {
                http_response_code(400);
                echo json_encode(['error' => 'La partida ya ha finalizado']);
                return;
            }

            $partida->setEstado('rendida');
            PartidaDAO::actualizarPartida($partida);

            http_response_code(200);
            echo json_encode(['mensaje' => 'Te has rendido correctamente', 'partida' => $partida->toArray()]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function actualizarPartida($idPartida, $datos) {
        try {
            $partida = PartidaDAO::getPartidaById($idPartida);
            if (!$partida || $partida->getIdUsuario() !== $this->usuario->getId()) {
                http_response_code(404);
                echo json_encode(['error' => 'Partida no encontrada']);
                return;
            }

            if (isset($datos['estado'])) $partida->setEstado($datos['estado']);
            if (isset($datos['casillas_destapadas'])) $partida->setCasillasDestapadas((int)$datos['casillas_destapadas']);
            if (isset($datos['casillas_perdidas_seguidas'])) $partida->setCasillasPerdidasSeguidas((int)$datos['casillas_perdidas_seguidas']);

            $ok = PartidaDAO::actualizarPartida($partida);

            if ($ok) {
                http_response_code(200);
                echo json_encode(['mensaje' => 'Partida actualizada']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Error al actualizar partida']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}