<?php
require 'config.php';
require 'dao/UsuariosDaoMysql.php';

$usuarioDao = new UsuariosDaoMysql($pdo);
$lista = $usuarioDao->findAll();

?>

<a href="adicionar.php">ADICIONAR USUARIO</a>

<table border="2" width="100%">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    <?php
    foreach ($lista as $usuario) : ?>
        <tr>
            <td ><?=$usuario->getId()?></td>
            <td ><?=$usuario->getNome()?></td>
            <td ><?=$usuario->getemail()?></td>
            <td width="20%" align="center">
                <a href="editar.php?id=<?=$usuario->getId()?>">[EDITAR]</a>
                <a href="excluir.php?id=<?=$usuario->getId()?>" onclick="return confirm('Tem certeza que deseja excluir?')">[EXCLUIR]</a>
            </td>

        </tr>
    <?php endforeach; ?>
</table>