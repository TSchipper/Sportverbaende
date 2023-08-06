<?php
    
    function loadRecord ($id) {
        include('./include/content.inc.php');
        $sqlCommand         =   "SELECT SportverbandID, ShortCut, Name FROM ligen WHERE ID = $id";
        foreach ($dbContext->query($sqlCommand) as $row) {
            $sportverbandID     =   $row['SportverbandID'];
            $shortCut           =   $row['ShortCut'];
            $name               =   $row['Name'];
        }
        return array ("SportverbandID" => $sportverbandID, "ShortCut" => $shortCut, "Name" => $name);
    }

    function createRecord ($sportverbandID, $shortCut, $name) {
        //https://www.w3schools.com/php/php_mysql_insert_lastid.asp
        //include('./include/content.inc.php');
        $dbContext          =   new mysqli ("localhost", "root", null, "sportverbaende");
        $sqlCommand         =   "INSERT INTO ligen (SportverbandID, ShortCut, Name) VALUES ('".$sportverbandID."', '".$shortCut."', '".$name."')";

        if ($dbContext->query($sqlCommand) === TRUE) {
            return ($dbContext->insert_id);
        } else {
            return -1;
        }
    }

    function saveRecord ($id, $sportverbandID, $shortCut, $name) {
        include('./include/content.inc.php');
        $sqlCommand         =   $dbContext->prepare("UPDATE ligen SET SportverbandID = :sportverbandID, ShortCut = :shortCut, Name = :name WHERE ID = :id");
        $sqlCommand->execute(array('id' => $id, 'sportverbandID' => $sportverbandID, 'shortCut' => $shortCut, 'name' => $name));
    }

    function deleteRecord ($id) {
        include('./include/content.inc.php');
        $sqlCommand         =   $dbContext->prepare("DELETE FROM ligen WHERE ID = :id");
        $sqlCommand->execute(array('id' => $id));
    }

    if (isset ($_POST['command']) AND $_POST['command'] == "create") {
        $newID = createRecord ($_POST['SportverbandID'], $_POST['ShortCut'], $_POST['Name']);
        header("Location: ./ligen_controller.php?ID=".$newID);
        exit();
    }

    if (isset ($_POST['command']) AND $_POST['command'] == "discardCreate") {
        header("Location: ./ligen_create.php");
        exit();
    }
    
    if (isset($_GET['ID'])) {
        $id                 =   $_GET['ID'];

        if (isset ($_POST['command']) AND $_POST['command'] == "save") {
            saveRecord ($id , $_POST['SportverbandID'], $_POST['ShortCut'] , $_POST['Name']);
        } else if (isset ($_POST['command']) AND $_POST['command'] == "delete") {
            deleteRecord ($id);
            header("Location: ./ligen_index.php");
            exit();
        }
        
        $record             =   loadRecord ($id);
        if (isset ($record)) {
            $sportverbandID =   $record['SportverbandID'];
            $shortCut       =   $record['ShortCut'];
            $name           =   $record['Name'];
            include('./ligen_edit.php');
        } else {
            echo "M I S S I N G   R E C O R D";
        }
    } else {
        echo "I N V A L I D   R E Q U E S T";
    }
?>