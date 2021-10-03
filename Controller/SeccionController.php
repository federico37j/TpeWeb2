<?php
require_once "./Model/SeccionModel.php";

class SeccionController
{

    private $model;


    public function __construct()
    {
        $this->model = new SeccionModel();
    }

     // Se obtiene la lista de secciones de la DB.
     public function getSecciones()
    {
        return $this->model->getSecciones();
    }

}