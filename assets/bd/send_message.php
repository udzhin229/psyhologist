<?php
session_start();
date_default_timezone_set('Europe/Kiev');
require_once 'connect.php';
// Проверка, что пользователь авторизован
if (!isset($_SESSION['user_mail'])) {
  echo json_encode(array('success' => false, 'message' => 'User is not authenticated'));
  exit;
}

// Получение данных из POST-запроса
$user_from = $_SESSION['user_mail'];
$user_to = $_POST['email'];
$text = $_POST['text'];
$date = date("M d H:i:s");

// Вставка сообщения в базу данных
$sql = "INSERT INTO messages (user_from, user_to, text, date) VALUES (:user_from, :user_to, :text, :date)";
$stmt = $pdo->prepare($sql);
if (!$stmt->execute(array(
  ':user_from' => $user_from,
  ':user_to' => $user_to,
  ':text' => $text,
  ':date' => $date
))) {
  http_response_code(400);
  die(json_encode(array('success' => false, 'message' => 'Error inserting message into the database')));
}

// Проверка на ошибки
$errorInfo = $stmt->errorInfo();
if (isset($errorInfo[1])) {
  http_response_code(400);
  die(json_encode(array('success' => false, 'message' => 'Error inserting message into the database: ' . $errorInfo[2])));
}

// Ответ на запрос AJAX
echo json_encode(array('success' => true));

?>