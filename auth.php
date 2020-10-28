<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/src/config.php');
$idForm = 3;
include_once($_SERVER["DOCUMENT_ROOT"].'/src/validate.php');

$content = include_template('auth.php', array(
    'title' => 'Вход на сайт',    
    'errors' => $errors,
));
$dataPages = array(
    'title' => 'Вход на сайт',   
    'content' => $content,
    'auth' => $auth,
);
print(include_template('layout.php', $dataPages));
