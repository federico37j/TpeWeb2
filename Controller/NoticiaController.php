
<?php
require_once "./Model/NoticiaModel.php";
require_once "./Controller/SeccionController.php";
require_once "./View/NoticiaView.php";
require_once "./Controller/AdministradorController.php";
require_once "./Helpers/AuthHelper.php";

class NoticiaController
{

    private $model;
    private $view;
    private $controllerAdmin;
    private $secciones;
    private $authHelper;

    public function __construct()
    {
        $this->model = new NoticiaModel();
        $this->seccionController = new SeccionController();
        $this->view = new NoticiaView();
        $this->controllerAdmin = new AdministradorController();
        $this->authHelper = new AuthHelper();
        $this->secciones = $this->seccionController->getSecciones();
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
        $noticias = $this->model->getNoticias();
        $noticia = $this->model->getNoticia($id);
        $this->view->verNoticia($noticia, $noticias, $this->secciones);
    }

    // Se obtiene la lista de noticias según la seccion y se las pasa a la vista.
    public function getNoticiaBySeccion($id_seccion)
    {
        $noticias = $this->model->getNoticiaBySeccion($id_seccion);
        $this->view->showNoticias($noticias, $this->secciones);
    }

    // Se inserta una nueva noticia.
    public function createNoticia()
    {
        $this->model->insertNoticia($_POST['titulo'], $_POST['detalle'], $_POST['fecha'], $_POST['secciones']);
        $this->controllerAdmin->showAdministrador();
    }

    // Se eliminar una noticia segun el id.
    function deleteNoticia($id)
    {
        // try {
            $respuesta = $this->model->deleteNoticia($id);
            $this->controllerAdmin->showAdministrador($respuesta);
        // } catch (Exception $error) {
        //     echo $error . "Fallo". $respuesta ;
        // }
    }

    // Se inserta una nueva noticia.
    public function updateNoticia($id_noticia)
    {
        $this->model->updateNoticia($_POST['titulo'], $_POST['detalle'], $_POST['secciones'], $id_noticia);
        $this->controllerAdmin->showAdministrador();
    }
}
