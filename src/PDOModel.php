<?php

namespace App;
class Model
{
    public function getArticles(): array
    {
        return $this->database->getArticles();
    }

    public function getArticlesById(int $id): array
    {
        $articleList = $this->getArticles();
        $currentArticle = [];
        foreach ($articleList as $ar) {
            if (array_key_exists($id, $articleList)) {
                $currentArticle = $articleList[$id];
            }
        }
        return $currentArticle;
    }

    public function saveArticles($articles)
    {
        $fp = fopen('articles.json', 'w');
        fwrite($fp, json_encode($articles));
        fclose($fp);
    }
}