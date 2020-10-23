<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/src/config.php');
if (!isset($page404) || $page404 == false) {

    $sql = "SELECT t.name, t.date, c.name as category, t.status, t.file  FROM task t JOIN category c ON t.category_id = c.id $category";
    $res = $conn->query($sql);
    $arTask = array();
    while ($row = $res->fetch_array()) {
        if ($row['status'] == 0) {
            $row['status'] = false;
        } else {
            $row['status'] = true;
        }
        if (empty($row['date'])) {
            $row['date'] = 'null';
        }
        if (empty($row['file'])) {
            $row['filePath'] = '#';
            $row['fileName'] = 'Home.psd';
        } else {
            $path = explode("/", $row['file']);
            $row['fileName'] = end($path);
            $row['filePath'] = "/upload/".$row['fileName'];
        }
        $arTask[] = $row;
    }
    
    $show_complete_tasks = rand(0, 1);

    $templates = array(
        'arTask' => $arTask,
        'arCategories' => $arCategories,
        'show_complete_tasks' => $show_complete_tasks,
    );
    $content = include_template('main.php', $templates);
    $dataPages = array(
        'content' => $content,
        'title' => 'Дела в порядке',
    );

    print(include_template('layout.php', $dataPages));
} else {
    die('<h1>Ошибка 404 - неправильный адрес страницы</h1>');   // показ ошибки 404
}
