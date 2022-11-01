<?php

function users_new($link, $username) {
    $username = trim($username);

    if ($username == '') {
        return false;
    }

    $t = "INSERT INTO users (username) VALUES ('%s')";

    $query = sprintf($t, mysqli_real_escape_string($link, $username));
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    return true;
}

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

?>