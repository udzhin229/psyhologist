<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/bd/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/assets/css/root.css">
    <link rel="stylesheet" href="/assets/css/registration.css">
    <link rel="import" href="header.html">
    <title>PsihoDoc</title>
  </head>
  <body>
  <div class="page">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php')?>
      <main>
        <section>
          <div class="container">
            <div class="section__inner">
                <div class="up">
                    <a href="/login.php" class="title-text">Авторизироваться</a>
                    <div class="line">
                        <hr>
                        <div class="green-line"></div>
                    </div>
                </div>
                <form id="form" action="/assets/bd/reg.php" method="post">
                    <div class="title">Регистрация</div>
                    <div class="d-title">Создайте аккаунт, чтобы продолжить</div>
                    <label for="choose" class="ttl">Кто Вы?</label>
                    <div class="choose">
                        <div id="clients" class="active">Я клиент</div>
                        <div id="psychologists">Я психолог</div>
                    </div>
                    <label for="num" class="ttl">Номер телефона</label>
                    <input type="tel" name="phone_number" id="phone_number" required placeholder="+38 (000) 000 00 00">
                    <?php
                    if($_SESSION['mess1']) {
                      echo '<span id="mess">'.$_SESSION['mess1'].'</span>';
                      unset($_SESSION['mess1']);
                    }
                    ?>
                    <label for="email" class="ttl">E-mail</label>
                    <input type="email" name="email" id="email" required placeholder="@gmail.com">
                    <?php
                    if($_SESSION['mess2']) {
                      echo '<span id="mess">'.$_SESSION['mess2'].'</span>';
                      unset($_SESSION['mess2']);
                    }
                    ?>
                    <label for="pass" class="ttl">Пароль</label>
                    <input type="password" name="pass" id="pass" required placeholder="Введите пароль">
                    <div class="remember">
                        <input type="checkbox" name="rem" id="rem">
                        <label for="rem">Запомнить меня</label>
                    </div>
                    <input type="hidden" name="role" id="role" value="">
                    <input id="submit" type="submit" value="Зарегистрироваться">
                </form>
            </div>
          </div>
        </section>
      </main>
      </div>
      <script>
        const client = document.getElementById("clients");
        const psycho = document.getElementById("psychologists");
        const submit = document.getElementById("submit");
        const form = document.getElementById("form");
        const phoneInput = document.getElementById('phone_number');
        const emailInput = document.getElementById('email');
        const messSpans = document.querySelectorAll('#mess');
        client.addEventListener("click", () => {
          submit.value = "Зарегистрироваться";
          client.classList.add("active");
          psycho.classList.remove("active");
          var choose = document.querySelector('.choose .active').id;
          document.querySelector('#role').value = choose;
        });
        psycho.addEventListener("click", () => {
          submit.value = "Перейти к верификации";
          psycho.classList.add("active");
          client.classList.remove("active");
          var choose = document.querySelector('.choose .active').id;
          document.querySelector('#role').value = choose;
        });
        // добавляем обработчик событий для input phone_number
        phoneInput.addEventListener('input', function(event) {
          messSpans.forEach(function(messSpan) {
            messSpan.remove();
          });
        });
        // добавляем обработчик событий для input email
        emailInput.addEventListener('input', function(event) {
          messSpans.forEach(function(messSpan) {
            messSpan.remove();
          });
        });
      </script>
  </body>
</html>