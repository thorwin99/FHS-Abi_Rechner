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
    $RELPHI = array($_SUBJ['Re'], $_SUBJ['Phi']);

    $EAFGEDE = array($_SUBJ['Ge'], $_SUBJ['De']);//Prüfungsfächer Gesundheit Deutsch / e.A. Fächer
    $EAFGEEN = array($_SUBJ['Ge'], $_SUBJ['Eng']);//Prüfungsfächer Gesundheit Englisch / e.A. Fächer
    $EAFTE = array($_SUBJ['MT/ET'], $_SUBJ['Ma']);//Prüfungsfächer Technik / e.A. Fächer
    $EAFER = array($_SUBJ['Er'], $_SUBJ['De']);//Prüfungsfächer Ernährung / e.A. Fächer
    $EAFWLDE = array($_SUBJ['Wl'], $_SUBJ['De']);//Prüfungsfächer Wirtschaft Deutsch / e.A. Fächer
    $EAFWLEN = array($_SUBJ['Wl'], $_SUBJ['Eng']);//Prüfungsfächer Wirtschaft Englisch / e.A. Fächer

    $PFGESDE = array($_SUBJ['Ma'], $_SUBJ['Gmk'], $_SUBJ['Bio'], "Fremdsprache" => $LANGUAGES);//Pflichtfächer Gesundheit Deutsch
    $PFGESEN = array($_SUBJ['Ma'], $_SUBJ['Gmk'], $_SUBJ['De'], $_SUBJ['Bio'],);//Pflichtfächer Gesundheit Englisch
    $PFTE = array($_SUBJ['De'], $_SUBJ['Gmk'], "Fremdsprache" => $LANGUAGES, "Naturwissenschaft" => array($_SUBJ['Che'], $_SUBJ['Phy']));//Pflichtfächer Technik
    $PFER = array($_SUBJ['Ma'], $_SUBJ['Gmk'], "Fremdsprache" => $LANGUAGES, "Naturwissenschaft" => array($_SUBJ['Che'], $_SUBJ['Bio']));//Pflichtfächer Ernährung
    $PFWLDE = array($_SUBJ['Ma'], $_SUBJ['Gmk'], $_SUBJ['Phy'], "Fremdsprache" => $LANGUAGES);//Pflichtfächer Wirtschaft Deutsch
    $PFELEN = array($_SUBJ['Ma'], $_SUBJ['Gmk'], $_SUBJ['Phy'],"Fremdsprache" => $_SUBJ['De']);//Pflichtfächer Wirtschaft Englisch

    $FGESDE = array($_SUBJ['Wl'], $_SUBJ['Bin'], $_SUBJ['Spo'], $_SUBJ['Erz'], "Religion/Philosophie" => $RELPHI, "Fremdsprache" => $LANGUAGES);//Wahlfächer Gesundheit Deutsch
    $FGESEN = array($_SUBJ['Wl'], $_SUBJ['Bin'], $_SUBJ['Spo'], $_SUBJ['Erz'], "Religion/Philosophie" => $RELPHI, "Fremdsprache" => $LANGUAGES);//Wahlfächer Gesundheit Deutsch
    $FTE = array($_SUBJ['Bin'], $_SUBJ['Phy'], $_SUBJ['Che'], "Religion/Philosophie" => $RELPHI, "Fremdsprache" => $LANGUAGES);//Wahlfächer Technik
    $FER = array($_SUBJ['Wl'], $_SUBJ['Che'], $_SUBJ['Bio'], $_SUBJ['Bin'], "Religion/Philosophie" => $RELPHI, "Fremdsprache" => $LANGUAGES);//Wahlfächer Ernährung
    $FWLDE = array($_SUBJ['Bin'], $_SUBJ['Rl'], $_SUBJ['Wl'], "Religion/Philosophie" => $RELPHI, "Fremdsprache" => $LANGUAGES);//Wahlfächer Wirtschaft Deutsch
    $FWLEN = array($_SUBJ['Bin'], $_SUBJ['Rl'], $_SUBJ['Wl'], $_SUBJ['Dsp'], "Religion/Philosophie" => $RELPHI, "Fremdsprache" => $LANGUAGES);//Wahlfächer Wirtschaft Englisch
?>