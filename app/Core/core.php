<?php

class Core
{

    public function start($urlGet)
    {

        if (isset($urlGet['metodo'])) {
            $acao = $urlGet['metodo'];
        } else {
            $acao = 'index';
        }


        if (isset($urlGet['pagina'])) {
            $controller = ucfirst($urlGet['pagina'] . 'Controller');
        } else {
            $controller = 'HomeController';
        }

        if (!class_exists($controller)) {
            $controller = 'ERROCONTROLLER';
        }

        if (isset($urlGet['id']) && $urlGet['id'] != null) {
            $id = $urlGet['id'];
        } else {
            $id = null;
        }
        #Função que chame a HomeController e o metodo dela!(Chama funções de forma dinamica)
        call_user_func_array(array(new $controller, $acao), array('id' => $id));
    }
}
