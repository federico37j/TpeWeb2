
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
            //El nuevo usuario siempre será un usuario normal
            $usuarioComun = 2;
            $id = $this->model->insertRegistro($userEmail, $userPassword, $usuarioComun);
            if ($id) {
                // Cuando registro un usuario, se le redirige a la página correspondiente a su rol.
                $this->autenticar();
            } else {
                // Si no se pudo registrar el usuario, se le muestra un mensaje de error.
                $this->view->showLogin("Error al registrar el usuario");
            }
        }
    }

    // Se busca si coinciden los datos de la bd con los entrantes.
    public function autenticar()
    {
        // Valido que los campos no estén vacíos
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $userEmail = $_POST['email'];
            $userPassword = $_POST['password'];

            // Busco el usuario en la bd segun el email
            $user = $this->model->autenticar($userEmail);

            // Verifico que el usuario exista y que la contraseña coincida
            if ($user && password_verify($userPassword, ($user->password))) {
                // Si el usuario existe y la contraseña coincide, lo guardo en la sesión
                session_start();
                $_SESSION['EMAIL'] = $user->email;
                $_SESSION['ROL'] = $user->id_rol;
                $_SESSION['ID_USUARIO'] = $user->id_usuario;

                // Redirijo al usuario a la página del administrador
                $this->view->showAdminLocation();
            } else {
                // Si no existe el usuario o la contraseña no coincide, muestro el error
                $this->view->showLogin("Nombre de usuario o contraseña incorrecta");
            }
        }
    }
}
