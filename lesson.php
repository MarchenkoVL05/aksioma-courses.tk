<?
  require_once("DB.php");
  require_once("models/lessons.php");
  
  $link = db_connect();
  $lesson = lessons_get($link, $_GET["id"]);

  include("views/lessonTemplate.php");
?>