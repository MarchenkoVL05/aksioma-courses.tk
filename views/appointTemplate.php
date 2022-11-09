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
    <title>Назначенные уроки</title>
</head>
<body>
    <!--  -->
    <?php $user = users_get($link, $_GET["username"]); ?>
    <!--  -->
    <div class="container">
        <div class="go-back"><a class="go-back__link" href="javascript:window.history.back()"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
        <p class="appoint-text appoint-text--bold"><img src="../images/teacher-1.png" alt="урок">Вам назначено прохождение следующих курсов: </p>
        <p class="appoint-text--small">Жмите на название для быстрого перехода к нему!</p>
        <div class="appoint-done-help">
            <img class="done-img done-img--opacity1" src="../images/done.png" alt="Пройден!">
            <div class="appoint-done-help-text">- Отметить курс пройденным</div>
        </div>
        <div class="appointed-cur-wrapper">
            <?php foreach ($appointedCourses as $ac) : ?>
                <?php if ($ac["username"] == $user["username"] && $ac["done"] != 1) : ?>
                    <?php foreach ($categories as $category) : ?>
                        <?php if ($category["category_name"] == $ac["category_name"]) : ?>
                            <a href="index.php?action=filter&id=<?=$category["id"]?>">
                                <div class="appointed-cur__item">
                                    <div class="appointed-cur__item-inner">
                                        <img src="../images/yt.png" alt="урок"><?=$ac["category_name"]?>
                                    </div>
                                    <a class="done-img-link" href="index.php?action=courseDone&id=<?=$ac["user_category_id"]?>"><img class="done-img" src="../images/done.png" alt="Пройден!"></a>
                                </div>
                            </a>
                        <?php endif?>
                    <?php endforeach?>
                <?php endif?>
            <?php endforeach?>
        </div>
    </div>
</body>
</html>