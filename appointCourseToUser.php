<?php
    // Подключение к базе
    require_once("DB.php");
    // Связь между юзером и назначенным ему курсом
    require_once("models/user_category.php");

    // Дескриптор соединения
    $link = db_connect();

    $username = $_POST["user"];
    $category = $_POST["category"];

    // Проверяем назначен ли этому ученику этот урок уже в базе
    $appointed = user_category_get($link, $username, $category);
    if ($appointed) {
        echo "<script>alert('Для него этот урок уже назначен :)')</script>";
        header("Refresh: 0, url=index.php?action=appointCourse");
    } else {
        user_category_new($link, $username, $category);
        echo "<script>alert('Готово!')</script>";
        header("Refresh: 0, url=index.php?action=appointCourse");
    }

?>