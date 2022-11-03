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
        <div class="go-back"><a class="go-back__link" href="admin/index.php"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
        <!--  -->
        <!-- Поиск -->
        <div class="search__wrapper search__wrapper--delete-Q">
            <div class="search">
                <input class="search-input" type="text" placeholder="Урок или вопрос + Enter">
                <button class="search__btn"><img class="search__btn-img" src="../images/cancel.png" alt="Отменить"></button>
            </div>
        </div>
        <!--  -->
        <div class="admin-lessons">
            <!-- Кусок вёрстки взят из административной страницы, чтобы не мучиться с классами CSS -->
            <?php foreach ($questions as $question) : ?>
                <?php foreach ($lessons as $lesson) : ?>
                    <?php if ($question["q_lesson"] == $lesson["id"]) : ?>
                        <div class="delete-question-wrapper">
                            <div class="lesson-name"><span>Урок: </span><?=$lesson["title"]?></div>
                            <div class="admin-lessons__item">
                                <div class="admin-lessons__item-descr">
                                    <div class="admin-lessons__item-name admin-lessons__item-name--test-delete"><?= $question["q_name"]?></div>
                                </div>
                                <div class="admin-btns-wrapper">
                                    <div class="admin-lessons__edit-btn"><a href="../index.php?action=deletetest&q_id=<?=$question["q_id"]?>"><img class="admin-btn-img" src="../images/trash.png" alt="Удалить"></a></div>
                                </div>
                            </div>
                        </div>
                    <?php endif?>
                <?php endforeach?>
            <?php endforeach?>
        </div>
        <!--  -->
    </div>
    <script src="../script.js"></script>
</body>
</html>