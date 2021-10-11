<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class AdministradorView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty();
    }

    // Se muestra el Administrador
    function showAdministrador($noticias, $secciones, $noticia = "", $seccion = "", $mostrar = "", $respuesta = "")
    {
        $this->smarty->assign('noticias', $noticias);
        $this->smarty->assign('noticia', $noticia);
        $this->smarty->assign('secciones', $secciones);
        $this->smarty->assign('seccion', $seccion);
        $this->smarty->assign('mostrar', $mostrar);
        $this->smarty->assign('respuesta', $respuesta);
        $this->smarty->display('templates/administrador.tpl');
    }

    // Relocalización a Admin
    function showAdminLocation()
    {
        header("Location: " . BASE_URL . "admin");
    }
}
