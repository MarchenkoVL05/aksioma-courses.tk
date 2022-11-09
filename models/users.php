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

function users_get($link, $username) {
    $t = "SELECT * FROM users WHERE username='%s'";
    $query = sprintf($t, mysqli_real_escape_string($link, $username));
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    $user = mysqli_fetch_assoc($result);

    return $user;
}

function users_delete($link, $id) {
    $id = (int)$id;

    if ($id == 0) {
        return false;
    }

    $query = sprintf("DELETE FROM users WHERE id='%d'", $id);
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    return mysqli_affected_rows($link);
}

?>