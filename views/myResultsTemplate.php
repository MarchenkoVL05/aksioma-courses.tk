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
    <title>Мои результаты</title>
</head>
<body>
    <div class="container">
        <div class="go-back"><a class="go-back__link" href="javascript:window.history.back()"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
        <div class="my-r">
            <?php foreach ($myResults as $result) : ?>
                <div class="my-r__head-wrapper">
                    <?php foreach ($lessons as $lesson) : ?>
                        <?php if ($lesson["id"] == $result["id_of_lesson"]) : ?>
                            <div class="my-r__head">Урок: <b><?php echo $lesson["title"]?></b></div>
                        <?php endif?>
                    <?endforeach?>
                    <div class="my-r__head">Результат за тестирование: <span><?php echo $result["test_results"]?></span></div>
                    <div class="my-r__head my-r__head--try">Попытка: <span><?php echo $result["try"]?></span></div>
                </div>
            <?php endforeach?>
        </div>
    </div>
</body>
</html>