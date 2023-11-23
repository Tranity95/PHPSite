<?php

namespace App;

use App\Service\ArticleService;
use App\View;
use App\Models;

class FrontEndController
{
    private $articleService;
    private \App\View $view;

    public function __construct(ArticleService $articleService, View $view)
    {
        $this->articleService = $articleService;
        $this->view = $view;
    }

    public function articleList()
    {
        $articles = $this->articleService->index();
        $this->view->showArticleList($articles);
    }

    public function singleArticle($id)
    {
        $article = $this->model->getById((int)$id);
        $this->view->showSingleArticle($article);
    }

}