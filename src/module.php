<?php
$category = "";
if (isset($_GET['category'])) { // проверяю запрос на категорию задач
    $cat_id = mysqli_real_escape_string($conn, $_GET['category']); // защищаем от SQL-инъекции
    $category = " AND c.id = '" . $cat_id . "'";  // формируем запрос на показ задач одной категории 
    $page404 = true;  // по умолчанию запрос выдаст ошибку 404
}
$search = "";
if (isset($_GET['search']) && !empty($_GET['search'])) { // проверяю запрос на поиск задач    
    $search = "AND MATCH (t.name) AGAINST ('".trim(mysqli_real_escape_string($conn, $_GET['search']))."')";
}   

$userID = "";
if(isset($_SESSION['user_id'])){
$userID = $_SESSION['user_id'];
}


$sql = "SELECT c.id, c.name, COUNT(t.id) as count_id FROM category c LEFT JOIN task t ON t.category_id = c.id AND t.user_id = '".$userID."' GROUP BY c.id";
$res = $conn->query($sql);
$arCategories = array();
while ($row = $res->fetch_array()) {
    $arCategories[] = $row;
    if (isset($cat_id) && $cat_id == $row['id']) {
        $page404 = false; // есть совпадение на запрос категории в адресной строке, 404 ошибку не показываем
    }
}

include_once($_SERVER["DOCUMENT_ROOT"] . '/helpers.php');