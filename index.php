<?php
 include_once('./helpers.php');
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

$arCategories = array(
    'Входящие',
    'Учеба',
    'Работа',
    'Домашние дела',
    'Авто',
);

$arTask = array(
    array(
        'name' => 'Собеседование в IT компании',
        'date' => '01.12.2019',
        'category' => 'Работа',
        'status' => false,
    ),
    array(
        'name' => 'Выполнить тестовое задание',
        'date' => '25.12.2019',
        'category' => 'Работа',
        'status' => false,
    ),
    array(
        'name' => 'Сделать задание первого раздела',
        'date' => '21.12.2020',
        'category' => 'Учеба',
        'status' => true,
    ),
    array(
        'name' => 'Встреча с другом',
        'date' => '22.12.2019',
        'category' => 'Входящие',
        'status' => false,
    ),
    array(
        'name' => 'Купить корм для кота',
        'date' => 'null',
        'category' => 'Домашние дела',
        'status' => false,
    ),
    array(
        'name' => 'Заказать пиццу',
        'date' => 'null',
        'category' => 'Домашние дела',
        'status' => false,
    ),
);
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