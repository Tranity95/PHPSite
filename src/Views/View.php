<?php
declare(strict_types=1);
namespace App\Views;
class View {
    public $loader;
    public $twig;
    public function __construct($loader, $twig)
    {
        $this->loader = $loader;
        $this->twig = $twig;
    }
    public function showArticleList($articles)
    {
        echo $this->twig->render('blog-list.twig', ['articles'=>$articles]);
    }
    public function showSingleArticle($article)
    {
        echo $this->twig->render('blog-single.twig', ['article'=>$article]);
    }


}