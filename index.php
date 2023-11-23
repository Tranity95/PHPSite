<?php
declare(strict_types=1);

require('vendor/autoload.php');


//use NoahBuscher\Macaw\Macaw;
use FastRoute\RouteCollector;


$container = require __DIR__ . '/../app/bootstrap.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

use Opis\Database\Database;
use Opis\Database\Connection;
use Psr\Container\ContainerInterface;
use function DI\factory;

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->useAutowiring(false);
$containerBuilder->useAttributes(false);
$containerBuilder->addDefinitions('config/config.php');
$container = $containerBuilder->build();
/*
echo '<pre>';
echo var_dump($_REQUEST);
echo '</pre>';
include('tables-data.php');
*/
$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\FrontEndController', 'articleList']);
    $r->addRoute('GET', 'article/(:num)', ['App\FrontEndController','/singleArticle']);
    $r->addRoute('GET', 'admin', ['App\BackEndController', '/adminPage']);
    $r->addRoute('GET', 'admin/articles', ['App\BackEndController', '/adminArticlesPage']);
    $r->addRoute('POST', 'admin/update', ['App\BackEndController', '/adminUpdateArticle']);
    $r->addRoute('GET', 'admin/article/edit/(:num)', ['App\BackEndController', '/adminEditArticle']);
    $r->addRoute('GET', 'admin/article/create', ['App\BackEndController', '/adminCreateArticle']);
    $r->addRoute('GET', 'admin/article/delete/(:num)', ['App\BackEndController', '/adminDeleteArticle']);


/*
    // {id} must be a number (\d+)
    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
    // The /{title} suffix is optional
    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
*/
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);

}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
case  FastRoute\Dispatcher::NOT_FOUND:
    // ... 404 Not Found
break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        list($class, $method) = explode("/", $handler, 2);
        call_user_func_array(array(new $class, $method), $vars);
        break;
}

/*
Macaw::get('/', 'App\FrontEndController@articleList');
Macaw::get('article/(:num)', 'App\FrontEndController@singleArticle');
Macaw::get('admin', 'App\BackEndController@adminPage');
Macaw::get('admin/articles', 'App\BackEndController@adminArticlesPage');
Macaw::post('admin/update', 'App\BackEndController@adminUpdateArticle');
Macaw::get('admin/article/edit/(:num)', 'App\BackEndController@adminEditArticle');
Macaw::get('admin/article/create', 'App\BackEndController@adminCreateArticle');
Macaw::get('admin/article/delete/(:num)', 'App\BackEndController@adminDeleteArticle');

Macaw::dispatch();
*/