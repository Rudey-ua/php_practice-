<?php
session_start();

$tmp_image_name = $_FILES['image']['tmp_name'];
$image_name = $_FILES['image']['name'];



for($i = 0; $i < count($image_name); $i++){

    $uniquename = uniqid();
    $tmp_name = $tmp_image_name; 
    $name = $image_name;
    $extension = substr($name[$i], strrpos($name[$i], '.') + 1);
    $bdImageName = "pictures/$uniquename.$extension";
    move_uploaded_file($tmp_name[$i], $bdImageName);
}


die();

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