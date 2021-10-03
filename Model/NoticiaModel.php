<?php

class NoticiaModel
{
    private $bd;

    public function __construct()
    {
        //Se crea conexión con la bd.
        $this->bd = new PDO('mysql:host=localhost;' . 'dbname=db_eleco;charset=utf8', 'root', '');
    }

    // Se traen las noticias.
    public function getNoticias()
    {
        $sentencia = $this->bd->prepare("SELECT noti.id_noticia, noti.titulo, noti.detalle, noti.fecha_subida, sec.nombre_seccion FROM noticia AS noti
        INNER JOIN seccion AS sec ON noti.id_seccion = sec.id_seccion ORDER BY noti.fecha_subida ASC");
        $sentencia->execute();
        $noticias = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $noticias;
    }

    // Se trae por id la noticia junto con su seccion.
    public function getNoticia($id)
    {
        $sentencia = $this->bd->prepare("SELECT noti.id_noticia, noti.titulo, noti.detalle, noti.fecha_subida, noti.id_seccion, sec.nombre_seccion FROM noticia AS noti
        INNER JOIN seccion AS sec ON noti.id_seccion = sec.id_seccion
        WHERE noti.id_noticia=?");
        $sentencia->execute(array($id));
        $noticia = $sentencia->fetch(PDO::FETCH_OBJ);
        return $noticia;
    }

    //Se obtiene la lista de noticias de la DB según seccion.
    function getNoticiaBySeccion($id_seccion)
    {
        $sentencia = $this->bd->prepare('SELECT noti.id_noticia, noti.titulo, noti.detalle, noti.fecha_subida, sec.id_seccion, sec.nombre_seccion FROM noticia AS noti
        INNER JOIN seccion AS sec ON noti.id_seccion = sec.id_seccion
        WHERE sec.id_seccion = ? ORDER BY noti.fecha_subida ASC');
        $sentencia->execute(array($id_seccion));
        $noticias = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $noticias;
    }

    // Se inserta una nueva noticia en la BD.
    function insertNoticia($titulo, $detalle, $fecha_subida, $id_seccion)
    {
        $sentencia = $this->bd->prepare("INSERT INTO noticia(titulo, detalle, fecha_subida, id_seccion) VALUES(?, ?, ?, ?)");
        $sentencia->execute(array($titulo, $detalle, $fecha_subida, $id_seccion));
    }

    // Se eliminar una noticia según el id.
    function deleteNoticia($id)
    {
        $sentencia = $this->bd->prepare("DELETE FROM noticia WHERE id_noticia=?");
        $sentencia->execute(array($id));
    }

    // Se actualiza la noticia en la BD segun el id.
    function updateNoticia($titulo, $detalle, $id_seccion, $id_noticia)
    {
        $sentencia = $this->bd->prepare("UPDATE noticia SET titulo=?, detalle=?, id_seccion=? WHERE id_noticia=?");
        $sentencia->execute(array($titulo, $detalle, $id_seccion, $id_noticia));
    }

    /*
    SELECT * FROM `noticia` AS n
    INNER JOIN `imagen_noticia` AS img ON img.id_noticia = n.id_noticia
    WHERE n.id_noticia=1
    */
}
