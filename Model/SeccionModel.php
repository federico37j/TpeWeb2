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

}
