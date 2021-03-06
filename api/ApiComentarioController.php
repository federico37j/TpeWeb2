<?php
require_once './Model/ComentarioModel.php';
require_once './View/ApiView.php';

class ApiComentarioController
{
    private $model;
    private $view;

    function __construct()
    {
        $this->model = new ComentarioModel();
        $this->view = new APIView();
    }

    // Me traigo todos los comentarios
    public function obtenerComentariosPorNoticia($params = null)
    {
        // obtengo el id de la noticia
        $id_noticia = $params[':ID'];
        //obtengo el orden sino esta seteado le pongo el default ASC si lo esta seteado lo pongo en el orden que le paso por parametro.
        $orden = isset($params[':ORDEN']) ? $params[':ORDEN'] : 'ASC';
        //obtengo los comentarios de la noticia
        if (!empty($id_noticia) && !empty($orden)) {
            if ($orden == 'ASC' || $orden == 'DESC') {
                $comentario = $this->model->getAllComentarioByNoticia($id_noticia, $orden);
                //retorno los comentarios
                $this->view->response($comentario, 200);
            } else {
                $this->view->response('Orden no valido', 404);
            }
        }
    }

    //filtrar comentarios por puntaje
    public function filterComentariosByPuntaje($params = null)
    {
        // obtengo el id de la noticia.
        $id_noticia = $params[":ID"];
        // obtengo el puntaje.
        $puntaje = $params[":PUNTAJE"];
        if (!empty($id_noticia) && !empty($puntaje)) {
            // obtengo los comentarios de la noticia ordenados por puntaje.
            $comentarios = $this->model->filterComentariosByPuntaje($id_noticia, $puntaje);
            //retorno los comentarios.
            $this->view->response($comentarios, 200);
        }
    }

    // Inserto un comentario
    public function insertarComentario()
    {
        $body = $this->getBody();
        // chequeo que el body no este vacio
        if (!empty($body)) {
            //chequeo que el body tenga todos los campos
            if (isset($body->id_noticia) && isset($body->id_usuario) && isset($body->descripcion) && isset($body->puntaje) && isset($body->fecha_actual)) {
                $id = $this->model->insertComentario($body->descripcion, $body->puntaje, $body->fecha_actual, $body->id_noticia, $body->id_usuario);
                if ($id != 0) {
                    $this->view->response("Comentario insertado", 200);
                } else {
                    $this->view->response("Error al insertar comentario", 404);
                }
            } else {
                $this->view->response("Faltan campos", 404);
            }
        } else {
            $this->view->response("Error al insertar comentario el body esta vacio", 404);
        }
    }

    // Elimino un comentario
    public function borrarComentario($params = null)
    {
        $id_comentario = $params[':ID'];
        $result = $this->model->deleteComentarioById($id_comentario);
        if ($result) {
            $this->view->response("Comentario eliminado", 200);
        } else {
            $this->view->response("Error al eliminar comentario", 404);
        }
    }

    private function getBody()
    {
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }
}
