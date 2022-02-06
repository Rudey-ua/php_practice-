<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$pdo = new PDO('mysql:host=localhost;dbname=blog;','root','');

$sql = "SELECT * FROM `users` WHERE email=:email";
$statement = $pdo->prepare($sql);
$statement->execute(['email'=>$email]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if(!empty($user['email']) && password_verify($password, $user['password'])) {
    $_SESSION['status'] = 'Authorized';
}
else{
    $_SESSION['status'] = 'Not authorized';
}

header("Location: task_14.php");

