<?php
session_start();
date_default_timezone_set('Europe/Kiev');
require_once 'connect.php';
$user_from = trim($_SESSION['user_mail']);
$user_to = trim($_POST['email']);
// Выборка сообщений
$sql1 = "SELECT * FROM messages WHERE user_from = '$user_from' AND user_to = '$user_to' LIMIT 400";
$sql2 = "SELECT * FROM messages WHERE user_from = '$user_to' AND user_to = '$user_from' LIMIT 400";
$result1 = $pdo->query($sql1);
$result2 = $pdo->query($sql2);
if (!$result1 || !$result2) {
    die('Ошибка выполнения запроса: ' . $mysqli->error);
}
// Преобразование результатов в формат JSON
$messages1 = array();
while ($row = $result1->fetch(PDO::FETCH_ASSOC)) {
    $messages1[] = $row;
}
$messages2 = array();
while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
    $messages2[] = $row;
}
// Объединение массивов сообщений и сортировка по дате
$messages = array_merge($messages1, $messages2);
usort($messages, function ($a, $b) {
    return strtotime($a['date']) - strtotime($b['date']);
});
echo json_encode($messages);
?> 