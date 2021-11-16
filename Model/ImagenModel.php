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
        $sentencia = $this->db->prepare("INSERT INTO imagen (imagen,id_noticia) VALUES (?, ?)");
        $sentencia->execute([$imagen, $id_noticia]);
    }

    // Borrar imagen por el id de la noticia.
    public function deleteImagenByNoticia($id_noticia)
    {
        $sentencia = $this->db->prepare("DELETE FROM imagen WHERE id_noticia=?");
        $respuesta = $sentencia->execute([$id_noticia]);
        return $respuesta;
    }
}
