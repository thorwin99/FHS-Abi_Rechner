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
                    calcAbi();
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
                foreach($_POST['emarks'] as $emark){//Zähle die summe der e.A.Fächer
                    $SUMEmarks += $emark * 2;
                    if($emark <= 4){
                        $CountEUn++;
                    }
                }
                foreach($_POST['marks'] as $mark){//Zähle die Summe der anderen Fächer
                    $SUMPMarks += $mark;
                    if($mark <= 4){
                        $CountUn++;
                    }
                }
                if($CountEUn >= $AllowedEUn){//Prüfe ob zu viele e.A. Unterkurse
                    echo getHTMLObject("h2", array("id" => "resultString"), "Zu viele e.A. Unterkurse: " . $CountEUn);
                }else{
                    if($CountUn + $CountEUn >= $AllowedUn){//Prüfe ob zu viele Unterkurse
                        echo getHTMLObject("h2", array("id" => "resultString"), "Zu viele Unterkurse: " . ($CountEUn + $CountUn));
                    }else{
                        if($SUMEmarks < $MinEASum){//Prüfe ob genug e.A. Punkte
                            echo getHTMLObject("h2", array("id" => "resultString"), "Zu wenig e.A. Punkte: " . $SUMEmarks . " / " . $MinEASum);
                        }else{
                            if($SUMPMarks + $SUMEmarks < $MinMarkSum){//Prüfe ob genug Punkte
                                echo getHTMLObject("h2", array("id" => "resultString"), "Zu wenig Punkte: " . ($SUMEmarks + $SUMPMarks). " / " . $MinMarkSum);
                            }else{//Zeige Ergebnis
                                echo getHTMLObject("h2", array("id" => "resultString"), "Bestanden mit " . ($SUMEmarks + $SUMPMarks) . " Punkten");
                            }
                        }
                    }
                }
                

            }
            
            function calcAbi(){
                
            }
        ?>
	</body>
</html>