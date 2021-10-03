<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';
require_once "./Helpers/AuthHelper.php";

class NoticiaView
{
    private $smarty;
    private $authHelper;

    public function __construct()
    {
        // Se instancia a Smarty
        $this->smarty = new Smarty();

        $this->authHelper = new AuthHelper();
    }

    // Se listan todas las noticias
    public function showNoticias($noticias, $secciones)
    {
        $this->smarty->assign('noticias', $noticias);
        $this->smarty->assign('secciones', $secciones);
        $this->smarty->assign('rol', $this->authHelper->isAdmin());
        $this->smarty->display('templates/noticiaList.tpl');
    }

    //Muestra la noticia 
    public function verNoticia($noticia, $noticias, $secciones)
    {
        $this->smarty->assign('noticias', $noticias);
        $this->smarty->assign('secciones', $secciones);
        $this->smarty->assign('active', "activo");
        $this->smarty->assign('rol', $this->authHelper->isAdmin());
        $this->smarty->assign('noticia', $noticia);
        $this->smarty->display('templates/noticiaList.tpl');
    }

    // Relocalización a Home
    function showHomeLocation()
    {
        header("Location: " . BASE_URL . "home");
    }
}
