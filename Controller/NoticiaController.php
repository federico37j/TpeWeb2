
<?php
require_once "./Model/NoticiaModel.php";
require_once "./Model/SeccionModel.php";
require_once "./View/NoticiaView.php";
require_once "./View/AdministradorView.php";
require_once "./Helpers/AuthHelper.php";

class NoticiaController
{

    private $model;
    private $view;
    private $viewAdmin;
    private $secciones;
    private $seccionesModel;
    private $authHelper;

    public function __construct()
    {
        $this->model = new NoticiaModel();
        $this->seccionesModel = new SeccionModel();
        $this->view = new NoticiaView();
        $this->viewAdmin = new AdministradorView();
        $this->authHelper = new AuthHelper();
        $this->secciones = $this->seccionesModel->getSecciones();
    }

    // Trae las noticias y se las pasa a la vista.
    public function showHome()
    {
        $noticias = $this->model->getNoticias();
        $this->view->showNoticias($noticias, $this->secciones);
    }

    // Se trae la noticia segun su id y se pasa a la vista.
    public function mostrarNoticia($id)
    {
        if ($id > 0) {
            $noticias = $this->model->getNoticias();
            $noticia = $this->model->getNoticia($id);
            $this->view->showNoticias($noticias, $this->secciones, $noticia, "mostrar");
        }
    }

    // Se obtiene la lista de noticias según la seccion y se las pasa a la vista.
    public function getNoticiaBySeccion($id_seccion)
    {
        if ($id_seccion > 0) {
            $noticias = $this->model->getNoticiaBySeccion($id_seccion);
            $this->view->showNoticias($noticias, $this->secciones);
        }
    }

    // Se inserta una nueva noticia.
    public function createNoticia()
    {
        $this->authHelper->checkLoggedIn();
        if (!empty($_POST['titulo']) && !empty($_POST['detalle']) && !empty($_POST['fecha']) && !empty($_POST['secciones'])) {
            $this->authHelper->checkLoggedIn();
            $this->model->insertNoticia($_POST['titulo'], $_POST['detalle'], $_POST['fecha'], $_POST['secciones']);
        }
        $this->viewAdmin->showAdminLocation();
    }

    // Se eliminar una noticia segun el id.
    function deleteNoticia($id)
    {
        if ($id > 0 &&  $this->authHelper->isAdmin() === 'true') {
            $this->model->deleteNoticia($id);
        }
        $this->viewAdmin->showAdminLocation();
    }

    // Se eliminar una noticia segun sección.
    function deleteNoticiaPorSeccion($id)
    {
        $this->authHelper->checkLoggedIn();
        if ($id > 0 &&  $this->authHelper->isAdmin() === 'true') {
            $this->model->deleteNoticiaPorSeccion($id);
            $this->seccionesModel->deleteSeccion($id);
        }
        $this->viewAdmin->showAdminLocation();
    }

    // Se actualiza una nueva noticia.
    public function updateNoticia($id_noticia)
    {
        $this->authHelper->checkLoggedIn();
        if (!empty($_POST['titulo']) && !empty($_POST['detalle']) && !empty($_POST['secciones'] && $id_noticia > 0)) {
            $this->model->updateNoticia($_POST['titulo'], $_POST['detalle'], $_POST['secciones'], $id_noticia);
        }
        $this->viewAdmin->showAdminLocation();
    }
}
