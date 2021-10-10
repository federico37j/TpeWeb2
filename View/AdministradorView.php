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
    function showAdministrador($noticias, $secciones, $respuesta = "")
    {
        $this->smarty->assign('noticias', $noticias);
        $this->smarty->assign('secciones', $secciones);
        $this->smarty->assign('respuesta', $respuesta);
        $this->smarty->display('templates/administrador.tpl');
    }

    //Muestra la noticia 
    public function verNoticiaPopUp($noticias, $secciones, $noticia)
    {
        $this->smarty->assign('noticias', $noticias);
        $this->smarty->assign('noticia', $noticia);
        $this->smarty->assign('secciones', $secciones);
        $this->smarty->assign('activo', 'activo');
        $this->smarty->display('templates/administrador.tpl');
    }

    //Muestra la noticia 
    public function verSeccionPopUp($noticias, $secciones, $seccion)
    {
        $this->smarty->assign('noticias', $noticias);
        $this->smarty->assign('secciones', $secciones);
        $this->smarty->assign('seccion', $seccion);
        $this->smarty->assign('mostrar', 'mostrar');
        $this->smarty->display('templates/administrador.tpl');
    }
}
