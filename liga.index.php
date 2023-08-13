<?php
$title = "Ligen";
$navElement = "navToLiga";
include('./include/html.head.inc.php');
?>

<body>
	<div class="grid-container">
		<?php
            include('./include/html.body.header.inc.php');
include('./include/html.body.navigation.inc.php'); ?>
		<div class="content">
			<?php include('./liga.overview.php'); ?>
		</div>
		<?php include('./include/html.body.footer.inc.php'); ?>
	</div>
</body>

</html>