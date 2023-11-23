<?php
namespace App\Models;
use Opis\Database\Database;
use Opis\Database\Connection;

abstract class Model
{
    protected $db;
    protected $table;

    public function __construt($conn, $tbName)
    {
        $connection = $conn;
        $connection->options([
            PDO::ATTR_PERSISTENT => true,
            PDO::FETCH_ASSOC => true,
            PDO::ERRMODE_EXCEPTION => true
        ]);
        $this->db = $conn;
        $this->table = $tbName;
    }

    public function getAll(): array
    {
        return $this->db->from($this->table)
            ->select()
            ->fetchAssoc()
            ->all();
    }

    public function getById($id)
    {
        return $this->db->from($this->table)
            ->where('id')->is($id)
            ->select()
            ->fetchAssoc()
            ->all();
    }
    public function delete($id)
    {
         $this->db->from($this->table)
            ->where('id')->is($id)
            ->delete();
    }
    public function edit($id, $article)
    {
        $this->db->update($this->table)->from($this->table)
            ->where('id')->is($id)
            ->set(array(
                'title'=>$article['title'],
                'image'=>$article['image'],
                'content'=>$article['content'],
            ));
    }
    public function add($article)
    {
        $this->db->insert(array(
            'title'=>$article['title'],
            'image'=>$article['image'],
            'content'=>$article['content'],
        ))->into($this->table);
    }
}