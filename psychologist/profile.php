<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/bd/connect.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'SELECT * FROM psychologists WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $psyho = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql1 = "SELECT * FROM files WHERE psyh_id = ?";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->bindParam(1, $id);
    $stmt1->execute();
    $files = $stmt1->fetchAll(PDO::FETCH_ASSOC);
} else {
    $id = null;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/assets/css/root.css">
    <link rel="stylesheet" href="/assets/css/profile.css">
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
                    <!-- Change to <video> -->
                    <div class="video"></div>
                    <div class="about">Обо мне:</div>
                    <div class="description"><?php echo $psyho['description'] ?></div>
                    <div class="about">Образование</div>
                    <div class="educations">
                        <?php
                        foreach ($files as $row) {
                            $pdf_file = $row['file'];
                            // Создаем уникальное имя файла
                            $filename = uniqid() . '.pdf';
                            // Сохраняем файл на сервере
                            file_put_contents($filename, $pdf_file);
                            // Выводим ссылку на файл
                            echo '
                            <div class="block">
                                <img src="/assets/images/education.svg" alt="">
                                <div class="texts">
                                    <div class="title">Національна академія додаткової професійної освіти</div>
                                    <div class="text">Практичний психолог. Сімейний психолог</div>
                                </div>
                                <a href="' . $filename . '" target="_blank"><img src="/assets/images/show.svg" alt=""></a>
                            </div>
                            ';
                        }
                        ?>
                        <!-- <div class="block">
                            <img src="/assets/images/education.svg" alt="">
                            <div class="texts">
                                <div class="title">Національна академія додаткової професійної освіти</div>
                                <div class="text">Практичний психолог. Сімейний психолог</div>
                            </div>
                            <a href="#"><img src="/assets/images/show.svg" alt=""></a>
                        </div>
                        <div class="block">
                            <img src="/assets/images/education.svg" alt="">
                            <div class="texts">
                                <div class="title">Національна академія додаткової професійної освіти</div>
                                <div class="text">Практичний психолог. Сімейний психолог</div>
                            </div>
                            <a href="#"><img src="/assets/images/show.svg" alt=""></a>
                        </div> -->
                    </div>
                    <div class="about">Мои направления работы</div>
                    <div class="vectors">
                        <?php 
                        $vector = explode(";", $psyho['vector']);
                        foreach ($vector as $value) {
                            echo '<div class="block">'.$value.'</div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="right">
                    <div class="name"><?php echo $psyho['name'] ?></div>
                    <div class="who">
                        <div class="who-bl">Клинический психолог</div>
                        <div class="who-bl">Психолог</div>
                    </div>
                    <div class="info">
                        <div class="info-bl"><?php echo $psyho['year'] ?> лет опыта работы</div>
                        <div class="info-bl"><?php echo $psyho['old'] ?> года</div>
                        <div class="info-bl">Проверено Psihodoc</div>
                    </div>
                    <div class="about">Когда ко мне обращаются</div>
                    <div class="when">
                        <div class="when-bl">Пережити горе</div>
                        <div class="when-bl">Пережити втрату</div>
                        <div class="when-bl">Підтримку в складних ситуаціях</div>
                        <div class="when-bl">Вийти з кризи</div>
                        <div class="when-bl">Подолати вікову кризу</div>
                        <div class="when-bl">Адаптуватися</div>
                        <div class="when-bl">Змін у житті</div>
                    </div>
                    <div class="next">
                        <div class="price_per_min"><span><?php echo $psyho['price'] ?></span>грн за 60 мин.</div>
                        <div class="where">Консультации проходят в онлайн режиме</div>
                        <a class="button" href="calendar.php?email=<?php echo $psyho['email']?>">Забронировать консультацию</a>
                        <a class="button" href="/chat.php?email=<?php echo $psyho['email']?>">Задать вопрос психологу</a>
                    </div>
                </div>
            </div>
          </div>
        </section>
      </main>
      </div>
  </body>
</html>