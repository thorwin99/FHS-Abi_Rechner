<html>
	<head>
		<title>
			<?php
            require 'includes/utilFunctions.php';
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
		<script type="text/javascript" src="script/marks.js"></script>
	</head>
	<body>
		<!--Includes settings menu-->
		<?php include 'includes/settingsBar.php';?>
		<h1>Noteneingabe</h1>
		<!--TODO: Add Abi calc -->
		<form id="marksForm" action="result.php" method="post">
			<!--Table with mark fields-->
            <?php
                require_once 'includes/profilesData.php';
                switch($_POST['absch']){  
                    case "Abitur":
                        include 'includes/tabFHS.php';
                        break;
                    case "Fachhochschule":
                        include 'includes/tabFHS.php';
                        break;
                    default:
                        redirect("index.html");
                        break;
                }
            ?>
            <input type="hidden" name="absch" value="<?php echo $_POST['absch']?>">
			<input type="hidden" name="profil" value="<?php echo $_POST['profil']?>">
			<input type="submit" value="Ergebnis">
		</form>
	</body>
</html>