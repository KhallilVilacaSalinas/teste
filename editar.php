<?php
    require 'config.php';
    require 'dao/UsuariosDaoMysql.php';

    $usuarioDao = new UsuariosDaoMysql($pdo);

    $usuario = false;

    $id = filter_input(INPUT_GET, 'id');

    if ($id){
        $usuario = $usuarioDao->findById($id);
    }

    if ($usuario === false) {
        header('Location: index.php');
        exit;
    }
?>

<div style="
    display: table;
    width: 100%;
    height:85%;" >
    <form style="
        display: table-cell;    
        text-align: center;
        vertical-align: middle;"
        action="editar_action.php" method="POST">
        <h1>Editar Usuario</h1>
            <input type="hidden" name="id" value="<?=$usuario->getId()?>"/>

        <label>
            Nome: <br>
            <input type="text" name="name" value="<?=$usuario->getNome()?>"/>

        </label> <br><br>
        <label>
            Email: <br>
            <input type="email" name="email" value="<?=$usuario->getEmail()?>" />

        </label> <br><br>

        <input type="submit" value="Editar" />
    </form>
</div>