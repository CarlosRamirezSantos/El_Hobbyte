<?php
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../Model/casilla.php';

class CasillaDAO {

    public static function crear(Casilla $casilla) {

        $conexion = Database::connect();
        $stmt = $conexion->prepare("INSERT INTO casilla (id_partida, posicion, tipo_prueba, esfuerzo_necesario, destapada, resultado_prueba) VALUES (?, ?, ?, ?, ?, ?)");
        $id_partida = $casilla->getIdPartida();
        $posicion = $casilla->getPosicion();
        $tipo_prueba = $casilla->getTipoPrueba();
        $esfuerzo_necesario = $casilla->getEsfuerzoNecesario();
        $destapada = $casilla->getDestapada();
        $resultado_prueba = $casilla->getResultadoPrueba();
        $stmt->bind_param("issiis", $id_partida, $posicion, $tipo_prueba, $esfuerzo_necesario, $destapada, $resultado_prueba);
        $ok = $stmt->execute();
        $stmt->close();
        $conexion->close();
        return $ok;
    }

    public static function getCasillaById($id) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("SELECT * FROM casilla WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $casilla = null;
        if ($fila = $resultado->fetch_assoc()) {
            $casilla = new Casilla(
                $fila['id'],
                $fila['id_partida'],
                $fila['posicion'],
                $fila['tipo_prueba'],
                $fila['esfuerzo_necesario'],
                $fila['destapada'],
                $fila['resultado_prueba']
            );
        }
        $stmt->close();
        $conexion->close();
        return $casilla;
    }

    public static function getCasillasPartida($id_partida) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("SELECT * FROM casilla WHERE id_partida = ?");
        $stmt->bind_param("i", $id_partida);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $casillas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $casillas[] = new Casilla(
                $fila['id'],
                $fila['id_partida'],
                $fila['posicion'],
                $fila['tipo_prueba'],
                $fila['esfuerzo_necesario'],
                $fila['destapada'],
                $fila['resultado_prueba']
            );
        }
        $stmt->close();
        $conexion->close();
        return $casillas;
    }

    public static function actualizar(Casilla $casilla) {

        $conexion = Database::connect();
        $stmt = $conexion->prepare("UPDATE casilla SET posicion=?, tipo_prueba=?, esfuerzo_necesario=?, destapada=?, resultado_prueba=? WHERE id=?");
        $posicion = $casilla->getPosicion();
        $tipo_prueba = $casilla->getTipoPrueba();
        $esfuerzo_necesario = $casilla->getEsfuerzoNecesario();
        $destapada = $casilla->getDestapada();
        $resultado_prueba = $casilla->getResultadoPrueba();
        $id = $casilla->getId();
        $stmt->bind_param("ssiisi", $posicion, $tipo_prueba, $esfuerzo_necesario, $destapada, $resultado_prueba, $id);
        $ok = $stmt->execute();
        $stmt->close();
        $conexion->close();
        return $ok;
    }

    public static function borrar($id) {
        
        $conexion = Database::connect();
        $stmt = $conexion->prepare("DELETE FROM casilla WHERE id = ?");
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();
        $conexion->close();
        return $ok;
    }
}
