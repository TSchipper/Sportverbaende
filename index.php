<?php

include("./support/exeuteSqlScript.php");

exeuteSqlScript("./data/dataModel/dataBaseStructures.sql");

header('Location: ./home.controller.php');
exit();
