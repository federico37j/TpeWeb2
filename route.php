<?php
require_once "Controller/NoticiaController.php";
require_once "Controller/LoginController.php";
require_once "Controller/AdministradorController.php";
require_once "Controller/SeccionController.php";

// Se guarda la URL en un constante
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    // Acción por defecto si no envían
    $action = 'home';
}

$params = explode('/', $action);

// Se instancia los controller
$noticiaController = new NoticiaController();
$loginController = new LoginController();
$administradorController = new AdministradorController();
$authHelper = new AuthHelper();
$seccionController = new SeccionController();

// Determina que camino seguir según la acción
switch ($params[0]) {
    case 'home':
        $noticiaController->showHome();
        break;
    case 'verNoticia':
        $noticiaController->mostrarNoticia($params[1]);
        break;
    case 'verNoticiasBySeccion':
        $noticiaController->getNoticiaBySeccion($params[1]);
        break;
    case 'createNoticia':
        $noticiaController->createNoticia();
        break;
    case 'deleteNoticia':
        $noticiaController->deleteNoticia($params[1]);
        break;
    case 'editNoticia':
        $administradorController->mostrarNoticiaAdmin($params[1]);
        break;
    case 'updateNoticia':
        $noticiaController->updateNoticia($params[1]);
        break;
    case 'login':
        $loginController->showLogin();
        break;
    case 'logout':
        $authHelper->logout();
        break;
    case 'registrar':
        $loginController->registrarUsuario();
        break;
    case 'acceder':
        $loginController->autenticar();
        break;
    case 'admin':
        $administradorController->showAdministrador();
        break;
    case 'createSeccion':
        $seccionController->createSeccion();
        break;
    case 'deleteSeccion':
        $seccionController->deleteSeccion($params[1]);
        break;    
    default:
        echo ('404 Page not found');
        break;
}
/*

//     case 'updateNoticia': 
//         $noticiaController->updateTask($params[1]); 
//         break;
//     
*/
