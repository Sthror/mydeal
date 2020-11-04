<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/src/config.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/src/module.php');
$idForm = 1;
include_once($_SERVER["DOCUMENT_ROOT"].'/src/validate.php');
$template = 'guest.php';
if($auth == true){
    $template = 'add.php';
}
$content = include_template($template, array(
    'title' => 'Добавление задачи',
    'arCategories' => $arCategories,
    'errors' => $errors,
));
$dataPages = array(
    'title' => 'Добавление задачи',   
    'arCategories' => $arCategories,
    'content' => $content,
    'auth' => $auth,
);
print(include_template('layout.php', $dataPages));
