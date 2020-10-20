<?php
$conn = new mysqli('localhost','sergey','kokoc2019','mydeal');
if ($conn->connect_errno) {    
    die("<h1>Не удалось подключиться к MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error."</h1>");
}

$sql = "SELECT name FROM category";
$res = $conn->query($sql);
while($row = $res->fetch_array()){
    $arCategories[] = $row['name'];
}

$sql = "SELECT t.name, t.date, c.name as category, t.status  FROM task t JOIN category c ON t.category_id = c.id";
$res = $conn->query($sql);
while($row = $res->fetch_array()){
    if($row['status'] == 0){
        $row['status'] = false;
    } else {
        $row['status'] = true;
    }
    if(empty($row['date'])){
        $row['date'] = 'null';
    }  
    $arTask[] = $row;    
}
 include_once('./helpers.php');
// показывать или нет выполненные задачи
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
?>