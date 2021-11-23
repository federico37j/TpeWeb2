
<?php
require_once "./Model/NoticiaModel.php";
require_once "./Model/SeccionModel.php";
require_once "./Model/ComentarioModel.php";
require_once "./Model/ImagenModel.php";
require_once "./View/NoticiaView.php";
require_once "./View/AdministradorView.php";
require_once "./Helpers/AuthHelper.php";

class NoticiaController
{
    private $model;
    private $imagenModel;
    private $comentarioModel;
    private $seccionesModel;
    private $view;
    private $viewAdmin;
    private $secciones;
    private $authHelper;

    public function __construct()
    {
        $this->model = new NoticiaModel();
        $this->seccionesModel = new SeccionModel();
        $this->comentarioModel = new ComentarioModel();
        $this->imagenModel = new ImagenModel();
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

    // obtener las noticias segun titulo, detalle, fecha
    public function showNoticiasFiltroAvanzado()
    {
        //Se obtienen los datos enviados por POST
        $titulo = $_POST['titulo'];
        $detalle = $_POST['detalle'];
        $fecha = $_POST['fecha'];

        //Se obtienen las noticias filtradas
        $noticias = $this->model->getNoticiasFiltroAvanzado($titulo, $detalle, $fecha);
        $this->view->showNoticias($noticias, $this->secciones);
    }

    // obtener noticias por paginado.
    public function showNoticiasPaginado($paginas)
    {
        if ($paginas <= 0) {
            $paginas = 1;
        }
        $noticias = $this->model->getNoticiasPaginado($paginas);
        $this->view->showNoticias($noticias, $this->secciones);
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
            $noticias = $this->model->getNoticiaConSeccion($id_seccion);
            $this->view->showNoticias($noticias, $this->secciones);
        }
    }

    // Se inserta una nueva noticia.
    public function createNoticia()
    {
        $this->authHelper->checkLoggedIn();
        if (!empty($_POST['titulo']) && !empty($_POST['detalle']) && !empty($_POST['fecha']) && !empty($_POST['secciones'])) {
            $id_noticia =  $this->model->insertNoticia($_POST['titulo'], $_POST['detalle'], $_POST['fecha'], $_POST['secciones']);

            if ($id_noticia != 0) {
                // Se guarda el nombre y la ruta de la imagen.
                $img = $_FILES['image']['name'];
                $ruta = $_FILES['image']['tmp_name'];
                $destino = "img/noticias/" . $img;
                // Se mueve la imagen a la carpeta img.
                copy($ruta, $destino);
                // Se insertan las imagenes.
                $this->imagenModel->insertarImagen($img, $id_noticia);
            }
        }
        $this->viewAdmin->showAdminLocation();
    }

    // Se eliminar una noticia segun el id.
    function deleteNoticia($id)
    {
        if ($id > 0 &&  $this->authHelper->isAdmin() == 1) {
            $this->imagenModel->deleteImagenByNoticia($id);
            $this->comentarioModel->deleteComentarioByIdNoticia($id);
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
                $respuestaDeleteImagen =  $this->imagenModel->deleteImagenByNoticia($noticia->id_noticia);
                if ($respuestaDeleteImagen != 0) {
                    $this->comentarioModel->deleteComentarioByIdNoticia($noticia->id_noticia);
                }
            }
            $resultadoDeleteSeccion = $this->model->deleteNoticiaPorSeccion($id);
            if ($resultadoDeleteSeccion != 0) {
                $this->seccionesModel->deleteSeccion($id);
            }
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
