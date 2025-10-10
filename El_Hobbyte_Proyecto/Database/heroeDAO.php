<?php
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../Model/heroe.php';

class HeroeDAO {

    public static function crear(Heroe $heroe) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare(
            "INSERT INTO heroe (id_partida, nombre, capacidad_maxima, capacidad_actual, estado) VALUES (?, ?, ?, ?, ?)"
        );

        $id_partida = $heroe->getIdPartida();
        $nombre = $heroe->getNombre();
        $capacidad_maxima = $heroe->getCapacidadMaxima();
        $capacidad_actual = $heroe->getCapacidadActual();
        $estado = $heroe->getEstado();

    
        $stmt->bind_param("isiis", $id_partida, $nombre, $capacidad_maxima, $capacidad_actual, $estado);
        
        $ok = $stmt->execute();
        $stmt->close();
        $conexion->close();
        return $ok;
    }


    public static function getHeroesPartida($id_partida) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("SELECT * FROM heroe WHERE id_partida = ?");
        $stmt->bind_param("i", $id_partida);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $heroes = [];
        while ($fila = $resultado->fetch_assoc()) {
            $heroes[] = new Heroe(
                $fila['id'],
                $fila['id_partida'],
                $fila['nombre'],
                $fila['capacidad_maxima'],
                $fila['capacidad_actual'],
                $fila['estado']
            );
        }
        $stmt->close();
        $conexion->close();
        return $heroes;
    }

    public static function getHeroeById($id) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("SELECT * FROM heroe WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $heroe = null;
        if ($fila = $resultado->fetch_assoc()) {
            $heroe = new Heroe(
                $fila['id'],
                $fila['id_partida'],
                $fila['nombre'],
                $fila['capacidad_maxima'],
                $fila['capacidad_actual'],
                $fila['estado']
            );
        }
        $stmt->close();
        $conexion->close();
        return $heroe;
    }

    public static function actualizar(Heroe $heroe) {
    $conexion = Database::connect();
    $stmt = $conexion->prepare("UPDATE heroe SET capacidad_actual=?, estado=? WHERE id=?");

    $capacidad_actual = $heroe->getCapacidadActual();
    $estado = $heroe->getEstado();
    $id = $heroe->getId();

    $stmt->bind_param("isi", $capacidad_actual, $estado, $id);

    $ok = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $ok;
}

    public static function borrar($id) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("DELETE FROM heroe WHERE id = ?");
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();
        $conexion->close();
        return $ok;
    }
}
