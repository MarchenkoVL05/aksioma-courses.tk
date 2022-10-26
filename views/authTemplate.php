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
    <title>Авторизация</title>
</head>
<body>
    <div class="container">
      <div class="go-back"><a class="go-back__link go-back--center" href="../index.php"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
      <form class="auth-form" action="../index.php?action=<?= $_GET['action']?>" method="POST">
        <h1 class="auth-title">Как Вас зовут?</h1>
        <input name="name" class="auth-input" placeholder="Фамилия и имя" type="text">
        <button class="auth-btn" type="submit">Сохранить</button>
      </form>
    </div>
</body>
</html>