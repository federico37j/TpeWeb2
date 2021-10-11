<?php

class UserModel
{
    private $bd;

    public function __construct()
    {
        $this->bd = new PDO('mysql:host=localhost;' . 'dbname=db_eleco;charset=utf8', 'root', '');
    }

    // Inserta un usuario nuevo.
    public function insertRegistro($userEmail, $userPassword)
    {
        $sentencia = $this->bd->prepare('INSERT INTO usuario (email, password) VALUES (? , ?)');
        $sentencia->execute(array($userEmail, $userPassword));
    }

    // Trae el usuario que coincide con ese mail.
    public function autenticar($userEmail)
    {
        $sentencia = $this->bd->prepare('SELECT * FROM usuario WHERE email = ?');
        $sentencia->execute(array($userEmail));
        $user = $sentencia->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}
