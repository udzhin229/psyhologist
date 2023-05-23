function view(email) {
  // Отправка AJAX-запроса на получение сообщений
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/assets/bd/get_messages.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var messages = JSON.parse(xhr.responseText);
      // Вывод сообщений на странице
      for (var i = 0; i < messages.length; i++) {
        var message = messages[i];
        var html = "<div>" + message.text + "</div>";
        document
          .getElementById("messages")
          .insertAdjacentHTML("beforeend", html);
      }
    }
  };
  xhr.send("email=" + email);
}
