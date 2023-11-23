<?php
namespace App\Model;



use Opis\Database\Database;

class ArticleModel extends CoreModel implements ModelInterface {


    /**
     * ArticleModel constructor.
     */
    public function __construct(Database $db)
    {
        parent::__construct($db);
        $this->setTable('articles');
    }
}