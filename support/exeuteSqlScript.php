<?php

//https://www.php-resource.de/forum/php-developer-forum/88291-sql-datei-per-php-ausf%C3%BChren
function exeuteSqlScript($scriptFile)
{
    $pdo = new PDO('mysql:host=localhost;dbname=sportverbaende', 'root', null);
    $fileContent = file_get_contents($scriptFile);
    $sqlCommands = explode(';', $fileContent);

    foreach($sqlCommands as $sqlCommand) {
        if ($sqlCommand != null and $sqlCommand !="" and !str_contains($sqlCommand, "--")) {
            $statement          =   $pdo->prepare($sqlCommand);
            $statement->execute();// || die("Error: " . mysql_error() . "<br />Cmd: $cmd<br />");
        }
    }
}
