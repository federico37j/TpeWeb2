<?php

class ImagenModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_eleco;charset=utf8', 'root', '');
    }

    //Insertar una imagen.
    public function insertarImagen($imagen, $id_noticia)
    {
        $pathImg = $this->uploadImage($imagen);
        $sentencia = $this->db->prepare("INSERT INTO imagen (imagen,id_noticia) VALUES (?, ?)");
        $sentencia->execute([$pathImg, $id_noticia]);
    }

    private function uploadImage($image)
    {
        $target = "img/noticias/" . uniqid() . "." . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        move_uploaded_file($image['tmp_name'], $target);
        return $target;
    }

    // Borrar imagen por el id de la noticia.
    public function deleteImagenByNoticia($id_noticia)
    {
        $sentencia = $this->db->prepare("DELETE FROM imagen WHERE id_noticia=?");
        $respuesta = $sentencia->execute([$id_noticia]);
        return $respuesta;
    }
}
