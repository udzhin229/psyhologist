<?php
session_start();
require_once 'connect.php';
$email = $_POST['email'];
// Выполняем запрос на поиск психолога по email
$query = "SELECT times FROM psychologists WHERE email = :email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->execute();

// Получаем результат запроса
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Возвращаем результат в формате JSON
echo json_encode($result);
?>