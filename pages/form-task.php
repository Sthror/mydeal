<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/src/config.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/src/validate.php');

$content = include_template('add.php', array(
    'title' => 'Добавление задачи',
    'arCategories' => $arCategories,
    'errors' => $errors,
));
$dataPages = array(
    'title' => 'Добавление задачи',   
    'arCategories' => $arCategories,
    'content' => $content,
);
print(include_template('layout.php', $dataPages));
