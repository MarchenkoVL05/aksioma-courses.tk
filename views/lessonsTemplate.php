<?php
    // Пагинация
    $page = $_GET["page"];
    // Количество выводимых уроков на странице
    $count = 8;
    // Вычисляем количество страниц
    $page_count = floor(count($lessons) / $count);

    $acCounter = '';
?>
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
        <div class="greeting">Добрый день</div>
        <!-- Кнопки -->
        <div class="admin-panel-buttons-wrapper">
            <a id="admin-panel-link" href="../admin/index.php"><button class="admin-panel-btn">Панель администратора</button></a>
            <a id="appoint-cur-link" href="index.php?action=appoint">
                <button class="admin-panel-btn admin-panel-btn--testResults">
                    Назначенные курсы
                </button>
                <?php foreach ($appointedCourses as $ac) : ?>
                    <?php if ($ac["username"] == $curUserName && $ac["done"] != 1) : ?>
                        <?php $acCounter++?>
                        <div class="appointed-cirlce"><?=$acCounter?></div>
                    <?php endif?>
                <?php endforeach?>
            </a>
            <a id="my-results-link" href="index.php?action=myresults">
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
            <div class="categories__title">Выберите курс:</div>
            <div class="categories__btn-wrapper">
                <?php if ($categories) foreach ($categories as $category) : ?>
                <button onclick="window.location.href='../index.php?action=filter&id=<?=$category['id']?>'" 
                class="categories__btn <?php if ($_GET['id'] == $category["id"]) echo 'categories__btn--active'?>"><?= $category["category_name"]?></button>
                <?php endforeach ?>
            </div>
            <div class="categories__more"><button class="categories__more-btn">больше категорий <span>&darr;</span></button></div>
        </div>
        <!-- Список уроков -->
        <div class="lessons">
            <!-- Постраничный вывод уроков -->
            <?php for ($i = $page * $count; $i < ($page + 1) * $count; $i++) : ?>
                <?php if ($lessons[$i]["id"] != NULL) : ?>
                    <div class="lessons__item">
                        <div class="lessons__item-name"><a class="lessons__item-name-link" href="lesson.php?id=<?=$lessons[$i]["id"]?>"><?= $lessons[$i]["title"]?></a></div>
                        <div class="lessons__item-date">Опубликовано: <?= $lessons[$i]["date"]?></div>
                    </div>
                <?php endif?>
            <?php endfor?>
        </div>
        <div class="page-list">
            <?php if ($page_count <= 5) : ?>

                <?php for ($p = 0; $p <= $page_count; $p++) :?>
                    <!-- Если выбрана категория -->
                    <?php if ($_GET['action'] != NULL) : ?>
                        <a href="?action=<?=$_GET['action']?>&id=<?=$_GET['id']?>&page=<?=$p?>"><button class="page-btn <?php if ($p == $_GET["page"]) echo 'page-btn--active'?>"><?=$p + 1?></button></a>
                    <?php else : ?>
                        <a href="?page=<?=$p?>"><button class="page-btn <?php if ($p == $_GET["page"]) echo 'page-btn--active'?>"><?=$p + 1?></button></a>
                    <?php endif;?>
                <?php endfor;?>

            <?php else : ?>

                <!-- Выводим первые 5 страниц -->
                <?php if ($_GET["page"] < 4) : ?>
                    <?php for ($p = 0; $p < 5; $p++) : ?>
                        <?php if ($_GET['action'] != NULL) : ?>
                        <a href="?action=<?=$_GET['action']?>&id=<?=$_GET['id']?>&page=<?=$p?>"><button class="page-btn <?php if ($p == $_GET["page"]) echo 'page-btn--active'?>"><?=$p + 1?></button></a>
                        <?php else : ?>
                            <a href="?page=<?=$p?>"><button class="page-btn <?php if ($p == $_GET["page"]) echo 'page-btn--active'?>"><?=$p + 1?></button></a>
                        <?php endif;?>
                        <!--  -->
                    <?php endfor?>
                    <div class="pagination-dots">...</div>
                    <a href="?action=<?=$_GET['action']?>&id=<?=$_GET['id']?>&page=<?=$p?>"><button class="page-btn <?php if ($p == $_GET["page"]) echo 'page-btn--active'?>"><?=$page_count?></button></a>
                <!-- Нажата последняя страница перед "..." -->
                <?php elseif($_GET["page"] >= 4 && (($_GET["page"] + 4) < $page_count)) : ?>
                    <?php for ($p = $_GET["page"] - 3; $p < $_GET["page"] + 2; $p++) : ?>
                        <a href="?action=<?=$_GET['action']?>&id=<?=$_GET['id']?>&page=<?=$p?>"><button class="page-btn <?php if ($p == $_GET["page"]) echo 'page-btn--active'?>"><?=$p + 1?></button></a>
                    <?php endfor?>
                    <div class="pagination-dots">...</div>
                    <a href="?action=<?=$_GET['action']?>&id=<?=$_GET['id']?>&page=<?=$page_count - 1?>"><button class="page-btn <?php if ($p == $_GET["page"]) echo 'page-btn--active'?>"><?=$page_count?></button></a>
                <!-- Убрать точки в конце списка страниц -->
                <?php elseif (($_GET["page"] + 4) < $page_count) : ?>
                    <?php for ($p = $_GET["page"] - 1; $p < $page_count; $p++) : ?>
                        <a href="?action=<?=$_GET['action']?>&id=<?=$_GET['id']?>&page=<?=$p?>"><button class="page-btn <?php if ($p == $_GET["page"]) echo 'page-btn--active'?>"><?=$p + 1?></button></a>
                    <?php endfor?>
                <!-- Конец списка страниц -->
                <?php elseif (($_GET["page"] + 4) >= $page_count) : ?>
                    <div class="pagination-dots">...</div>
                    <?php for ($p = $_GET["page"] - 2; $p < $page_count; $p++) : ?>
                        <a href="?action=<?=$_GET['action']?>&id=<?=$_GET['id']?>&page=<?=$p?>"><button class="page-btn <?php if ($p == $_GET["page"]) echo 'page-btn--active'?>"><?=$p + 1?></button></a>
                    <?php endfor?>
                <?php endif?>
            <?endif?>
        </div>
    </div>
    <script src="../script.js"></script>
    <script>
        BX24.init(function() {
            // Вывести приветствие
            BX24.callMethod('user.current', {}, function(res) {
                let greeting = document.querySelector(".greeting");
                let username = res.data().NAME + ' ' + res.data().LAST_NAME;
                greeting.innerHTML += `, ${username}!`;
                
                let userNameLink = document.querySelector(".username-link");
                userNameLink.href = `index.php?action=auth&username=${username}`;

                let lessonLink = document.querySelectorAll('.lessons__item-name-link');
                lessonLink.forEach((link) => {
                    link.href += `&username=${username}`;
                });

                let myResultsLink = document.getElementById("my-results-link");
                myResultsLink.href += `&username=${username}`;

                let appointCurLink = document.getElementById("appoint-cur-link");
                appointCurLink.href += `&username=${username}`;
            });
        });
    </script>
</body>
</html>