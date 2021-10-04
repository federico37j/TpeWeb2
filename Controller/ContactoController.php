
<?php
require_once "./View/ContactoView.php";

class ContactoController
{

    private $view;

    public function __construct()
    {
        $this->view = new ContactoView();
    }

    // Se muestra contacto.
    public function showContacto()
    {
        $this->view->showContacto();
    }

    

}
