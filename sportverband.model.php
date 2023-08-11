<?php

class Sportverband
{
    public $id;
    public $shortCut;
    public $name;
    public $numberOfMembers;

    public function __construct($id, $shortCut, $name, $numberOfMembers)
    {
        $this->id               =       $id;
        $this->shortCut         =       $shortCut;
        $this->name             =       $name;
        $this->numberOfMembers  =       $numberOfMembers;
    }

    /*
    public function listCount($dbContext)
    {
        return ($dbContext.numRows("SELECT COUNT (*) FROM sportverbaende"));
    }

    public function list($dbContext)
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

    public function getObjectByID($dbContext, $id)
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

    public function create($dbContext)
    {
        //https://www.w3schools.com/php/php_mysql_insert_lastid.asp
        $sqlCommand         =   "INSERT INTO sportverbaende (ShortCut, Name, NumberOfMembers) VALUES ('".$this->shortCut."', '".$this->name."', '".$this->numberOfMembers."')";
        if ($$dbContext->insert($sqlCommand) === true) {
            return ($dbContextSqli->insert_id);
        } else {
            return -1;
        }
    }

    public function update($dbContext)
    {
        $sqlCommand         =   $dbContext->prepare("UPDATE sportverbaende SET ShortCut = :shortCut, Name = :name, NumberOfMembers = :numberOfMembers WHERE ID = :id");
        $sqlCommand->execute(array('id' => $this->id, 'shortCut' => $this->shortCut, 'name' => $this->name, 'numberOfMembers' => $this->numberOfMembers ));
    }

    public function delete($dbContext)
    {
        $sqlCommand         =   $dbContext->prepare("DELETE FROM sportverbaende WHERE ID = :id");
        $sqlCommand->execute(array('id' => $this->id));
    }
    */
}
