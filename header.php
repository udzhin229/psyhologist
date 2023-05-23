<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Заголовок страницы</title>
    <style>
        /* Header */
        header {
            padding: 31px 0;
            background: #FFFFFF;
            box-shadow: 0px 0px 19px rgba(0, 0, 0, 0.08);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
            width: 100%;
        }
        header nav {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        header nav .nav-left, header nav .nav-left .nav-brand, header nav .nav-right, header nav .nav-left .nav-lang {
            display: flex;
            align-items: center;
        }
        header nav .nav-left {
            gap: 80px;
        }
        header nav .nav-left .nav-brand {
            text-decoration: none;
        }
        header nav .nav-left .nav-brand > span {
            font-family: var(--font-gilr);
            font-style: normal;
            font-weight: 600;
            font-size: 24px;
            line-height: 29px;
            color: #333333;
            padding-left: 20px;
        }
        header nav .nav-left .nav-lang {
            gap: 9px;
        }
        header nav .nav-left .nav-lang a {
            text-decoration: none;
            font-family: var(--font-gilr);
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 19px;
            color: rgba(51, 51, 51, 0.15);
        }
        header nav .nav-left .nav-lang .line {
            width: 1px;
            height: 19px;
            background: rgba(51, 51, 51, 0.15);
        }
        header nav .nav-left .nav-lang a.active {
            color: #333333;
        }
        header nav .nav-right {
            position: relative;
            gap: 70px;
        }
        header nav .nav-right .me-3 {
            display: flex;
            align-items: center;
            gap: 30px;
        }
        header nav .nav-right .me-3 > a {
            text-decoration: none;
            font-family: var(--font-gilr);
            font-style: normal;
            font-weight: 500;
            font-size: 18px;
            line-height: 21px;
            color: #333333;
        }
        header nav .nav-right a.btn-profile {
            text-decoration: none;
            cursor: pointer;
            outline: none;
            border: none;
            height: 55px;
            background: #B1DDCF;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 0 30px 0 20px;
        }
        header nav .nav-right a.btn-profile > span {
            font-family: var(--font-gilr);
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 25px;
            color: #333333;
        }
        header nav .nav-right .profile {
            cursor: pointer;
            border-radius: 50%;
            display: grid;
            place-items: center;
            overflow: hidden;
            width: 63px;
            height: 63px;
        }
        header nav .nav-right .block-modal {
            display: none;
            position: absolute;
            flex-direction: column;
            gap: 17px;
            bottom: -133px;
            right: 20px;
            width: 243px;
            background: #FFFFFF;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.13);
            border-radius: 11px;
            padding: 20px 0 13px 17px;
        }
        header nav .nav-right .block-modal.hide {
            display: flex;
        }
        header nav .nav-right .block-modal .bl-modal {
            display: flex;
            align-items: center;
            width: 100%;
            text-decoration: none;
            gap: 20px;
        }
        header nav .nav-right .block-modal .bl-modal .img {
            width: 100%;
            max-width: 24px;
            display: flex;
        }
        header nav .nav-right .block-modal .bl-modal > span {
            font-family: var(--font-gilr);
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 16px;
            width: 100%;
            color: #333333;
        }
        </style>
  </head>
  <body>
    <header>
        <div class="container">
            <nav>
                <div class="nav-left">
                    <a href="/" class="nav-brand">
                        <img src="/assets/images/logo.svg" alt="Logo"/>
                        <span>PsihoDoc</span>
                    </a>
                    <div class="nav-lang">
                        <a href="" class="active">UA</a>
                        <div class="line"></div>
                        <a href="">ENG</a>
                    </div>
                </div>
                <div class="nav-right">
                    <div class="me-3">
                        <?php if($_SESSION['user_mail']) {echo '<a href="/chat.php">Чаты</a>';} ?>
                        <?php if(isset($_SESSION['user_mail'])) {
                            // Получаем информацию о текущем пользователе из базы данных
                            $user_id = $_SESSION['user_mail'];
                            $stmt = $pdo->prepare("SELECT role_id FROM psychologists WHERE email=:email");
                            $stmt->bindParam(':email', $user_id);
                            $stmt->execute();
                            $user = $stmt->fetch();

                            // Если пользователь - психолог, выводим ссылку на супервизоров
                            if($user['role_id'] == '2') {
                            echo '<a href="#">Супервизоры</a>';
                            }
                        } ?>
                        <a href="#">Курсы для психологов</a>
                    </div>
                    <?php
                    if(!$_SESSION['user_mail']) {
                        echo '<a href="/registration.php" class="btn-profile" id="btn-profile">
                        <img src="/assets/images/header-btn.svg" alt="">
                        <span>Профіль</span>
                        </a>';
                    }
                    else {
                        echo '<div class="profile" id="profile">
                        <img src="/assets/images/profile.svg" alt="">
                        </div>';
                    }
                    ?>
                    <div class="block-modal" id="block-modal">
                        <a href="#" class="bl-modal">
                            <div class="img">
                                <img src="/assets/images/add-photo.svg" alt="">
                            </div>
                            <span>Добавить фото</span>
                        </a>
                        <a href="#" class="bl-modal">
                            <div class="img">
                                <img src="/assets/images/add-certif.svg" alt="">
                            </div>
                            <span>Добавить сертификат</span>
                        </a>
                        <a href="#" class="bl-modal" onclick="logout(event)">
                            <div class="img">
                                <img src="/assets/images/exit.svg" alt="">
                            </div>
                            <span>Выйти из аккаунта</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    </body>
</html>
<script>
    const block = document.getElementById('block-modal')
    const profile = document.getElementById('profile');
    if (profile) {
        profile.addEventListener('click', function() {
        block.classList.toggle('hide');
      });
    }
    function logout(event) {
        event.preventDefault();
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/assets/bd/logout.php", true);
        xhr.send();
        location.replace('/');
    }
</script>