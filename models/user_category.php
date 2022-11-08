<?php
    function user_category_new($link, $username, $category) {
        $username = trim($username);
        $category = trim($category);
    
        if ($category == '' || $username == '') {
            return false;
        }
    
        $t = "INSERT INTO user_category (username, category_name) VALUES ('%s', '%s')";
    
        $query = sprintf($t, mysqli_real_escape_string($link, $username), mysqli_real_escape_string($link, $category));
        $result = mysqli_query($link, $query);
    
        if (!$result) {
            die(mysqli_error($link));
        }
    
        return true;
    }

    function user_category_all($link) {
        $query = "SELECT * FROM user_category ORDER BY user_category_id DESC";
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

    function user_category_get($link, $username, $category) {
        $t = "SELECT * FROM user_category WHERE username='%s' AND category_name='%s'";

        $query = sprintf($t, mysqli_real_escape_string($link, $username), mysqli_real_escape_string($link, $category));
        $result = mysqli_query($link, $query);
    
        if (!$result) {
            die(mysqli_error($link));
        }
    
        $lesson = mysqli_fetch_assoc($result);
    
        return $lesson;
    }
?>