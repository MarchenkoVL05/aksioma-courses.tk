<?php

function results_new($link, $username, $lessonId, $testResults, $testText) {
    $username = trim($username);

    if ($username == '') {
        return false;
    }

    $t = "INSERT INTO results (username, id_of_lesson, test_results, test_text) VALUES ('%s', '%d', '%d', '%s')";

    $query = sprintf($t, mysqli_real_escape_string($link, $username), mysqli_real_escape_string($link, $lessonId), mysqli_real_escape_string($link, $testResults), mysqli_real_escape_string($link, $testText));
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    return true;
}


function results_all($link) {
    $query = "SELECT * FROM results ORDER BY result_id DESC";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    // Дёргаем из БД
    $n = mysqli_num_rows($result);
    $testResults = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $testResults[] = $row;
    }

    return $testResults;
}
?>