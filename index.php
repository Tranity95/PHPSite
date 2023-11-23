<?php
declare(strict_types=1);

require('vendor/autoload.php');


use FastRoute\RouteCollector;
use Opis\Database\Connection;
use Opis\Database\Database;
use Psr\Container\ContainerInterface;
use function DI\factory;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//$container = require __DIR__ . '/../app/bootstrap.php';



$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->useAutowiring(false);
$containerBuilder->useAttributes(false);
$containerBuilder->addDefinitions('config/config.php');
$container = $containerBuilder->build();

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\FrontEndController', 'articleList']);
    $r->addRoute('GET', 'article/(:num)', ['App\FrontEndController', '/singleArticle']);
    $r->addRoute('GET', 'admin', ['App\BackEndController', '/adminPage']);
    $r->addRoute('GET', 'admin/articles', ['App\BackEndController', '/adminArticlesPage']);
    $r->addRoute('POST', 'admin/update', ['App\BackEndController', '/adminUpdateArticle']);
    $r->addRoute('GET', 'admin/article/edit/(:num)', ['App\BackEndController', '/adminEditArticle']);
    $r->addRoute('GET', 'admin/article/create', ['App\BackEndController', '/adminCreateArticle']);
    $r->addRoute('GET', 'admin/article/delete/(:num)', ['App\BackEndController', '/adminDeleteArticle']);


});
$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo '405 Method Not Allowed';
        break;

    case FastRoute\Dispatcher::FOUND:
        $controller = $route[1];
        $parameters = $route[2];

        // We could do $container->get($controller) but $container->call()
        // does that automatically
        $container->call($controller, $parameters);
        break;
}
//
//$httpMethod = $_SERVER['REQUEST_METHOD'];
//$uri = $_SERVER['REQUEST_URI'];
//
//if (false !== $pos = strpos($uri, '?')) {
//    $uri = substr($uri, 0, $pos);
//
//}
//$uri = rawurldecode($uri);
//
//$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
//
//switch ($routeInfo[0]) {
//    case  FastRoute\Dispatcher::NOT_FOUND:
//        // ... 404 Not Found
//        break;
//    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
//        $allowedMethods = $routeInfo[1];
//        break;
//    case FastRoute\Dispatcher::FOUND:
//        $handler = $routeInfo[1];
//        $vars = $routeInfo[2];
//        list($class, $method) = explode("/", $handler, 2);
//        call_user_func_array(array(new $class, $method), $vars);
//        break;
//}

