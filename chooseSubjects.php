<html>
	<head>
		<title>
			<?php
            require_once 'includes/htmlObjectFunctions.php';
			if(!isset($_POST['absch'])){//Wenn die Seite geladen wird, ohne dass $_POST['absch'] gesetzt ist, weiterleitung auf index.php
				redirect("index.php");
			}
            //Zwinge den Browser die Seite nicht in den Cache zu laden, um Fehler zu vermeiden.
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Pragma: no-cache");
            header("Expires: 0");
            //Der titel der seite wird auf Abschluss + Rechner - Seite gesetzt
			echo $_POST['absch'] . " Rechner - Fachauswahl";
			?>
		</title>
		 <meta charset="UTF-8"> 
		<link rel="stylesheet" type="text/css" href="style/webStyle.css">
		<!-- load jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <?php
            //Lädt das Javascript für den jeweiligen abschluss
            require_once 'includes/htmlObjectFunctions.php';
            if($_POST['absch'] == "Abitur"){
                 echo getHTMLObject("script", array("src" => "script/ABISubjects.js"), "");
            }else{
                 echo getHTMLObject("script", array("src" => "script/FHSSubjects.js"), "");
            }
            
        ?>
	</head>
	<body>
        <!--Noscript Redirect to enable-javascript.com if it isnt activated-->
        <noscript>
            AKTIVIERE JAVASCRIPT!!!
            <style>html{display:none;}</style>
            <meta http-equiv="refresh" content="0.0;url=http://www.enable-javascript.com/">
        </noscript>
        <!--Include settingsBar-->
        <?php include 'includes/settingsBar.php';?>
        <?php include 'includes/navBar.html'?>
        <div class="page">
            <div class="content">
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
            </div>
        </div>
	</body>
</html>