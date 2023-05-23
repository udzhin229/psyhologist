<?php
session_start();
require_once 'connect.php';
$user_email = trim($_SESSION['user_mail']);
$stmt = $pdo->prepare('
SELECT tmp.email, m1.*, m2.text AS last_message
FROM (
  SELECT DISTINCT
    IF(user_from = :user_email, user_to, user_from) AS email,
    MAX(date) AS max_date
  FROM messages
  WHERE user_from = :user_email OR user_to = :user_email
  GROUP BY email
) AS tmp
JOIN messages AS m1 ON
  (m1.user_from = :user_email OR m1.user_to = :user_email) AND
  IF(m1.user_from = :user_email, m1.user_to, m1.user_from) = tmp.email AND
  m1.date = tmp.max_date
LEFT JOIN messages AS m2 ON
  (m2.user_from = :user_email OR m2.user_to = :user_email) AND
  IF(m2.user_from = :user_email, m2.user_to, m2.user_from) = tmp.email AND
  m2.date = tmp.max_date
');
$stmt->execute(['user_email' => $user_email]);
$chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($chats);
// SELECT DISTINCT
// IF(user_from = :user_email, user_to, user_from) as email, text
// FROM messages
// WHERE user_from = :user_email OR user_to = :user_email

// SELECT m1.user_from, m1.user_to, m1.text, m1.date
// FROM messages m1
// INNER JOIN (
//     SELECT 
//         IF(user_from = :user_email, user_to, user_from) AS email, 
//         MAX(date) AS max_date
//     FROM messages
//     WHERE user_from = :user_email OR user_to = :user_email
//     GROUP BY email
// ) m2 ON (
//     m1.date = m2.max_date 
//     AND (m1.user_from = m2.email OR m1.user_to = m2.email)
// )
?>