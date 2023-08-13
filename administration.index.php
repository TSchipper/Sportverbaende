<?php include('./include/html.head.inc.php'); ?>

<body>
    <div class="grid-container">
        <?php
            include('./include/html.body.header.inc.php');
include('./include/html.body.navigation.inc.php');
?>
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <img class="listIcon" src="./icon/Settings.png" title="Administration">
                    Administration
                </div>

                <div class="card-body">
                    <form action="./administration.controller.php" method="post">
                        <input type="hidden" name="FileName" value="./data/fieldSettings.sql" />
                        <button type="submit" name="command" value="executeSQLScript" class="btn btn-primary">

                            <img class="listIcon" src="./icon/Document.png"
                                title="Feldeinstellungen zurücksetzen">&nbsp;|&nbsp;Feldeinstellungen zurücksetzen
                        </button>
                    </form>

                    <form action="./administration.controller.php" method="post">
                        <input type="hidden" name="FileName" value="./data/create_Data_Sportverband.sql" />
                        <button type="submit" name="command" value="executeSQLScript" class="btn btn-primary">
                            <img class="listIcon" src="./icon/Refresh.png"
                                title="Daten zurücksetzen">&nbsp;|&nbsp;Sportverbände zurücksetzen
                        </button>
                    </form>

                    <form action="./administration.controller.php" method="post">
                        <input type="hidden" name="FileName" value="./data/create_Data_Liga.sql" />
                        <button type="submit" name="command" value="executeSQLScript" class="btn btn-secondary">
                            <img class="listIcon" src="./icon/Refresh.png" title="Daten zurücksetzen">&nbsp;|&nbsp;Ligen
                            zurücksetzen
                        </button>
                    </form>

                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="btn-group" ID="actionButtons">
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <?php include('./include/html.body.footer.inc.php'); ?>
    </div>
</body>

</html>