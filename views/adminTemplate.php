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
        <div class="go-back"><a class="go-back__link" href="../index.php"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
        <h1 class="admin-panel-title"><img class="admin-panel-title__img" src="../images/businessman.png" alt="Администратор"> Добро пожаловать в <span>Админку</span>!</h1>
        <p class="admin-text">Здесь вы можете редактировать Ваши курсы</p>
        <div class="admin-create-lesson-btns-wrapper">
            <a href="../index.php?action=add"><button class="admin-create-lesson-btn">Создать новый урок</button></a>
            <a href="../index.php?action=addcategory"><button class="admin-create-lesson-btn">Новый раздел</button></a>
            <a href="../index.php?action=userslist"><button class="admin-create-lesson-btn admin-create-lesson-btn--bg">Результаты тестов</button></a>
        </div>
        <!-- Назначить курс студенту -->
        <div class="appointCourse-wrapper">
            <a href="../index.php?action=appointCourse"><button class="admin-create-lesson-btn admin-create-lesson-btn--appoint">Назначить курс</button></a>
            <a href="../index.php?action=addtest"><button class="admin-create-lesson-btn admin-create-lesson-btn--test">Создать вопрос</button></a>
            <a href="../index.php?action=deletetest"><button class="admin-create-lesson-btn admin-create-lesson-btn--test">Удалить вопрос</button></a>
        </div>
        <!-- Поиск -->
        <div class="search">
            <div class="search__inner">
                <input class="search-input search-input--admin" type="text" placeholder="Поиск + Enter">
                <button class="search__btn search__btn--admin"><img class="search__btn-img" src="../images/cancel.png" alt="Отменить"></button>
            </div>
        </div>
        <!-- Управление категориями -->
        <div class="categories">
            <div class="categories__title">Управление категориями:</div>
            <div class="categories__btn-wrapper">
                <?php if ($categories) foreach ($categories as $category) : ?>
                <button class="categories__btn categories__btn--admin">
                    <?= $category["category_name"]?>
                    <div class="categories-admin-btn-inner">
                        <a href="../index.php?action=editcategory&id=<?=$category["id"]?>"><img class="categories-admin-btn-img" src="../images/pencil-2.png" alt="Редактировать"></a>
                        <a href="../index.php?action=deletecategory&id=<?=$category["id"]?>"><img class="categories-admin-btn-img" src="../images/trash-2.png" alt="Удалить"></a>
                    </div>
                </button>
                <?php endforeach ?>
            </div>
            <div class="categories__more"><button class="categories__more-btn">больше категорий <span>&darr;</span></button></div>
        </div>
        <!-- Список уроков -->
        <div class="admin-helps">
            <div class="admin-helps__item">
                <img class="admin-btn-img" src="../images/pencil.png" alt="Редактировать">
                <p>- Редактировать урок или название курса (категорию)</p>
            </div>
            <div class="admin-helps__item">
                <img class="admin-btn-img" src="../images/trash.png" alt="Удалить">
                <p>- Удалить урок или название курса</p>
            </div>
        </div>
        <div class="admin-lessons">
        <!--  -->
        <?php for ($i = $page * $count; $i < ($page + 1 ) * $count; $i++) : ?>
            <?php if ($lessons[$i]["title"] != NULL) : ?>
                <div class="admin-lessons__item">
                    <div class="admin-lessons__item-descr">
                        <div class="admin-lessons__item-name"><?= $lessons[$i]["title"]?></div>
                        <div class="admin-lessons__item-date"><?= $lessons[$i]["date"]?></div>
                    </div>
                    <div class="admin-btns-wrapper">
                        <div class="admin-lessons__edit-btn"><a href="../index.php?action=edit&id=<?=$lessons[$i]["id"]?>"><img class="admin-btn-img" src="../images/pencil.png" alt="Редактировать"></a></div>
                        <div class="admin-lessons__edit-btn"><a href="../index.php?action=delete&id=<?=$lessons[$i]["id"]?>"><img class="admin-btn-img" src="../images/trash.png" alt="Удалить"></a></div>
                    </div>
                </div>
            <?php endif;?>
        <?php endfor?>
        </div>
        <!--  -->
                <div class="page-list">
            <?php if ($page_count <= 5) : ?>

                <?php for ($p = 0; $p <= $page_count; $p++) :?>
                    <!-- Если выбрана категория -->
                    <?php if ($_GET['action'] != NULL) : ?>
                        <a class="page-btn-link" href="?page=<?=$p?>"><button class="page-btn page-btn--yellow <?php if ($p == $_GET["page"]) echo 'page-btn--active-yellow'?>"><?=$p + 1?></button></a>
                    <?php else : ?>
                        <a class="page-btn-link" href="?page=<?=$p?>"><button class="page-btn page-btn--yellow <?php if ($p == $_GET["page"]) echo 'page-btn--active-yellow'?>"><?=$p + 1?></button></a>
                    <?php endif;?>
                <?php endfor;?>

            <?php else : ?>

                <!-- Выводим первые 5 страниц -->
                <?php if ($_GET["page"] < 4) : ?>
                    <?php for ($p = 0; $p < 5; $p++) : ?>
                        <?php if ($_GET['action'] != NULL) : ?>
                        <a class="page-btn-link" href="?page=<?=$p?>"><button class="page-btn page-btn--yellow <?php if ($p == $_GET["page"]) echo 'page-btn--active-yellow'?>"><?=$p + 1?></button></a>
                        <?php else : ?>
                            <a class="page-btn-link" href="?page=<?=$p?>"><button class="page-btn page-btn--yellow <?php if ($p == $_GET["page"]) echo 'page-btn--active-yellow'?>"><?=$p + 1?></button></a>
                        <?php endif;?>
                        <!--  -->
                    <?php endfor?>
                    <div class="pagination-dots">...</div>
                    <a class="page-btn-link" href="?page=<?=$p?>"><button class="page-btn page-btn--yellow <?php if ($p == $_GET["page"]) echo 'page-btn--active-yellow'?>"><?=$page_count?></button></a>
                <!-- Нажата последняя страница перед "..." -->
                <?php elseif($_GET["page"] >= 4 && (($_GET["page"] + 5) < $page_count)) : ?>
                    <?php for ($p = $_GET["page"] - 3; $p < $_GET["page"] + 2; $p++) : ?>
                        <a class="page-btn-link" href="?page=<?=$p?>"><button class="page-btn page-btn--yellow <?php if ($p == $_GET["page"]) echo 'page-btn--active-yellow'?>"><?=$p + 1?></button></a>
                    <?php endfor?>
                    <div class="pagination-dots">...</div>
                    <a class="page-btn-link" href="?page=<?=$page_count - 1?>"><button class="page-btn page-btn--yellow <?php if ($p == $_GET["page"]) echo 'page-btn--active-yellow'?>"><?=$page_count?></button></a>
                <!-- Убрать точки в конце списка страниц -->
                <?php elseif (($_GET["page"] + 5) < $page_count) : ?>
                    <?php for ($p = $_GET["page"] - 1; $p < $page_count; $p++) : ?>
                        <a class="page-btn-link" href="?page=<?=$p?>"><button class="page-btn page-btn--yellow <?php if ($p == $_GET["page"]) echo 'page-btn--active-yellow'?>"><?=$p + 1?></button></a>
                    <?php endfor?>
                <!-- Конец списка страниц -->
                <?php elseif (($_GET["page"] + 5) >= $page_count) : ?>
                    <div class="pagination-dots">...</div>
                    <?php for ($p = $_GET["page"] - 2; $p < $page_count; $p++) : ?>
                        <a class="page-btn-link" href="?page=<?=$p?>"><button class="page-btn page-btn--yellow <?php if ($p == $_GET["page"]) echo 'page-btn--active-yellow'?>"><?=$p + 1?></button></a>
                    <?php endfor?>
                <?php endif?>
            <?endif?>
        </div>
        <!--  -->
    </div>
    <script src="../script.js"></script>
</body>
</html>