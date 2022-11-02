<?php
    // Модель урока со своими методами
    require_once("models/lessons.php");
    // Подключение к базе
    require_once("DB.php");
    // Модель юзера
    require_once("models/users.php");
    // Модель теста
    require_once("models/test.php");
    // Модель результатов
    require_once("models/results.php");

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
    // Текстовые ответы пользователя и их количество
    $resultUserAnswerTextCount = 0;
    $resultUserAnswerText = '';

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
            // Получаем текстовый ответ из POST 
            $userAnswerText = $_POST[$resultQuestions[$i]['q_name']];
            // Добавляем счётчик ответов, требующих проверки
            $resultUserAnswerTextCount++;
            // Сохраняем название вопроса и его текстовый ответ + обратно заменяем "_" на пробел
            $resultQuestions[$i]['q_name'] = str_replace('_', ' ', $resultQuestions[$i]['q_name']);
            $resultUserAnswerText = $resultUserAnswerText . '<br>' . $resultQuestions[$i]['q_name'] . '<br>' . $userAnswerText;
        }

        // Находим пересечения, т.е. правильные ответы
        $result = array_intersect_assoc($rightAnswers, $userAnswer);
        // Насколько правильных ответил ученик
        $resultCount = count($result);
        
        // Добавляем в общее число правильных ответов ученика
        $userRightAnswersCount += $resultCount;
    }

    // Округляем до 2-х знаков итоговый результат
    if ($rightAnswersCount > 0) {
        $userResultsTest = round((($userRightAnswersCount / $rightAnswersCount) * 100), 2);
    }

    // 
    // 
    $username = $_POST['username'];

    $lessonID = $_POST['id_of_lesson'];

    $users = users_all($link);
    foreach ($users as $user) {
        if ($user['username'] == $username) {
            results_new($link, $username, $lessonID, $userResultsTest, $resultUserAnswerText);
        }
    }

    include("views/resultTemplate.php");
?>