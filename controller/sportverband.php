<?php

include("../model/sportverband.php");

function initDatabase()
{
    // get data from the SQL file
    $query = file_get_contents("../../data/data.sql");

    // prepare the SQL statements
    $stmt = $dbContext->prepare($query);

    // execute the SQL
    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Fail";
    }
}

function chartContent()
{
    include('../../include/dbContext.pdo.inc.php');

    $chartLabels = "";
    $charData ="";

    $sqlCommand = "SELECT Name, NumberOfMembers FROM sportverbaende";

    foreach ($dbContext->query($sqlCommand) as $row) {
        $chartLabels .=  "'".$row['Name']." (".number_format($row['NumberOfMembers'], 0, '', '.').")', ";
        $result .=  "'".$row['NumberOfMembers']."',";

    }
    $chartLabels = substr($chartLabels, 0, strlen($chartLabels) - 2);
    $charData = substr($charData, 0, strlen($charData) - 1);

    return array('chartLabels' => $chartLabels, 'chartData' => $charData);
}

function loadRecord($id)
{
    include('../include/dbContext.pdo.inc.php');

    $result ="";
    $sqlCommand         =   "SELECT ShortCut, Name, NumberOfMembers FROM sportverbaende WHERE ID = $id";
    foreach ($dbContext->query($sqlCommand) as $row) {

        $shortCut =  $row['ShortCut'];
        $name =  $row['Name'];
        $numberOfMembers =  $row['NumberOfMembers'];

        $result = "<input type={\"hidden\" name=\"ID\" value=\".$id.\"/>

                        <div class=\"form-group row\">
                            <label class=\"col-sm-2 col-form-label\">Kürzel</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name=\"ShortCut\" class=\"form-control\"
                                    value=\".$shortCut.\" />
                            </div>
                        </div>

                        <div class=\"form-group row\">
                            <label class=\"col-sm-2 col-form-label\">Name</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name=\"Name\" class=\"form-control\"
                                    value=\".$name.\" />
                            </div>
                        </div>

                        <div class=\"form-group row\">
                            <label class=\"col-sm-2 col-form-label\">Anzahl Mitglieder</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name=\"NumberOfMembers\" class=\"form-control\"
                                    value=\"$numberOfMembers\" />
                            </div>
                        </div>
                    <tr>";
    }
    return $result;
}


if (!isset($_POST['command']) and !isset($_GET['id'])) {
    header("Location: ../view/sportverband/index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
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
    header("Location: ../view/create.php");
    exit();
}

if (isset($_POST['command']) and $_POST['command'] == "delete") {
    deleteRecord($_POST['ID']);
    header("Location: ../view/sportverband/index.php");
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
        include('../view/sportverband/edit.php');
    } else {
        echo "M I S S I N G   R E C O R D";
    }
} else {
    echo "I N V A L I D   R E Q U E S T";
}
