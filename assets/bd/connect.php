<?php
$host = 'localhost';
$dbname = 'psycho';
$user = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Failed to connect to database: " . $e->getMessage());
}
// $host = 'localhost';
// $dbname = 'm115737_psyh';
// $user = 'm115737_psyh_u';
// $password = 'Misanov03';
// $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
// try {
//     $pdo = new PDO($dsn, $user, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Failed to connect to database: " . $e->getMessage());
// }
?>