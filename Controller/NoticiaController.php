
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
        // Reviso si tiene seteado algun campo del filtro.
        if (isset($_GET['titulo']) || isset($_GET['detalle']) || isset($_GET['fecha'])) {
            $this->showNoticiasFiltroAvanzado();
        }

        // Sino esta seteado el numero de pagina le asigno el valor 1.
        if (!isset($_GET['nroPagina'])) {
            $nroPagina = 1;
        } else {
            $nroPagina = $_GET['nroPagina'];
        }

        if (is_numeric($nroPagina)) {
            // va de 5 en 5 cada vez que entra una variable.
            $offset = ($nroPagina - 1) * 5;
            // Traigo las noticias segun el paginado.
            $noticias = $this->model->getNoticiasPaginado($offset);
            // Traigo la cantidad de noticias.
            $cantidadTotalNoticias = $this->model->obtenerCantidadDeNoticias();
            // uso ceil para redondear hacia arriba el numero de paginas que se necesitan para mostrar todas las noticias.
            $nroPagMax = ceil($cantidadTotalNoticias / 5);
        }
        $this->view->showNoticias($noticias, $this->secciones, $this->authHelper->isAdmin(), $this->authHelper->getIdUsuario(), "", "", $nroPagMax, $nroPagina);
    }

    // obtener las noticias segun titulo, detalle, fecha
    public function showNoticiasFiltroAvanzado()
    {
        //Se obtienen los datos enviados por POST
        $titulo = $_GET['titulo'];
        $detalle = $_GET['detalle'];
        $fecha = $_GET['fecha'];
        // pregunto si estan seteados 
        if (isset($titulo) || isset($detalle) || isset($fecha)) {
            //Se obtienen las noticias filtradas
            $noticias = $this->model->getNoticiasFiltroAvanzado($titulo, $detalle, $fecha);
            $this->view->showNoticias($noticias, $this->secciones, $this->authHelper->isAdmin(), $this->authHelper->getIdUsuario());
        }
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
            $this->view->showNoticias($noticias, $this->secciones, $this->authHelper->isAdmin(), $this->authHelper->getIdUsuario(), $noticia, "mostrar");
        }
    }

    // Se trae la noticia segun su id y se pasa a la vista.
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
            $this->view->showNoticias($noticias, $this->secciones, $this->authHelper->isAdmin(), $this->authHelper->getIdUsuario());
        }
    }

    // Se inserta una nueva noticia.
    public function createNoticia()
    {
        $this->authHelper->checkLoggedIn();
        if (!empty($_POST['titulo']) && !empty($_POST['detalle']) && !empty($_POST['fecha']) && !empty($_POST['secciones'])) {
            $id_noticia =  $this->model->insertNoticia($_POST['titulo'], $_POST['detalle'], $_POST['fecha'], $_POST['secciones']);

            if ($id_noticia != 0) {
                // Valido si se subio una imagen.
                if (
                    isset($_FILES['image'])  && $_FILES['image']['type'] == "image/jpg" ||
                    $_FILES['image']['type'] == "image/jpeg" ||  $_FILES['image']['type'] == "image/png"
                ) {
                    // Se inserta la imagen.
                    $this->imagenModel->insertarImagen($_FILES['image'], $id_noticia);
                }
            }
        }
        // Se redirige a la vista del administrador.
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
