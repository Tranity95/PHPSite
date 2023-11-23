<?php
$data = json_decode(file_get_contents('articles.json'), true);
$article = json_decode($_REQUEST);
$id = $_REQUEST['req'];
echo $article;
if($article.type=='edit')
{
    $_REQUEST['id'];
}
elseif ($article.type=='delete')
{
    array_splice($data, json_decode($article.content).id, 1);
    $fd = fopen('articles.json', 'w');
    fwrite($fd, json_encode($data));
    fclose($fd);
}
