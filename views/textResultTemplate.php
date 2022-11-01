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
    <title>Текстовый результат</title>
</head>
<body>
    <div class="container">
        <div class="go-back"><a class="go-back__link" href="javascript:window.history.back()"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
        <?php foreach ($results as $result) : ?>
            <?php if ($result["result_id"] == $resultID) : ?>
                <div class="text-result"><?php echo $result["test_text"]?></div>
            <?php endif?>
        <?endforeach?>
    </div>
</body>
</html>