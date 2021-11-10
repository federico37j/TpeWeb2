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
        $id_noticia = $params[':ID'];
        $comentario = $this->model->getAllComentarioByNoticia($id_noticia);
        $this->view->response($comentario, 200);
    }

    // Inserto un comentario
    public function insertarComentario()
    {
        $body = $this->getBody();
        $id = $this->model->insertComentario($body->descripcion, $body->puntaje, $body->id_noticia, $body->id_usuario);
        if ($id != 0) {
            $this->view->response("Comentario insertado", 200);
        } else {
            $this->view->response("Error al insertar comentario", 404);
        }
    }

    // Elimino un comentario
    public function borrarComentario($params = null) {
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
