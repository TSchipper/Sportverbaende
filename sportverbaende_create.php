<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sportverbände</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="./css/layout.css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		
		<script src="./jquery/navigation.js"></script>
		<script type="text/javascript">
			window.onload = function() {hilightNavItem ('navToSportverbaende');};
		</script>
	</head>

    <body>
    <div class="grid-container">
  			<div class="header">
    			<h1>Sportverbände</h1>
  			</div>
  
  			<div class="navigation">
			  <?php include('./include/navigation.inc.php');?>
			</div>

			<div class="content">
                <form action="sportverbaende_controller.php" method="post">
                    <div class="card">
                        <div class="card-header">
                            <img class="listIcon" src="./icon/Create.png">
                            Sportverband anlegen
                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kürzel</label>
                                <div class="col-sm-10">
                                    <input type="text" name="ShortCut" class="form-control" value=""/>
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="Name" class="form-control" value=""/>
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Anzahl Mitglieder</label>
                                <div class="col-sm-10">
                                    <input type="text" name="NumberOfMembers" class="form-control" value=""/>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" name="command" value="create" class="btn btn-success">
                                <img class="listIcon" src="./icon/Create.png">&nbsp;|&nbsp;Anlegen
                            </button>
                            <button type="submit" name="command" value="discardCreate" class="btn btn-secondary">
                                <img class="listIcon" src="./icon/Refresh.png">&nbsp;|&nbsp;Verwerfen
                            </button>
                        </div>
                    </div>
                </form>
			</div>  
	  		<div class="footer">
				<p>Aktuelles Datum: <?php echo date("d.m.Y H:i:s");?></p>
		  	</div>
		</div>
	</body>
</html>    