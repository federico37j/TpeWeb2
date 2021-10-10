
<?php
require_once "./Model/NoticiaModel.php";
require_once "./Controller/SeccionController.php";
require_once "./View/AdministradorView.php";
require_once "./Helpers/AuthHelper.php";

class AdministradorController
{

    private $model;
    private $view;
    private $secciones;
    private $authHelper;

    public function __construct()
    {
        $this->model = new NoticiaModel();
        $this->seccionController = new SeccionController();
        $this->view = new AdministradorView();
        $this->authHelper = new AuthHelper();
        $this->secciones = $this->seccionController->getSecciones();
    }

    // Trae las noticias y se las pasa a la vista.
    public function showAdministrador($respuesta = "")
    {
        $this->authHelper->checkLoggedIn();
        $noticias = $this->model->getNoticias();

        $this->view->showAdministrador($noticias, $this->secciones,$respuesta);
    }

    // Se trae la noticia segun su id y se pasa a la vista.
    public function mostrarNoticiaPorId($id)
    {
        $noticias = $this->model->getNoticias();
        $noticia = $this->model->getNoticia($id);
        $this->view->verNoticiaPopUp($noticias, $this->secciones, $noticia);
    }

    // Se trae la seccion segun su id y se pasa a la vista.
    public function mostrarSeccionPorId($id)
    {
        $noticias = $this->model->getNoticias();
        $seccion = $this->seccionController->getSeccion($id);
        $this->view->verSeccionPopUp($noticias, $this->secciones, $seccion);
    }
}
