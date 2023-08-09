<?php

include("./DBController.php");

class Sportverband
{
    private $dbContext;

    public $id;
    public $shortCut;
    public $name;
    public $numberOfMembers;

    public function __construct($id, $shortCut, $name, $numberOfMembers)
    {
        $this->dbContext        =       new DBController();
        $this->id               =       $id;
        $this->shortCut         =       $shortCut;
        $this->name             =       $name;
        $this->numberOfMembers  =       $numberOfMembers;
    }

    public static function welcomeMessage()
    {
        return "Wilkommen, ich bin das model 'sportverband.php'";
    }

    public function object2tr()
    {
        return (
            "<tr>
			    <td class=\"tableCell_Icon\">
				    <form action=\"../../controller/sportverband.php?ID=".$this->ID."\" method=\"post\">
                        <span style=\"white-space: nowrap;\">
                            <input type=\"checkbox\"/>
                            <a href=\"../../controller/sportverband.php?ID=".$this->ID."\">
                                <img class=\"listIcon\" src=\"../../icon/Edit.png\" title=\"Bearbeiten\">
                        </a>
                        <img class=\"listIcon\" src=\"../../icon/Duplicate.png\" title=\"Duplizieren (Mockup)\">
                        <img class=\"listIcon\" src=\"../../icon/Delete.png\" title=\"Löschen\" onClick=\"activateDeleteConfirmation (".$sportverband->ID.")\"/>
                        </span>
	    	    	</form>
	        	</td>
    		    <td class=\"tableCell_Text\">".$this->ShortCut."</td>
     	    	<td class=\"tableCell_Text\">".$this->Name."</td>
	    	    <td class=\"tableCell_Number\">".number_format($this->NumberOfMembers, 0, '', '.')."</td>
	       </tr>"
        );
    }

    public static function list()
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

    public function create()
    {
        //https://www.w3schools.com/php/php_mysql_insert_lastid.asp
        $sqlCommand         =   "INSERT INTO sportverbaende (ShortCut, Name, NumberOfMembers) VALUES ('".$this->shortCut."', '".$this->name."', '".$this->numberOfMembers."')";
        if ($$dbContext->insert($sqlCommand) === true) {
            return ($dbContextSqli->insert_id);
        } else {
            return -1;
        }
    }

    public function update()
    {
        $sqlCommand         =   $dbContext->prepare("UPDATE sportverbaende SET ShortCut = :shortCut, Name = :name, NumberOfMembers = :numberOfMembers WHERE ID = :id");
        $sqlCommand->execute(array('id' => $this->id, 'shortCut' => $this->shortCut, 'name' => $this->name, 'numberOfMembers' => $this->numberOfMembers ));
    }

    public function delete()
    {
        $sqlCommand         =   $dbContext->prepare("DELETE FROM sportverbaende WHERE ID = :id");
        $sqlCommand->execute(array('id' => $this->id));
    }
}
