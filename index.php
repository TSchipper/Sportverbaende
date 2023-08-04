<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sportverbände</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="./Sportverbaende.css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		
		<script src="./jquery/navigation.js"></script>
		<script type="text/javascript">
			window.onload = function() {hilightNavItem ('navToWilkommen');};
		</script>
	</head>
 
	<body>
		<div class="grid-container">
  			<div class="header">
    			<h1>Sportverbände</h1>
  			</div>
  
  			<div class="navigation" style="background-color:#aaa;">
			  <?php include('./include/navigation.inc.php');?>
			</div>

  			<div class="content" style="background-color:#bbb;">
			  <h2>Herzlich Willkommen bei den Top-20-Sportverbänden<h2>
				<img src="./images/welcome.png" width="80%" align="center">
			</div>  
	  		<div class="footer">
				<p>Aktuelles Datum: <?php echo date("d.m.Y H:i:s");?></p>
		  	</div>
		</div>
	</body>
</html>