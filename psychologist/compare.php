<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/bd/connect.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/bd/pdo_psyho.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/assets/css/root.css">
    <link rel="stylesheet" href="/assets/css/psychologist.css">
    <title>PsihoDoc</title>
  </head>
  <body>
  <div class="page">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php')?>
      <main>
        <section>
          <div class="container">
            <div class="section__inner">
              <div class="head">
                <div class="title">Сравнение психологов</div>
              </div>
              <div class="blocks">
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        function likePsyho() {
            // Получаем сохраненные идентификаторы психологов из localStorage
            var comparePsychologists = localStorage.getItem('comparePsychologists');
            if (comparePsychologists) {
            comparePsychologists = JSON.parse(comparePsychologists);
            } else {
            comparePsychologists = [];
            }

            // Обработчик клика на сердечко
            $('.like-fill').click(function() {
            $(this).toggleClass('active');
            var psychologistId = $(this).closest('.block').data('psychologist-id');
            if ($(this).hasClass('active')) {
                // Добавляем идентификатор психолога в список сравнения
                comparePsychologists.push(psychologistId);
            } else {
                // Удаляем идентификатор психолога из списка сравнения
                var index = comparePsychologists.indexOf(psychologistId);
                if (index !== -1) {
                comparePsychologists.splice(index, 1);
                }
            }
            
            // Сохраняем список сравнения в localStorage
            localStorage.setItem('comparePsychologists', JSON.stringify(comparePsychologists));
            showLocalPsyho();
            });
            // Восстанавливаем состояние элементов
            $('.like-fill').each(function() {
            var psychologistId = $(this).closest('.block').data('psychologist-id');
            if (comparePsychologists.indexOf(psychologistId) !== -1) {
                $(this).addClass('active');
            }
            });
        }
        function showLocalPsyho() {
            var comparePsychologists = localStorage.getItem('comparePsychologists');
            if (comparePsychologists) {
            comparePsychologists = JSON.parse(comparePsychologists);
            $.ajax({
                url: '/assets/bd/get_psyho_local.php',
                type: 'POST',
                data: {psychologistIds: comparePsychologists},
                dataType: 'json',
                success: function(response) {
                // Очистка блока перед добавлением новых данных
                $('.blocks').empty();
                // Добавление данных о психологах на страницу
                $.each(response, function(index, row) {
                    var block = '<div class="block" data-psychologist-id="'+row['id']+'">' +
                            '<div class="mark"><img src="/assets/images/star.svg" alt="">5.00</div>' +
                            '<div class="photo_like">' +
                            '<div class="ava"><img src="/assets/images/ava.svg" alt="avatar"></div>' +
                            '<div class="like-fill"></div>' +
                            '</div>' +
                            '<div class="name">'+row['name']+'</div>' +
                            '<div class="who">Психолог</div>' +
                            '<div class="practice">' +
                            '<div class="exp">Опыт '+row['year']+' лет</div>' +
                            '<div class="point"></div>' +
                            '<div class="exp">1 000+ часов практики</div>' +
                            '</div>' +
                            '<hr>' +
                            '<div class="desc">'+row['description']+'</div>' +
                            '<div class="price_per_min"><span>'+row['price']+'</span>грн за 60 мин.</div>' +
                            '<a href="/psychologist/profile.php?id='+row['id']+'" class="button">Ознакомится</a>' +
                            '<a href="#" class="button">Посмотреть время</a>' +
                            '</div>';
                $('.blocks').append(block);
                });
                likePsyho();
                },
                error: function() {
                $('.blocks').empty();
                console.log('Ошибка запроса на сервер.');
                }
            });
            } else {
            var compareStatus = localStorage.getItem('compareStatus');
            localStorage.setItem('compareStatus', 'false');
            loadPsyho();
            }
        }
    showLocalPsyho();
    });
    </script>
    <!-- <script>
      $(document).ready(function() {
        function checkClick() {
        var compareStatus = localStorage.getItem('compareStatus');
        if (compareStatus === 'true') {
          showLocalPsyho();
        } else {
          loadPsyho();
        }
      }
        checkClick();
      // Функция для выполнения AJAX-запроса и обновления содержимого страницы
      function loadPsyho() {
        $.ajax({
          url: '/assets/bd/get_psyho.php',
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            // Очистка блока перед добавлением новых данных
            $('.blocks').empty();
            // Добавление данных о психологах на страницу
            $.each(response, function(index, row) {
              var block = '<div class="block" data-psychologist-id="'+row['id']+'">' +
                          '<div class="mark"><img src="/assets/images/star.svg" alt="">5.00</div>' +
                          '<div class="photo_like">' +
                          '<div class="ava"><img src="/assets/images/ava.svg" alt="avatar"></div>' +
                          '<div class="like-fill"></div>' +
                          '</div>' +
                          '<div class="name">'+row['name']+'</div>' +
                          '<div class="who">Психолог</div>' +
                          '<div class="practice">' +
                          '<div class="exp">Опыт '+row['year']+' лет</div>' +
                          '<div class="point"></div>' +
                          '<div class="exp">1 000+ часов практики</div>' +
                          '</div>' +
                          '<hr>' +
                          '<div class="desc">'+row['description']+'</div>' +
                          '<div class="price_per_min"><span>'+row['price']+'</span>грн за 60 мин.</div>' +
                          '<a href="/psychologist/profile.php?id='+row['id']+'" class="button">Ознакомится</a>' +
                          '<a href="#" class="button">Посмотреть время</a>' +
                          '</div>';
              $('.blocks').append(block);
            });
            likePsyho();
          },
          error: function() {
            console.log('Ошибка запроса на сервер.');
          }
        });
      }
      function showLocalPsyho() {
        var comparePsychologists = localStorage.getItem('comparePsychologists');
        if (comparePsychologists) {
          comparePsychologists = JSON.parse(comparePsychologists);
          $.ajax({
            url: '/assets/bd/get_psyho_local.php',
            type: 'POST',
            data: {psychologistIds: comparePsychologists},
            dataType: 'json',
            success: function(response) {
              // Очистка блока перед добавлением новых данных
              $('.blocks').empty();
              // Добавление данных о психологах на страницу
              $.each(response, function(index, row) {
                var block = '<div class="block" data-psychologist-id="'+row['id']+'">' +
                          '<div class="mark"><img src="/assets/images/star.svg" alt="">5.00</div>' +
                          '<div class="photo_like">' +
                          '<div class="ava"><img src="/assets/images/ava.svg" alt="avatar"></div>' +
                          '<div class="like-fill"></div>' +
                          '</div>' +
                          '<div class="name">'+row['name']+'</div>' +
                          '<div class="who">Психолог</div>' +
                          '<div class="practice">' +
                          '<div class="exp">Опыт '+row['year']+' лет</div>' +
                          '<div class="point"></div>' +
                          '<div class="exp">1 000+ часов практики</div>' +
                          '</div>' +
                          '<hr>' +
                          '<div class="desc">'+row['description']+'</div>' +
                          '<div class="price_per_min"><span>'+row['price']+'</span>грн за 60 мин.</div>' +
                          '<a href="/psychologist/profile.php?id='+row['id']+'" class="button">Ознакомится</a>' +
                          '<a href="#" class="button">Посмотреть время</a>' +
                          '</div>';
              $('.blocks').append(block);
              });
              likePsyho();
            },
            error: function() {
              console.log('Ошибка запроса на сервер.');
            }
          });
        } else {
          var compareStatus = localStorage.getItem('compareStatus');
          localStorage.setItem('compareStatus', 'false');
          loadPsyho();
        }
      }
      $('#compare-button').click(function() {
        var compareStatus = localStorage.getItem('compareStatus');
        if (compareStatus === 'true') {
          loadPsyho(); // вызов функции для отображения всех психологов
          localStorage.setItem('compareStatus', 'false');
        } else {
          showLocalPsyho(); // вызов функции для отображения психологов
          localStorage.setItem('compareStatus', 'true');
        }
      });
      });
    </script> -->
  </body>
</html>