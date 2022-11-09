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
    <title>Назначение курса ученику</title>
</head>
<body>
    <div class="container">
        <div class="go-back"><a class="go-back__link" href="admin/index.php"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
        <div class="appoint-header"> <img src="../images/teacher.png" alt="Учитель"> Распределение курсов</div>
        <p class="appoint-text">Назначтье прохождение курса выбранному ученику и он появится в его уведомлениях!</p>
        <a href="index.php?action=users" class="appoint-text--link">Обновить список авторизованных пользователей</a>
        <!--  -->
        <form class="appoint-course-form" action="appointCourseToUser.php" method="POST">
            <div class="selects-wrapper">
                <!--  -->
                <div data-am-select>
                    <select name="user" required>
                        <?php foreach ($users as $user) : ?>
                            <option value="<?=$user["username"]?>"><?=$user["username"]?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <!--  -->
                <div data-am-select>
                    <select name="category" required>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?=$category["category_name"]?>"><?=$category["category_name"]?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <!--  -->
            </div>
            <input class="appoint-course-input" type="submit" value="Назначить">
        </form>
        <!--  -->
        <div class="appoint-table-header">Назначенные уроки</div>
        <?php foreach ($appointedCourses as $ac) : ?>
            <div class="appoint-table">
                <div class="appoint-table__item">
                    <div class="appoint-table__item-name"><?=$ac["username"]?></div>
                    <div class="appoint-table__item-course"><?=$ac["category_name"]?></div>
                    <a href="index.php?action=deleteAppointedCourse&id=<?=$ac["user_category_id"]?>"><button class="appoint-table__item-btn">Удалить</button></a>
                </div>
            </div>
        <?php endforeach?>
    </div>
</body>
</html>