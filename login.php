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
    <link rel="stylesheet" href="/assets/css/login.css">
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
                    <a href="/registration.php" class="title-text">Зарегистрироваться</a>
                    <div class="line">
                        <hr>
                        <div class="green-line"></div>
                    </div>
                </div>
                <form action="/assets/bd/login.php" method="post">
                    <div class="title">С возвращением!</div>
                    <div class="d-title">Мы скучали по тебе! Пожалуйста, введите свои данные</div>
                    <label for="email" class="ttl">E-mail</label>
                    <input type="email" name="email" id="email" required placeholder="@gmail.com">
                    <?php
                    if($_SESSION['mess1']) {
                      echo '<span id="mess">'.$_SESSION['mess1'].'</span>';
                      unset($_SESSION['mess1']);
                    }
                    ?>
                    <label for="pass" class="ttl">Пароль</label>
                    <input type="password" name="pass" id="pass" required placeholder="Введите пароль">
                    <?php
                    if($_SESSION['mess2']) {
                      echo '<span id="mess">'.$_SESSION['mess2'].'</span>';
                      unset($_SESSION['mess2']);
                    }
                    ?>
                    <div class="all-rem">
                      <div class="remember">
                          <input type="checkbox" name="rem" id="rem">
                          <label for="rem">Запомнить меня</label>
                      </div>
                      <div class="forget">Восстановить пароль?</div>
                    </div>
                    <input type="submit" value="Авторизироваться">
                </form>
            </div>
          </div>
        </section>
      </main>
      </div>
      <script>
        const emailInput = document.getElementById('email');
        const passInput = document.getElementById('pass');
        const messSpans = document.querySelectorAll('#mess');
        // добавляем обработчик событий для input phone_number
        emailInput.addEventListener('input', function(event) {
          messSpans.forEach(function(messSpan) {
            messSpan.remove();
          });
        });
        // добавляем обработчик событий для input email
        passInput.addEventListener('input', function(event) {
          messSpans.forEach(function(messSpan) {
            messSpan.remove();
          });
        });
      </script>
  </body>
</html>