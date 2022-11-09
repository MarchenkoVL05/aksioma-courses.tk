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
    <title>Пользователи</title>
</head>
<body>
    <div class="container">
        <div class="go-back"><a class="go-back__link" href="index.php?action=appointCourse"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
        <div class="appoint-table-header">Авторизованные в приложении ученики</div>
        <?php foreach ($users as $user) : ?>
            <div class="appoint-table">
                <div class="appoint-table__item">
                    <div class="appoint-table__item-name"><?=$user["username"]?></div>
                    <a href="index.php?action=deleteUser&id=<?=$user["id"]?>"><button class="appoint-table__item-btn">Удалить</button></a>
                </div>
            </div>
        <?php endforeach?>
    </div>
</body>
</html>