<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результаты</title>
</head>
<body>
    <?php
        // Модель урока со своими методами
        require_once("models/lessons.php");
          // Подключение к базе
        require_once("DB.php");
        // Модель урока со своими методами
          // Модель теста
        require_once("models/test.php");
          // Дескриптор соединения
        $link = db_connect();

        $lesson = lessons_get($link, $_POST['id_of_lesson']);
        $questions = test_all($link);

        // Сюда складываю вопросы конкретного теста
        $resultQuestions = array();

        foreach ($questions as $question) {
            // если id урока из hidden поля равно id урока из общего списка
            if ($question["q_lesson"] == $_POST['id_of_lesson']) {
                $resultQuestions[] = $question;
            }
        }

        // Всего правильных ответов
        $rightAnswersCount = 0;
        // Количество правильных ответов пользователя
        $userRightAnswersCount = 0;

        // Сколько вопросов в тесте
        $count = count($resultQuestions);

        for ($i = 0; $i < $count; $i++) {
            $resultQuestions[$i]['q_name'] = str_replace(' ', '_', $resultQuestions[$i]['q_name']);

            $rightAnswers = array();
            // Получаем правильные ответы
            $rightAnswers[] =  $resultQuestions[$i]['q_righ1'];
            $rightAnswers[] =  $resultQuestions[$i]['q_righ2'];
            $rightAnswers[] =  $resultQuestions[$i]['q_righ3'];
            $rightAnswers[] =  $resultQuestions[$i]['q_righ4'];
            $rightAnswers[] =  $resultQuestions[$i]['q_righ5'];
            $rightAnswers[] =  $resultQuestions[$i]['q_righ6'];
            $rightAnswers[] =  $resultQuestions[$i]['q_righ7'];
            $rightAnswers[] =  $resultQuestions[$i]['q_righ8'];
            $rightAnswers[] =  $resultQuestions[$i]['q_righ9'];
            $rightAnswers[] =  $resultQuestions[$i]['q_righ10'];

            // Убираем пустые значения из массива правильных ответов
            $rightAnswers = array_diff($rightAnswers, array(''));

            // Сколько всего правильных ответов в вопросе
            $rightAnswersCountInQ = count($rightAnswers);
            $rightAnswersCount += $rightAnswersCountInQ; 


            // Ответы ученика
            $userAnswer = array();
            // Ответы ученика в виде текста
            $userAnswerText = '';

            // Если ответ массив (т.е. выбирался один/несколько вариантов) то мержим в общий массив
            if (is_array($_POST[$resultQuestions[$i]['q_name']])) {
                $userAnswer = array_merge($userAnswer, $_POST[$resultQuestions[$i]['q_name']]);
            } else {
                $userAnswerText = $_POST[$resultQuestions[$i]['q_name']];
            }


            // Находим пересечения, т.е. правильные ответы
            $result = array_intersect_assoc($rightAnswers, $userAnswer);
            // Насколько правильных ответил ученик
            $resultCount = count($result);
            
            // Добавляем в общее число правильных ответов ученика
            $userRightAnswersCount += $resultCount;
        }

        // Итог
        var_dump($userRightAnswersCount);
        echo '/';
        var_dump($rightAnswersCount);

    ?>
</body>
</html>