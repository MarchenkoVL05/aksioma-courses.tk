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
        <h1 class="userslist-title">Список всех Ваших сотрудников</h1>
        <div class="userslist-grid">
            <div class="grid-row">
                <div class="grid-column grid-column--bold">Имя</div>
                <div class="grid-column grid-column--bold">Тест</div>
                <div class="grid-column grid-column--bold">Результат</div>
            </div>
            <?php foreach ($users as $user) :?>
            <div class="grid-row">
                <div class="grid-column"><?=$user['name']?></div>
                <div class="grid-column"><?=$user['name']?></div>
                <div class="grid-column"><?=$user['name']?></div>
            </div>
            <?php endforeach?>
        </div>
    </div>
</body>
</html>