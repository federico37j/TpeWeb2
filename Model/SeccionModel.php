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
}
