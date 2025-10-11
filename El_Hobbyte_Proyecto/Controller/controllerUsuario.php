<?php
require_once __DIR__ . '/../Model/usuario.php';
require_once __DIR__ . '/../Database/usuarioDAO.php';

class UsuarioController {
    private $usuarioAutenticado;

    public function __construct(Usuario $usuarioAutenticado = null) {
        $this->usuarioAutenticado = $usuarioAutenticado;
    }

    public static function obtenerCredenciales() {
        $input = file_get_contents('php://input');
        $datos = json_decode($input, true) ?: [];
        return [
            'nombre_usuario' => $datos['auth_nombre'] ?? null,
            'clave' => $datos['auth_clave'] ?? null,
        ];
    }

    public static function verificarUsuarioLogin($nombre, $clave) {
        $usuario = UsuarioDAO::getUsuarioPorNombre($nombre);
        if ($usuario && $clave === $usuario->getClave()) {
            return $usuario;
        }
        return null;
    }

    public static function autenticarYVerificarRol($rolRequerido = null) {
    $credenciales = UsuarioController::obtenerCredenciales();
    
    if (!$credenciales['nombre_usuario'] || !$credenciales['clave']) {
        http_response_code(400);
        echo json_encode(['error' => 'Faltan auth_nombre o auth_clave']);
        exit;
    }

    $controlador = new UsuarioController();
    $usuario = $controlador->verificarUsuarioLogin($credenciales['nombre_usuario'], $credenciales['clave']);
    
    if (!$usuario) {
        http_response_code(401);
        echo json_encode(['error' => 'Credenciales inválidas']);
        exit;
    }

    if ($rolRequerido && $usuario->getRol() !== $rolRequerido) {
        http_response_code(403);
        echo json_encode(['error' => "Acceso denegado. Se requiere rol: $rolRequerido"]);
        exit;
    }

    return $usuario;
}

    public function crearUsuario($datos) {
        if (empty($datos['nombre_usuario']) || empty($datos['clave']) || empty($datos['email'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan campos obligatorios: nombre_usuario, clave, email']);
            return;
        }

        $usuario = new Usuario(
            null,
            $datos['nombre_usuario'],
            $datos['email'],
            $datos['clave'], 
            $datos['rol'] ?? 'jugador',
            date('Y-m-d H:i:s')
        );

        if (UsuarioDAO::crear($usuario)) {
            http_response_code(201);
            echo json_encode(['mensaje' => 'Usuario creado exitosamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo crear el usuario']);
        }
    }

    public function getUsuarioPorId($id) {
        $usuario = UsuarioDAO::getUsuarioPorId((int)$id);
        if ($usuario) {
            echo json_encode([
                'id' => $usuario->getId(),
                'nombre_usuario' => $usuario->getNombreUsuario(),
                'email' => $usuario->getEmail(),
                'clave' => $usuario->getClave(),
                'rol' => $usuario->getRol(),
                'fecha_creacion' => $usuario->getFechaCreacion()
            ]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
        }
    }

    public function getAllUsuarios() {
        $usuarios = UsuarioDAO::getAllUsuarios();
        $lista = [];
        foreach ($usuarios as $u) {
            $lista[] = [
                'id' => $u->getId(),
                'nombre_usuario' => $u->getNombreUsuario(),
                'email' => $u->getEmail(),
                'clave' => $u->getClave(),
                'rol' => $u->getRol(),
                'fecha_creacion' => $u->getFechaCreacion()
            ];
        }
        echo json_encode($lista);
    }

    public function actualizarUsuario($id, $datos) {
        $usuario = UsuarioDAO::getUsuarioPorId((int)$id);
        if (!$usuario) {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
            return;
        }

        if (isset($datos['nombre_usuario'])) $usuario->setNombreUsuario($datos['nombre_usuario']);
        if (isset($datos['email'])) $usuario->setEmail($datos['email']);
        if (isset($datos['clave'])) $usuario->setClave($datos['clave']);
        if (isset($datos['rol'])) $usuario->setRol($datos['rol']);
        
        if (UsuarioDAO::modificarUsuario($usuario)) {
            echo json_encode(['mensaje' => 'Usuario actualizado']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo actualizar el usuario']);
        }
    }

    public function borrarUsuario($id) {
        if (UsuarioDAO::borrarUsuario((int)$id)) {
            echo json_encode(['mensaje' => 'Usuario eliminado']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado o no se pudo eliminar']);
        }
    }

    
    public function actualizarContrasena($idUsuario, $datos) {
        $contrasenaActual = $datos['contrasena_actual'] ?? '';
        $nuevaContrasena = $datos['nueva_contrasena'] ?? '';

        if (empty($contrasenaActual) || empty($nuevaContrasena)) {
            http_response_code(400);
            echo json_encode(['error' => 'Se requieren "contrasena_actual" y "nueva_contrasena"']);
            return;
        }

        if (strlen($nuevaContrasena) < 6) {
            http_response_code(400);
            echo json_encode(['error' => 'La nueva contraseña debe tener al menos 6 caracteres']);
            return;
        }

        
        $usuario = UsuarioDAO::getUsuarioPorId((int)$idUsuario);
        if (!$usuario) {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
            return;
        }

    
        if ($contrasenaActual !== $usuario->getClave()) {
            http_response_code(401);
            echo json_encode(['error' => 'La contraseña actual es incorrecta']);
            return;
        }

        
        $usuario->setClave($nuevaContrasena);
        if (UsuarioDAO::modificarUsuario($usuario)) {
            http_response_code(200);
            echo json_encode(['mensaje' => 'Contraseña actualizada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo actualizar la contraseña']);
        }
    }
}