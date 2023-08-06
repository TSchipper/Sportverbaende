<?php
    function dropdownContent (
        $tableName
        , $columnName
        , $preselectedValue
        , $valueColumn
        , $textColumn
        , $orderByClause
    ) {
        
        $dbContext          =       new PDO('mysql:host=localhost;dbname=sportverbaende', 'root');
        $sqlCommand         =       "SELECT ".$valueColumn." AS ValueColumn, ".$textColumn." AS TextColumn FROM ".$tableName." ORDER BY ".$orderByClause;
        
        $dropdownContent    =       "<select name=\"".$columnName."\" class=\"form-control\">";
        
        foreach ($dbContext->query($sqlCommand) as $row) {
            $newOption      =       "";
            if (isset ($preselectedValue) AND $preselectedValue == $row['ValueColumn']) {
                $newOption  .=      "<option value=\"".$row['ValueColumn']."\" selected=\"selected\">".$row['TextColumn']."</option>";
            } else {
                $newOption  .=      "<option value=\"".$row['ValueColumn']."\">".$row['TextColumn']."</option>";
            };
            $dropdownContent
                            .=      $newOption;
        }
        $dropdownContent    .=      "</select>";
        return                      $dropdownContent;
    }
    
?>