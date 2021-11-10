<?php

class UserModel
{
    private $bd;

    public function __construct()
    {
        $this->bd = new PDO('mysql:host=localhost;' . 'dbname=db_eleco;charset=utf8', 'root', '');
    }

    // Traigo todos los usuarios
    public function getAllUsers()
    {
        $sentencia = $this->bd->prepare('SELECT * FROM usuario AS u INNER JOIN rol AS r ON u.id_rol=r.id_rol');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    // Traigo un usuario por su id
    public function getUserById($id)
    {
        $sentencia = $this->bd->prepare('SELECT * FROM usuario AS u INNER JOIN rol AS r ON u.id_rol=r.id_rol WHERE u.id_usuario=?');
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    // Actualizo el rol de un usuario.
    public function updateUserRole($id, $role)
    {
        $sentencia = $this->bd->prepare('UPDATE usuario SET id_rol=? WHERE id_usuario=?');
        $sentencia->execute(array($role, $id));
    }

    // Inserta un usuario nuevo.
    public function insertRegistro($userEmail, $userPassword, $id_rol)
    {
        $sentencia = $this->bd->prepare('INSERT INTO usuario (email, password, id_rol) VALUES (?, ?, ?)');
        $sentencia->execute(array($userEmail, $userPassword, $id_rol));
        return $this->bd->lastInsertId();
    }

    // Borro un usuario.
    public function deleteUser($id)
    {
        $sentencia = $this->bd->prepare('DELETE FROM usuario WHERE id_usuario=?');
        $sentencia->execute(array($id));
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
