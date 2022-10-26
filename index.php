<!-- Этот файл по сути Контроллер в паттерне MVC -->
<?
  // Подключение к базе
  require_once("DB.php");
  // Модель урока со своими методами
  require_once("models/lessons.php");
  // Модель категорий уроков
  require_once("models/categories.php");
  // Модель пользователя
  require_once("models/users.php");

  $link = db_connect();

  // Получаем параметр запроса (На странице админки)
  if (isset($_GET["action"])) {
    $action = $_GET["action"];
  } else {
    $action = "";
  }

  if ($action == "add") {
    // Добавить урок
    if (!empty($_POST)) {
      lessons_new($link, $_POST["title"], $_POST["date"], $_POST["content"], $_POST["video"], $_POST["category_id"]);
      header("Location: index.php");
    }
    $categories = categoies_all($link);
    include("views/createLessonTemplate.php");
    // Редактировать урок
  } else if ($action == "edit") {
    if (!isset($_GET["id"])) {
      header("Location: index.php");
    }

    $id = (int)$_GET["id"];

    $categories = categoies_all($link);
    if (!empty($_POST) && $id > 0) {
      lessons_edit($link, $id, $_POST["title"], $_POST["date"], $_POST["content"], $_POST["video"], $_POST["category_id"]);
      header("Location: index.php");
    }

    $lesson = lessons_get($link, $id);
    include("views/createLessonTemplate.php");
    // Удалить урок
  } else if ($action == "delete") {
    $id = $_GET["id"];
    $lesson = lessons_delete($link, $id);
    header("Location: index.php");
    // Добавить категорию
  } else if ($action == "addcategory") {
    if (!empty($_POST)) {
      category_new($link, $_POST["category_name"]);
      header("Location: index.php");
    }
    include("views/createCategoryTemplate.php");
    // Редактировать категорию
  } else if ($action == "editcategory") {
    if (!isset($_GET["id"])) {
      header("Location: index.php");
    }

    $id = (int)$_GET["id"];

    if (!empty($_POST) && $id > 0) {
      categories_edit($link, $id, $_POST["category_name"]);
      header("Location: index.php");
    }

    $category = categories_get($link, $id);
    include("views/createCategoryTemplate.php");
    // Редактировать категорию
  } else if ($action == "deletecategory") {
      $id = $_GET["id"];
      categories_delete($link, $id);
      header("Location: index.php");
      // Фильтр по категориям
  } else if ($action == "filter") {
    $id = $_GET["id"];
    if ($id == '0') {
      $lessons = lessons_all($link);
      $categories = categoies_all($link);
    } else {
      $lessons = lessons_filtered_by_category($link, $id);
      $categories = categoies_all($link);
    }
    include("views/lessonsTemplate.php");
  } else if ($action == "userslist") {
    // Список сотрудников
    $users = users_all($link);
    include("views/adminUsersTemplate.php");
  } else if ($action == "auth") {
    // Создать пользователя
    if (!empty($_POST)) {
      users_new($link, $_POST["name"]);
      header("Location: index.php");
    }
    include("views/authTemplate.php");
  } else {
    // Иначе - просто вернуть все на главную страницу
      $lessons = lessons_all($link);
      $categories = categoies_all($link);
      include("views/lessonsTemplate.php");
    }

?>

