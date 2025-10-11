<?php

require_once __DIR__ . '/Model/usuario.php';
require_once __DIR__ . '/Model/partida.php';
require_once __DIR__ . '/Model/casilla.php';
require_once __DIR__ . '/Model/heroe.php';
require_once __DIR__ . '/Controller/controllerUsuario.php';
require_once __DIR__ . '/Controller/controllerPartida.php';
require_once __DIR__ . '/Database/usuarioDAO.php';
require_once __DIR__ . '/Database/partidaDAO';
require_once __DIR__ . '/Database/casillaDAO.php';
require_once __DIR__ . '/Database/heroeDAO.php';

header('Content-Type: application/json');

$metodo = $_SERVER['REQUEST_METHOD'];
$ruta = $_SERVER['REQUEST_URI'];
$parametros = explode("/", $ruta);
unset($parametros[0]);

switch ($parametros[1] ?? '') {

    case 'admin':
        $credenciales = UsuarioController::obtenerCredenciales();
        if (!$credenciales['nombre_usuario'] || !$credenciales['clave']) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan auth_nombre o auth_clave']);
            exit;
        }
        $controlador = new UsuarioController();
        $usuario = $controlador->verificarUsuarioLogin($credenciales['nombre_usuario'], $credenciales['clave']);
        if (!$usuario || $usuario->getRol() !== 'administrador') {
            http_response_code(403);
            echo json_encode(['error' => 'Acceso denegado. Solo administradores pueden acceder']);
            exit;
        }

        if (($parametros[2] ?? '') === 'usuarios') {
            switch ($metodo) {
                case 'GET':
                    if (isset($parametros[3]) && is_numeric($parametros[3])) {
                        $controlador->getUsuarioPorId($parametros[3]);
                    } else {
                        $controlador->getAllUsuarios();
                    }
                    break;
                case 'POST':
                    $datosUsuario = $_POST;
                    if (empty($datosUsuario)) {
                        $datosUsuario = json_decode(file_get_contents("php://input"), true) ?: [];
                    }
                    $controlador->crearUsuario($datosUsuario);
                    break;
                case 'PUT':
                    if (isset($parametros[3]) && is_numeric($parametros[3])) {
                        $put_vars = json_decode(file_get_contents("php://input"), true) ?: [];
                        $controlador->actualizarUsuario($parametros[3], $put_vars);
                    }
                    break;
                case 'DELETE':
                    if (isset($parametros[3]) && is_numeric($parametros[3])) {
                        $controlador->borrarUsuario($parametros[3]);
                    }
                    break;
                default:
                    http_response_code(405);
                    echo json_encode(['error' => 'Método no permitido']);
                    break;
            }
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Ruta no soportada para admin']);
        }
        break;

   
    case 'gamer': 
        $credenciales = UsuarioController::obtenerCredenciales();
        if (!$credenciales['nombre_usuario'] || !$credenciales['clave']) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan auth_nombre o auth_clave']);
            exit;
        }
        $controlador = new UsuarioController();
        $usuario = $controlador->verificarUsuarioLogin($credenciales['nombre_usuario'], $credenciales['clave']);
        if (!$usuario || $usuario->getRol() !== 'jugador') {
            http_response_code(403);
            echo json_encode(['error' => 'Acceso denegado. Solo jugadores pueden acceder']);
            exit;
        }

        $controladorPartida = new PartidaController($usuario);

        if (($parametros[2] ?? '') === 'partidas') {
            switch ($metodo) {
                case 'GET':
                    if (!isset($parametros[3])) {
                        $controladorPartida->getPartidasUsuario();
                    } elseif (isset($parametros[3]) && is_numeric($parametros[3])) {
                        $controladorPartida->getEstadoPartida($parametros[3]);
                    }
                    break;
                case 'POST':
                    if (!isset($parametros[3])) {
                        $controladorPartida->crearPartida();
                    } elseif (isset($parametros[3]) && is_numeric($parametros[3]) && ($parametros[4] ?? '') === 'casilla' && isset($parametros[5]) && is_numeric($parametros[5])) {
                        $controladorPartida->destaparCasilla($parametros[3], $parametros[5]);
                    } elseif (isset($parametros[3]) && is_numeric($parametros[3]) && ($parametros[4] ?? '') === 'rendirse') {
                        $controladorPartida->rendirse($parametros[3]);
                    }
                    break;
                default:
                    http_response_code(405);
                    echo json_encode(['error' => 'Método no permitido para /gamer']);
                    break;
            }
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Ruta no soportada para gamer']);
        }
        break;

    case 'user':
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

        switch ($metodo) {
            case 'GET':
                
                echo json_encode($usuario->toArray());
                break;

            case 'PATCH':
                $datos = json_decode(file_get_contents("php://input"), true) ?: [];
                $controlador->actualizarContrasena($usuario->getId(), $datos);
                break;

            default:
                http_response_code(405);
                echo json_encode(['error' => 'Método no permitido en /user']);
                break;
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Ruta principal no soportada']);
        break;
}