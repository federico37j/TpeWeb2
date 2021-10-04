<?php

class SeccionModel
{
    private $bd;

    public function __construct()
    {
        $this->bd = new PDO('mysql:host=localhost;' . 'dbname=db_eleco;charset=utf8', 'root', '');
    }


     // Se obtiene la lista de secciones de la DB.
     public function getSecciones()
     {
         $sentencia = $this->bd->prepare('SELECT * FROM seccion');
         $sentencia->execute();
         $secciones = $sentencia->fetchAll(PDO::FETCH_OBJ);
         return $secciones;
     }

     // Se inserta una nueva seccion en la BD.
    function insertSeccion($nombre)
    {
        $sentencia = $this->bd->prepare("INSERT INTO seccion(nombre_seccion) VALUES(?)");
        $sentencia->execute(array($nombre));
    }

    // Se eliminar una seccion según el id.
    function deleteSeccion($id)
    {
        $sentencia = $this->bd->prepare("DELETE FROM seccion WHERE id_seccion=?");
        $sentencia->execute(array($id));
    }

    // Se actualiza la seccion en la BD segun el id.
    function updateSeccion($nombre, $id_seccion)
    {
        $sentencia = $this->bd->prepare("UPDATE seccion SET nombre_seccion=? WHERE id_seccion=?");
        $sentencia->execute(array($nombre, $id_seccion));
    }

    // Se trae por id la seccion junto con su seccion.
    public function getSeccion($id)
    {
        $sentencia = $this->bd->prepare("SELECT * FROM seccion WHERE id_seccion=?");
        $sentencia->execute(array($id));
        $seccion = $sentencia->fetch(PDO::FETCH_OBJ);
        return $seccion;
    }
}
