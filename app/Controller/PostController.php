<?php

class PostController
{
    public function index($params)
    {
        try {

            $postagem =  Postagem::selecionaPorId($params);
            #Vai carregar as pastas aonde tem a View                           
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('single.html');

            // var_dump($postagem);

            $parametros = array();
            $parametros['titulo'] = $postagem->titulo;
            $parametros['conteudo'] = $postagem->conteudo;
            $parametros['comentarios'] = $postagem->comentarios;


            $conteudo = $template->render($parametros);
            echo $conteudo;



            // var_dump($colecPostagens);
 
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
