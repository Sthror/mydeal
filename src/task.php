<?php

$sql = "SELECT t.name, t.date, c.name as category, t.status, t.file, t.user_id  FROM task t JOIN category c ON t.category_id = c.id WHERE t.user_id = '" . $userID . "'$category";
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
        $row['filePath'] = "/uploads/" . $row['fileName'];
    }
    $arTask[] = $row;
}

$show_complete_tasks = rand(0, 1);

$templates = array(
    'arTask' => $arTask,
    'arCategories' => $arCategories,
    'show_complete_tasks' => $show_complete_tasks,
);
$content = include_template($template, $templates);
$dataPages = array(
    'content' => $content,
    'title' => 'Дела в порядке',
    'auth' => $auth,
);
