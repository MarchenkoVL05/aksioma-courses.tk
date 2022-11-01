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
        <div class="go-back"><a class="go-back__link" href="/admin/index.php"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
        <h1 class="userslist-title">Список всех Ваших учеников</h1>
        <div class="userslist-grid">
            <div class="grid-row">
                <div class="grid-column grid-column--bold">Имя</div>
                <div class="grid-column grid-column--bold">Тест</div>
                <div class="grid-column grid-column--bold">Результат</div>
                <div class="grid-column grid-column--bold grid-column--fz-small">Требуют проверки</div>
            </div>
            <?php foreach ($results as $result) :?>
            <div class="grid-row">
                <div class="grid-column"><?=$result['username']?></div>
                <?php foreach ($lessons as $lesson) : ?>
                    <?php if ($lesson["id"] == $result['id_of_lesson']) : ?>
                        <div class="grid-column"><?=$lesson["title"]?></div>
                    <?php endif?>
                <?php endforeach?>
                <div class="grid-column"><?=$result['test_results']?>%</div>
                <div class="grid-column"><a class="results-text-link" href="index.php?action=checktext&resultID=<?php echo $result['result_id']?>">ссылка</a></div>
            </div>
            <?php endforeach?>
        </div>
    </div>
</body>
</html>