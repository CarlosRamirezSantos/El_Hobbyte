<?php
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../Model/partida.php';

class PartidaDAO {

    public static function crearPartida(Partida $partida) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("INSERT INTO partida (id_usuario, tipo, casillas_totales, casillas_destapadas, casillas_perdidas_seguidas, estado, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $id_usuario = $partida->getIdUsuario();
        $tipo = $partida->getTipo();
        $casillas_totales = $partida->getCasillasTotales();
        $casillas_destapadas = $partida->getCasillasDestapadas();
        $casillas_perdidas_seguidas = $partida->getCasillasPerdidasSeguidas();
        $estado = $partida->getEstado();
        $fecha_inicio = $partida->getFechaInicio();
        $fecha_fin = $partida->getFechaFin();

        $stmt->bind_param("isiiisss", $id_usuario, $tipo, $casillas_totales, $casillas_destapadas, $casillas_perdidas_seguidas, $estado, $fecha_inicio, $fecha_fin);

        $ok = $stmt->execute();

        $stmt->close();
        $conexion->close();

        return $ok;
    }

    public static function getPartidasUsuario($id_usuario) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("SELECT * FROM partida WHERE id_usuario = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $partidas = [];

        while ($fila = $resultado->fetch_assoc()) {
            $partidas[] = new Partida(
                $fila['id'],
                $fila['id_usuario'],
                $fila['tipo'],
                $fila['casillas_totales'],
                $fila['casillas_destapadas'],
                $fila['casillas_perdidas_seguidas'],
                $fila['estado'],
                $fila['fecha_inicio'],
                $fila['fecha_fin']
            );
        }

        $stmt->close();
        $conexion->close();

        return $partidas;
    }

    public static function getPartidaById($id) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("SELECT * FROM partida WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $resultado = $stmt->get_result();

        $partida = null;
        if ($fila = $resultado->fetch_assoc()) {
            $partida = new Partida(
                $fila['id'],
                $fila['id_usuario'],
                $fila['tipo'],
                $fila['casillas_totales'],
                $fila['casillas_destapadas'],
                $fila['casillas_perdidas_seguidas'],
                $fila['estado'],
                $fila['fecha_inicio'],
                $fila['fecha_fin']
            );
        }

        $stmt->close();
        $conexion->close();

        return $partida;
    }

    public static function actualizarPartida(Partida $partida) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("UPDATE partida SET tipo=?, casillas_totales=?, casillas_destapadas=?, casillas_perdidas_seguidas=?, estado=?, fecha_inicio=?, fecha_fin=? WHERE id=?");

        $tipo = $partida->getTipo();
        $casillas_totales = $partida->getCasillasTotales();
        $casillas_destapadas = $partida->getCasillasDestapadas();
        $casillas_perdidas_seguidas = $partida->getCasillasPerdidasSeguidas();
        $estado = $partida->getEstado();
        $fecha_inicio = $partida->getFechaInicio();
        $fecha_fin = $partida->getFechaFin();
        $id = $partida->getId();

        $stmt->bind_param("siiisssi", $tipo, $casillas_totales, $casillas_destapadas, $casillas_perdidas_seguidas, $estado, $fecha_inicio, $fecha_fin, $id);

        $ok = $stmt->execute();

        $stmt->close();
        $conexion->close();

        return $ok;
    }

    public static function borrarPartida($id) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("DELETE FROM partida WHERE id = ?");
        
        $stmt->bind_param("i", $id);
        
        $ok = $stmt->execute();
        $stmt->close();
        $conexion->close();

        return $ok;
    }
}
