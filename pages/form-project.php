<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/src/config.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/src/module.php');
$idForm = 4;
include_once($_SERVER["DOCUMENT_ROOT"].'/src/validate.php');
$template = 'guest.php';
if($auth == true){
    $template = 'category.php';
}
$content = include_template($template, array(
    'title' => 'Добавление задачи',
    'arCategories' => $arCategories,    
    'errors' => $errors,
));
$dataPages = array(
    'title' => 'Добавление задачи',
    'content' => $content,
    'auth' => $auth,
);
print(include_template('layout.php', $dataPages));
