<?php

require_once 'libs/Router.php';
require_once 'api/ApiComentarioController.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('comentario/:ID', 'GET', 'ApiComentarioController', 'obtenerComentariosPorNoticia');
$router->addRoute('comentario/:ID/:ORDEN', 'GET', 'ApiComentarioController', 'obtenerComentariosPorNoticia');
$router->addRoute('comentario/:ID/PUNTAJE/:PUNTAJE', 'GET', 'ApiComentarioController', 'filterComentariosByPuntaje');
$router->addRoute('comentario', 'POST', 'ApiComentarioController', 'insertarComentario');
$router->addRoute('comentario/:ID', 'DELETE', 'ApiComentarioController', 'borrarComentario');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
