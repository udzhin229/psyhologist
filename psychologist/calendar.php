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
    <link rel="stylesheet" href="/assets/css/calendar.css">
    <title>PsihoDoc</title>
  </head>
  <body>
  <div class="page">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php')?>
      <main>
        <section>
          <div class="container">
            <div class="section__inner">
                <div class="left">
                    <div class="title">Выберите время</div>
                    <div class="online"><img src="/assets/images/calendar/online.png" alt="online">онлайн</div>
                    <div class="price_min"><span id="price">1000</span> грн, <span id="min">60</span> минут</div>
                    <div class="calendar">
                        <div class="header">
                            <img style="cursor: pointer;" id="prev" src="/assets/images/calendar/prev.png" alt="prev">
                            <div id="month">1-14 мая</div>
                            <img style="cursor: pointer;" id="next" src="/assets/images/calendar/next.png" alt="next">
                        </div>
                        <div class="days">
                            <div class="day">пн</div>
                            <div class="day">вт</div>
                            <div class="day">ср</div>
                            <div class="day">чт</div>
                            <div class="day">пт</div>
                            <div class="day">сб</div>
                            <div class="day">вс</div>
                        </div>
                        <div class="dates">

                        </div>
                    </div>
                    <div class="time">Выберите время</div>
                    <div class="time_blocks">
                        <div class="block active">9:00</div>
                        <div class="block">10:00</div>
                    </div>
                </div>
            </div>
          </div>
        </section>
      </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
        var currentDate = new Date();
        var currentMonth = currentDate.getMonth();
        var currentYear = currentDate.getFullYear();

        function updateCalendar() {
            var monthText = getMonthName(currentMonth) + ' ' + currentYear;
            $('#month').text(monthText);

            // Очищаем предыдущие даты
            $('.date').remove();

            var startDate = new Date(currentYear, currentMonth, 1);
            var endDate = new Date(currentYear, currentMonth + 1, 0);
            var startDay = startDate.getDay(); // Номер первого дня месяца (0 - воскресенье, 1 - понедельник, и т.д.)
            var totalDays = endDate.getDate(); // Общее количество дней в месяце

            // Пересчитываем startDay для недели, начинающейся с понедельника
            if (startDay === 0) {
                startDay = 6;
            } else {
                startDay--;
            }

            // Получаем даты предыдущего месяца
            var prevMonthEndDate = new Date(currentYear, currentMonth, 0);
            var prevMonthTotalDays = prevMonthEndDate.getDate();
            var prevMonthStartDay = startDay - 1; // Номер первого дня предыдущего месяца

            // Генерируем даты предыдущего месяца
            for (var i = prevMonthTotalDays - prevMonthStartDay; i <= prevMonthTotalDays; i++) {
                var $date = $('<div class="date not-now">' + i + '</div>');
                $('.dates').append($date);
            }

            // Генерируем даты текущего месяца
            for (var j = 1; j <= totalDays; j++) {
                var $date = $('<div class="date active">' + j + '</div>');
                if (currentYear === currentDate.getFullYear() && currentMonth === currentDate.getMonth() && j === currentDate.getDate()) {
                $date.addClass('today');
                }
                $('.dates').append($date);
            }

            // Добавляем дополнительные даты следующего месяца, если необходимо
            var remainingCells = 7 - ($('.date').length % 7);
            if (remainingCells < 7) {
                for (var k = 1; k <= remainingCells; k++) {
                var $date = $('<div class="date not-now">' + k + '</div>');
                $('.dates').append($date);
                }
            }
        }
        // Функция для получения названия месяца по индексу
        function getMonthName(monthIndex) {
            var monthNames = ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'];
            return monthNames[monthIndex];
        }

        // Обработчики событий для кнопок "prev" и "next"
        $('#prev').click(function() {
            currentMonth--;
            if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
            }
            updateCalendar();
        });

        $('#next').click(function() {
            currentMonth++;
            if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
            }
            updateCalendar();
        });

        updateCalendar(); // Инициализация отображения календаря

        $(".date.active").click(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var email = urlParams.get('email');
            
            $.ajax({
                type: 'post',
                url: '/assets/bd/take_time.php',
                data: {email: email},
                success: function(response){
                    console.log(response);
                }
            });
        });
        });
    </script>
    </body>
</html>