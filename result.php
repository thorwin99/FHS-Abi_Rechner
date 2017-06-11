<html>
	<head>
		<title>
			<?php
            require 'includes/htmlObjectFunctions.php';
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
		<?php //include 'includes/settingsBar.php';?>
		<h1>Ergebnis</h1>
        <?php
            switch($_POST['absch']){
                case "Abitur":
                    break;
                case "Fachhochschule":
                    calcFHS();
                    break;
                default:
                    break;
            }
        
            function calcFHS(){
                $AllowedUn = 6;//Erlaubte Unterkurse gesamt
                $AllowedEUn = 2;//Erlaubte Unterkurse in e.A.
                $MinEASum = 20;//Mindestsumme aller e.A. Fächer
                $MinMarkSum = 95;//Mindestsumme aller Noten
                $SUMEmarks = 0;//Summe e.A.
                $SUMPMarks = 0;//Summe anderer Fächer
                $CountEUn = 0;//Anzahl unterkurse in den EA Fächern
                $CountUn = 0;//Anzahl unterkurse in den anderen Fächern
                foreach($_POST['emarks'] as $emark){
                    $SUMEmarks += $emark * 2;
                    if($emark <= 4){
                        $CountEUn++;
                    }
                }
                foreach($_POST['marks'] as $mark){
                    $SUMPMarks += $mark * 2;
                    if($mark <= 4){
                        $CountUn++;
                    }
                }
                if($CountEUn >= $AllowedEUn){
                    echo getHTMLObject("h2", array("id" => "resultString"), "Zu viele e.A. Unterkurse: " . $CountEUn);
                }

            }
        ?>
	</body>
</html>