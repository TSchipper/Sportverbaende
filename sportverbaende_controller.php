<?php
    
    function loadRecord ($id) {
        include('./include/content.inc.php');
        $sqlCommand         =   "SELECT ShortCut, Name, NumberOfMembers FROM sportverbaende WHERE ID = $id";
        foreach ($dbContext->query($sqlCommand) as $row) {
            $shortCut           =   $row['ShortCut'];
            $name               =   $row['Name'];
            $numberOfMembers    =   $row['NumberOfMembers'];
        }
        return array ("ShortCut" => $shortCut, "Name" => $name, "NumberOfMembers" => $numberOfMembers);
    }

    function createRecord ($shortCut, $name, $numberOfMembers) {
        //https://www.w3schools.com/php/php_mysql_insert_lastid.asp
        //include('./include/content.inc.php');
        $dbContext          =   new mysqli ("localhost", "root", null, "sportverbaende");
        $sqlCommand         =   "INSERT INTO sportverbaende (ShortCut, Name, NumberOfMembers) VALUES ('".$shortCut."', '".$name."', '".$numberOfMembers."')";

        if ($dbContext->query($sqlCommand) === TRUE) {
            return ($dbContext->insert_id);
        } else {
            return -1;
        }
    }

    function saveRecord ($id, $shortCut, $name, $numberOfMembers) {
        include('./include/content.inc.php');
        $sqlCommand         =   $dbContext->prepare("UPDATE sportverbaende SET ShortCut = :shortCut, Name = :name, NumberOfMembers = :numberOfMembers WHERE ID = :id");
        $sqlCommand->execute(array('id' => $id, 'shortCut' => $shortCut, 'name' => $name, 'numberOfMembers' => $numberOfMembers ));
    }

    function deleteRecord ($id) {
        include('./include/content.inc.php');
        $sqlCommand         =   $dbContext->prepare("DELETE FROM sportverbaende WHERE ID = :id");
        $sqlCommand->execute(array('id' => $id));
    }

    if (isset ($_POST['command']) AND $_POST['command'] == "create") {
        $newID = createRecord ($_POST['ShortCut'] , $_POST['Name'] , $_POST['NumberOfMembers']);
        header("Location: ./sportverbaende_controller.php?ID=".$newID);
        exit();
    }

    if (isset ($_POST['command']) AND $_POST['command'] == "discardCreate") {
        header("Location: ./sportverbaende_create.php");
        exit();
    }
    
    if (isset($_GET['ID'])) {
        $id                 =   $_GET['ID'];

        if (isset ($_POST['command']) AND $_POST['command'] == "save") {
            saveRecord ($id , $_POST['ShortCut'] , $_POST['Name'] , $_POST['NumberOfMembers']);
        } else if (isset ($_POST['command']) AND $_POST['command'] == "delete") {
            deleteRecord ($id);
            header("Location: ./sportverbaende_index.php");
            exit();
        }
        
        $record             =   loadRecord ($id);
        if (isset ($record)) {
            $shortCut           =   $record['ShortCut'];
            $name               =   $record['Name'];
            $numberOfMembers    =   $record['NumberOfMembers'];
            include('./sportverbaende_edit.php');
        } else {
            echo "M I S S I N G   R E C O R D";
        }
    } else {
        echo "I N V A L I D   R E Q U E S T";
    }
?>