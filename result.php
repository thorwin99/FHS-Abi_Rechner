<html>
	<head>
		<title>
			<?php
            require_once 'includes/htmlObjectFunctions.php';
            require_once 'includes/profileData.php';
			if(!isset($_POST['absch'])){//Wenn die Seite geladen wird, ohne dass $_POST['absch'] gesetzt ist, weiterleitung auf index.php
				redirect("index.php");
			}
            //Der titel der seite wird auf Abschluss + Rechner - Seite gesetzt
			echo $_POST['absch'] . " Rechner - Ergebnis"
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
                <h1>Ergebnis</h1>
                <?php
                    //Führe die Funktion für den gewählten Abschluss aus.
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
                        $MarksCount = sizeof($_POST['marks']) + sizeof($_POST['emarks']);//Anzahl der eingebrachten Noten
                        $AllowedUn = floor(($MarksCount * 0.2));//Erlaubte unterkurse
                        $MinPNotUn = 3;//Erlaubte anzahn an Unterkursen in den Prüfungen
                        $MinPMarkSum = 20;//Mindestsumme der Prüfung
                        $MinEASum = 40;//Mindestsumme der e.A. Zusammen
                        $MinPSum = 100;//Mindestsumme der Prüfungen gesamt
                        $MinMarkSum = 200;//Mindestsumme der Punkte in den Fächern
                        $SUMEMarks = 0;//Summe der e.A. Fächer
                        $SUMMarks = 0;//Summe der anderen Fächer
                        $SUMPunterMinPNotUn = 0;//Summe der Prüfungen unter 20 Punkte
                        $SUMNull = 0;//Summe der Fächer mit 0 Punkten
                        $SUMPMarks = 0;//Summe der Prüfungen
                        $CountUn = 0;//Anzahl der Unterkurse
                        
                        //Geht die Noten der e.A. Durch
                        foreach($_POST['emarks'] as $emark){
                            $SUMEMarks += $emark;
                            if($emark < 5){//Wenn Unterkurs
                                if($emark == 0)$SUMNull++;//Wenn 0
                                $CountUn++;
                            }
                        }
                        //Summe der e.A. Noten bilden.
                        foreach($_POST['marks'] as $mark){
                            $SUMMarks += $mark;
                            if($emark < 5){//Wenn Unterkurs
                                if($emark == 0)$SUMNull++;//Wenn 0
                                $CountUn++;
                            }
                        }
                        //Summe der Prüfungsfächer bilden
                        foreach($_POST['pmarks'] as $subject => $mark){//Summe der jeweiligen Prüfung bilden.
                            if(isset($_POST['mpmarks'][$subject])){//Wenn eine Mündliche geschrieben wurde wird anders gerechnet
                                $MpMark = $_POST['mpmarks'][$subject];//Bekomme die Mündliche Prüfungsnote des Faches
                                $thisSum = ceil((4*($mark*2+$MpMark)/3));
                                $SUMPMarks += $thisSum;
                                if($thisSum < $MinPMarkSum){//Wenn ein Unterkurs drin
                                    $SUMPunterMinPNotUn++;
                                }
                            }else{
                                $thisSum = ceil((4*$mark));
                                $PMarksSum[$subject] = $thisSum;
                                if($thisSum < $MinPMarkSum){//Wenn ein Unterkurs drin
                                    $SUMPunterMinPNotUn++;
                                }
                                $SUMPMarks += $thisSum;
                            }
                        }
                        //Summe der mündlichen Prüfungen
                        foreach($_POST['mpmarks'] as $subject => $mark){
                            if(!isset($_POST['pmarks'][$subject])){//Wenn noch nicht in der vorherigen Rechnung mit drin
                                $thisSum = ceil((4*$mark));
                                if($thisSum < $MinPMarkSum){//Wenn ein Unterkurs
                                    $SUMPunterMinPNotUn++;
                                }
                                $SUMPMarks += $thisSum;
                            }
                        }

                        $gesPoints = round(($SUMEMarks + $SUMMarks)/$MarksCount*40);//Berechne gesamtpunktzahl

                        if($SUMNull > 0){//Wenn zuviele Nullkurse
                            echo getHTMLObject("h2", array("id" => "resultString"), "Du hast " . $SUMNull . " mal 0 Punkte. Erlaubt sind 0 mal 0 Punkte.");
                        }else if($SUMEMarks < $MinEASum){//Prüfe ob genug e.A. Punktzahl
                            echo getHTMLObject("h2", array("id" => "resultString"), "Zu wenig Punkte in e.A. Fächern: " . $SUMEMarks . " von " . $MinEASum);
                        }else if($AllowedUn < $CountUn){//Wenn zuviele Unterkurse
                            echo getHTMLObject("h2", array("id" => "resultString"), "Zu viele Unterkurse: " . $CountUn);
                        }else if($gesPoints < $MinMarkSum){//Wenn zuwenig Punkte
                            echo getHTMLObject("h2", array("id" => "resultString"), "Zu wenig Punkte in der Summe: " . $gesPoints . " von " . $MinMarkSum);
                        }else if(!($SUMPunterMinPNotUn < $MinPNotUn)){//Zuviele Prüfungen unter 5 Punkten
                            echo getHTMLObject("h2", array("id" => "resultString"), "Zu viele Prüfungen unter 5 Punkten");
                        }else if($SUMPMarks < $MinPSum){//Zuwenig Punkte in den Prüfungen gesamt
                            echo getHTMLObject("h2", array("id" => "resultString"), "Zu wenig Punkte insgesamt in den Prüfungen: " . $SUMPMarks . " von " . $MinPSum);
                        }else{//Bestanden
                            echo getHTMLObject("h2", array("id" => "resultString"), "Bestanden mit insgesamt " . ($gesPoints + $SUMPMarks) . " Punkten, das entspricht einer " . getMarkFromPoints($gesPoints + $SUMPMarks, 0));
                            echo getHTMLObject("h3", array("id" => "resultString"), "und " . $SUMPMarks . " in den Prüfungen.");
                        }
                    }

                    function getMarkFromPoints($points, $type){//Type = 0 Abi   Type = 1 FHS
                        //Gobale Werte (siehe profileData.php)
                        global $FHSMarkTable;
                        global $AbiMarkTable;
                        
                        //Switch auf typ. Wenn 0 dann Abi, wenn 1 dann FHS
                        switch($type){
                            case 0:
                                $prevValue = 0;//Der Wert der zuvor aus der Tabelle gelesen wurde
                                $previousTablePoints = 0;//Die Punktzahl, die vorher aus der Tabelle gelesen wurde
                                foreach($AbiMarkTable as $refPoints => $value){
                                    if($points >= $previousTablePoints && $points < $refPoints){//Wenn deine Punktzahl zwischen der Vorherigen und jetzigen Punktzahl liegt, wird die prevValue zurückgegeben 
                                        return $prevValue;
                                    }else{
                                        $previousTablePoints = $refPoints;
                                        $prevValue = $value;
                                    }
                                }
                                return $AbiMarkTable[$previousTablePoints];
                                break;
                            case 1:
                                $prevValue = 0;//Der Wert der zuvor aus der Tabelle gelesen wurde
                                $previousTablePoints = 0;//Die Punktzahl, die vorher aus der Tabelle gelesen wurde
                                foreach($FHSMarkTable as $refPoints => $value){
                                    if($points >= $previousTablePoints && $points < $refPoints){//Wenn deine Punktzahl zwischen der Vorherigen und jetzigen Punktzahl liegt, wird die prevValue zurückgegeben 
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
            </div>
        </div>
	</body>
</html>