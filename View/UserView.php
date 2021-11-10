<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class UserView
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
    }

    // Se muestran los usuarios
    public function showUsuarios($usuarios)
    {
        $this->smarty->assign('usuarios', $usuarios);
        $this->smarty->display('templates/usuarios.tpl');
    }

}
