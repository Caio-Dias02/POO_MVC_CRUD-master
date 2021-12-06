<?php

class Core
{

    public function start($urlGet)
    {

        $acao = 'index';

        if (isset($urlGet['pagina'])) {
            $controller = ucfirst($urlGet['pagina'] . 'Controller');
        } else {
            $controller = 'HomeController';
        }

        if (!class_exists($controller)) {
            $controller = 'ERROCONTROLLER';
        }

        #Função que chame a HomeController e o metodo dela!(Chama funções de forma dinamica)
        call_user_func_array(array(new $controller, $acao), array());
    }
}
