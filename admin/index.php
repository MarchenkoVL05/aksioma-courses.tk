<?php

require_once("../DB.php");
require_once("../models/lessons.php");

$link = db_connect();

$lessons = lessons_all($link);

include("../views/adminTemplate.php");

?>