<?php

require 'config.php';
require 'dao/UsuariosDaoMysql.php';

$usuarioDao = new UsuariosDaoMysql($pdo);

$id = filter_input(INPUT_POST, 'id');
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($id && $name && $email) {

    $usuario = new Usuarios();
    $usuario->setId($id);
    $usuario->setNome($name);
    $usuario->setEmail($email);

    $usuarioDao->update($usuario);

    header('Location: index.php');
    exit;
} else {
    header("Location: adicionar.php?id=".$id);
    exit;
}
