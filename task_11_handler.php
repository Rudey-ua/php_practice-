<?php 

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$pdo = new PDO('mysql:host=localhost;dbname=blog;','root','');

function addNewUser($pdo, $email, $password){
    $sql = "INSERT INTO `users` (`email`, `password`) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email, 'password' => $password]);
}

function checkEmail($pdo, $email, $password){

    $sql = "SELECT * FROM `users` WHERE email = :email";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if(!empty($user)) {
        $message = 'Такой email уже существует в базе!';
        return $_SESSION['danger'] = $message;
    }else{
        $message = "Вы успешно зарегистрировались!";
        $_SESSION['success'] = $message;
        return addNewUser($pdo, $email, $password);
    }
}

echo checkEmail($pdo, $email, $password);

header("Location: /task_11.php");