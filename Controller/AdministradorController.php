
<?php
require_once "./Model/NoticiaModel.php";
require_once "./Model/SeccionModel.php";
require_once "./View/AdministradorView.php";
require_once "./Helpers/AuthHelper.php";

class AdministradorController
{

    private $model;
    private $view;
    private $secciones;
    private $seccionesModel;
    private $authHelper;

    public function __construct()
    {
        $this->model = new NoticiaModel();
        $this->seccionesModel = new SeccionModel();
        $this->view = new AdministradorView();
        $this->authHelper = new AuthHelper();
        $this->secciones = $this->seccionesModel->getSecciones();
    }

    // Trae las noticias y se las pasa a la vista.
    public function showAdministrador($respuesta = "")
    {
        $this->authHelper->checkLoggedIn();
        $noticias = $this->model->getNoticias();
        $this->view->showAdministrador($noticias, $this->secciones, "", "", $respuesta);
    }

    // Se trae la noticia segun su id y se pasa a la vista.
    public function mostrarNoticiaPorId($id)
    {
        $noticias = $this->model->getNoticias();
        $noticia = $this->model->getNoticia($id);
        $this->view->showAdministrador($noticias, $this->secciones, $noticia, "", "editarNoticia");
    }

    // Se trae la seccion segun su id y se pasa a la vista.
    public function mostrarSeccionPorId($id)
    {
        $noticias = $this->model->getNoticias();
        $seccion = $this->seccionesModel->getSeccion($id);
        // $this->view->verSeccionPopUp($noticias, $this->secciones, $seccion);
        $this->view->showAdministrador($noticias, $this->secciones, "", $seccion, "editarSeccion");
    }

    function showAdminLocation()
    {
        $this->view->showAdminLocation();
    }
}
