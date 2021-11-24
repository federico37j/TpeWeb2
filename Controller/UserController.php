
<?php
require_once "./Model/UserModel.php";
require_once "./Model/ComentarioModel.php";
require_once "./View/UserView.php";
require_once "./Helpers/AuthHelper.php";

class UserController
{

    private $view;
    private $model;
    private $comentarioModel;
    private $authHelper;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->comentarioModel = new ComentarioModel();
        $this->view = new UserView();
        $this->authHelper = new AuthHelper();
    }

    // Muestro la lista de usuarios.
    public function showUsers()
    {
        $this->authHelper->checkLoggedIn();
        
        $usuarios = $this->model->getAllUsers();
        $this->view->showUsuarios($usuarios);
    }

    //Modifico el rol de un usuario segun el id
    function modificarRol($id_user)
    {
        $this->authHelper->checkLoggedIn();

        $user = $this->model->getUserById($id_user);
        $rol = $user->id_rol;
        if ($rol == 1) {
            session_start();
            if ($user->email !== $_SESSION['EMAIL']) {
                $usuarioComun = 2;
                $this->model->updateUserRole($id_user, $usuarioComun);
            }
            session_abort();
        } else {
            $usuarioAdmin = 1;
            $this->model->updateUserRole($id_user, $usuarioAdmin);
        }
        $this->showUsers();
    }

    // Borro un usuario por el id.
    function deleteUser($id_user)
    {
        $this->authHelper->checkLoggedIn();

        if (!empty($id_user)) {
            //Valido que el usuario exista.
            $user = $this->model->getUserById($id_user);
            //Valido que el usuario sea el administrador y que no se quiera eliminar a el mismo.
            session_start();
            if ($user->email !== $_SESSION['EMAIL']) {
                $this->comentarioModel->deleteComentarioByUsuario($id_user);
                $this->model->deleteUser($id_user);
            }
            session_abort();

            $this->showUsers();
        }
    }
}
