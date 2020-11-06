<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/src/config.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/src/module.php');
$idForm = 5;
include_once($_SERVER["DOCUMENT_ROOT"] . '/src/validate.php');
$template = 'guest.php';
if($auth == true){
    $template = 'main.php';
}
if (!isset($page404) || $page404 == false) {
    include_once($_SERVER["DOCUMENT_ROOT"].'/src/task.php');
    $content = include_template($template, $templates);
    print(include_template('layout.php', $dataPages)); 
}
else {
    $dataPages = array(
        'page404' => 'Ошибка 404 - неправильный адрес страницы',
        'auth' => $auth,
        'title' => 'Ошибка 404',
    );
    print(include_template('layout.php', $dataPages)); 
   
}

