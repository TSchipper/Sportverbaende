<?php

include("./support/DBContext.php");
$db = new DBContext();

$title = "Home";
$navElement = "navToHome";
include('.//home.index.php');
