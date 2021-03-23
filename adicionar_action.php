<?php

require 'config.php';
require 'dao/UsuariosDaoMysql.php';

$usuarioDao = new UsuariosDaoMysql($pdo);

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($name && $email) {

    if ($usuarioDao->findByEmail($email) === false) {
        $novoUsuario = new Usuarios;
        $novoUsuario->setNome($name);
        $novoUsuario->setEmail($email);

        $usuarioDao->add($novoUsuario);

        header('Location: index.php');
        exit;
    } else {
        header('Location: adicionar.php');
        exit;
    }
}
