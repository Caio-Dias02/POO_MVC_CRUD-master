<?php

class Postagem
{
    public static function selecionaTodos()
    {


        $con = Connection::getConn();

        $sql = "SELECT * FROM postagem ORDER BY titulo DESC";
        #Vai preparar a execução do sql
        $sql = $con->prepare($sql);
        $sql->execute();

        $resultado = array();

        #Vai listar tudo que foi encontrado no sql
        // var_dump($sql->fetchAll());

        #Vai pegar os registros do banco e transformar em objeto da classe Postagem
        while ($row = $sql->fetchObject('Postagem')) {
            $resultado[] = $row;
        }

        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco");
        }

        return $resultado;
    }

    public static function selecionaPorId($idPost)
    {

        $con = Connection::getConn();

        $sql = "SELECT * from postagem where id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject('Postagem');

        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco");
        }

        return $resultado;
    }
}
