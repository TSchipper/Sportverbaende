<?php

include("./sportverband.model.php");
include("./DBController.php");

function listCount($dbContext)
{
    return ($dbContext->numRows("SELECT * FROM sportverbaende"));
}

function getObjects($dbContext)
{
    $_sportverbaende = array();

    $sqlCommand = "SELECT ID, ShortCut, Name, NumberOfMembers FROM sportverbaende";

    foreach ($dbContext->runQuery($sqlCommand) as $row) {
        $id =  $row['ID'];
        $shortCut =  $row['ShortCut'];
        $name =  $row['Name'];
        $numberOfMembers =  $row['NumberOfMembers'];

        $_sportverband = new Sportverband($id, $shortCut, $name, $numberOfMembers);
        $_sportverbaende[]=$_sportverband;
    }
    return $_sportverbaende;
}

function getObjectByID($dbContext, $id)
{
    $sqlCommand = "SELECT ShortCut, Name, NumberOfMembers FROM sportverbaende WHERE ID = ".$id;

    foreach ($dbContext->runQuery($sqlCommand) as $row) {
        $shortCut =  $row['ShortCut'];
        $name =  $row['Name'];
        $numberOfMembers =  $row['NumberOfMembers'];

        $_sportverband = new Sportverband($id, $shortCut, $name, $numberOfMembers);
    }
    return $_sportverband;
}

function create($dbContext, $object)
{
    //https://www.w3schools.com/php/php_mysql_insert_lastid.asp
    $sqlCommand       =   "INSERT INTO sportverbaende (ShortCut, Name, NumberOfMembers) VALUES ('".$object->shortCut."', '".$object->name."', ".$object->numberOfMembers.")";
    return $dbContext->insert($sqlCommand);
}

function update($dbContext, $object)
{
    $sqlCommand         =   "UPDATE sportverbaende SET ShortCut = '".$object->shortCut."', Name = '".$object->name."', NumberOfMembers = ".$object->numberOfMembers." WHERE ID = ".$object->id;
    $dbContext->execute($sqlCommand);
}

function delete($dbContext, $id)
{
    $sqlCommand         =   "DELETE FROM sportverbaende WHERE ID = ".$id;
    $dbContext->execute($sqlCommand);

}

function objects2thead()
{
    return (
        "<thead>
                <tr>
                    <th></th>
                    <th><u>Kürzel</u></th>
                    <th><u>Name</u></th>
                    <th><u>Anzahl Mitglieder</u></th>
                </tr>
            </thead>"
    );
}

function object2tr($object)
{
    return (
        "<tr>
			<td class=\"tableCell_Icon\">
				
                    <span style=\"white-space: nowrap;\">
                        <input type=\"checkbox\"/>
                        <a href=\"./sportverband.controller.php?id=".$object->id."\">
                                <img class=\"listIcon\" src=\"./icon/Edit.png\" title=\"Bearbeiten\">
                        </a>
                        <img class=\"listIcon\" src=\"./icon/Duplicate.png\" title=\"Duplizieren (Mockup)\">
                        <img class=\"listIcon\" src=\"./icon/Delete.png\" title=\"Löschen\" onClick=\"activateDeleteConfirmation (".$object->id.")\"/>
                    </span>
	    	    
	        </td>
    		<td class=\"tableCell_Text\">".$object->shortCut."</td>
     	    <td class=\"tableCell_Text\">".$object->name."</td>
	    	<td class=\"tableCell_Number\">".number_format($object->numberOfMembers, 0, '', '.')."</td>
	    </tr>"
    );
}

function objects2tbody($objects)
{
    $tableRows  =       "";
    foreach ($objects as $object) {
        $tableRows  .=      object2tr($object);
    }
    return ("<tbody>".$tableRows."</tbody>");
}

function objects2table($objects)
{
    $table      =       "<table class=\"table table-light table-striped table-hover\">";
    $table      .=          objects2thead();
    $table      .=          objects2tbody($objects);
    $table      .=      "</table>";
    return      $table;
}

function object2cardBody($object)
{
    return (
        "<input type=\"hidden\" name=\"ID\" value=\"".$object->id."\"/>
        <div class=\"form-group row\">
            <label class=\"col-sm-2 col-form-label\">Kürzel</label>
                <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"ShortCut\" class=\"form-control\" value=\"".$object->shortCut."\"/>
                </div>
        </div>
        <div class=\"form-group row\">
            <label class=\"col-sm-2 col-form-label\">Name</label>
            <div class=\"col-sm-10\">
                <input type=\"text\" name=\"Name\" class=\"form-control\" value=\"".$object->name."\"/>
            </div>
        </div>
        <div class=\"form-group row\">
            <label class=\"col-sm-2 col-form-label\">Anzahl Mitglieder</label> 
            <div class=\"col-sm-10\">
                <input type=\"text\" name=\"NumberOfMembers\" class=\"form-control\" value=\"".$object->numberOfMembers."\"/>
            </div>
        </div>"
    );
}

$dbContext = new DBController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sportverband = getObjectByID($dbContext, $id);
    include("./sportverband.edit.php");
} elseif (isset($_POST['command']) and $_POST['command'] == "list") {
    include("./sportverband.index.php");
} elseif (isset($_POST['command']) and $_POST['command'] == "create") {
    $object = new Sportverband(
        "",
        $_POST['ShortCut'],
        $_POST['Name'],
        $_POST['NumberOfMembers']
    );
    $newID = create($dbContext, $object);
    header("Location: ./sportverband.controller.php?id=".$newID);
    exit();
} elseif (isset($_POST['command']) and $_POST['command'] == "update") {
    $object = new Sportverband(
        $_POST['ID'],
        $_POST['ShortCut'],
        $_POST['Name'],
        $_POST['NumberOfMembers']
    );
    update($dbContext, $object);
    header("Location: ./sportverband.controller.php?id=".$object->id);
    exit();
} elseif (isset($_POST['command']) and $_POST['command'] == "delete") {
    delete($dbContext, $_POST['ID']);
    include("./sportverband.index.php");
}




if (isset($_POST['command']) and $_POST['command'] == "initDatabase") {
    initDatabase();
    header("Location: ./index.php");
    exit();
}

if (isset($_POST['command']) and $_POST['command'] == "discardCreate") {
    header("Location: ../view/create.php");
    exit();
}
