<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/src/config.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/helpers.php');
$idForm = 2;
include_once($_SERVER["DOCUMENT_ROOT"].'/src/validate.php');

$content = include_template('register.php', array(
    'title' => 'Регистрация нового пользователя',
    'errors' => $errors,
));
$dataPages = array(
    'title' => 'Регистрация нового пользователя',    
    'content' => $content,
    'auth' => $auth,
);
print(include_template('layout.php', $dataPages));
