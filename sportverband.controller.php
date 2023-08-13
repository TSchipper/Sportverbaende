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
#-------------------------------------------------------------------------------

#-------------------------------------------------------------------------------
# Laden der objektspezifischen Feldeinstellungen
#-------------------------------------------------------------------------------
$fieldSettings = new FieldSettings($dbContext, "Sportverband");
#-------------------------------------------------------------------------------


#-------------------------------------------------------------------------------
# Ausführung des Controllers
#-------------------------------------------------------------------------------
$title = "Sportverbände";
$navElement = "navToSportverband";

# Anzeige einer Übersicht aller Sportverbände
if  (
    (!isset($_POST['command']) and !isset($_GET['ID']))
    or
    (isset($_POST['command']) and $_POST['command'] == "list")
) {
    include("./Sportverband.index.php");
}

# Anlager und Anzeige eines Sportverbands per ID als Get-Parameter
elseif (isset($_GET['ID'])) {

    $ID = $_GET['ID'];
    if ($ID == -1) {
        include("./Sportverband.create.php");
    } else {
        $object = Sportverband::getObjectByID($dbContext, $ID);
        include("./Sportverband.edit.php");
    }

}

# Erstellung eines neuen Sportverbands
elseif (isset($_POST['command']) and $_POST['command'] == "create") {
    $object = new Sportverband(
        "",                         //ID
        null,                       //DisplayName
        $_POST['ShortCut'],         //ShortCut
        $_POST['Name'],             //Name
        $_POST['NumberOfMembers']   //NumberOfMembers
    );
    $newID = Sportverband::create($dbContext, $object);
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
    $ID = $_POST['ID'];

    $object = new Sportverband(
        $ID,
        null                          #DisplayName
        ,
        $_POST['ShortCut'],
        $_POST['Name'],
        $_POST['NumberOfMembers']
    );
    Sportverband::update($dbContext, $object);
    header("Location: ./Sportverband.controller.php?ID=".$ID);
    exit();
}

# Rückführung zum Eingabeformular zur Bearbeitung eines bestehenden Sportverbands nach Verwerfen
elseif (isset($_POST['command']) and $_POST['command'] == "discardUpdate" and isset($_POST['ID'])) {
    $ID = $_POST['ID'];
    header("Location: ./Sportverband.controller.php?ID=".$ID);
    exit();
}

# Löschung eines bestehenden Sportverbands und Rückführung zur Übersicht aller Sportverbände
elseif (isset($_POST['command']) and $_POST['command'] == "delete") {
    $object = new Sportverband($_POST['ID'], null, null, null, null);
    Sportverband::delete($dbContext, $object);
    include("./Sportverband.index.php");
}

# Setzen eines Sortierkriteriums
elseif (isset($_POST['command']) and $_POST['command'] == "setSortOrder" and isset($_POST['ClassName']) and isset($_POST['ColumnName'])) {
    $className      =   $_POST['ClassName'];
    $columnName     =   $_POST['ColumnName'];
    $fieldSetting   =   $fieldSettings->getFieldSetting($dbContext, $className, $columnName);
    $fieldSetting->setSortOrder($dbContext, $className, $columnName);
    header("Location: ./Sportverband.controller.php");
    exit();
}

# Entfernen eines Sortierkriteriums
elseif (isset($_POST['command']) and $_POST['command'] == "removeSortOrder" and isset($_POST['ClassName']) and isset($_POST['ColumnName'])) {
    $className      =   $_POST['ClassName'];
    $columnName     =   $_POST['ColumnName'];
    $fieldSetting   =   $fieldSettings->getFieldSetting($dbContext, $className, $columnName);
    $fieldSetting->removeSortOrder($dbContext);
    header("Location: ./Sportverband.controller.php");
    exit();
}
