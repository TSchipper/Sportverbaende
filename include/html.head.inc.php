<?php

function showDynamicHtmlHead($title, $navElement)
{
    echo("
    <head>
    	<meta charset=\"utf-8\">
	    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"> 
    	<title".$title."</title>
	    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\"
		    integrity=\"sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh\" crossorigin=\"anonymous\">
	    <link rel=\"stylesheet\" href=\"../../css/layout.css\"> 
    	<script type=\"text/javascript\" src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>

	    <script src=\"../../jquery/html.body.navigation\"></script>
    	<script type=\"text/javascript\">
		    window.onload = function() {hilightNavItem('".$navElement."');};
	    </script>
    </head>
    );"
    );
}
