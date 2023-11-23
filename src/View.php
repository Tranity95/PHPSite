<?php
declare(strict_types=1);
namespace App;
class View {
    public $loader;
    public $twig;
    public function __construct()
    {
        $this->loader = new \Twig\Loader\FilesystemLoader('template');
        $this->twig = new \Twig\Environment($this->loader, []);
    }
    public function showArticleList($articles)
    {
        echo $this->twig->render('blog-list.twig', ['articles'=>$articles]);
    }
    public function showSingleArticle($article)
    {
        echo $this->twig->render('blog-single.twig', ['article'=>$article]);
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