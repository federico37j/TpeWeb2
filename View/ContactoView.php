<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class ContactoView
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
    }

    // Se muestra contacto
    public function showContacto()
    {
        $this->smarty->display('templates/contacto.tpl');
    }
}
