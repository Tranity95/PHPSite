<?php
namespace App;
use App\View;
use App\Models;
class BackEndController
{
    private Models\ArticleModel $model;
    private \App\View $view;

    public function __construct()
    {
        $this->model = new Models\ArticleModel();
        $this->model->__construt("Article");
        $this->view = new \App\View();
    }

    public function adminPage()
    {
        $this->view->showAdmin();
    }
    public function adminArticlesPage()
    {
        $articles = $this->model->getArticles();
        $this->view->showArticles($articles);
    }
    public function adminEditArticle($id)
    {
        //if($id!="0"){
            $article = $this->model->getById($id);
        //}
//        else{
//            $articles = $this->model->getArticles();
//            $article['id']=end($articles)['id'];
//            //$article['id']=array_search(max($articles), $articles) + 1;
//        }
        $this->view->showAdminEditArticle($article);
    }
    public function adminCreateArticle()
    {
        $article =[];
        $this->view->showAdminEditArticle($article);
    }
    public function adminDeleteArticle($id)
    {
        $this->model->delete($id);
        $this->adminArticlesPage();
    }
    public function adminUpdateArticle()
    {

        $id=$_POST['id'];
        $title=$_POST['title'];
        $content=$_POST['content'];
        $image=$_POST['image'];

        if(!empty($id)){
            $articles = $this->model->getById($id);
            $articles['title']=$title;
            $articles['content']=$content;
            $articles['image']=$image;
            $this->model->edit($id, $articles);
        }
        else{
            $article = [
                'title' => $title,
                'image' => "images/repey.jpg",
                'content' => $content
            ];
            $this->model->add($article);

            //$id=array_search($article,$articles);
        }
        $this->adminEditArticle((int)$id);


    }
}