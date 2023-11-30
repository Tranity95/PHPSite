<?php


namespace App\Views;


class BackView
{
    public function __construct($loader, $twig)
    {
        $this->loader = $loader;
        $this->twig = $twig;
    }
    public function showAdmin()
    {
        echo $this->twig->render('pages/dashboard.twig',['title'=>'Dashboard']);
    }
    public function showArticles(array $articles)
    {
        echo $this->twig->render('pages/articles.twig',['title'=>'Article','articles'=>$articles]);
    }
    public function showAdminEditArticle($article)
    {
        echo $this->twig->render('pages/articleEdit.twig',['article'=>$article]);
    }
}