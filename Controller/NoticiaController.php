
<?php
require_once "./Model/NoticiaModel.php";
require_once "./Model/SeccionModel.php";
require_once "./Model/ComentarioModel.php";
require_once "./View/NoticiaView.php";
require_once "./View/AdministradorView.php";
require_once "./Helpers/AuthHelper.php";

class NoticiaController
{

    private $model;
    private $comentarioModel;
    private $view;
    private $viewAdmin;
    private $secciones;
    private $seccionesModel;
    private $authHelper;

    public function __construct()
    {
        $this->model = new NoticiaModel();
        $this->seccionesModel = new SeccionModel();
        $this->comentarioModel = new ComentarioModel();
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

    // Trae las noticias y se las pasa a la vista.
    public function showAdministrador($respuesta = "")
    {
        $this->authHelper->checkLoggedIn();
        $noticias = $this->model->getNoticias();
        $this->viewAdmin->showAdministrador($noticias, $this->secciones, "", "", $respuesta);
    }

    // Se trae la noticia segun su id y se pasa a la vista.
    public function mostrarNoticia($id)
    {
        if (!empty($id)) {
            $noticias = $this->model->getNoticias();
            $noticia = $this->model->getNoticia($id);
            $this->view->showNoticias($noticias, $this->secciones, $noticia, "mostrar");
        }
    }

    public function mostrarNoticiaPorId($id)
    {
        $this->authHelper->checkLoggedIn();
        if ($id > 0) {
            $noticias = $this->model->getNoticias();
            $noticia = $this->model->getNoticia($id);
            $this->viewAdmin->showAdministrador($noticias, $this->secciones, $noticia, "", "editarNoticia");
        }
    }

    // Se trae la sección segun su id y se pasa a la vista.
    public function mostrarSeccionPorId($id)
    {
        $this->authHelper->checkLoggedIn();
        if ($id > 0) {
            $noticias = $this->model->getNoticias();
            $seccion = $this->seccionesModel->getSeccion($id);
            $this->viewAdmin->showAdministrador($noticias, $this->secciones, "", $seccion, "editarSeccion");
        }
    }

    // Se obtiene la lista de noticias según la seccion y se las pasa a la vista.
    public function getNoticiaBySeccion($id_seccion)
    {
        if (!empty($id_seccion)) {
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
        if ($id > 0 &&  $this->authHelper->isAdmin() == 1) {
            $this->model->deleteNoticia($id);
        }
        $this->viewAdmin->showAdminLocation();
    }

    // Se eliminar una noticia segun sección.
    function deleteNoticiaPorSeccion($id)
    {
        if ($id > 0 &&  $this->authHelper->isAdmin() == 1) {
            $noticias = $this->model->getNoticiaBySeccion($id);
            foreach ($noticias as $noticia) {
                $this->comentarioModel->deleteComentarioByIdNoticia($noticia->id_noticia);
            }
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
