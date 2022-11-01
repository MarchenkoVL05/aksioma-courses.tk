<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Шрифты -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Мои стили -->
    <link href="../style.css" rel="stylesheet">
    <title>Все уроки</title>
    <!-- bitrix24 api -->
    <script src="https://api.bitrix24.com/api/v1/"></script>
</head>
<body>
    <div class="container">
        <h1 class="lessons-title"><img class="lessons-title__img" src="./images/mortarboard.png" alt="Шапочка"> Список всех уроков</h1>
        <div class="greeting"></div>
        <!-- Кнопки -->
        <div class="admin-panel-buttons-wrapper">
            <a href="../admin/index.php"><button class="admin-panel-btn">Панель администратора</button></a>
            <a href="#"><button class="admin-panel-btn admin-panel-btn--testResults">Назначенные уроки</button></a>
            <a href="#">
                <button class="admin-panel-btn admin-panel-btn--testResults">
                    <img class="resluts-btn-img" src="../images/results.png" alt="Результаты"> Мои результаты
                </button>
            </a>
        </div>
        <!-- Поиск -->
        <div class="search__wrapper">
            <div class="search">
                <input class="search-input" type="text" placeholder="Поиск + Enter">
                <button class="search__btn"><img class="search__btn-img" src="../images/cancel.png" alt="Отменить"></button>
            </div>
            <a class="username-link" href="index.php?action=auth&username="><button class="btn-register">Авторизоваться в приложении</button></a>
        </div>
        <!-- Выбор категории -->
        <div class="categories">
            <div class="categories__title">Выбор категории:</div>
            <div class="categories__btn-wrapper">
                <?php if ($categories) foreach ($categories as $category) : ?>
                <button onclick="window.location.href='../index.php?action=filter&id=<?=$category['id']?>'" 
                class="categories__btn <?php if ($_GET['id'] == $category["id"]) echo 'categories__btn--active'?>"><?= $category["category_name"]?></button>
                <?php endforeach ?>
            </div>
        </div>
        <!-- Список уроков -->
        <div class="lessons">
            <?php foreach ($lessons as $lesson) : ?>
            <div class="lessons__item">
                <div class="lessons__item-name"><a href="lesson.php?id=<?=$lesson["id"]?>"><?= $lesson["title"]?></a></div>
                <div class="lessons__item-date">Опубликовано: <?= $lesson["date"]?></div>
            </div>
            <?php endforeach?>
        </div>
    </div>
    <script src="../script.js"></script>
    <script>
        BX24.init(function() {
            // Вывести приветствие
            BX24.callMethod('user.current', {}, function(res) {
                let greeting = document.querySelector(".greeting");
                let username = res.data().NAME + ' ' + res.data().LAST_NAME;
                greeting.innerHTML = `Добрый день, ${username}!`;
                
                let userNameLink = document.querySelector(".username-link");
                userNameLink.href = `index.php?action=auth&username=${username}`;
            });
        });
    </script>
</body>
</html>