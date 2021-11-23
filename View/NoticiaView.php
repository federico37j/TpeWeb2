<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';
require_once "./Helpers/AuthHelper.php";

class NoticiaView
{
    private $smarty;
    private $rol;
    private $id_usuario;
    private $authHelper;

    public function __construct()
    {
        // Se instancia a Smarty
        $this->smarty = new Smarty();
        $this->authHelper = new AuthHelper();
        $this->rol = 0;
        $this->id_usuario = 0;
    }

    // Se listan todas las noticias
    public function showNoticias($noticias, $secciones, $noticia = "", $mostrar = "",$nroPagMax = "", $nroPagina = 1)
    {   
        $this->smarty->assign('noticias', $noticias);
        $this->smarty->assign('secciones', $secciones);
        $this->smarty->assign('active', $mostrar);
        // Valido si el usuario es admin o usuario normal.
        if ($this->authHelper->isAdmin() == 1) {
            $this->rol = "admin";
        } else if ($this->authHelper->isAdmin() == 2) {
            $this->rol = "usuarioComun";
        }
        $this->smarty->assign('rol', $this->rol);
        $this->smarty->assign('noticia', $noticia);
        // Obtengo el id del usuario
        if ($this->authHelper->getIdUsuario()) {
            $this->id_usuario = $this->authHelper->getIdUsuario();
        }
        $this->smarty->assign('nroPagMax', $nroPagMax);
        $this->smarty->assign('nroPagina', $nroPagina);
        $this->smarty->assign('usuario',  $this->id_usuario);
        $this->smarty->display('templates/noticiaList.tpl');
    }

    // Relocalización a Home
    function showHomeLocation()
    {
        header("Location: " . BASE_URL . "home");
    }
}
