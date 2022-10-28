<?php

function test_new($link, 
$q_name, 
$q_lesson, 
$q_type, 
$q_answer1, $q_answer2, $q_answer3, $q_answer4, $q_answer5, 
$q_answer6, $q_answer7, $q_answer8, $q_answer9, $q_answer10, 
$q_righ1, $q_righ2, $q_righ3, $q_righ4, $q_righ5,
$q_righ6, $q_righ7, $q_righ8, $q_righ9, $q_righ10) {
    // Начало функции
    $q_righ1 = (int)$q_righ1;
    $q_righ2 = (int)$q_righ2;
    $q_righ3 = (int)$q_righ3;
    $q_righ4 = (int)$q_righ4;
    $q_righ5 = (int)$q_righ5;
    $q_righ6 = (int)$q_righ6;
    $q_righ7 = (int)$q_righ7;
    $q_righ8 = (int)$q_righ8;
    $q_righ9 = (int)$q_righ9;
    $q_righ10 = (int)$q_righ10;
     
    $t = "INSERT INTO test (q_name, q_lesson, q_type, q_answer1, q_answer2, q_answer3, q_answer4, q_answer5, q_answer6, q_answer7, q_answer8,
    q_answer9, q_answer10, q_righ1, q_righ2, q_righ3, q_righ4, q_righ5, q_righ6, q_righ7, q_righ8, q_righ9, q_righ10) VALUES
    ('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d')";

    $query = sprintf($t, mysqli_real_escape_string($link,$q_name), mysqli_real_escape_string($link,$q_lesson), mysqli_real_escape_string($link,$q_type),
    mysqli_real_escape_string($link,$q_answer1), mysqli_real_escape_string($link,$q_answer2), mysqli_real_escape_string($link,$q_answer3), mysqli_real_escape_string($link,$q_answer4), 
    mysqli_real_escape_string($link,$q_answer5), mysqli_real_escape_string($link,$q_answer6), mysqli_real_escape_string($link,$q_answer7), mysqli_real_escape_string($link,$q_answer8), 
    mysqli_real_escape_string($link,$q_answer9), mysqli_real_escape_string($link,$q_answer10), 
    mysqli_real_escape_string($link, $q_righ1), mysqli_real_escape_string($link, $q_righ2), mysqli_real_escape_string($link, $q_righ3), mysqli_real_escape_string($link, $q_righ4), 
    mysqli_real_escape_string($link, $q_righ5), mysqli_real_escape_string($link, $q_righ6), mysqli_real_escape_string($link, $q_righ7), mysqli_real_escape_string($link, $q_righ8), 
    mysqli_real_escape_string($link, $q_righ9), mysqli_real_escape_string($link, $q_righ10));

    $result = mysqli_query($link, $query);
    if (!$result) {
        die(mysqli_error($link));
    }

    return true;
}

function test_all($link) {
    $query = "SELECT * FROM test ORDER BY q_id ASC";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    // Дёргаем из БД
    $n = mysqli_num_rows($result);
    $questions = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $questions[] = $row;
    }

    return $questions;
}

function test_get($link, $q_lesson) {
    $query = sprintf("SELECT * FROM test WHERE id=%d", (int)$q_lesson);
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    $question = mysqli_fetch_assoc($result);

    return $question;
}

?>