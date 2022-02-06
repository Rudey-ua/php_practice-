<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$pdo = new PDO('mysql:host=localhost;dbname=blog;','root','');

function selectData($pdo, $email){
    $sql = "SELECT * FROM `users` WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email'=>$email]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function Authorization($pdo, $email, $password) {
    $user = selectData($pdo, $email);

    if(!empty($user['email']) && password_verify($password, $user['password'])) {
        return $_SESSION['status'] = 'Authorized';
    }
    else{
        return $_SESSION['status'] = 'Not authorized';
    }
}

Authorization($pdo, $email, $password);

header("Location: task_14.php");

