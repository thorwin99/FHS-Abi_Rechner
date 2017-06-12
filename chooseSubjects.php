<html>
	<head>
		<title>
			<?php
			if(!isset($_POST['absch'])){
				redirect("index.html");
			}
			echo $_POST['absch'] . " Rechner"
			?>
		</title>
		 <meta charset="UTF-8"> 
		<link rel="stylesheet" type="text/css" href="style/webStyle.css">
		<!-- load jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="script/Subjects.js"></script>
	</head>
	<body>
		<h1 id="order">Wähle deine Fächer</h1>
		<form id="subjectFrom" action="marks.php" method="post">
			<?php
				include 'includes/fhsSubjectChooser.php';
			?>
			<input type="submit" value="Bestätigen">
			<!--Hidden values-->
			<input type="hidden" name="absch" value="<?php echo $_POST['absch']?>">
			<input type="hidden" name="profil" value="<?php echo $_POST['profil']?>">
		</form>
	</body>
</html>