<!DOCTYPE html>
<html lang="de">

<?php
    include('../../include/html.head.inc.php');
showDynamicHtmlHead("Sportverbände", "navToLigen");
?>

<body>
	<div class="grid-container">
		<?php
        include('../../include/html.body.header.inc.php');
		showDynamicHeader("Ligen");
		include('../../include/html.body.navigation.inc.php');
		?>
		<div class="content">
			<h2>Ligen<h2>
		</div>
		<?php include('../../include/html.body.footer.inc.php');?>
	</div>
</body>

</html>