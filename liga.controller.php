<?php

#-------------------------------------------------------------------------------
# Einbindung der benötigten  Modelle
#-------------------------------------------------------------------------------
include("./support/FieldSettings.php");
include("./model/basic.php");
include("./model/Sportverband.php");
include("./model/liga.php");
#-------------------------------------------------------------------------------

#-------------------------------------------------------------------------------
# Einbindung und Initialisierung DB-Connector
#-------------------------------------------------------------------------------
include("./support/DBController.php");
$dbContext = new DBController();
$fieldSettings = new FieldSettings($dbContext, "Liga");
#-------------------------------------------------------------------------------

#-------------------------------------------------------------------------------
# Ausführung des Controllers
#-------------------------------------------------------------------------------

$title = "Liga";
$navElement = "navToLiga";

# Anzeige einer Übersicht aller Ligen
if  (
    (!isset($_POST['command']) and !isset($_GET['id']))
    or
    (isset($_POST['command']) and $_POST['command'] == "list")
) {
    include("./liga.index.php");
}

# Anzeige einer Liga per ID als Get-Parameter
elseif (isset($_GET['id'])) {
    $ID = $_GET['id'];
    $liga = Liga::getObjectByID($dbContext, $ID);
    include("./liga.edit.php");
}

# Erstellung einer neuen Liga
elseif (isset($_POST['command']) and $_POST['command'] == "create") {
    $object = new Liga(
        "",
        $_POST['SportverbandID'],
        $_POST['ShortCut'],
        $_POST['Name']
    );
    $newID = create($dbContext, $object);
    header("Location: ./liga.controller.php?id=".$newID);
    exit();

}

# Rückführung zum Eingabeformular zur Erstellung einer neuen Liga nach Verwerfen
elseif (isset($_POST['command']) and $_POST['command'] == "discardCreate") {
    header("Location: ./liga.create.php");
    exit();
}

# Bearbeitung einer bestehenden Liga
elseif (isset($_POST['command']) and $_POST['command'] == "update") {
    $object = new Liga(
        $_POST['ID'],
        null                          #DisplayName
        ,
        $_POST['SportverbandID'],
        null                          #Sportverband
        ,
        $_POST['ShortCut'],
        $_POST['Name']
    );
    Liga::update($dbContext, $object);
    header("Location: ./liga.controller.php?id=".$object->id);
    exit();
}

# Rückführung zum Eingabeformular zur Bearbeitung einer bestehenden Liga nach Verwerfen
elseif (isset($_POST['command']) and $_POST['command'] == "discardUpdate" and isset($_POST['ID'])) {
    $ID = $_POST['ID'];
    header("Location: ./liga.controller.php?id=".$ID);
    exit();
}

# Löschung einer bestehenden Liga und Rückführung zur Übersicht aller Ligen
elseif (isset($_POST['command']) and $_POST['command'] == "delete") {
    Liga::delete($dbContext, $_POST['ID']);
    include("./liga.index.php");
}
