<!-- Этот файл по сути Контроллер в паттерне MVC -->
<?
  // Подключение к базе
  require_once("DB.php");
  // Модель урока со своими методами
  require_once("models/lessons.php");
  // Модель категорий уроков
  require_once("models/categories.php");
  // Модель теста
  require_once("models/test.php");
  // Модель юзера
  require_once("models/users.php");
  // Модель результатов тестирования
  require_once("models/results.php");

  // Дескриптор соединения
  $link = db_connect();

  // Получаем параметр запроса (На странице админки)
  if (isset($_GET["action"])) {
    $action = $_GET["action"];
  } else {
    $action = "";
  }

  if ($action == "test") {

    $lesson_id = $_GET['id'];
    $lessons = lessons_all($link);
    $questions = test_all($link);
    include("views/testTemplate.php");

  } else if ($action == "search") {

    // Поиск в публичной части
    $categories = categoies_all($link);
    $lessons = lessons_all($link);
    include("views/searchTemplate.php");

  } else if ($action == "adminSearch") {
    // Поиск в админке

    $categories = categoies_all($link);
    $lessons = lessons_all($link);
    include("views/adminSearchTemplate.php");

  } else if ($action == "addtest") {
    // Добавить вопрос

    $categories = categoies_all($link);
    $lessons = lessons_all($link);
    if (!empty($_POST)) {
      test_new($link, $_POST["q-name"], $_POST["q-lesson_id"], $_POST["q-lesson_type"], 
      $_POST["answer1"], $_POST["answer2"], $_POST["answer3"], $_POST["answer4"], $_POST["answer5"],
      $_POST["answer6"], $_POST["answer7"], $_POST["answer8"], $_POST["answer9"], $_POST["answer10"],
      $_POST["q-right1"], $_POST["q-right2"], $_POST["q-right3"], $_POST["q-right4"], $_POST["q-right5"], 
      $_POST["q-right6"], $_POST["q-right7"], $_POST["q-right8"], $_POST["q-right9"], $_POST["q-right10"]);
      header("Refresh: 0, url=/admin/index.php");
    }
    include("views/createTestTemplate.php");
    
  } else if ($action == "deletetest") {

    // Удалить вопрос(ы)
    $lessons = lessons_all($link);
    $questions = test_all($link);
    if (!empty($_GET["q_id"])) {
      $testId = $_GET["q_id"];
      test_delete($link, $testId);
      // header("Location: index.php");
      header("Refresh: 0, url=index.php?action=deletetest");
    }
    include("views/deleteTestTemplate.php");

  } else if ($action == "add") {

    // Добавить урок
    if (!empty($_POST)) {
      lessons_new($link, $_POST["title"], $_POST["date"], $_POST["content"], $_POST["video"], $_POST["category_id"]);
      header("Refresh: 0, url=/admin/index.php");
    }
    $categories = categoies_all($link);
    include("views/createLessonTemplate.php");

  } else if ($action == "edit") {
    // Редактировать урок
    if (!isset($_GET["id"])) {
      header("Refresh: 0, url=/admin/index.php");
    }

    $id = (int)$_GET["id"];

    $categories = categoies_all($link);
    if (!empty($_POST) && $id > 0) {
      lessons_edit($link, $id, $_POST["title"], $_POST["date"], $_POST["content"], $_POST["video"], $_POST["category_id"]);
      header("Refresh: 0, url=/admin/index.php");
    }

    $lesson = lessons_get($link, $id);
    include("views/createLessonTemplate.php");

  } else if ($action == "delete") {

    // Удалить урок
    $id = $_GET["id"];
    $lesson = lessons_delete($link, $id);
    header("Refresh: 0, url=/admin/index.php");

  } else if ($action == "addcategory") {
    // Добавить категорию

    if (!empty($_POST)) {
      category_new($link, $_POST["category_name"]);
      header("Refresh: 0, url=/admin/index.php");
    }
    include("views/createCategoryTemplate.php");
    
  } else if ($action == "editcategory") {

    // Редактировать категорию
    if (!isset($_GET["id"])) {
      header("Refresh: 0, url=/admin/index.php");
    }

    $id = (int)$_GET["id"];

    if (!empty($_POST) && $id > 0) {
      categories_edit($link, $id, $_POST["category_name"]);
      header("Refresh: 0, url=/admin/index.php");
    }

    $category = categories_get($link, $id);
    include("views/createCategoryTemplate.php");

  } else if ($action == "deletecategory") {
    // Удалить категорию

      $id = $_GET["id"];
      categories_delete($link, $id);
      header("Refresh: 0, url=/admin/index.php");

  } else if ($action == "filter") {
    // Фильтр по категориям

    $id = $_GET["id"];
    if ($id == '0') {
      $lessons = lessons_all($link);
      $categories = categoies_all($link);
    } else {
      $lessons = lessons_filtered_by_category($link, $id);
      $categories = categoies_all($link);
    }
    include("views/lessonsTemplate.php");

  } else if ($action == 'auth') {
    // Авторизоваться в приложении

    $username = $_GET['username'];
    $users = users_all($link);
    $userNamesFromDB = array();

    foreach ($users as $user) {
      $userNamesFromDB[] = $user["username"];
    }

    if (in_array($username, $userNamesFromDB)) {
      header("Refresh: 0, url=index.php");
    } else {
      users_new($link, $username);
    }

    include("views/authSuccess.php");

  } else if ($action == "appoint") {
    // Страница назначенные уроки

    include("views/appointTemplate.php");

  } else if ($action == "appointCourse") {
    // Назначить курс в админке
    
    $users = users_all($link);
    $categories = categoies_all($link);
    include("views/appointAdminTemplate.php");

  } else if ($action == "userslist") {
    // Список тестов учеников в админке

    $results = results_all($link);
    $lessons = lessons_all($link);
    include("views/adminUsersTemplate.php");

  } else if ($action == 'checktext') {
    // Страница текстового ответа ученика на тест 

    $results = results_all($link);
    $resultID = $_GET['resultID'];
    include("views/textResultTemplate.php");

  } else if ($action == 'deleteresult') {
    // Удалить результат ученика

    $resultID = $_GET["result_id"];
    results_delete($link, $resultID);
    header("Refresh: 0, url=index.php?action=userslist");

  } else if ($action == 'myresults') {
    // Страница Мои результаты

    $resultUsername = $_GET['username'];
    $myResults = results_get($link, $resultUsername);
    $lessons = lessons_all($link);
    include("views/myResultsTemplate.php");

  } else {
    // Иначе - просто вернуть все на главную страницу
      $lessons = lessons_all($link);
      $categories = categoies_all($link);
      include("views/lessonsTemplate.php");
    }

?>

