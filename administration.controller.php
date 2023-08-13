<?php

#-------------------------------------------------------------------------------
# Einbindung der benötigten  Modelle
#-------------------------------------------------------------------------------
include("./model/basic.php");
#-------------------------------------------------------------------------------

#-------------------------------------------------------------------------------
# Einbindung DB-Connector
#-------------------------------------------------------------------------------
include("./support/DBController.php");
$dbContext = new DBController();
#-------------------------------------------------------------------------------

#-------------------------------------------------------------------------------
# Ausführung des Controllers
#-------------------------------------------------------------------------------

$title = "Administration";
$navElement = "navToAdministration";
include('.//administration.index.php');


if  (
    isset($_POST['command'])
    and $_POST['command'] =="executeSQLScript"
    and isset($_POST['FileName'])
) {
    $filename = $_POST['FileName'];
    $dbContext->executeSQLScript($filename);
}
