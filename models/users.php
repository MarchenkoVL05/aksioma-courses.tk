<?php

function users_all($link) {
    $query = "SELECT * FROM users ORDER BY id DESC";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    // Дёргаем из БД
    $n = mysqli_num_rows($result);
    $users = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $users[] = $row;
    }

    return $users;
}

function users_new($link, $name) {
    $name = trim($name);

    if ($name == '') {
        return false;
    }

    $t = "INSERT INTO users (name) VALUES ('%s')";

    $query = sprintf($t, mysqli_real_escape_string($link, $name));
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    return true;
}

?>