<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/bd/connect.php');
$psychologistIds = $_POST['psychologistIds'];
// Получение данных о психологах
$sql = "SELECT * FROM psychologists WHERE id IN (".implode(',', $psychologistIds).")";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$psychologists = $stmt->fetchAll();

// Возврат данных в формате JSON
header('Content-Type: application/json');
echo json_encode($psychologists);
?> 