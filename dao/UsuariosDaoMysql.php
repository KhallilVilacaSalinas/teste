<?php

require_once 'models/Usuarios.php';

class UsuariosDaoMysql implements UsuariosDAO
{
    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function add(Usuarios $usuarios)
    {

        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");
        $sql->bindValue(':nome', $usuarios->getNome());
        $sql->bindValue(':email', $usuarios->getEmail());
        $sql->execute();

        $usuarios->setId($this->pdo->lastInsertId());
        return $usuarios;
    }
    public function findAll()
    {
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM usuarios ORDER BY id ASC");
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

            foreach ($data as $item) {
                $u = new Usuarios();
                $u->setId($item['id']);
                $u->setNome($item['nome']);
                $u->setEmail($item['email']);

                $array[] = $u;
            }
        }

        return $array;
    }
    public function findByEmail($email)
    {
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $u = new Usuarios();
            $u->setId($data['id']);
            $u->setNome($data['nome']);
            $u->setEmail($data['email']);

            return $u;
        } else {
            return false;
        }
    }
    public function findById($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $data = $sql->fetch();

            $u = new Usuarios();
            $u->setId($data['id']);
            $u->setNome($data['nome']);
            $u->setEmail($data['email']);

            return $u;
        } else {
            return false;
        }
    }
    public function update(Usuarios $usuarios)
    {
        $sql = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id");
        $sql->bindValue(':nome', $usuarios->getNome());
        $sql->bindValue(':email', $usuarios->getEmail());
        $sql->bindValue(':id', $usuarios->getId());
        $sql->execute();

        return true;
    } 
    
    public function delete($id)
    {   
    $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    }
}
