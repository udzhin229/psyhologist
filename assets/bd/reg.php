<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'connect.php';

// Получаем данные из формы
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$password = $_POST['pass'];
$password_hashed = password_hash($password, PASSWORD_DEFAULT);
$role_id = ($_POST['role'] == 'psychologists') ? 2 : 1; // 2 - id роли психолога, 1 - id роли клиента

// Проверяем, есть ли уже в базе данных пользователь с таким email или номером телефона
$sql = "SELECT * FROM (SELECT email, phone_number FROM psychologists UNION ALL SELECT email, phone_number FROM clients) AS psycho WHERE LOWER(email) = LOWER(?) OR phone_number = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email, $phone_number]);
$user = $stmt->fetch();
if ($user) {
  if ($user['email'] == $email && $user['phone_number'] == $phone_number) {
    $_SESSION['mess2'] = "Пользователь с таким email уже существует";
    $_SESSION['mess1'] = "Пользователь с таким номером телефона уже существует";
    header('Location: /registration.php');
  }
  else if ($user['email'] == $email) {
    // Если пользователь с таким email уже существует, то выводим ошибку
    $_SESSION['mess2'] = "Пользователь с таким email уже существует";
    header('Location: /registration.php');
  } elseif ($user['phone_number'] == $phone_number) {
    // Если пользователь с таким номером телефона уже существует, то выводим ошибку
    $_SESSION['mess1'] = "Пользователь с таким номером телефона уже существует";
    header('Location: /registration.php');
  }
} else {
  // Если пользователь с таким номером телефона или email не существует, то создаем новую запись в соответствующей таблице
  if ($_POST['role'] == 'psychologists') {
    $sql = "INSERT INTO psychologists (phone_number, email, password, role_id) VALUES (?, ?, ?, ?)";
  } else {
    $sql = "INSERT INTO clients (phone_number, email, password, role_id) VALUES (?, ?, ?, ?)";
  }
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$phone_number, $email, $password_hashed, $role_id]);

  if ($_POST['role'] == 'psychologists') {
    $_SESSION['user_mail'] = $email;
    header('Location: /verification.php');
  } else {
    $_SESSION['user_mail'] = $email;
    header('Location: /');
  }
}
?>