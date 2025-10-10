<?php

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../Model/usuario.php';

class UsuarioDAO {

    public static function crear(Usuario $usuario) {
        try {
            $conexion = Database::connect();
            $query = "INSERT INTO usuario (nombre_usuario, email, clave, rol, fecha_creacion) 
                      VALUES (?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($query);
            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $conexion->error);
            }

            $nombre_usuario = $usuario->getNombreUsuario();
            $email = $usuario->getEmail();
            $clave = $usuario->getClave(); 
            $rol = $usuario->getRol();
            $fecha_creacion = $usuario->getFechaCreacion();

            $stmt->bind_param('sssss', $nombre_usuario, $email, $clave, $rol, $fecha_creacion);
            $ok = $stmt->execute();
            $stmt->close();
            return $ok;
        } catch (Exception $e) {
            error_log("Error en UsuarioDAO::crear: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion) && $conexion) {
                $conexion->close();
            }
        }
    }

    public static function getAllUsuarios() {
        $conexion = Database::connect();
        $usuarios = [];
        $query = "SELECT id, nombre_usuario, email, clave, rol, fecha_creacion FROM usuario";
        $resultado = $conexion->query($query);

        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = new Usuario(
                $fila["id"],
                $fila["nombre_usuario"],
                $fila["email"],
                $fila["clave"],
                $fila["rol"],
                $fila["fecha_creacion"]
            );
        }
        $conexion->close();
        return $usuarios;
    }

    public static function getUsuarioPorId(int $id) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("SELECT id, nombre_usuario, email, clave, rol, fecha_creacion FROM usuario WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $usuario = null;
        if ($fila = $resultado->fetch_assoc()) {
            $usuario = new Usuario(
                $fila["id"],
                $fila["nombre_usuario"],
                $fila["email"],
                $fila["clave"],
                $fila["rol"],
                $fila["fecha_creacion"]
            );
        }
        $stmt->close();
        $conexion->close();
        return $usuario;
    }

    public static function getUsuarioPorNombre(string $nombre) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("SELECT id, nombre_usuario, email, clave, rol, fecha_creacion FROM usuario WHERE nombre_usuario = ?");
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $usuario = null;
        if ($fila = $resultado->fetch_assoc()) {
            $usuario = new Usuario(
                $fila["id"],
                $fila["nombre_usuario"],
                $fila["email"],
                $fila["clave"],
                $fila["rol"],
                $fila["fecha_creacion"]
            );
        }
        $stmt->close();
        $conexion->close();
        return $usuario;
    }

    public static function modificarUsuario(Usuario $usuario) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("UPDATE usuario SET nombre_usuario = ?, email = ?, clave = ?, rol = ? WHERE id = ?");
        $nombre = $usuario->getNombreUsuario();
        $email = $usuario->getEmail();
        $clave = $usuario->getClave();
        $rol = $usuario->getRol();
        $id = $usuario->getId();

        $stmt->bind_param("ssssi", $nombre, $email, $clave, $rol, $id);
        $ok = $stmt->execute();
        $stmt->close();
        $conexion->close();
        return $ok;
    }

    public static function borrarUsuario(int $id) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("DELETE FROM usuario WHERE id = ?");
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();
        $conexion->close();
        return $ok;
    }
}