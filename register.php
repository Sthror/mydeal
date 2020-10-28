<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/src/config.php');
$idForm = 2;
include_once($_SERVER["DOCUMENT_ROOT"].'/src/validate.php');

$content = include_template('register.php', array(
    'title' => 'Регистрация нового пользователя',
    'arCategories' => $arCategories,
    'errors' => $errors,
));
$dataPages = array(
    'title' => 'Регистрация нового пользователя',   
    'arCategories' => $arCategories,
    'content' => $content,
    'auth' => $auth,
);
print(include_template('layout.php', $dataPages));
