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
		<h1>Ergebnis</h1>
        <?php
            switch($_POST['absch']){
                case "Abitur":
                    break;
                case "Fachhochschule":
                    
                    
                    
                    
                    break;
                default:
                    break;
            }
        ?>
	</body>
</html>