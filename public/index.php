<?php
/**
 * @author Fábio Assunção - fabio@fabioassuncao.com.br
 * @version 0.0.1
 * @date February 06, 2016
 * @date updated April 05, 2016
 */

require '../bootstrap.php';

/* Create alias for Router. */
use Babita\Core\Router;

$router = new Router();

/* Define routes. */
$router->get('/', 'Controllers\Home@index');
$router->get('/grupo', 'Controllers\Home@grupo');
$router->get('/parceiros', 'Controllers\Home@parceiros');
$router->get('/cases', 'Controllers\Home@cases');
$router->get('/premios', 'Controllers\Home@premios');
$router->get('/premios/premio-youtube-educacao-digital', 'Controllers\Home@premioyoutube2023');
$router->get('/videos', 'Controllers\Home@videos');
$router->get('/politica-privacidade', 'Controllers\Home@politicaPrivacidade');

$router->get('/projeto-seduc-amazonas', 'Controllers\Home@projeto');

$router->get('/solucoes/iptv', 'Controllers\Home@iptv');
$router->get('/solucoes/myscreen', 'Controllers\Home@myscreen');
$router->get('/solucoes/mylivecom', 'Controllers\Home@mylivecom');
$router->get('/solucoes/myclass', 'Controllers\Home@myclass');
$router->get('/solucoes/syncast', 'Controllers\Home@syncast');
$router->get('/solucoes/studio-pack', 'Controllers\Home@studioPack');

$router->get('/produtora', 'Controllers\Home@produtora');
$router->get('/editora', 'Controllers\Home@editora');

$router->get('/compliance', 'Controllers\Home@compliance');

$router->get('/fale-conosco', 'Controllers\FaleConosco@faleConosco');
//$router->post('/fale-conosco', 'Controllers\FaleConosco@processar');

/* If no route found. */
$router->error('Controllers\Error@index');

/* Turn on old style routing. */
$router->fallback = false;

/* Execute matched routes. */
$router->dispatch();
