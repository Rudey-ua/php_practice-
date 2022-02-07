<?php
session_start();
$image = $_FILES['image']['name'];
$pdo = new PDO('mysql:host=localhost;dbname=blog;', 'root', '');


function uploadPicture($image, $pdo){

    $name = uniqid();
    $tmp_name = $_FILES['image']['tmp_name'];
    $extension = substr($image, strrpos($image, '.') + 1);
    $bdImageName = "pictures/$name.$extension";

    $sql = 'INSERT INTO images (image_name) VALUES (:image)';
    $statement = $pdo->prepare($sql);
    $statement->execute(['image'=> $bdImageName]);

    $_SESSION['message'] = 'Ваше изображение успешно загружено!';

    return move_uploaded_file($tmp_name, $bdImageName);

}

uploadPicture($image, $pdo);

header("Location: task_16.php");