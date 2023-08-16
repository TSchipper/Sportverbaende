<?php

#-------------------------------------------------------------------------------
# Einbindung der benötigten  Modelle
#-------------------------------------------------------------------------------
include("./model/basic.php");
include("./support/DBContext.php");
$dbContext = new DBContext();

#-------------------------------------------------------------------------------

#-------------------------------------------------------------------------------
# Ausführung des Controllers
#-------------------------------------------------------------------------------

$title = "Setup";
$navElement = "navToSetup";

include('.//setup.index.php');

function loadSportverband($dbContext)
{
    $dbContext->exeuteSqlScriptFile("./data/dataSamples/loadSportverband.sql");
}

function resetSportverband($dbContext)
{
    $dbContext->exeuteSqlScriptFile("./data/dataSamples/resetSportverband.sql");
    $dbContext->exeuteSqlScriptFile("./data/dataModel/dataBaseStructures.sql");
}

function loadLiga($dbContext)
{
    $dbContext->exeuteSqlScriptFile("./data/dataSamples/loadLiga.sql");
}

function resetLiga($dbContext)
{
    $dbContext->exeuteSqlScriptFile("./data/dataSamples/resetLiga.sql");
}

if (isset($_POST['command'])) {
    switch ($_POST['command']) {
        case 'loadSportverband':
            loadSportverband($dbContext);
            break;
        case 'resetSportverband':
            resetSportverband($dbContext);

            break;
        case 'loadLiga':
            loadLiga($dbContext);
            break;
        case 'resetLiga':
            resetLiga($dbContext);
            break;
    }
}
