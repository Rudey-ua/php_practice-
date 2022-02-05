<?php

$text = $_POST['text'];

$pdo = new PDO('mysql:host=localhost;dbname=blog;', 'root', '');
$sql = "INSERT INTO `test` (`text`) VALUES (:text)";

$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);

header("Location: /task_9.php");

?>