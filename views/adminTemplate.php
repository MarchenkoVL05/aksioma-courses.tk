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
        <div class="go-back"><a class="go-back__link" href="../index.php"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
        <h1 class="admin-panel-title"><img class="admin-panel-title__img" src="../images/businessman.png" alt="Администратор"> Добро пожаловать в <span>Админку</span>!</h1>
        <p class="admin-text">Здесь вы можете редактировать Ваши курсы</p>
        <a href="../index.php?action=add"><button class="admin-create-lesson-btn">Создать новый урок</button></a>
        <div class="search">
            <input class="search-input" type="text" placeholder="Поиск + Enter">
            <button class="search__btn"><img class="search__btn-img" src="../images/cancel.png" alt="Отменить"></button>
        </div>
        <div class="admin-lessons">
        <?php foreach ($lessons as $lesson) : ?>
            <div class="admin-lessons__item">
                <div class="admin-lessons__item-descr">
                    <div class="admin-lessons__item-name"><?= $lesson["title"]?></div>
                    <div class="admin-lessons__item-date"><?= $lesson["date"]?></div>
                </div>
                <div class="admin-btns-wrapper">
                    <div class="admin-lessons__edit-btn"><a href="../index.php?action=edit&id=<?=$lesson["id"]?>"><img class="admin-btn-img" src="../images/pencil.png" alt="Редактировать"></a></div>
                    <div class="admin-lessons__edit-btn"><a href="../index.php?action=delete&id=<?=$lesson["id"]?>"><img class="admin-btn-img" src="../images/trash.png" alt="Удалить"></a></div>
                </div>
            </div>
        <?php endforeach?>
        </div>
    </div>
    <script src="../script.js"></script>
</body>
</html>