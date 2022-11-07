<?php
    // Пагинация
    $page = $_GET["page"];
    // Количество выводимых уроков на странице
    $count = 8;
    // Вычисляем количество страниц
    $page_count = floor(count($lessons) / $count);
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
</head>
<body>
    <div class="container">
        <h1 class="lessons-title"><img class="lessons-title__img" src="./images/mortarboard.png" alt="Шапочка"> Список всех уроков</h1>
        <!-- Кнопки -->
        <div class="admin-panel-buttons-wrapper">
            <a id="admin-panel-link" href="../admin/index.php"><button class="admin-panel-btn">Панель администратора</button></a>
            <a href="#"><button class="admin-panel-btn admin-panel-btn--testResults">Назначенные уроки</button></a>
            <a id="my-results-link" href="index.php?action=myresults">
                <button class="admin-panel-btn admin-panel-btn--testResults">
                    <img class="resluts-btn-img" src="../images/results.png" alt="Результаты"> Мои результаты
                </button>
            </a>
        </div>
        <!-- Поиск -->
        <div class="search__wrapper">
            <div class="search">
                <input class="search-input" type="text" value="<?=$_GET["word"]?>" placeholder="Поиск + Enter">
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
            <div class="categories__more"><button class="categories__more-btn">больше категорий <span>&darr;</span></button></div>
        </div>
        <!-- Список уроков -->
        <div class="lessons">
            <?php foreach ($lessons as $lesson) : ?>
                <div class="lessons__item">
                    <div class="lessons__item-name"><a class="lessons__item-name-link" href="lesson.php?id=<?=$lesson["id"]?>"><?= $lesson["title"]?></a></div>
                    <div class="lessons__item-date">Опубликовано: <?= $lesson["date"]?></div>
                </div>
                <?php endforeach?>
        </div>
    </div>
    <script src="../script.js"></script>
    <script>
        let url = new URL(window.location.href);
        var word = url.searchParams.get("word");
        

        let lessonsItemNames = document.querySelectorAll(".lessons__item-name");

        let searchInput = document.querySelector(".search-input");
        let searchCloseBtn = document.querySelector(".search__btn");

        searchInput.value = `${word}`;
        searchCloseBtn.style.display = "block";

        searchCloseBtn.addEventListener("click", (event) => {
            event.target.style.display = "none";
            window.location.href = "index.php";
        });

        lessonsItemNames.forEach((itemName, itemIndex) => {
        if (!itemName.textContent.toLowerCase().includes(word.toLowerCase())) {
          itemName.parentNode.style.display = "none";
        }
      });
    </script>
</body>
</html>