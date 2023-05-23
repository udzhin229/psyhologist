<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
require_once 'connect.php';
// Получаем данные из формы
$name = $_POST['name'];
$old = $_POST['old'];
$price = $_POST['price'];
$year = $_POST['year'];
$vector = $_POST['vector_hid'];
$user_mail = $_SESSION['user_mail'];
$sql = "UPDATE psychologists SET name = ?, old = ?, price = ?, year = ?, vector = ? WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$name, $old, $price, $year, $vector, $user_mail]);
// Получаем id последнего измененного психолога
$sql1 = "SELECT id FROM psychologists WHERE email = ?";
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute([$user_mail]);
$psychologist_id = $stmt1->fetch();

// Проверяем, что id психолога является корректным
if ($psychologist_id) {
    if (isset($_FILES)) {
        foreach ($_FILES["file"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $filecontent = addslashes(file_get_contents($_FILES["file"]["tmp_name"][$key]));
    
                // Записываем содержимое файла в базу данных
                $sql2 = "INSERT INTO files (psyh_id, file) VALUES (:psyh_id, :file)";
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->bindParam(':psyh_id', intval($psychologist_id));
                $stmt2->bindParam(':file', $filecontent, PDO::PARAM_LOB);
                $stmt2->execute();
            }
        }
    }
} else {
    echo "Error getting psychologist id.";
}
header('Location: /');
?>