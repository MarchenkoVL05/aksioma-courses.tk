<?php

function results_new($link, $username, $lessonId, $testResults, $try, $testText) {
    $username = trim($username);

    if ($username == '') {
        return false;
    }

    $try = (int)$try;

    $t = "INSERT INTO results (username, id_of_lesson, test_results, try, test_text) VALUES ('%s', '%d', '%d', '%d', '%s')";

    $query = sprintf($t, mysqli_real_escape_string($link, $username), mysqli_real_escape_string($link, $lessonId), mysqli_real_escape_string($link, $testResults), mysqli_real_escape_string($link, $try), mysqli_real_escape_string($link, $testText));
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

function results_get($link, $username) {
    $query = sprintf("SELECT * FROM results WHERE username='%s'", $username);
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    $numRows = mysqli_num_rows($result);
    $myResults = array();

    for ($i = 0; $i < $numRows; $i++) {
        $row = mysqli_fetch_assoc($result);
        $myResults[] = $row;
    }

    return $myResults;
}

function results_delete($link, $id) {
    $id = (int)$id;

    if ($id == 0) {
        return false;
    }

    $query = sprintf("DELETE FROM results WHERE result_id='%d'", $id);
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    return mysqli_affected_rows($link);
}
?>