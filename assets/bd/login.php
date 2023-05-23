<?php
session_start();
require_once 'connect.php';

$email = $_POST['email'];
$password = $_POST['pass'];
// $remember = isset($_POST['rem']) ? true : false;

// Проверяем, является ли введенный email адресом психолога или клиента
$sql = "SELECT * FROM psychologists WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$user = $stmt->fetch();
if (!$user) {
  $sql = "SELECT * FROM clients WHERE email = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$email]);
  $user = $stmt->fetch();
}

if (!$user) {
  // Если пользователь не найден, то выводим ошибку
  $_SESSION['mess1'] = "Почта не найдена";
  header('Location: /login.php');
} else if (!password_verify($password, $user['password'])) {
  // Если пароль не совпадает, то выводим ошибку
  $_SESSION['mess2'] = "Неверный пароль";
  header('Location: /login.php');
} else {
  // Если все верно, то сохраняем данные пользователя в сессию
  $_SESSION['user_mail'] = $user['email'];

  // Если пользователь выбрал опцию "Запомнить меня", то сохраняем его данные в cookie
//   if ($remember) {
//     setcookie('user_email', $user['email'], time() + 3600 * 24 * 30);
//     setcookie('user_password', $user['password'], time() + 3600 * 24 * 30);
//   }

  header('Location: /');
}
?>