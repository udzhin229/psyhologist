<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/bd/connect.php');
// $sql = "SELECT * FROM psychologists JOIN clients ON psychologists.email = clients.email";
// $users = $pdo->query($sql);

// $stmt = $pdo->prepare('SELECT email FROM clients UNION SELECT email FROM psychologists');
// $stmt->execute();
// $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $user_email = trim($_SESSION['user_mail']);
// $stmt = $pdo->prepare('
// SELECT DISTINCT
// IF(user_from = :user_email, user_to, user_from) as email
// FROM messages
// WHERE user_from = :user_email OR user_to = :user_email
// ');
// $stmt->execute(['user_email' => $user_email]);
// $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/assets/css/chat.css">
    <link rel="stylesheet" href="/assets/css/root.css">
    <title>Chat</title>
  </head>
  <body>
    <div class="page">
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php')?>
        <main>
            <div class="container">
                <section>
                    <div class="chats">
                        <div class="title">Месседжер</div>
                        <hr>
                        <div class="users">
                            <!-- <?php
                            // while($row = $users->fetch_assoc()) {
                            //     echo "Column1: " . $row["column1"]. " - Column2: " . $row["column2"]. "<br>";
                            // }
                            foreach ($chats as $chat) {
                                echo '
                                <div class="user" onclick="view(\''.$chat['email'].'\');">
                                    <div class="img"><img src="/assets/images/chat/ava.png" alt="avatar"></div>
                                    <div class="info_user">
                                        <div class="line"><span class="name">'.$chat['email'].'</span></div>
                                        <div class="line"><span class="message">Hi! How are you?</span><div class="time">12m</div></div>
                                    </div>
                                </div>
                                ';
                            }
                            ?> -->
                        </div>
                    </div>
                    <div class="chat">
                        <div class="messages" id="messages">
                        </div>
                        <div class="send">
                            <form method="post">
                                <input type="hidden" name="send_email" id="send_mail">
                                <input type="text" name="send_mess" id="send_mess" placeholder="Write a message">
                                <button type="submit"><img src="/assets/images/chat/send.png" alt="send"></button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
var lastChatId = 0;
var existingChats = [];
$(document).ready(function() {
    getChats();
    setInterval(getChats, 3000);
});
function getChats() {
    $.ajax({
        url: '/assets/bd/get_chats.php',
        type: 'post',
        dataType: 'json',
        success: function(response) {
            $('.users').empty();
            var users = '';
            $.each(response, function(index, chat) {
              users += '<div class="user" onclick="view(\''+chat.email+'\', this);">' +
                      '<div class="img"><img src="/assets/images/chat/ava.png" alt="avatar"></div>' +
                      '<div class="info_user">' +
                      '<div class="line"><span class="name">'+chat.email+'</span></div>' +
                      '<div class="line"><span class="message">'+chat.text+'</span><div class="time">12m</div></div>' +
                      '</div>' +
                      '</div>';
            });
            $('.users').append(users);
        },
        error: function() {
            alert('Error while getting chats!');
        }
    });
}
function view(email, element) {
  // Получаем элементы управления
  var messagesDiv = document.getElementById("messages");
  document.getElementById("send_mail").value = email;
  update();
  // Отправка AJAX-запроса на получение сообщений
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/assets/bd/get_messages.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var messages = JSON.parse(xhr.responseText);
      messagesDiv.innerHTML = "";
      // Вывод сообщений на странице
      for (var i = 0; i < messages.length; i++) {
        var message = messages[i];
        var html = '<div class="message ' + (message.user_from === email ? 'reply' : 'own') + '">' +
          '<div class="img"><img src="/assets/images/chat/ava.png" alt="avatar"></div>' +
          '<hr>' +
          '<div class="info_user">' +
          '<div class="name">' + message.user_from + '</div>' +
          '<div class="text">' + message.text + '</div>' +
          '<div class="date">' + message.date + '</div>' +
          '</div>' +
          '</div>';
        messagesDiv.insertAdjacentHTML("beforeend", html);
      }
      // Удаляем класс "active" у всех чатов
      $('.user').removeClass('active');
      // Добавляем класс "active" только к нажатому чату
      $(element).addClass('active');
    }
  };
  xhr.send("email=" + email);
  setInterval(function () {
    update();
  }, 3000);
}
var sendForm = document.querySelector(".send form");
var sendInput = document.getElementById("send_mess");
// Отправка сообщения при нажатии на кнопку отправки
sendForm.addEventListener("submit", function (event) {
event.preventDefault();
email = document.getElementById("send_mail").value;
var message = sendInput.value.trim();
if (message) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/assets/bd/send_message.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        sendInput.value = "";
        var activeUser = $(".user.active");
        view(email, activeUser); // Обновляем чат после отправки сообщения // Обновляем чат после отправки сообщения
        console.log('успех');
    }
    };
    xhr.send("email=" + email + "&text=" + message);
}
});
  
function update() {
    // Получаем элементы управления
  var messagesDiv = document.getElementById("messages");
  email = document.getElementById("send_mail").value;
  // Отправка AJAX-запроса на получение сообщений
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/assets/bd/get_messages.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var messages = JSON.parse(xhr.responseText);
      messagesDiv.innerHTML = "";
      // Вывод сообщений на странице
      for (var i = 0; i < messages.length; i++) {
        var message = messages[i];
        var html = '<div class="message ' + (message.user_from === email ? 'reply' : 'own') + '">' +
          '<div class="img"><img src="/assets/images/chat/ava.png" alt="avatar"></div>' +
          '<hr>' +
          '<div class="info_user">' +
          '<div class="name">' + message.user_from + '</div>' +
          '<div class="text">' + message.text + '</div>' +
          '<div class="date">' + message.date + '</div>' +
          '</div>' +
          '</div>';
        messagesDiv.insertAdjacentHTML("beforeend", html);
      }
    }
  };
  xhr.send("email=" + email);
}
    </script>
  </body>
</html>
