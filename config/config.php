<?php
use App\FrontEndController;
use App\Model\ArticleModel;
use App\Service\ArticleService;
use App\Views\BackView;
use App\Views\View;
use Opis\Database\Connection;
use Opis\Database\Database;

use function DI\create;
use function DI\get;
return [
    'Connection' => create(Connection::class)
        ->constructor(
            $_ENV['DB_DSN'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD']
        ),
    'Database' => create(Database::class)
        ->constructor(
            get('Connection')
        ),
    'ArticleModel' => create(ArticleModel::class)
        ->constructor(
            get('Database')
        ),
    'View' => create(View::class)
        ->constructor(
            get('FrontTwig')
        ),
    'BackView' => create(View::class)
        ->constructor(
            get('BackTwig')
        ),
    'ArticleService' => create(ArticleService::class)
        ->constructor(
            get('ArticleModel')
        ),
    /*
    'UserService' => create(UserService::class)
        ->constructor(
            get('UserModel')
        ),
    */
    FrontEndController::class => create(FrontEndController::class)
        ->constructor(
            get('ArticleService'),
            get('View')
        ),
    BackController::class => create(BackController::class)
        ->constructor(
            get('ArticleService'),
            get('UserService'),
            get('BackView')
        ),
];