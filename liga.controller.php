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
include("./support/DBContext.php");
$dbContext = new DBContext();
#-------------------------------------------------------------------------------

#-------------------------------------------------------------------------------
# Laden der objektspezifischen Feldeinstellungen
#-------------------------------------------------------------------------------

$fieldSettings = new FieldSettings($dbContext, "Liga");
#-------------------------------------------------------------------------------

#-------------------------------------------------------------------------------
# Ausführung des Controllers
#-------------------------------------------------------------------------------
$title = "Ligen";
$navElement = "navToLiga";


# Anzeige einer Übersicht aller Ligen
if  (
    (!isset($_POST['command']) and !isset($_GET['ID']))
    or
    (isset($_POST['command']) and $_POST['command'] == "list")
) {
    include("./liga.index.php");
}

# Anlager und Anzeige einer Liga per ID als Get-Parameter
elseif (isset($_GET['ID'])) {

    $ID = $_GET['ID'];
    if ($ID == -1) {
        include("./Liga.create.php");
    } else {
        $object = Liga::getObjectByID($dbContext, $ID);
        include("./Liga.edit.php");
    }

}

# Erstellung einer neuen Liga
elseif (isset($_POST['command']) and $_POST['command'] == "create") {
    $object = new Liga(
        "",                         //ID
        null,                       //DisplayName
        $_POST['SportverbandID'],   //SportverbandID
        null,                       //Sportverband
        $_POST['ShortCut'],         //ShortCut
        $_POST['Name'],             //Name
    );
    $newID = Liga::create($dbContext, $object);
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
    $ID = $_POST['ID'];

    $object = new Liga(
        $ID,
        null                          #DisplayName
        ,
        $_POST['SportverbandID'],
        null                          #Sportverband
        ,
        $_POST['ShortCut'],
        $_POST['Name']
    );
    Liga::update($dbContext, $object);
    header("Location: ./liga.controller.php?ID=".$ID);
    exit();
}

# Rückführung zum Eingabeformular zur Bearbeitung einer bestehenden Liga nach Verwerfen
elseif (isset($_POST['command']) and $_POST['command'] == "discardUpdate" and isset($_POST['ID'])) {
    $ID = $_POST['ID'];
    header("Location: ./liga.controller.php?ID=".$ID);
    exit();
}

# Löschung einer bestehenden Liga und Rückführung zur Übersicht aller Ligen
elseif (isset($_POST['command']) and $_POST['command'] == "delete") {
    $object = new Liga($_POST['ID'], null, null, null, null, null);
    Liga::delete($dbContext, $object);
    include("./liga.index.php");
}

# Setzen eines Sortierkriteriums
elseif (isset($_POST['command']) and $_POST['command'] == "setSortOrder" and isset($_POST['ClassName']) and isset($_POST['ColumnName'])) {
    $className      =   $_POST['ClassName'];
    $columnName     =   $_POST['ColumnName'];
    $fieldSetting   =   $fieldSettings->getFieldSetting($dbContext, $className, $columnName);
    $fieldSetting->setSortOrder($dbContext, $className, $columnName);
    header("Location: ./Liga.controller.php");
    exit();
}

# Entfernen eines Sortierkriteriums
elseif (isset($_POST['command']) and $_POST['command'] == "removeSortOrder" and isset($_POST['ClassName']) and isset($_POST['ColumnName'])) {
    $className      =   $_POST['ClassName'];
    $columnName     =   $_POST['ColumnName'];
    $fieldSetting   =   $fieldSettings->getFieldSetting($dbContext, $className, $columnName);
    $fieldSetting->removeSortOrder($dbContext);
    header("Location: ./Liga.controller.php");
    exit();
}
