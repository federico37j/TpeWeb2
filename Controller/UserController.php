
<?php
require_once "./Model/UserModel.php";
require_once "./Model/ComentarioModel.php";
require_once "./View/UserView.php";

class UserController
{

    private $view;
    private $model;
    private $comentarioModel;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->comentarioModel = new ComentarioModel();
        $this->view = new UserView();
    }

    public function showUsers()
    {
        $usuarios = $this->model->getAllUsers();
        $this->view->showUsuarios($usuarios);
    }

    function modificarRol($id_user)
    {
        $user = $this->model->getUserById($id_user);
        $rol = $user->id_rol;
        if ($rol == 1) {
            session_start();
            if($user->email !== $_SESSION['EMAIL']){
                $usuarioComun = 2;
                $this->model->updateUserRole($id_user, $usuarioComun);
            }
        } else {
            $usuarioAdmin = 1;
            $this->model->updateUserRole($id_user, $usuarioAdmin);
        }
        $this->showUsers();
    }

    function deleteUser($id_user){
        if(!empty($id_user)){
            //Valido que el usuario exista.
            $user = $this->model->getUserById($id_user);
            //Valido que el usuario sea el administrador y que no se quiera eliminar a el mismo.
            session_start();
            if ($user->email !== $_SESSION['EMAIL']){
                $this->comentarioModel->deleteComentarioByUsuario($id_user);
                $this->model->deleteUser($id_user);
            }    
            $this->showUsers();
        }  
    }

}
