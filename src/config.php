<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
$conn = new mysqli('localhost', 'z90932tq_oc', 'Ttb*gZ8F', 'z90932tq_oc');
if ($conn->connect_errno) {
    die("<h1>Не удалось подключиться к MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error . "</h1>");
}

$category = "";
if (isset($_GET['category'])) { // проверяю запрос на категорию задач
    $cat_id = mysqli_real_escape_string($conn, $_GET['category']); // защищаем от SQL-инъекции
    $category = " AND c.id = '" . $cat_id . "'";  // формируем запрос на показ задач одной категории 
    $page404 = true;  // по умолчанию запрос выдаст ошибку 404
}


$sql = "SELECT c.id, c.name, COUNT(t.id) as count_id FROM category c LEFT JOIN task t ON t.category_id = c.id AND t.user_id = '".$_SESSION['user_id']."' GROUP BY c.id";
$res = $conn->query($sql);
$arCategories = array();
while ($row = $res->fetch_array()) {
    $arCategories[] = $row;
    if (isset($cat_id) && $cat_id == $row['id']) {
        $page404 = false; // есть совпадение на запрос категории в адресной строке, 404 ошибку не показываем
    }
}

include_once($_SERVER["DOCUMENT_ROOT"] . '/helpers.php');
$auth = false;
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
    $auth = true;
}
