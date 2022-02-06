<?php 

session_start();

$text = $_POST['text'];

if(!empty($text)){
    unset($_SESSION['danger']);
    $_SESSION['message'] = $text;
}
else{
    unset($_SESSION['message']);
    $danger_text = "Поле не может быть пустым!";
    $_SESSION['danger'] = $danger_text;
}

header("Location: task_12.php");