<?php
    include('./include/content.inc.php');
	$sqlCommand = "SELECT ID, ShortCut, Name, NumberOfMembers FROM sportverbaende";
	$tableRows = "";
	$chartLabels = "";
	$chartData = "";
	
	foreach ($dbContext->query($sqlCommand) as $row) {
		$tableRows .= "<tr>
						<td class=\"tableCell_Icon\">
							<form action=\"./sportverbaende_controller.php?ID=".$row['ID']."\" method=\"post\">
								<input type=\"image\" src=\"./icon/Edit.png\" class=\"listIcon\" title=\"Bearbeiten\" name=\"command\" value=\"edit\" />
								<input type=\"image\" src=\"./icon/Delete.png\" class=\"listIcon\" title=\"Löschen\" name=\"command\" value=\"delete\" />
							</form>
						</td>
						<td class=\"tableCell_Text\">".$row['ShortCut']."</td>
						<td class=\"tableCell_Text\">".$row['Name']."</td>
						<td class=\"tableCell_Number\">".number_format($row['NumberOfMembers'], 0, '', '.')."</td>
					</tr>";
		$chartLabels .=  "'".$row['Name']." (".number_format($row['NumberOfMembers'], 0, '', '.').")', ";
		$chartData .=  "'".$row['NumberOfMembers']."',";
	}
	$chartLabels = substr ($chartLabels, 0, strlen ($chartLabels) - 2);
	$chartData = substr ($chartData, 0, strlen ($chartData) - 1);
?>

<div class="overview">

    <div class="overviewContent">
        <div class="card">
            <div class="card-header">
                Sportverbände (Anzahl: 
                <?php
                    $sqlCommand = $dbContext->query("SELECT COUNT(*) FROM sportverbaende");
                    $countSportverbaende = $sqlCommand->fetchColumn(0);
                    echo $countSportverbaende;  
                ?>)
            </div>

            <div class="card-body">
                <table class="table table-light table-striped table-hover">
                    <thead>
                        <tr><th></th><th><u>Kürzel</u></th><th><u>Name</u></th><th><u>Anzahl Mitglieder</u></th></tr>
                    </thead>
                    <tbody>
                        <?php echo $tableRows;?>
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-1">
                            <a href="./sportverbaende_create.php"><img class="listIcon" src="./icon/Create.png" title="Anlegen"></a>
                        </div>
                        <div class="container col-10 visible">
                            <div class="row">
                                <div class="col-9">Möchten Sie den Datensatz tatsächlich löschen?</div>
                                <div class="col-1"><button class="btn btn-danger">Ja</button></div>
                                <div class="col-1"><button class="btn btn-secondary">Nein</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overviewPlugin">
    <!--<canvas width="251" height="125" style="display: block; box-sizing: border-box; height: 140px; width: 280px;"></canvas>-->
        <div class="chartjs-size-monitor-shrink">
            <canvas id="myChart" class="chartjs-render-monitor" width="380px" height="600px" style="background: rgb(249, 249, 249); display: block; width: 400px; height: 600px; display: block; box-sizing: border-box;"></canvas>
        </div>
	    <script>	
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'pie',
                data: {
	                labels: [<?php echo $chartLabels; ?>],
	                datasets: [{
	                    label: 'Anzahl Mitglieder',
	                    data: [<?php echo $chartData; ?>],
        	            borderWidth: 1
	                }]
                }
                , options: {
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        </script>
    </div>
</div>