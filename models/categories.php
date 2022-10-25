<?php

    function categoies_all($link) {
        $query = "SELECT * FROM categories ORDER BY id DESC";
        $result = mysqli_query($link, $query);

        if (!$result) {
            mysqli_error($link);
        }

        $n = mysqli_num_rows($result);
        $categories = array();

        for ($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_assoc($result);
            $categories[] = $row;
        }

        return $categories;
    }

    function categories_get($link, $category_id) {
        $query = sprintf("SELECT * FROM categories WHERE id=%d", (int)$category_id);
        $result = mysqli_query($link, $query);
    
        if (!$result) {
            die(mysqli_error($link));
        }
    
        $category= mysqli_fetch_assoc($result);
    
        return $category;
    }

    function category_new($link, $categoryName) {
        $categoryName = trim($categoryName);

        if ($categoryName == '') {
            return false;
        }

        $t = "INSERT INTO categories (category_name) VALUES ('%s')";

        $query = sprintf($t, mysqli_real_escape_string($link, $categoryName));
        $result = mysqli_query($link, $query);

        if (!$result) {
            die(mysqli_error($link));
        }
    
        return true;
    }

    function categories_edit($link, $id, $categoryName) {
        $categoryName = trim($categoryName);
    
        if ($categoryName == '') {
            return false;
        }
    
        $sql = "UPDATE categories SET category_name='%s' WHERE id='%d'";
    
        $query = sprintf($sql, mysqli_real_escape_string($link, $categoryName), $id);
    
        $result = mysqli_query($link, $query);
    
        if (!$result) {
            die(mysqli_query($link, $query));
        }
    
        return mysqli_affected_rows($link);
    }

    function categories_delete($link, $id) {
        $id = (int)$id;
    
        if ($id == 0) {
            return false;
        }
    
        $query = sprintf("DELETE FROM categories WHERE id='%d'", $id);
        $result = mysqli_query($link, $query);
    
        if (!$result) {
            die(mysqli_error($link));
        }
    
        return mysqli_affected_rows($link);
    }

?>