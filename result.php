<html>
	<head>
		<title>
			<?php
            require_once 'includes/htmlObjectFunctions.php';
            require_once 'includes/profileData.php';
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
                $AllowedUn = floor((sizeof($_POST['emarks']) + sizeof($_POST['marks']))*0.4);//Erlaubte Unterkurse gesamt
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
                if($AllowedEUn < $CountEUn){//Prüfe ob zu viele e.A. Unterkurse
                    echo getHTMLObject("h2", array("id" => "resultString"), "Zu viele e.A. Unterkurse: " . $CountEUn . " von " . $AllowedEUn);
                }else{
                    if($AllowedUn < $CountUn + $CountEUn){//Prüfe ob zu viele Unterkurse
                        echo getHTMLObject("h2", array("id" => "resultString"), "Zu viele Unterkurse: " . ($CountEUn + $CountUn) . " von " . $AllowedUn);
                    }else{
                        if($SUMEmarks < $MinEASum){//Prüfe ob genug e.A. Punkte
                            echo getHTMLObject("h2", array("id" => "resultString"), "Zu wenig e.A. Punkte: " . $SUMEmarks . " von " . $MinEASum);
                        }else{
                            if($SUMPMarks + $SUMEmarks < $MinMarkSum){//Prüfe ob genug Punkte
                                echo getHTMLObject("h2", array("id" => "resultString"), "Zu wenig Punkte: " . ($SUMEmarks + $SUMPMarks). " / " . $MinMarkSum);
                            }else{//Zeige Ergebnis
                                echo getHTMLObject("h2", array("id" => "resultString"), "Bestanden mit " . ($SUMEmarks + $SUMPMarks) . " Punkten, das entspricht einer " . getMarkFromPoints(($SUMEmarks + $SUMPMarks), 1));
                            }
                        }
                    }
                }
                

            }
            
            function calcAbi(){
                $MarksCount = sizeof($_POST['marks']) + sizeof($_POST['emarks']);
                $AllowedUn = floor(($MarksCount * 0.2));
                $MinPNotUn = 3;
                $MinPMarkSum = 20;
                $MinEASum = 40;
                $MinPSum = 100;
                $MinMarkSum = 200;
                $SUMEMarks = 0;
                $SUMMarks = 0;
                $SUMPuberMinPNotUn = 0;
                $SUMNull = 0;
                $SUMPMarks = 0;
                $CountUn = 0;
                $PMarksSum = array();
                foreach($_POST['emarks'] as $emark){
                    $SUMEMarks += $emark;
                    if($emark < 5){
                        if($emark == 0)$SUMNull++;
                        $CountUn++;
                    }
                }//Summe der e.A. Noten bilden.
                foreach($_POST['marks'] as $mark){
                    $SUMMarks += $mark;
                    if($emark < 5){
                        if($emark == 0)$SUMNull++;
                        $CountUn++;
                    }
                }//Summe der anderen Fächer bilden
                foreach($_POST['pmarks'] as $subject => $mark){
                    if(isset($_POST['mpmarks'][$subject])){
                        $MpMark = $_POST['mpmarks'][$subject];
                        $thisSum = ceil((4*($mark*+$MpMark)/3));
                        $PMarksSum[$subject] = $thisSum;
                        $SUMPMarks += $thisSum;
                        if($thisSum >= $MinPMarkSum){
                            $SUMPuberMinPNotUn++;
                        }
                    }else{
                        $thisSum = ceil((4*$mark));
                        $PMarksSum[$subject] = $thisSum;
                        if($thisSum >= $MinPMarkSum){
                            $SUMPuberMinPNotUn++;
                        }
                        $SUMPMarks += $thisSum;
                    }
                    
                    
                }//Summe der jeweiligen Prüfung bilden.
                
                
                if($SUMNull > 0){
                    echo getHTMLObject("h2", array("id" => "resultString"), "Du hast " . $SUMNull . " mal 0 Punkte. Erlaubt sind 0 mal 0 Punkte.");
                }else if($SUMEMarks < $MinEASum){//Prüfe ob genug e.A. Punktzahl
                    echo getHTMLObject("h2", array("id" => "resultString"), "Zu wenig Punkte in e.A. Fächern: " . $SUMEMarks . " von " . $MinEASum);
                }else if($AllowedUn < $CountUn){
                    echo getHTMLObject("h2", array("id" => "resultString"), "Zu viele Unterkurse: " . $CountUn);
                }else if(round(($SUMEMarks + $SUMMarks)/$MarksCount*40) < $MinMarkSum){
                    echo getHTMLObject("h2", array("id" => "resultString"), "Zu wenig Punkte in der Summe: " . round(($SUMEMarks + $SUMMarks)/$MarksCount*40) . " von " . $MinMarkSum);
                }else if(!($SUMPuberMinPNotUn < $MinPNotUn)){
                    echo getHTMLObject("h2", array("id" => "resultString"), "Zu viele Prüfungen unter 5 Punkten");
                }else if($SUMPMarks < $MinPSum){
                    echo getHTMLObject("h2", array("id" => "resultString"), "Zu wenig Punkte insgesamt in den Prüfungen: " . $SUMPMarks . " von " . $MinPSum);
                }else{
                    echo getHTMLObject("h2", array("id" => "resultString"), "Bestanden mit " . ($SUMEMarks + $SUMMarks) . " Punkten, das entspricht einer " . getMarkFromPoints(($SUMEmarks + $SUMPMarks), 0));
                    echo getHTMLObject("h3", array("id" => "resultString"), "und " . $SUMPMarks . " in den Prüfungen.");
                }
            }
            
            function getMarkFromPoints($points, $type){//Type = 0 Abi   Type = 1 FHS
                global $FHSMarkTable;
                global $AbiMarkTable;
                switch($type){
                    case 0:
                        $prevValue = 0;
                        $previousTablePoints = 0;
                        foreach($AbiMarkTable as $refPoints => $value){
                            if($points >= $previousTablePoints && $points < $refPoints){
                                return $prevValue;
                            }else{
                                $valueints = $refPoints;
                                $prevValue = $value;
                            }
                        }
                        return $AbiMarkTable[$previousTablePoints];
                        break;
                    case 1:
                        $prevValue = 0;
                        $previousTablePoints = 0;
                        foreach($FHSMarkTable as $refPoints => $value){
                            if($points >= $previousTablePoints && $points < $refPoints){
                                return $prevValue;
                            }else{
                                $previousTablePoints = $refPoints;
                                $prevValue = $value;
                            }
                        }
                        return $FHSMarkTable[$previousTablePoints];
                        break;
                    default:
                        break;
                }
                
                
            }
        ?>
	</body>
</html>