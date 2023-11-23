<?php
namespace App;
use Models\Model;

class HomeController
{
    private $repository;
    private $twig;

    public function __construct(ArticleRepository $repository, Environment $twig)
    {
        $this->repository = $repository;
        $this->twig = $twig;
    }
}