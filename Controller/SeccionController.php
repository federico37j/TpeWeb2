<?php
require_once "./Model/SeccionModel.php";
require_once "./View/NoticiaView.php";

class SeccionController
{

    private $model;
    private $noticiaModel;
    private $viewAdmin;

    public function __construct()
    {
        $this->noticiaModel = new NoticiaModel();
        $this->model = new SeccionModel();
        $this->viewAdmin = new AdministradorView();
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
        $this->viewAdmin->showAdminLocation();
    }

    // Se eliminar una noticia segun el id.
    function deleteSeccion($id)
    {
        $respuesta = $this->model->deleteSeccion($id);
        if (!empty($respuesta)) {
            $respuesta = $id;
        }
        $secciones = $this->model->getSecciones();
        $noticias = $this->noticiaModel->getNoticias();
        $this->viewAdmin->showAdministrador($noticias, $secciones, $respuesta);
    }

    // Se inserta una nueva seccion.
    public function updateSeccion($id_seccion)
    {
        $this->model->updateSeccion($_POST['nombre'], $id_seccion);
        $this->viewAdmin->showAdminLocation();
    }

    // Se trae la seccion segun su id y se pasa a la vista.
    public function getSeccion($id)
    {
        return $this->model->getSeccion($id);
    }
}
