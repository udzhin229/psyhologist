<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/bd/connect.php');
$sql = 'SELECT * FROM psychologists WHERE verification = true';
$psyho = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>