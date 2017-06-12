<?php
	$_SUBJ = array(	"Ma" => "Mathe", 
                    "MT/ET" => "MT/ET", 
                    "De" => "Deutsch", 
                    "Eng" => "Englisch", 
                    "Ge" => "Gesundheit", 
                    "Wl" => "Wirtschaftslehre",
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
                    "Dsp" => "Darstellendes Spiel");

    $LANGUAGES = array($_SUBJ['Fr'], $_SUBJ['Eng'], $_SUBJ['Spa']);

    $EAFGEDE = array($_SUBJ['Ge'], $_SUBJ['De']);//Prüfungsfächer Gesundheit Deutsch / e.A. Fächer
    $EAFGEEN = array($_SUBJ['Ge'], $_SUBJ['Eng']);//Prüfungsfächer Gesundheit Englisch / e.A. Fächer
    $EAFTE = array($_SUBJ['MT/ET'], $_SUBJ['Ma']);//Prüfungsfächer Technik / e.A. Fächer
    $EAFER = array($_SUBJ['Er'], $_SUBJ['De']);//Prüfungsfächer Ernährung / e.A. Fächer
    $EAFWLDE = array($_SUBJ['Wl'], $_SUBJ['De']);//Prüfungsfächer Wirtschaft Deutsch / e.A. Fächer
    $EAFWLEN = array($_SUBJ['Wl'], $_SUBJ['Eng']);//Prüfungsfächer Wirtschaft Englisch / e.A. Fächer

    $PFGESDE = array($_SUBJ['Ma'], $_SUBJ['Gmk'], "Fremdsprache" => $LANGUAGES);//Pflichtfächer Gesundheit Deutsch
    $PFGESEN = array($_SUBJ['Ma'], $_SUBJ['Gmk'], $_SUBJ['De']);//Pflichtfächer Gesundheit Englisch
    $PFTE = array($_SUBJ['De'], $_SUBJ['Gmk'], "Fremdsprache" => $LANGUAGES);//Pflichtfächer Technik
    $PFER = array($_SUBJ['Ma'], $_SUBJ['Gmk'], "Fremdsprache" => $LANGUAGES);//Pflichtfächer Ernährung
    $PFWLDE = array($_SUBJ['Ma'], $_SUBJ['Gmk'], "Fremdsprache" => $LANGUAGES);//Pflichtfächer Wirtschaft Deutsch
    $PFELEN = array($_SUBJ['Ma'], $_SUBJ['Gmk'], "Fremdsprache" => $_SUBJ['De']);//Pflichtfächer Wirtschaft Englisch

    $NAGES = array($_SUBJ['Bio']);//Naturwissenschaften Gesundheit
    $NATE = array($_SUBJ['Che'], $_SUBJ['Phy']);//Naturwissenschaften Technik
    $NAER = array($_SUBJ['Che'], $_SUBJ['Bio']);//Naturwissenschaften Ernährung
    $NAWL = array($_SUBJ['Phy']);//Naturwissenschaften Wirtschaft

    $FGES = array();//Wahlfächer Gesundheit
    $FTE = array();//Wahlfächer Technik
    $FER = array();//Wahlfächer Ernährung
    $FWLDE = array();//Wahlfächer Wirtschaft Deutsch
    $FWLEN = array();//Wahlfächer Wirtschaft Englisch
?>