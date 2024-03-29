<?php

require_once 'init.php';
require_once './app/controllers/artistaController.php';
require_once './app/controllers/sesionController.php';
require_once './app/controllers/cancionController.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
define('CANCIONES', BASE_URL . 'canciones');
define('LOGIN', BASE_URL . 'login');


$action = 'inicio'; // accion por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}



// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case "inicio":
        $controller = new ArtistaController();
        $controller->showListaArtistas();
        break;
    case "canciones":
        $controller = new CancionController();
        $controller->listaCanciones();
        break;
    case "cancion":
        $controller = new CancionController();
        $controller->infoCancion($params[1]);
        break;
    case "artista":
        $controller = new ArtistaController();
        $controller->showArtista($params[1]);
        break;
    case "login":
        $controller = new SesionController();
        $controller->showLogin();
        break;
    case "auth":
        $controller = new SesionController();
        $controller->auth();
        break;
    case "logout":
        $controller = new SesionController();
        $controller->logout();
        break;
    case "registerurl":
        $controller = new SesionController();
        $controller->showRegister();
        break;
    case "registrar":
        $controller = new SesionController();
        $controller->register();
        break;
    case "addArtista":
        $controller = new ArtistaController();
        $controller->addArtista();
        break;
    case "removeArtista":
        $controller = new ArtistaController();
        $controller->removeArtist($params[1]);
        break;
    case "editArtista":
        // Obtén el valor del parámetro "artista" y pásalo a "editArtist"
        $controller = new ArtistaController();
        $controller->editArtist($params[1]);
        break;
    case "addCancion":
        $controller = new CancionController();
        $controller->agregarCancion();
        break;
    case "removeCancion":
        $controller = new CancionController();
        $controller->eliminarCancion($params[1]);
        break;
    case "editCancion":
        // Obtén el valor del parámetro "artista" y pásalo a "editArtist"
        $controller = new CancionController();
        $controller->editCancion($params[1]);
        break;
    default:
        echo "404 Page Not Found";
        break;
}
