<?php

class AuthHelper
{
    public function __construct()
    {
    }

    // Chequea si EMAIL no esta vacio o si el rol es distinto al el admin.
    public function checkLoggedIn()
    {
        session_start();
        if (!isset($_SESSION['EMAIL']) || !$_SESSION['ROL'] == 1) {
            session_abort();
            $this->showHomeLocation();
        }
    }

    // Se destruye la session del usuario.
    public function logout()
    {
        session_start();
        session_destroy();
        $this->showHomeLocation();
    }

    // Retorna si el usuario es admin.
    public function isAdmin()
    {
        $respuesta = "false";
        session_start();
        if (!empty($_SESSION['ROL'])) {
            if ($_SESSION['ROL'] == 1) {
                $respuesta = "true";
            } else {
                $respuesta = "false";
            }
        }
        session_abort();
        return  $respuesta;
    }

    // Relocalización a Home.
    public function showHomeLocation()
    {
        header("Location: " . BASE_URL . "home");
    }
}
