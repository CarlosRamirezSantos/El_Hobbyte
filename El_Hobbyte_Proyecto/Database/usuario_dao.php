<?php

require_once('database.php');
require_once('../Model/usuario.php');


class UsuarioDAO {

    public static function crear($usuario) {
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
        throw new Exception("Error al crear el usuario: " . $e->getMessage());
    } finally {
        if (isset($conexion) && $conexion) {
            $conexion->close();
        }
    }
}

    public static function getAllUsuarios() {
        $conexion = Database::connect();
        $usuarios = [];
        $query = "SELECT * FROM usuario";
        $resultado = $conexion->query($query);

        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = new Usuario($fila["id"], $fila["nombre_usuario"], $fila["email"], $fila["clave"],$fila["rol"], $fila["fecha_creacion"]);
        }
        $conexion->close();
        return $usuarios;
    }
public static function getUsuarioById(int $id) {
    $conexion = Database::connect();

    $stmt = $conexion->prepare("SELECT * FROM usuario WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $usuarioEncontrado = null;
    if ($fila = $resultado->fetch_assoc()) {
        $usuarioEncontrado = new Usuario(
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

    return $usuarioEncontrado;
}


   public static function modificarUsuario(Usuario $usuario) {
    $conexion = Database::connect();

    $id = $usuario->getId();
    $nombre = $usuario->getNombreUsuario();
    $clave = $usuario->getClave();
    $rol = $usuario->getRol();

    $stmt = $conexion->prepare("UPDATE usuario SET nombre_usuario = ?, clave = ?, rol = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nombre, $clave, $rol, $id);

    $ok = $stmt->execute();

    $stmt->close();
    $conexion->close();

    return $ok;
}


    public static function borrarPersona($id) {
        $conexion = Database::connect();
        $stmt = $conexion->prepare("DELETE FROM usuario WHERE id = ?");
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();

        $stmt->close();
        $conexion->close();
        return $ok;
    }



public static function verificarUsuario($usuarioDAO, $username, $clave) {
    $usuario = $usuarioDAO->buscarPorUsername($username);
    return $usuario && $usuario->clave === $clave;
}

public static function obtenerDatosAutentificacion() {
    $input = file_get_contents("php://input");
    $datos = json_decode($input, true);
    return [
        'username' => $datos['username'] ?? null,
        'clave' => $datos['clave'] ?? null,
    ];
}
}
