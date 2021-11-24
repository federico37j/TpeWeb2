<?php
require_once "./Helpers/AuthHelper.php";

class NoticiaView
{
    private $smarty;
    private $rol;

    public function __construct()
    {
        // Se instancia a Smarty
        $this->smarty = new Smarty();
        $this->rol = "";
    }

    // Se listan todas las noticias
    public function showNoticias($noticias, $secciones, $isAdmin, $id_usuario, $noticia = "", $mostrar = "", $nroPagMax = "", $nroPagina = 1)
    {
        $this->smarty->assign('noticias', $noticias);
        $this->smarty->assign('secciones', $secciones);
        $this->smarty->assign('active', $mostrar);
        // Valido si el usuario es admin o usuario normal.
        if ($isAdmin == 1) {
            $this->rol = "admin";
        } else if ($isAdmin == 2) {
            $this->rol = "usuarioComun";
        }
        $this->smarty->assign('rol', $this->rol);
        $this->smarty->assign('noticia', $noticia);
        $this->smarty->assign('nroPagMax', $nroPagMax);
        $this->smarty->assign('nroPagina', $nroPagina);
        $this->smarty->assign('usuario',  $id_usuario);
        $this->smarty->display('templates/noticiaList.tpl');
    }

    // Relocalización a Home
    function showHomeLocation()
    {
        header("Location: " . BASE_URL . "home");
    }
}
