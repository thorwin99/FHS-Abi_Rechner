<?php
    //Alle Fächer
	$_SUBJ = array(	"Ma" => "Mathe", 
                    "MT/ET" => "MT/ET", 
                    "De" => "Deutsch", 
                    "Eng" => "Englisch", 
                    "Ge" => "Gesundheit", 
                    "Wl" => "Wirtschaftslehre",
                    "Vwl" => "Volkswirtschaftslehre",
                    "Bwl" => "Betriebswirtschaftslehre",
                    "Wge" => "Wirtschaftsgeographie",
                    "Rl" => "Rechtslehre",
                    "Er" => "Ernährung",
                    "Phy" => "Physik",
                    "Bio" => "Biologie",
                    "Che" => "Chemie",
                    "Spa" => "Spanisch",
                    "Fr" => "Französisch",
                    "Re" => "Religion",
                    "Phi" => "Philosophie",
                    "Spo" => "Sport",
                    "Bin" => "Informatik",
                    "Gmk" => "Gemeinschaftskunde",
                    "Erz" => "Erziehung",
                    "Dsp" => "Darstellendes Spiel",
                    "Ku" => "Kunst",
                    "Li" => "Literatur",
                    "Mu" => "Musik");

    $AbiMarkTable = array();//Array mit den Noten punkte referencen für Abi
    $FHSMarkTable = array();//Array mit den Noten punkte referencen für FHS

    loadCSVToArray("./csv/FHSMarkTable.CSV", $FHSMarkTable);//Lädt die Tabelle aus der csv datei
    loadCSVToArray("./csv/ABIMarkTable.CSV", $AbiMarkTable);//Lädt die Tabelle aus der csv datei

    //FHS Fächer organisation.
    $LANGUAGES = array( $_SUBJ['Eng']/*, $_SUBJ['Fr'], $_SUBJ['Spa']*/);
    $RELPHI = array($_SUBJ['Re'], $_SUBJ['Phi']);
    $KULIMU = array($_SUBJ['Dsp'], $_SUBJ['Ku'], $_SUBJ['Li'], $_SUBJ['Mu']);

    $EAFGEDE = array($_SUBJ['Erz'], $_SUBJ['De']);  //Prüfungsfächer Gesundheit Deutsch / e.A. Fächer
    $EAFGEEN = array($_SUBJ['Ge'], $_SUBJ['Eng']);  //Prüfungsfächer Gesundheit Englisch / e.A. Fächer
    $EAFTE = array($_SUBJ['MT/ET'], $_SUBJ['Ma']);  //Prüfungsfächer Technik / e.A. Fächer
    $EAFER = array($_SUBJ['Er'], $_SUBJ['De']);     //Prüfungsfächer Ernährung / e.A. Fächer
    $EAFWLDE = array($_SUBJ['Bwl'], $_SUBJ['De']);  //Prüfungsfächer Wirtschaft Deutsch / e.A. Fächer
    $EAFWLEN = array($_SUBJ['Vwl'], $_SUBJ['Eng']); //Prüfungsfächer Wirtschaft Englisch / e.A. Fächer

    $PFGESDE = array($_SUBJ['Ma'], $_SUBJ['Gmk'], $_SUBJ['Bio'], "Fremdsprache" => &$LANGUAGES);                                            //Pflichtfächer Gesundheit Deutsch
    $PFGESEN = array($_SUBJ['Ma'], $_SUBJ['Gmk'], $_SUBJ['De'], $_SUBJ['Bio']);                                                            //Pflichtfächer Gesundheit Englisch
    $PFTE = array($_SUBJ['De'], $_SUBJ['Gmk'], "Fremdsprache" => &$LANGUAGES, "Naturwissenschaft" => array($_SUBJ['Che'], $_SUBJ['Phy']));  //Pflichtfächer Technik
    $PFER = array($_SUBJ['Ma'], $_SUBJ['Gmk'], "Fremdsprache" => &$LANGUAGES, "Naturwissenschaft" => array($_SUBJ['Che'], $_SUBJ['Bio']));  //Pflichtfächer Ernährung
    $PFWLDE = array($_SUBJ['Ma'], $_SUBJ['Gmk'], $_SUBJ['Phy'], "Fremdsprache" => &$LANGUAGES);                                             //Pflichtfächer Wirtschaft Deutsch
    $PFWLEN = array($_SUBJ['Ma'], $_SUBJ['Gmk'], $_SUBJ['Phy'], $_SUBJ['De']);                                                              //Pflichtfächer Wirtschaft Englisch

    $FGESDE = array($_SUBJ['Wl'], $_SUBJ['Bin'], $_SUBJ['Spo'], $_SUBJ['Ge'], "Religion/Philosophie" => $RELPHI, "Fremdsprache" => &$LANGUAGES);                             //Wahlfächer Gesundheit Deutsch
    $FGESEN = array($_SUBJ['Wl'], $_SUBJ['Bin'], $_SUBJ['Spo'], $_SUBJ['Erz'], "Religion/Philosophie" => $RELPHI, "Fremdsprache" => &$LANGUAGES);                            //Wahlfächer Gesundheit Deutsch
    $FTE = array($_SUBJ['Bin'], "Religion/Philosophie" => $RELPHI, "Fremdsprache" => &$LANGUAGES, "Naturwissenschaft" => array($_SUBJ['Che'], $_SUBJ['Phy']));               //Wahlfächer Technik
    $FER = array($_SUBJ['Wl'], $_SUBJ['Bin'], "Religion/Philosophie" => $RELPHI, "Fremdsprache" => &$LANGUAGES, "Naturwissenschaft" => array($_SUBJ['Che'], $_SUBJ['Bio'])); //Wahlfächer Ernährung
    $FWLDE = array($_SUBJ['Bin'], $_SUBJ['Rl'], $_SUBJ['Wl'], "Religion/Philosophie" => $RELPHI, "Fremdsprache" => &$LANGUAGES);                                             //Wahlfächer Wirtschaft Deutsch
    $FWLEN = array($_SUBJ['Bin'], $_SUBJ['Rl'], $_SUBJ['Wl'], $_SUBJ['Dsp'], "Religion/Philosophie" => $RELPHI, "Fremdsprache" => &$LANGUAGES);                              //Wahlfächer Wirtschaft Englisch


    //AbiFächer
    $APFGEDE = array("Naturwissenschaft" => array($_SUBJ['Ma'], $_SUBJ['Bio']), $_SUBJ['Ge'], $_SUBJ['De'], "Fremdsprache" => &$LANGUAGES);//Prüfungsfächer Gesundheit Deutsch
    $APFGEEN = array("Naturwissenschaft" => array($_SUBJ['Ma'], $_SUBJ['Bio']), $_SUBJ['De'], $_SUBJ['Ge'], $_SUBJ['Eng']);//Prüfungsfächer Gesundheit Englisch
    $APFTE = array($_SUBJ['De'], $_SUBJ['MT/ET'], $_SUBJ['Ma'], "Fremdsprache" => &$LANGUAGES);//Prüfungsfächer Technik
    $APFER = array("Naturwissenschaft" => array($_SUBJ['Che'], $_SUBJ['Bio'], $_SUBJ['Ma']), $_SUBJ['Er'], $_SUBJ['De'], "Fremdsprache" => &$LANGUAGES);//Prüfungsfächer Ernährung
    $APFWLDE = array("Naturwissenschaft" => array($_SUBJ['Phy'], $_SUBJ['Ma']), $_SUBJ['Bwl'], $_SUBJ['De'], "Fremdsprache" => &$LANGUAGES);//Prüfungsfächer Wirtschaft Deutsch
    $APFWLEN = array("Naturwissenschaft" => array($_SUBJ['Phy'], $_SUBJ['Ma']), $_SUBJ['De'], $_SUBJ['Vwl'], $_SUBJ['Eng']);//Prüfungsfächer Wirtschaft Englisch
    
    $P5GEDE = array($_SUBJ['Gmk'], $_SUBJ['Wl']);//Wahl für mdl. Gesundheit Deutsch
    $P5GEEN = array($_SUBJ['Gmk'], $_SUBJ['Wl']);//Wahl für mdl. Gesundheit Englisch
    $P5TE = array($_SUBJ['Gmk'], $_SUBJ['Wl']);//Wahl für mdl. Technik
    $P5ER = array($_SUBJ['Gmk'], $_SUBJ['Wl']);//Wahl für mdl. Ernährung
    $P5WLDE = array($_SUBJ['Gmk'], $_SUBJ['Wl']);//Wahl für mdl. Wirtschaft Deutsch
    $P5WLEN = array($_SUBJ['Gmk'], $_SUBJ['Wl']);//Wahl für mdl. Wirtschaft Englisch

    $IVFGEDE = array($_SUBJ['Gmk'], $_SUBJ['Wl'], $_SUBJ['Ge'], $_SUBJ['Ma']);//Pflichtfächer, die 4 mal eingebracht werden müssen bei Gesundheit Deutsch
    $IVFGEEN = array($_SUBJ['Gmk'], $_SUBJ['Wl'], $_SUBJ['Erz'], $_SUBJ['Ma'], $_SUBJ['De']);//Pflichtfächer, die 4 mal eingebracht werden müssen bei Gesundheit Englisch
    $IVFTE = array($_SUBJ['Gmk'], $_SUBJ['De']);//Pflichtfächer, die 4 mal eingebracht werden müssen bei Technik
    $IVFER = array($_SUBJ['Gmk'], $_SUBJ['Wl'], $_SUBJ['Ma']);//Pflichtfächer, die 4 mal eingebracht werden müssen bei Ernährung
    $IVFWLDE = array($_SUBJ['Vwl'], $_SUBJ['Rl'], $_SUBJ['Ma']);//Pflichtfächer, die 4 mal eingebracht werden müssen bei Wirtschaft Deutsch
    $IVFWLEN = array($_SUBJ['Bwl'], $_SUBJ['Rl'], $_SUBJ['Ma'], $_SUBJ['De']);//Pflichtfächer, die 4 mal eingebracht werden müssen bei Wirtschaft Englisch

    $IIFGE = array("Kulturfach" => $KULIMU);//Pflichtfächer, die 2 mal eingebracht werden müssen bei Gesundheit
    $IIFTE = array("Kulturfach" => $KULIMU, $_SUBJ['Wl']);//Pflichtfächer, die 2 mal eingebracht werden müssen bei Technik
    $IIFER = array("Kulturfach" => $KULIMU);//Pflichtfächer, die 2 mal eingebracht werden müssen bei Ernährung
    $IIFWL = array("Kulturfach" => $KULIMU, $_SUBJ['Gmk']);//Pflichtfächer, die 2 mal eingebracht werden müssen bei Wirtschaft

    $NAFGEDE = array();//1. Nawi Gesundheit Deutsch
    $NAFGEEN = array();//1. Nawi Gesundheit Englisch
    $NAFTE = array("Naturwissenschaft" => array($_SUBJ['Che'], $_SUBJ['Phy']));//1. Nawi Technik
    $NAFER = array("Naturwissenschaft" => array($_SUBJ['Che'], $_SUBJ['Bio']));//1. Nawi Ernährung
    $NAFWLDE = array($_SUBJ['Phy']);//1. Nawi Wirtschaft Deutsch
    $NAFWLEN = array($_SUBJ['Phy']);//1. Nawi Wirtschaft Englisch

    $NAGEDE = array("Naturwissenschaft" => array($_SUBJ['Bio'], $_SUBJ['Bin']));//2. Nawi Gesundheit Deutsch
    $NAGEEN = array("Naturwissenschaft" => array($_SUBJ['Bio'], $_SUBJ['Bin']));//2. Nawi Gesundheit Englisch
    $NATE = array("Naturwissenschaft" => array($_SUBJ['Che'], $_SUBJ['Phy']), $_SUBJ['Bin']);//2. Nawi Technik
    $NAER = array("Naturwissenschaft" => array($_SUBJ['Che'], $_SUBJ['Bio'], $_SUBJ['Bin']));//2. Nawi Ernährung
    $NAWLDE = array();//2. Nawi Wirtschaft Deutsch
    $NAWLEN = array();//2. Nawi Wirtschaft Englisch

    $WFGEDE = array($_SUBJ['Spo'], "Religion/Philosophie" => $RELPHI, $_SUBJ['Bin']);//Wahlfächer Gesundheit Deutsch
    $WFGEEN = array($_SUBJ['Spo'], "Religion/Philosophie" => $RELPHI, $_SUBJ['Bin']);//Wahlfächer Gesundheit Englisch
    $WFTE = array($_SUBJ['Spo'], "Religion/Philosophie" => $RELPHI, $_SUBJ['Bin']);//Wahlfächer Technik
    $WFER = array($_SUBJ['Spo'], "Religion/Philosophie" => $RELPHI, $_SUBJ['Bin']);//Wahlfächer Ernährung
    $WFWLDE = array($_SUBJ['Spo'], "Religion/Philosophie" => $RELPHI, $_SUBJ['Bin']);//Wahlfächer Wirtschaft Deutsch
    $WFWLEN = array($_SUBJ['Spo'], "Religion/Philosophie" => $RELPHI, $_SUBJ['Bin']);//Wahlfächer Wirtschaft Englisch

    function loadCSVToArray($FileName, &$array){
        $fileHandler = fopen($FileName, "r");//Öffnet die datei $fileName als readonly.
        while(!feof($fileHandler)){//Geht jede zeile der datei durch bis zum endoffile
            $line = fgetcsv($fileHandler, 1024);//Lädt die zeile in das $line array. Die elemente sind in der datei getrennt mits kommata
            $array[$line[0]] = strval($line[1]);
        }
        fclose($fileHandler);//Schließt den FileStream
    }
?>