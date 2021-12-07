<?php
require_once('app/Core/core.php');
require_once('app/Controller/HomeController.php');
require_once('app/Controller/ErroController.php');
require_once('app/Controller/PostController.php');
require_once('app/model/postagem.php');
require_once('lib/Database/Connection.php');
require_once('vendor/autoload.php');
require_once('app/model/comentario.php');
require_once('app/Controller/SobreController.php');

$template = file_get_contents('app/Template/estrutura.html');

#Armazenar toda a saida do navegador, vai armazenar e jogar na variavel "saida"
ob_start();
$core = new Core;
$core->start($_GET);

$saida = ob_get_contents();
ob_end_clean();
#metodo que troca a string que voce quer mudar, nesse caso trocamos a area_dinamica que esta localizada no template por saida
$tplPronto = str_replace('{{area_dinamica}}', $saida, $template);

echo $tplPronto;
