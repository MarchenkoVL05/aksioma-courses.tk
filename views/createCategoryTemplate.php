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
    <!-- Редактор текста Tiny -->
    <script src="https://cdn.tiny.cloud/1/btcy28zm7gkt490uwu9hv0hxl14b3j75j5o1vid0p7yjhk90/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Создать курс</title>
</head>
<body>
    <div class="container">
        <div class="go-back"><a class="go-back__link" href="javascript:window.history.back()"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
        <h1 class="add-lesson-title"><img class="add-lesson-title__img" src="../images/stationery.png" alt="Создать урок"> Создание Курса</h1>
        <p class="add-category-text">Группируйте уроки по курсам для удобной навигации по приложению :)</p>
        <form class="add-lesson-form" action="../index.php?action=<?= $_GET["action"]?>&id=<?= $_GET["id"]?>" method="POST">
            <label class="add-lesson-label">
                Название Категории
                <input class="add-lesson-input" type="text" name="category_name" value="<?=$category["category_name"]?>"  autofocus required>
            </label>
            <input onclick="tinyMCE.triggerSave(true,true);" class="add-lesson-save" type="submit" value="Сохранить">
        </form>
    </div>
</body>
</html>