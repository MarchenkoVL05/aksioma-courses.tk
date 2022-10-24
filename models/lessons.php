<?php

function lessons_all($link) {
    $query = "SELECT * FROM lessons ORDER BY id DESC";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    // Дёргаем из БД
    $n = mysqli_num_rows($result);
    $lessons = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $lessons[] = $row;
    }

    return $lessons;
}

function lessons_get($link, $id_lesson) {
    $query = sprintf("SELECT * FROM lessons WHERE id=%d", (int)$id_lesson);
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    $lesson = mysqli_fetch_assoc($result);

    return $lesson;
}

function lessons_new($link, $title, $date, $content, $video) {
    $title = trim($title);
    $content = trim($content);
    $video = trim($video);

    if ($title == '') {
        return false;
    }

    $t = "INSERT INTO lessons (title, date, content, video) VALUES ('%s', '%s', '%s', '%s')";

    $query = sprintf($t,
    mysqli_real_escape_string($link, $title), mysqli_real_escape_string($link, $date), mysqli_real_escape_string($link, $content), mysqli_real_escape_string($link, $video));
    echo $query;
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    return true;
}

function lessons_edit($link, $id, $title, $date, $content, $video) {
    $title = trim($title);
    $content = trim($content);
    $date = trim($date);
    $video = trim($video);
    $id = (int)$id;

    if ($title == '') {
        return false;
    }

    $sql = "UPDATE lessons SET title='%s', content='%s', date='%s', video='%s' WHERE id='%d'";

    $query = sprintf($sql, mysqli_real_escape_string($link, $title), mysqli_real_escape_string($link, $content), mysqli_real_escape_string($link, $date), mysqli_real_escape_string($link, $video), $id);

    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_query($link, $query));
    }

    return mysqli_affected_rows($link);
}

function lessons_delete($link, $id) {
    $id = (int)$id;

    if ($id == 0) {
        return false;
    }

    $query = sprintf("DELETE FROM lessons WHERE id='%d'", $id);
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    return mysqli_affected_rows($link);
}

?>