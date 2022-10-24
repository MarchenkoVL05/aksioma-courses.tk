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
        <a href="../admin/index.php"><button class="admin-panel-btn">Панель администратора</button></a>
        <div class="search">
            <input class="search-input" type="text" placeholder="Поиск + Enter">
            <button class="search__btn"><img class="search__btn-img" src="../images/cancel.png" alt="Отменить"></button>
        </div>
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
</body>
</html>