<?php

function initDatabase()
{
    // database credentials
    // database connection string
    include('../../include/dbContext.inc.php');



    // get data from the SQL file
    $query = file_get_contents("./data/data.sql");

    // prepare the SQL statements
    $stmt = $dbContext->prepare($query);

    // execute the SQL
    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Fail";
    }
}

function loadRecord($id)
{
    include('./include/dbContext.inc.php');
    $sqlCommand         =   "SELECT ShortCut, Name, NumberOfMembers FROM sportverbaende WHERE ID = $id";
    foreach ($dbContext->query($sqlCommand) as $row) {
        $shortCut           =   $row['ShortCut'];
        $name               =   $row['Name'];
        $numberOfMembers    =   $row['NumberOfMembers'];
    }
    return array("ShortCut" => $shortCut, "Name" => $name, "NumberOfMembers" => $numberOfMembers);
}

function createRecord($shortCut, $name, $numberOfMembers)
{
    //https://www.w3schools.com/php/php_mysql_insert_lastid.asp
    $dbContext          =   new mysqli("localhost", "root", null, "sportverbaende");
    $sqlCommand         =   "INSERT INTO sportverbaende (ShortCut, Name, NumberOfMembers) VALUES ('".$shortCut."', '".$name."', '".$numberOfMembers."')";

    if ($dbContext->query($sqlCommand) === true) {
        return ($dbContext->insert_id);
    } else {
        return -1;
    }
}

function saveRecord($id, $shortCut, $name, $numberOfMembers)
{
    include('../../include/dbContext.inc.php');

    $sqlCommand         =   $dbContext->prepare("UPDATE sportverbaende SET ShortCut = :shortCut, Name = :name, NumberOfMembers = :numberOfMembers WHERE ID = :id");
    $sqlCommand->execute(array('id' => $id, 'shortCut' => $shortCut, 'name' => $name, 'numberOfMembers' => $numberOfMembers ));
}

function deleteRecord($id)
{
    include('../../include/dbContext.inc.php');

    $sqlCommand         =   $dbContext->prepare("DELETE FROM sportverbaende WHERE ID = :id");
    $sqlCommand->execute(array('id' => $id));
}

if (isset($_POST['command']) and $_POST['command'] == "initDatabase") {
    initDatabase();
    header("Location: ./index.php");
    exit();
}

if (isset($_POST['command']) and $_POST['command'] == "create") {
    $newID = createRecord($_POST['ShortCut'], $_POST['Name'], $_POST['NumberOfMembers']);
    header("Location: ../../controller/sportverband.php?ID=".$newID);
    exit();
}

if (isset($_POST['command']) and $_POST['command'] == "discardCreate") {
    header("Location: ../../view/create.php");
    exit();
}

if (isset($_POST['command']) and $_POST['command'] == "delete") {
    deleteRecord($_POST['ID']);
    header("Location: ../../view/sportverband/index.php");
    exit();
}

if (isset($_GET['ID'])) {
    $id                 =   $_GET['ID'];

    if (isset($_POST['command']) and $_POST['command'] == "save") {
        saveRecord($id, $_POST['ShortCut'], $_POST['Name'], $_POST['NumberOfMembers']);
    }

    $record             =   loadRecord($id);
    if (isset($record)) {
        $shortCut           =   $record['ShortCut'];
        $name               =   $record['Name'];
        $numberOfMembers    =   $record['NumberOfMembers'];
        include('../../view/sportverband/edit.php');
    } else {
        echo "M I S S I N G   R E C O R D";
    }
} else {
    echo "I N V A L I D   R E Q U E S T";
}
