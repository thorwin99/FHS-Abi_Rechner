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
		<script type="text/javascript" src="script/marks.js"></script>
	</head>
	<body>
        <!--Noscript Redirect to enable-javascript.com if it isnt activated-->
        <noscript>
            AKTIVIERE JAVASCRIPT!!!
            <style>html{display:none;}</style>
            <meta http-equiv="refresh" content="0.0;url=http://www.enable-javascript.com/">
        </noscript>
		<!--Includes settings menu-->
		<?php include 'includes/settingsBar.php';?>
        <?php include 'includes/navBar.html'?>
        <div class="page">
            <div class="content">
                <form id="marksForm" action="result.php" method="post">
                    <!--Table with mark fields-->
                    <?php
                        require_once 'includes/profileData.php';
                        switch($_POST['absch']){//Wählt je nach abschluss eine ansdere Tabelle  
                            case "Abitur":
                                include 'includes/tabAbi.php';
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
            </div>
        </div>
	</body>
</html>