<!DOCTYPE html>
<html lang="en">
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
    <title>Создание теста</title>
</head>
<body>
    <div class="container">
        <div class="go-back"><a class="go-back__link" href="javascript:window.history.back()"><img class="go-back__img" src="../images/rewind.png" alt="Вернуться"> Вернуться назад</a></div>
        <h1 class="add-lesson-title"><img class="add-lesson-title__img" src="../images/exam.png" alt="Создать урок"> Тестирование</h1>
        <form action="checkAnswers.php" method="POST">
            <?php foreach ($questions as $question) : ?>
                <!-- Если поле с id урока в таблице test равно id из GET параметра -->
                <?php if ($question["q_lesson"] == $lesson_id) : ?>
                    <!--  -->
                    <input type="hidden" value="<?php echo $question["q_lesson"]?>" name="id_of_lesson">
                    <!--  -->
                    <?php if ($question["q_type"] == 'text') : ?>
                        <div class="question-title question-title--mb"><?php echo $question["q_name"]?></div>
                        <textarea class="add-lesson-textarea" name="<?php echo $question["q_name"]?>"></textarea>
                    <?php elseif ($question["q_type"] !== 'text') : ?>
                        <!--  -->
                        <div class="question-title"><?php echo $question["q_name"]?></div>
                        <div class="question-input-wrapper">
                            <input class="question-input" value="<?php echo $question["q_answer1"]?>" name="<?php echo $question["q_name"]?>[]" type="<?php echo $question['q_type']?>">
                            <div class="question-answer"><?php echo $question["q_answer1"]?></div>
                        </div>
                        <div class="question-input-wrapper">
                            <input class="question-input" value="<?php echo $question["q_answer2"]?>" name="<?php echo $question["q_name"]?>[]" type="<?php echo $question['q_type']?>">
                            <div class="question-answer"><?php echo $question["q_answer2"]?></div>
                        </div>
                        <?php if ($question["q_answer3"]) : ?>
                            <div class="question-input-wrapper">
                                <input class="question-input" value="<?php echo $question["q_answer3"]?>" name="<?php echo $question["q_name"]?>[]" type="<?php echo $question['q_type']?>">
                                <div class="question-answer"><?php echo $question["q_answer3"]?></div>
                            </div>
                        <?php endif?>
                        <?php if ($question["q_answer4"]) : ?>
                            <div class="question-input-wrapper">
                                <input class="question-input" value="<?php echo $question["q_answer4"]?>" name="<?php echo $question["q_name"]?>[]" type="<?php echo $question['q_type']?>">
                                <div class="question-answer"><?php echo $question["q_answer4"]?></div>
                            </div>
                        <?php endif?>
                        <?php if ($question["q_answer5"]) : ?>
                            <div class="question-input-wrapper">
                                <input class="question-input" value="<?php echo $question["q_answer5"]?>" name="<?php echo $question["q_name"]?>[]" type="<?php echo $question['q_type']?>">
                                <div class="question-answer"><?php echo $question["q_answer5"]?></div>
                            </div>
                        <?php endif?>
                        <?php if ($question["q_answer6"]) : ?>
                            <div class="question-input-wrapper">
                                <input class="question-input" value="<?php echo $question["q_answer6"]?>" name="<?php echo $question["q_name"]?>[]" type="<?php echo $question['q_type']?>">
                                <div class="question-answer"><?php echo $question["q_answer6"]?></div>
                            </div>
                        <?php endif?>
                        <?php if ($question["q_answer7"]) : ?>
                            <div class="question-input-wrapper">
                                <input class="question-input" value="<?php echo $question["q_answer7"]?>" name="<?php echo $question["q_name"]?>[]" type="<?php echo $question['q_type']?>">
                                <div class="question-answer"><?php echo $question["q_answer7"]?></div>
                            </div>
                        <?php endif?>
                        <?php if ($question["q_answer8"]) : ?>
                            <div class="question-input-wrapper">
                                <input class="question-input" value="<?php echo $question["q_answer8"]?>" name="<?php echo $question["q_name"]?>[]" type="<?php echo $question['q_type']?>">
                                <div class="question-answer"><?php echo $question["q_answer8"]?></div>
                            </div>
                        <?php endif?>
                        <?php if ($question["q_answer9"]) : ?>
                            <div class="question-input-wrapper">
                                <input class="question-input" value="<?php echo $question["q_answer9"]?>" name="<?php echo $question["q_name"]?>[]" type="<?php echo $question['q_type']?>">
                                <div class="question-answer"><?php echo $question["q_answer9"]?></div>
                            </div>
                        <?php endif?>
                        <?php if ($question["q_answer10"]) : ?>
                            <div class="question-input-wrapper">
                                <input class="question-input" value="<?php echo $question["q_answer10"]?>" name="<?php echo $question["q_name"]?>[]" type="<?php echo $question['q_type']?>">
                                <div class="question-answer"><?php echo $question["q_answer10"]?></div>
                            </div>
                        <?php endif?>
                        <!--  -->
                    <?php endif?>
                <?php endif?>
            <?php endforeach?>
            <input onclick="tinyMCE.triggerSave(true,true);" class="add-test-submit add-lesson-save" type="submit" value="Отправить">
        </form>
    </div>
    <script>
        tinymce.init({ selector:'textarea', language_url: '../langs/ru.js'});
    </script>
</body>
</html>