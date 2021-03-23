<?php
require 'config.php';
require 'dao/UsuariosDAOMySql.php';

$usuarioDao = new UsuariosDaoMysql($pdo);

$id = filter_input(INPUT_GET, 'id');

if ($id) {

    $usuarioDao->delete($id);
}
header('Location: index.php');
exit;
