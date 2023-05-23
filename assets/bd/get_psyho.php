<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/bd/connect.php');


// Получаем данные о психологах из базы данных
$psyho = getPsyho();

// Выводим данные в формате JSON
echo json_encode($psyho);

function getPsyho() {
  global $pdo;

  // Выбираем все записи из таблицы `psyho`
  $query = $pdo->query("SELECT * FROM psychologists");

  // Получаем данные о психологах
  $psyho = $query->fetchAll(PDO::FETCH_ASSOC);

  return $psyho;
}
?>