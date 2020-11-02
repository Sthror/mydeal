<?php
$errors = array();
$requered_fields = array(
    'name',
    'project',
    'email',
    'password',
);
if (!empty($_POST)) {
    foreach ($requered_fields as $field) {
        if (isset($_POST[$field]) && empty($_POST[$field])) {
            $errors[$field] = 'Поле не заполнено';
        }
    }
    if (!empty($_POST['email'])) {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    }
    if (isset($email) && $email == false) {
        $errors['email'] = "E-mail введён некорректно";
    } else if (isset($email) && $email !== false) {
        $userEmail = mysqli_real_escape_string($conn, $_POST['email']);
        $sql = 'SELECT * FROM users WHERE email = "' . $userEmail . '"';
        $res_email = mysqli_query($conn, $sql);        
        $result = $res_email ? mysqli_fetch_array($res_email, MYSQLI_ASSOC): null;                
    }
    $authEmail = false;
    if (isset($res_email) && mysqli_num_rows($res_email) > 0 && $idForm == 2) {
        $errors['email'] = "Этот адрес почты уже зарегистрирован";
    } else if(isset($res_email) && mysqli_num_rows($res_email) > 0 && $idForm == 3){
        $authEmail = true;
    } else if($idForm == 3){
        $errors['auth'] = "Неверный логин/пароль";
    }
    if (!empty($_POST['project']) && !in_array($_POST['project'], array_column($arCategories, 'id'))) {
        $errors['project'] = 'Такого проекта не существует!';
    }
    if (!empty($_POST['date']) && is_date_valid($_POST['date']) !== true) {
        $errors['date'] = 'Не правильный формат даты! Воспользуйтесь встроенным в это поле календарем (справа нажмите на иконку календаря)';
    } else if (!empty($_POST['date']) && strtotime($_POST['date']) < strtotime(date('Y-m-d'))) {
        $errors['date'] = 'Дата выполнения задачи не может быть в прошлом';
    }
}
if (!empty($_FILES['file']['name'])) {
    $fileName = htmlspecialchars($_FILES['file']['name']);
    $fileURL = '/uploads/' . $fileName;
    $filePath =  $_SERVER["DOCUMENT_ROOT"] . $fileURL;

    move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
}
if (!empty($_POST) && empty($errors)) {
    switch ($idForm) {
        case 1: // форма добавления задачи
            $task = $_POST;
            $task['file'] = '';
            if (!empty($_FILES['file']['name'])) {
                $task['file'] = $filePath;
            }
            $sql = 'INSERT INTO task (name, category_id, date, file, user_id, status) VALUES (?, ?, ?, ?, '.$_SESSION['user_id'].', 0)';
            $stmt = db_get_prepare_stmt($conn, $sql, $task);
            $res = mysqli_stmt_execute($stmt);
            if ($res) {
                header("location: /");
            }
            break;
        case 2: // форма регистрации
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $name = htmlspecialchars($_POST['name']);
            $user = array($userEmail, $password, $name);
            $sql = 'INSERT INTO users (email, password, name) VALUES (?, ?, ?)';
            $stmt = db_get_prepare_stmt($conn, $sql, $user);
            $res = mysqli_stmt_execute($stmt);
            if ($res) {
                $result =  mysqli_insert_id($conn);                         
                $_SESSION['user_id'] = $result;
                header("location: /");
            }
            break;
        case 3: // форма аутентификации
           if($result && $authEmail == true && password_verify($_POST['password'], $result['password'])){
            $_SESSION['user_name'] = htmlspecialchars($result['name']);
            $_SESSION['user_id'] = $result['id'];
            header("location: /");            
           } else {
            $errors['auth'] = "Неверный логин/пароль"; 
           }
            break;
    }
}
