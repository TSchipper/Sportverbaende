<?php

class FieldSetting
{
    public $_className;
    public $_columnName;
    public $_columnRank;
    public $_displayName;
    public $_selectClass;
    public $_showInOverview;
    public $_showInForm;
    public $_sortOrder;
    public $_sortRank;

    public function __construct($className, $columnName, $columnRank, $displayName, $selectClass, $showInOverview, $showInForm, $sortOrder, $sortRank)
    {
        $this->_className       = $className;
        $this->_columnName      = $columnName;
        $this->_columnRank      = $columnRank;
        $this->_displayName     = $displayName;
        $this->_selectClass     = $selectClass;
        $this->_showInOverview  = $showInOverview;
        $this->_showInForm      = $showInForm;
        $this->_sortOrder       = $sortOrder;
        $this->_sortRank        = $sortRank;
    }
}

class FieldSettings
{
    public $_fieldSettings = array();

    public function __construct($dbContext, $className)
    {
        $sqlCommand = "SELECT * FROM FieldSettings WHERE ClassName = '".$className."' ORDER BY ColumnRank";
        $resultSet  = $dbContext->runQuery($sqlCommand);

        if ($resultSet != null) {
            foreach ($resultSet as $row) {

                $className       = $row['ClassName'];
                $columnName      = $row['ColumnName'];
                $columnRank      = $row['ColumnRank'];
                $displayName     = $row['DisplayName'];
                $selectClass     = $row['SelectClass'];
                $showInOverview  = $row['ShowInOverview'];
                $showInForm      = $row['ShowInForm'];
                $sortOrder       = $row['SortOrder'];
                $sortRank        = $row['SortRank'];


                $_fieldSetting = new FieldSetting($className, $columnName, $columnRank, $displayName, $selectClass, $showInOverview, $showInForm, $sortOrder, $sortRank);
                $this->_fieldSettings[]=$_fieldSetting;
            }
        }
    }

    public function getFieldSettings()
    {
        return $this->_fieldSettings;
    }

    public function orderByClause()
    {
        $result = "";
        if ($this->_fieldSettings != null) {
            foreach ($this->_fieldSettings as $fieldSetting) {
                switch ($fieldSetting->_sortOrder) {
                    case 'Asc':     $result .= $fieldSetting->_columnName." ASC, ";
                        break;
                    case 'Desc':    $result .= $fieldSetting->_columnName." DESC, ";
                        break;
                }
            }
        }
        if ($result != "") {
            return "ORDER BY ".substr($result, 0, strlen($result) - 2);
        }
        return ($result);
    }
}
