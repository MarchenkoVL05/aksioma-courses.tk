<?php

  // Подключение к базе
  require_once("DB.php");
  // Модель урока со своими методами
  require_once("models/lessons.php");
  // Модель категорий уроков
  require_once("models/categories.php");

  $link = db_connect();

  function lessons_filtered_by_category_on_test_page($link, $categoryIndex) {
      $query = sprintf("SELECT * FROM lessons WHERE category_id=%d", (int)$categoryIndex);
      $result = mysqli_query($link, $query);

      if (!$result) {
          die(mysqli_error($link));
      }

      $lessonsFiltered = array();

      $n = mysqli_num_rows($result);

      for ($i = 0; $i < $n; $i++) {
          $row = mysqli_fetch_assoc($result);
          $lessonsFiltered[$i] = $row;
      }

      $lessonsFiltered = json_encode($lessonsFiltered);

      echo $lessonsFiltered;
  }

  lessons_filtered_by_category_on_test_page($link, $_POST["category"]);
?>