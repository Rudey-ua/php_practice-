<?php 

session_start();

$text = $_POST['text'];

$pdo = new PDO('mysql:host=localhost;dbname=blog;','root','');

function addText($pdo, $text){
    $sql = "INSERT INTO `test` (`text`) VALUES (:text)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['text' => $text]);
}

function checkText($pdo, $text){

    $sql = "SELECT * FROM `test` WHERE text = :text";
    $statement = $pdo->prepare($sql);
    $statement->execute(['text' => $text]);
    $task = $statement->fetch(PDO::FETCH_ASSOC);

    if(!empty($task)) {
        $message = 'Такой текст уже существует в базе!';
        return $_SESSION['danger'] = $message;
    }else{
        $message = "Текст успешно добавлен в базу";
        $_SESSION['success'] = $message;
        return addText($pdo, $text);
    }
}

echo checkText($pdo, $text);

header("Location: /task_10.php");