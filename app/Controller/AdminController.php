<?php

class AdminController
{
    public function index()
    {
        #Vai carregar as pastas aonde tem a View                           
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('admin.html');

        $objPostagens = Postagem::selecionaTodos();
        $parametros = array();
        $parametros['postagens'] = $objPostagens;

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function create()
    {
        #Vai carregar as pastas aonde tem a View                           
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');


        $objPostagens = Postagem::selecionaTodos();

        $parametros = array();
        $parametros['postagens'] = $objPostagens;

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function insert()
    {
        try {
            Postagem::inserir($_POST);

            echo '<script>alert("Publicação inserida com sucesso!");</script>';
            echo '<script>location.href="http://localhost/POO_MVC_CRUD-master/?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost/POO_MVC_CRUD-master/?pagina=admin&metodo=create"</script>';
        }
    }

    public function change($paramId)
    {
        #Vai carregar as pastas aonde tem a View                           
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');

        $post = Postagem::selecionaPorId($paramId);

        $parametros = array();
        $parametros['id'] = $post->id;
        $parametros['titulo'] = $post->titulo;
        $parametros['conteudo'] = $post->conteudo;

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function update()
    {
        try {

            Postagem::update($_POST);

            echo '<script>alert("Publicação alterada com sucesso!");</script>';
            echo '<script>location.href="http://localhost/POO_MVC_CRUD-master/?pagina=home"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost/POO_MVC_CRUD-master/?pagina=admin&metodo=change&id=' . $_POST['id'] . '"</script>';
        }
    }

    public function delete($paramId)
    {
        try {
            Postagem::delete($paramId);

            echo '<script>alert("Publicação deletada com sucesso!");</script>';
            echo '<script>location.href="http://localhost/POO_MVC_CRUD-master/?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost/POO_MVC_CRUD-master/?pagina=admin&metodo=index"</script>';
        }
    }
}
