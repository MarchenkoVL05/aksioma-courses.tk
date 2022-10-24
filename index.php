<!-- Этот файл по сути Контроллер в паттерне MVC -->
<?
  // Подключение к базе
  require_once("DB.php");
  // Модель урока со своими методами
  require_once("models/lessons.php");

  $link = db_connect();

  // Получаем параметр запроса (На странице админки)
  if (isset($_GET["action"])) {
    $action = $_GET["action"];
  } else {
    $action = "";
  }

  // Добавить урок
  if ($action == "add") {
    if (!empty($_POST)) {
      lessons_new($link, $_POST["title"], $_POST["date"], $_POST["content"], $_POST["video"]);
      header("Location: index.php");
    }
    include("views/createLessonTemplate.php");
    // Редактировать урок
  } else if ($action == "edit") {
    if (!isset($_GET["id"])) {
      header("Location: index.php");
    }

    $id = (int)$_GET["id"];

    if (!empty($_POST) && $id > 0) {
      lessons_edit($link, $id, $_POST["title"], $_POST["date"], $_POST["content"], $_POST["video"]);
      header("Location: index.php");
    }

    $lesson = lessons_get($link, $id);
    include("views/createLessonTemplate.php");
    // Удалить урок
  } else if ($action == "delete") {
    $id = $_GET["id"];
    $lesson = lessons_delete($link, $id);
    header("Location: index.php");
    // Иначе - просто вернуть все на главную страницу
  } else {
    $lessons = lessons_all($link);
    include("views/lessonsTemplate.php");
  }

?>

