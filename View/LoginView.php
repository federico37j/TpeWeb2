<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class LoginView
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
    }

    // Se muestra el login
    public function showLogin($error = "", $exito = "")
    {
        $this->smarty->assign('error', $error);
        $this->smarty->assign('exito', $exito);
        $this->smarty->display('templates/login.tpl');
    }

    // Relocalización al admin
    public function showAdminLocation()
    {
        header("Location: " . BASE_URL . "admin");
    }
}
