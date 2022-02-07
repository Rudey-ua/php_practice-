<?php 

$id = $_GET['id'];
$filepath = $_GET['filepath'];
unlink($filepath);

$pdo = new PDO('mysql:host=localhost;dbname=blog;', 'root', '');

$sql = 'DELETE FROM `images` WHERE id = :id';
$statement = $pdo->prepare($sql);
$statement->execute(['id'=> $id]);

header("Location: task_17.php");