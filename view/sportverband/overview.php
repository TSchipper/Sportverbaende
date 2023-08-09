<?php include('../../controller/sportverband.php');
?>

<div class="overview">

    <div class="overviewContent">
        <div class="card">
            <div class="card-header">
                Sportverbände (Anzahl:
                <?php echo recordCount(1); ?>
            </div>
            <div class="card-body">
                <table class="table table-light table-striped table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th><u>Kürzel</u></th>
                            <th><u>Name</u></th>
                            <th><u>Anzahl Mitglieder</u></th>
                        </tr>
                        <?php echo overview(); ?>
                        overview()
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
                            <a href="./sportverbaende_create.php"><img class="listIcon" src="./icon/Create.png"
                                    title="Anlegen"></a>
                        </div>
                        <div class="container col-10 visible">
                            <div class="row">
                                <form action="sportverbaende_controller.php" method="post">
                                    <input ID="objectID" type="hidden" name="ID" value="" />
                                    <div class="btn-group invisible" ID="confirmationButtons">
                                        <button ID="confirmationText" type="button" class="btn btn-light">Soll dieses
                                            Objekt gelöscht werden?</button>
                                        <button ID="confirmationYes" type="submit" name="command" value="delete"
                                            class="btn btn-danger">Ja</button>
                                        <button ID="confirmationNo" type="button" class="btn btn-secondary"
                                            onClick="deactivateDeleteConfirmation ()">Nein</button>
                                    </div>
                                </form>
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
            <canvas id="myChart" class="chartjs-render-monitor" width="380px" height="600px"
                style="background: rgb(249, 249, 249); display: block; width: 400px; height: 600px; display: block; box-sizing: border-box;"></canvas>
        </div>
        <script>
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [ <?php echo $chartLabels; ?> ],
                    datasets: [{
                        label: 'Anzahl Mitglieder',
                        data: [ <?php echo $chartData; ?> ],
                        borderWidth: 1
                    }]
                },
                options: {
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