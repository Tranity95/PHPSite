<?php
$table = "";
$data = json_decode(file_get_contents('articles.json'), true);
foreach ($data as $article) {
    echo
    "<tr>
        <td scope='row'>".$article['id']."</td>
        <td>".$article['title']."</td>
        <td>".$article['content']."</td>
        <td>
        <form action='admin_data_edit.php' method='GET'>
            <button type='submit' value='".getValue("edit", $article)."' name = 'req'>Редактировать</button>
            <button type='submit' value='".getValue("delete", $article)."' name= 'req'>Удалить</button>   
        </form>
        </td>
    </tr>";
}
function getValue($type, $content){
    return
        "{
            'type': ".$type.",
            'content': ".json_encode($content)."
        }";
}
echo $table;
