<?php
session_start();
$conn = new mysqli('localhost', 'sergey', 'kokoc2019', 'mydeal');
if ($conn->connect_errno) {
    die("<h1>Не удалось подключиться к MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error . "</h1>");
}

$auth = false;
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
    $auth = true;
}