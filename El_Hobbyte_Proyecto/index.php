<?php

require_once __DIR__ . '/Model/usuario.php';
require_once __DIR__ . '/Model/partida.php';
require_once __DIR__ . '/Model/casilla.php';
require_once __DIR__ . '/Model/heroe.php';
require_once __DIR__ . '/Controller/controllerUsuario.php';
require_once __DIR__ . '/Controller/controllerPartida.php';
require_once __DIR__ . '/Database/usuarioDAO.php';
require_once __DIR__ . '/Database/partidaDAO.php';
require_once __DIR__ . '/Database/casillaDAO.php';
require_once __DIR__ . '/Database/heroeDAO.php';

header('Content-Type: application/json');

$metodo = $_SERVER['REQUEST_METHOD'];
$ruta = $_SERVER['REQUEST_URI'];
$parametros = explode("/", $ruta);
unset($parametros[0]);

switch ($parametros[1] ?? '') {

    case 'admin':
        $usuario = UsuarioController::autenticarYVerificarRol('administrador');
        $controlador = new UsuarioController();

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
        $usuario = UsuarioController::autenticarYVerificarRol('jugador');
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
        $usuario = UsuarioController::autenticarYVerificarRol(); 
        $controlador = new UsuarioController();

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