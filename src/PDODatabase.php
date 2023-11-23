<?php
namespace App;
use PDO;
class PDODatabase
{
    public PDO $conn;
    public
    function __construct()
    {
        try {
            // подключаемся к серверу
            $this->conn = new PDO("mysql:host=localhost;dbname=ArticleDB", "admin", "admin");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Database connection established";
        }
        catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getArticles()
    {
        $stmt = $this->conn->prepare("SELECT * FROM Article");
        $stmt->execute();
        $articles=[];
        foreach($stmt as $row){
            $article["id"] = $row["id"];
            $article["title"] = $row["title"];
            $article["content"] = $row["content"];
            $article["image"] = $row["image"];
            array_push($articles, $article);
        }
        return $articles;
    }

    public function getArticleById(int $id){
        $stmt = $this->conn->prepare("SELECT * FROM Article WHERE id=?");
        $stmt->execute(array($id));
        foreach($stmt as $row){
            $article["id"] = $row["id"];
            $article["title"] = $row["title"];
            $article["content"] = $row["content"];
            $article["image"] = $row["image"];
            return $article;
        }
        return null;
    }

    public function saveArticles($articles){
        foreach ($articles as $article){
            $stmt = $this->conn->prepare("UPDATE Article SET title=?, content=?, image=?");
            $stmt->execute([$article["title"],$article["content"], $article["image"]]);

        }
    }

    public function DeleteArticle($id)
    {
        $sql = "DELETE FROM Article WHERE id=?";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    public  function addArticle($article)
    {
        $stmt = $this->conn->prepare("INSERT INTO Article(title, content, image) VALUES(?, ?, ?)");
        $stmt->execute([$article["title"], $article["content"], $article["image"]]);
    }
}