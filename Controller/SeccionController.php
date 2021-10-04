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

    // Se inserta una nueva seccion.
    public function createSeccion()
    {
        $this->model->insertSeccion($_POST['nombre']);
        header("Location: " . BASE_URL . "admin");
    }

    // Se eliminar una noticia segun el id.
    function deleteSeccion($id)
    {
        $this->model->deleteSeccion($id);
        header("Location: " . BASE_URL . "admin");
    }

}