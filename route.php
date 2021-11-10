<?php
require_once "Controller/NoticiaController.php";
require_once "Controller/SeccionController.php";
require_once "Controller/LoginController.php";
require_once "Controller/ContactoController.php";
require_once "Controller/UserController.php";

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
$seccionController = new SeccionController();
$loginController = new LoginController();
$contactoController = new ContactoController();
$userController = new UserController();
$authHelper = new AuthHelper();

// Determina que camino seguir según la acción
switch ($params[0]) {
        // <--- Noticias --->
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
    case 'deleteNoticiaPorSeccion':
        $noticiaController->deleteNoticiaPorSeccion($params[1]);
        break;
    case 'editNoticia':
        $noticiaController->mostrarNoticiaPorId($params[1]);
        break;
    case 'updateNoticia':
        $noticiaController->updateNoticia($params[1]);
        break;
        // <--- Login --->
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
        // <--- Administrador --->
    case 'admin':
        $noticiaController->showAdministrador();
        break;
        // <--- Sección --->
    case 'createSeccion':
        $seccionController->createSeccion();
        break;
    case 'deleteSeccion':
        $seccionController->deleteSeccion($params[1]);
        break;
    case 'updateSeccion':
        $seccionController->updateSeccion($params[1]);
        break;
    case 'editSeccion':
        $noticiaController->mostrarSeccionPorId($params[1]);
        break;
        // <--- Contacto --->
    case 'contacto':
        $contactoController->showContacto();
        break;
        // <--- User --->
    case 'user':
        $userController->showUsers();
        break;
    case 'modificarRol':
        $userController->modificarRol($params[1]);
        break;
    case 'deleteUser':
        $userController->deleteUser($params[1]);
        break;
    default:
        echo ('404 Page not found');
        break;
}
