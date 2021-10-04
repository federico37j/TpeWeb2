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
    function showAdministrador($noticias, $secciones)
    {
        $this->smarty->assign('noticias', $noticias);
        $this->smarty->assign('secciones', $secciones);
        $this->smarty->display('templates/administrador.tpl');
    }

    //Muestra la noticia 
    public function verNoticiaAdmin($noticias, $secciones, $noticia_id = "", $seccion_id = "")
    {
        $this->smarty->assign('noticias', $noticias);
        $this->smarty->assign('noticia', $noticia_id);
        $this->smarty->assign('secciones', $secciones);
        $this->smarty->assign('activo', 'activo');
        $this->smarty->display('templates/administrador.tpl');
    }
}
