<?php
namespace App;
use App\View;
use App\Models;
class FrontEndController
{
    private Models\ArticleModel $model;
    private \App\View $view;

    public function __construct()
    {
        $this->model = new Models\ArticleModel();
        $this->view = new \App\View();
    }
    public function articleList()
    {
        $articles = $this->model->getAll();
        $this->view->showArticleList($articles);
    }
    public function singleArticle($id)
    {
        $article = $this->model->getById((int)$id);
        $this->view->showSingleArticle($article);
    }

}