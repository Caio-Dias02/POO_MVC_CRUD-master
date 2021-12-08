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
            $parametros['id'] = $postagem->id;
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

    public function addComent(){
       
        try {
            Comentario::inserir($_POST);
            header('Location: http://localhost/POO_MVC_CRUD-master/?pagina=post&id='.$_POST['id']);
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost/POO_MVC_CRUD-master/?pagina=post&id='. $_POST['id'] . '"</script>';
        }
        
    }
}
