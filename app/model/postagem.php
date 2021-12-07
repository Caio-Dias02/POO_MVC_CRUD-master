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
        } else {
            $resultado->comentarios = Comentario::selecionarComentarios($resultado->id);
        }
        return $resultado;
    }

    public static function inserir($dadosPost)
    {

        if (empty($dadosPost['titulo']) or empty($dadosPost['conteudo'])) {
            throw new Exception("Preencha todos os campos");

            return false;
        } else {
            $con = Connection::getConn();

            $sql = 'INSERT INTO postagem(titulo, conteudo) VALUES(:tit, :cont)';
            $sql = $con->prepare($sql);

            #Trocar os valores
            $sql->bindValue(':tit', $dadosPost['titulo']);
            $sql->bindValue(':cont', $dadosPost['conteudo']);
            $res = $sql->execute();

            if($res == 0){
                throw new Exception("Falha ao inserir publicação");

                return false;
            }

                return True;

        }
    }
}
