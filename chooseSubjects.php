<html>
	<head>
		<title>
			<?php
            require_once 'includes/htmlObjectFunctions.php';
			if(!isset($_POST['absch'])){
				redirect("index.html");
			}
            header("Cache-Control: no-cache, must-revalidate, max-age=0");
			echo $_POST['absch'] . " Rechner"
			?>
		</title>
		 <meta charset="UTF-8"> 
		<link rel="stylesheet" type="text/css" href="style/webStyle.css">
		<!-- load jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <?php
            require_once 'includes/htmlObjectFunctions.php';
            if($_POST['absch'] == "Abitur"){
                 echo getHTMLObject("script", array("src" => "script/ABISubjects.js"), "");
            }else{
                 echo getHTMLObject("script", array("src" => "script/FHSSubjects.js"), "");
            }
            
        ?>
	</head>
	<body>
        <?php include 'includes/navBar.html'?>
        <?php include 'includes/settingsBar.php';?>
		<h1 id="order">Wähle deine Fächer</h1>
		<form id="subjectFrom" action="marks.php" method="post">
			<?php
				include 'includes/SubjectChooser.php';
			?>
			<input type="submit" value="Bestätigen">
			<!--Hidden values-->
			<input type="hidden" name="absch" value="<?php echo $_POST['absch']?>">
			<input type="hidden" name="profil" value="<?php echo $_POST['profil']?>">
            <input type="hidden" name="seclanguage" value="<?php echo $_POST['seclanguage']?>">
		</form>
	</body>
</html>