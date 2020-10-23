<?php
$errors = array();
$requered_fields = array(
    'name',
    'project',
);
if (!empty($_POST)) {
    foreach ($requered_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Поле не заполнено';
        }
    }
    if (!empty($_POST['project']) && !in_array($_POST['project'], array_column($arCategories, 'id'))) {
        $errors['project'] = 'Такого проекта не существует!';
    }
    if (!empty($_POST['date']) && is_date_valid($_POST['date']) !== true) {
        $errors['date'] = 'Не правильный формат даты! Воспользуйтесь встроенным в это поле календарем (справа нажмите на иконку календаря)';
    } else if (!empty($_POST['date']) && strtotime($_POST['date']) < strtotime(date('Y-m-d'))) {
        $errors['date'] = 'дата должна быть в прошлом';
    }    
}
if (!empty($_FILES['file'])) {
    $fileName = htmlspecialchars($_FILES['file']['name']);
    $fileURL = '/uploads/' . $fileName;
    $filePath =  $_SERVER["DOCUMENT_ROOT"]. $fileURL;

    move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
}

if(!empty($_POST) && empty($errors)){
    $task = $_POST;
    $task['file'] = '';
    if(!empty($_FILES)){
        $task['file'] = $filePath;
    }
    $sql = 'INSERT INTO task (name, category_id, date, file, user_id, status) VALUES (?, ?, ?, ?, 1, 0)';
    $stmt = db_get_prepare_stmt($conn, $sql, $task);
    $res = mysqli_stmt_execute($stmt);
    if($res){
        header("location: /");
    }
}
?>