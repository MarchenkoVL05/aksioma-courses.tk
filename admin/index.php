<?php

require_once("../DB.php");
require_once("../models/lessons.php");
require_once("../models/categories.php");

$link = db_connect();

$lessons = lessons_all($link);
$categories = categoies_all($link);

include("../views/adminTemplate.php");

?>