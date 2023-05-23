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
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="/assets/css/root.css">
    <link rel="import" href="header.html">
    <title>PsihoDoc</title>
  </head>
  <body>
    <div class="page">
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php')?>
        <main>
            <section class="sec1">
                <div class="container">
                    <div class="section__inner">
                        <h1 class="title">PsihoDoc - твой психолог всегда рядом</h1>
                        <div class="grid">
                            <div class="grid-item">
                                <img src="/assets/images/sec1/s1.svg" alt="">
                                <p>Більшість клієнтів<br>обирали психолога з<br>першого разу</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec1/s2.svg" alt="">
                                <p>Каждый третий клиент<br>нашёл психолога у нас</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec1/s3.svg" alt="">
                                <p>Психолог на<br>любой бюджет</p>
                            </div>
                        </div>
                        <a href="/psychologist/psychologist.php" class="button">Выбрать психолога</a>
                    </div>
                </div>
            </section>
            <section class="sec2">
                <div class="container">
                    <div class="section__inner">
                        <h1 class="title">Мы Вам поможем:</h1>
                        <div class="grid">
                            <div class="grid-item">
                                <img src="/assets/images/sec2/1.svg" alt="">
                                <p>Побороти<br>залежність</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec2/2.svg" alt="">
                                <p>Впоратися<br>з емоційним<br>вигоранням</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec2/3.svg" alt="">
                                <p>Вийти з<br>депресії</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec2/4.svg" alt="">
                                <p>Впоратись<br>з тривогою</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec2/5.svg" alt="">
                                <p>Пережити<br>горе та втрату</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec2/6.svg" alt="">
                                <p>Підняти<br>самооцінку</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec2/7.svg" alt="">
                                <p>Налагодити сімейні<br>стосунки між<br>чоловіком і дружиною,<br>між батьками й дітьми</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec2/8.svg" alt="">
                                <p>Впоратися з розладом<br>харчової поведінки</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec2/9.svg" alt="">
                                <p>Розібратися<br>в собі</p>
                            </div>
                        </div>
                        <a href="/psychologist/psychologist.php" class="button">Начать терапию</a>
                    </div>
                </div>
            </section>
            <section class="sec3">
                <div class="container">
                    <div class="section__inner">
                        <div class="head">
                            <img src="/assets/images/logo1.svg" alt="">
                            <div class="ttl">
                                <div class="up-title">PsihoDoc</div>
                                <div class="title">Проста комунікація,<br>великі результати</div>
                            </div>
                        </div>
                        <div class="grid">
                            <div class="grid-item">
                                <img src="/assets/images/sec3/1.svg" alt="">
                                <p>Тільки перевірені<br>кваліфіковані спеціалісти</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec3/2.svg" alt="">
                                <p>Безкоштовне скасування чи<br>перенесення сесії </p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec3/3.svg" alt="">
                                <p>Консультації психологів за<br>розумною ціною</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec3/4.svg" alt="">
                                <p>Вагаєтесь в виборі психолога?<br>Напишіть йому в чаті додаткові<br>питання</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec3/5.svg" alt="">
                                <p>Конфіденційність та<br>приватність</p>
                            </div>
                            <div class="grid-item">
                                <img src="/assets/images/sec3/6.svg" alt="">
                                <p>Зміна психолога в будь-який<br>час</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="sec4">
                <div class="container">
                    <div class="sec4__inner">
                        <img src="/assets/images/doc.svg" alt="">
                        <div class="right">
                            <div class="title">Доєднуйтесь до команди<br>психологів PsihoDoc</div>
                            <div class="text">Ти професійний психолог, психіатр або психотерапевт,  зареєструйся на нашому сайті та стань членом нашої команди. Ти отримаєш можливість заробляти віддалено, у зручний час і зручному місці, не хвилюючись про оплату. Самостійно керуй своїм графіком, саморозвивайся та отримай цінний досвід роботи з клієнтами різних вікових і соціальних груп.</div>
                            <div class="dtext">Приєднуйся до нас і допомагай людям змінювати своє життя на краще!</div>
                            <a href="/registration.php" class="button">Зарегистрироваться</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
  </body>
</html>
