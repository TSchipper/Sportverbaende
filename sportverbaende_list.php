<?php include('./include/content.inc.php');?>
<div class="card">
    <div class="card-header">
        Sportverbände (Anzahl: 
        <?php
            $sqlCommand = $dbContext->query("SELECT COUNT(*) FROM sportverbaende");
            $countSportverbaende = $sqlCommand->fetchColumn(0);
            echo $countSportverbaende;
        ?>
        )
    </div>

    <div class="card-body">
        <table class="table table-light table-striped table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Kürzel</th>
                    <th>Name</th>
                    <th>Anzahl Mitglieder</th>
                </tr>
            </thead>
            <tbody>
            <?php
				$sqlCommand = "SELECT ID, ShortCut, Name, NumberOfMembers FROM sportverbaende";
				foreach ($dbContext->query($sqlCommand) as $row) {
                    echo "<tr>";
                        echo "<td class=\"tableCell_Icon\">
                            <a href=\"./sportverbaende_editController.php?ID=".$row['ID']."\">
                            <img class=\"listIcon\" src=\"./icon/Edit.png\">
                            </a>
                            
                            <img class=\"listIcon\" src=\"./icon/Delete.png\">
                            
                        </td>";
                        echo "<td class=\"tableCell_Text\">".$row['ShortCut']."</td>";
                        echo "<td class=\"tableCell_Text\">".$row['Name']."</td>";
                        echo "<td class=\"tableCell_Number\">".number_format($row['NumberOfMembers'], 0, '', '.')."</td>";
                    echo "</tr>";
				}
                ?>
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <img class="listIcon" src="./icon/Create.png">
    </div>
</div>