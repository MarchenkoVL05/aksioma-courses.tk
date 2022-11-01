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
    <!-- bitrix24 api -->
    <script src="https://api.bitrix24.com/api/v1/"></script>
    <title>Результаты</title>
</head>
<body>
    <div class="container">
        <h1 class="results-title"><img src="../images/results-1.png" alt="Результаты"> Ваши результаты: </h1>
        <div class="results-test">
            <div class="results-test__item">
                <div class="results-test__item-title">Тесты: </div>
                <div class="results-test__item-score"><?php echo $userResultsTest?>%</div>
                <?php if ($userResultsTest <= 50) : ?>
                    <div class="results-test__item-rate results-test__item-rate--2">Плохо :(</div>
                <?php elseif ($userResultsTest <= 65) : ?>
                    <div class="results-test__item-rate results-test__item-rate--3">Удовлетворительно</div>
                <?php elseif ($userResultsTest <= 80) : ?>
                    <div class="results-test__item-rate results-test__item-rate--4">хорошо</div>
                <?php elseif ($userResultsTest <= 100) : ?>
                    <div class="results-test__item-rate results-test__item-rate--5">Отлично!</div>
                <?php endif?>
            </div>
            <div class="results-test__item">
                <div class="results-test__item-title">Требуют проверки или нет ответа: </div>
                <div class="results-test__item-textAnswers"><?php echo $resultUserAnswerTextCount?></div>
            </div>
            <button class="results-close-btn" onclick="javascript:location.href='index.php'"
            style="background-color: <?php if ($userResultsTest <= 50) {echo '#a00101';} else if ($userResultsTest <= 65) {echo 'rgb(231, 147, 3)';} else if ($userResultsTest <= 80) {echo '#e6d200';} else if ($userResultsTest <= 100) {echo 'rgb(0, 192, 0)';} ?>"
            >Закрыть</button>
        </div>
    </div>
</body>
</html>