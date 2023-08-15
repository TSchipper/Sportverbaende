<?php

include("./support/DBContext.php");

$db = new DBContext();
include("./support/exeuteSqlScript.php");


$title = "Home";
$navElement = "navToHome";
include('.//home.index.php');
