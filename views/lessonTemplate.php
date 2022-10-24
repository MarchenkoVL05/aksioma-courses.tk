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
    <!-- https://www.youtube.com/oembed?url=<URL>&format=<FORMAT> -->
    <div class="container">
        <?php
            if ($lesson["video"]) {
                // Тут по идее логике не место, но ладно 
                // Получаем json по обычной url-ссылке в ютубе
                $embedLink = file_get_contents("https://www.youtube.com/oembed?url=".$lesson["video"]."&format=json");
                // Декодируем json
                $myLink = json_decode($embedLink);
                // Дёргаем поле html
                $src = $myLink -> html;
                // Ищем подстроку src с адресом встраимоего плеера
                $src = explode(" ", htmlspecialchars($src))[3];
                // Обрезаем кавычки
                $resultLink = substr($src, 10, -6);
            }
        ?>
        <div class="go-back"><a class="go-back__link" href="../index.php"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
        <h1 class="lesson-title"><?= $lesson["title"]?></h1>
        <?php if ($lesson["video"]) : ?>
            <div class="lesson-video">
                <iframe src=<?= $resultLink?>
                frameborder="0" 
                width="870" height="420" 
                allowfullscreen 
                ></iframe>
            </div>
        <?php endif?>
        <div class="lesson-content"><?= $lesson["content"]?></div>
        <div class="lesson-date">Опубликовано: <?= $lesson["date"]?></div>
    </div>
</body>
<style>
.lesson-video {
  margin-top: 45px;
}
</style>
</html>