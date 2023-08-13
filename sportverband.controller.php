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
# Einbindung DB-Connector
#-------------------------------------------------------------------------------
include("./support/DBController.php");

$dbContext = new DBController();
$fieldSettings = new FieldSettings($dbContext, "Sportverband");

#-------------------------------------------------------------------------------

#-------------------------------------------------------------------------------
# Ausführung des Controllers
#-------------------------------------------------------------------------------

$title = "Sportverband";
$navElement = "navToSportverband";

# Anzeige einer Übersicht aller Sportverbände
if  (
    (!isset($_POST['command']) and !isset($_GET['id']))
    or
    (isset($_POST['command']) and $_POST['command'] == "list")
) {
    include("./Sportverband.index.php");
}

# Anzeige eines Sportverbands per ID als Get-Parameter
elseif (isset($_GET['id'])) {
    $ID = $_GET['id'];
    $Sportverband = Sportverband::getObjectByID($dbContext, $ID);
    include("./Sportverband.edit.php");
}

# Erstellung eines neuen Sportverbands
elseif (isset($_POST['command']) and $_POST['command'] == "create") {
    $object = new Sportverband(
        "",
        $_POST['ShortCut'],
        $_POST['Name'],
        $_POST['NumberOfMembers']
    );
    $newID = create($dbContext, $object);
    header("Location: ./Sportverband.controller.php?id=".$newID);
    exit();

}

# Rückführung zum Eingabeformular zur Erstellung eines neuen Sportverbands nach Verwerfen
elseif (isset($_POST['command']) and $_POST['command'] == "discardCreate") {
    header("Location: ./Sportverband.create.php");
    exit();
}

# Bearbeitung eines bestehenden Sportverbands
elseif (isset($_POST['command']) and $_POST['command'] == "update") {
    $object = new Sportverband(
        $_POST['ID'],
        null                          #DisplayName
        ,
        $_POST['ShortCut'],
        $_POST['Name'],
        $_POST['NumberOfMembers']
    );
    Sportverband::update($dbContext, $object);
    header("Location: ./Sportverband.controller.php?id=".$object->id);
    exit();
}

# Rückführung zum Eingabeformular zur Bearbeitung eines bestehenden Sportverbands nach Verwerfen
elseif (isset($_POST['command']) and $_POST['command'] == "discardUpdate" and isset($_POST['ID'])) {
    $ID = $_POST['ID'];
    header("Location: ./Sportverband.controller.php?id=".$ID);
    exit();
}

# Löschung eines bestehenden Sportverbands und Rückführung zur Übersicht aller Sportverbände
elseif (isset($_POST['command']) and $_POST['command'] == "delete") {
    Sportverband::delete($dbContext, $_POST['ID']);
    include("./Sportverband.index.php");
}

if (isset($_POST['command']) and $_POST['command'] == "initDatabase") {
    initDatabase();
    header("Location: ./index.php");
    exit();
}
