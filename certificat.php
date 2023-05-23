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
    <link rel="stylesheet" href="/assets/css/certificate.css">
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
                    <div class="title-text">Верификация</div>
                    <div class="line">
                        <hr>
                        <div class="green-line"></div>
                    </div>
                </div>
                <form action="">
                    <div class="title">Верификация</div>
                    <label for="file1" class="ttl">Добавьте сертификат супервизора</label>
                    <div class="file1">Прикрепить</div>
                    <div class="file1-text">Файл номер 1</div>
                    <input type="submit" value="Отправить заявку">
                    <input style="margin: 0; border: 2px solid rgba(0, 0, 0, 0.15); background: transparent;" type="submit" value="Выйти">
                </form>
            </div>
          </div>
        </section>
      </main>
      </div>
  </body>
</html>