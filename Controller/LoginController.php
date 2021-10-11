
<?php
require_once "./Model/UserModel.php";
require_once "./View/LoginView.php";

class LoginController
{

    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->view = new LoginView();
    }

    // Se muestra el Login
    public function showLogin()
    {
        $this->view->showLogin();
    }

    // Se registra un nuevo usuario por defecto sin rol admin.
    public function registrarUsuario()
    {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $userEmail = $_POST['email'];
            $userPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $this->model->insertRegistro($userEmail, $userPassword);
            $this->view->showLogin("", "Usuario registrado");
        }
    }

    // Se busca si coinciden los datos de la bd con los entrantes.
    public function autenticar()
    {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $userEmail = $_POST['email'];
            $userPassword = $_POST['password'];

            $user = $this->model->autenticar($userEmail);
            if ($user && password_verify($userPassword, ($user->password))) {

                session_start();
                $_SESSION['EMAIL'] = $user->email;
                $_SESSION['ROL'] = $user->rol;
                $this->view->showAdminLocation();
            } else {
                $this->view->showLogin("Nombre de usuario o contraseña incorrecta");
            }
        }
    }

}
