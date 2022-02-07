<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=blog;', 'root', '');

$tmp_image_name = $_FILES['image']['tmp_name'];
$image_name = $_FILES['image']['name'];

for($i = 0; $i < count($image_name); $i++){

    $uniquename = uniqid();
    $tmp_name = $tmp_image_name; 
    $name = $image_name;
    $extension = substr($name[$i], strrpos($name[$i], '.') + 1);
    $bdImageName = "pictures/$uniquename.$extension";

    $sql = 'INSERT INTO images (image_name) VALUES (:image)';
    $statement = $pdo->prepare($sql);
    $statement->execute(['image'=> $bdImageName]);

    $_SESSION['message'] = 'Ваше изображение успешно загружено!';

    move_uploaded_file($tmp_name[$i], $bdImageName);
}

header("Location: task_16.php");


// Через функцию не работает, загружается только одна картинка!

/* function uploadFiles($pdo, $image_name, $tmp_image_name){
    for($i = 0; $i < count($image_name); $i++){

        $uniquename = uniqid();
        $tmp_name = $tmp_image_name; 
        $name = $image_name;
        $extension = substr($name[$i], strrpos($name[$i], '.') + 1);
        $bdImageName = "pictures/$uniquename.$extension";
    
        $sql = 'INSERT INTO images (image_name) VALUES (:image)';
        $statement = $pdo->prepare($sql);
        $statement->execute(['image'=> $bdImageName]);
    
        $_SESSION['message'] = 'Ваше изображение успешно загружено!';
    
        return move_uploaded_file($tmp_name[$i], $bdImageName);
    }
} */

