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
    <link rel="stylesheet" href="/assets/css/conference.css">
    <title>PsihoDoc</title>
  </head>
  <body>
  <div class="page">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php')?>
      <main>
        <div class="modal" id="modal">
            <div class="modal-exit" id="modal-exit">
                <div class="title">Вы уверены, что хотите выйти?</div>
                <button id="btn-exit">Выйти</button>
                <span id="back">Вернуться</span>
            </div>
            <div class="confirm-exit" id="confirm-exit">
                <div class="title">Какая была причина выхода из конференции?</div>
                <textarea name="text" id="text" placeholder="Опишите причину остановки консультации"></textarea>
                <button>Продолжить</button>
            </div>
        </div>
        <section>
          <div class="container">
            <div class="section__inner">
                <div class="video"></div>
                <div class="right">
                    <div class="camera">
                        <div class="text">У вас не включена камера</div>
                        <button id="btn-off">Включить</button>
                    </div>
                    <button class="exit" id="exit-conf">Отключиться со звонка</button>
                    <div class="alert">Если весомой причины остановки консультации не было, и клиент не нарушил правила сообщества - вам не вернутся деньги</div>
                </div>
            </div>
          </div>
        </section>
      </main>
    </div>
    <script>
        const exit_conf = document.getElementById('exit-conf');
        const btn_exit = document.getElementById('btn-exit');
        const back = document.getElementById('back');
        const modal = document.getElementById('modal');
        const modal_exit = document.getElementById('modal-exit');
        const confirm_exit = document.getElementById('confirm-exit');
        exit_conf.addEventListener('click', () => {
            modal.style.display = "flex";
            modal_exit.style.display = "flex";
            confirm_exit.style.display = "none";
        });
        btn_exit.addEventListener('click', () => {
            modal_exit.style.display = "none";
            confirm_exit.style.display = "flex";
        });
        modal.addEventListener("click", (event) => {
            if (event.target == modal || event.target == back) {
                modal.style.display = "none";
            }
        });
    </script>
  </body>
</html>