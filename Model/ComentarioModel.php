<?php

class ComentarioModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_eleco;charset=utf8', 'root', '');
    }

    // Obtenemos todos los comentarios segun el id de la noticia.
    public function getAllComentarioByNoticia($idNoticia)
    {
        $sentencia = $this->db->prepare("SELECT c.*, u.email FROM comentario AS c INNER JOIN usuario AS u ON c.id_usuario = u.id_usuario 
        WHERE c.id_noticia = ?");
        $sentencia->execute([$idNoticia]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    // Insertar un comentario.
    public function insertComentario($descripcion, $puntaje, $id_noticia, $id_usuario)
    {
        $sentencia = $this->db->prepare("INSERT INTO comentario(descripcion, puntaje, id_noticia, id_usuario) VALUES(?, ?, ?, ?)");
        $sentencia->execute([$descripcion, $puntaje, $id_noticia, $id_usuario]);
        return $this->db->lastInsertId();
    }

    // Elimino un comentario.
    public function deleteComentarioById($idComentario)
    {
        $sentencia = $this->db->prepare("DELETE FROM comentario WHERE id_comentario = ?");
        return $sentencia->execute([$idComentario]);
    }

    // Elimino un comentario segun el usuario.
    public function deleteComentarioByUsuario($idUsuario)
    {
        $sentencia = $this->db->prepare("DELETE FROM comentario WHERE id_usuario = ?");
        return $sentencia->execute([$idUsuario]);
    }

    // Se elimina un comentario según el id de la noticia.
    function deleteComentarioByIdNoticia($id_noticia)
    {
        $sentencia = $this->db->prepare("DELETE FROM comentario WHERE id_noticia=?");
        $resultado = $sentencia->execute([$id_noticia]);
        return $resultado;
    }
}
