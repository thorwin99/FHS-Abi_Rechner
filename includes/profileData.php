<?php
	static $_SUBJ = array(	"Ma" => "Mathe", 
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

    static $LANGUAGES = array($_SUBJ['Fr'], $_SUBJ['Eng'], $_SUBJ['Spa']);

    static $EAFGEDE = array($_SUBJ['Ge'], $_SUBJ['De']);//Prüfungsfächer Gesundheit Deutsch / e.A. Fächer
    static $EAFGEEN = array($_SUBJ['Ge'], $_SUBJ['Eng']);//Prüfungsfächer Gesundheit Englisch / e.A. Fächer
    static $EAFTE = array($_SUBJ['MT/ET'], $_SUBJ['Ma']);//Prüfungsfächer Technik / e.A. Fächer
    static $EAFER = array($_SUBJ['Er'], $_SUBJ['De']);//Prüfungsfächer Ernährung / e.A. Fächer
    static $EAFWLDE = array($_SUBJ['Wl'], $_SUBJ['De']);//Prüfungsfächer Wirtschaft Deutsch / e.A. Fächer
    static $EAFWLEN = array($_SUBJ['Wl'], $_SUBJ['Eng']);//Prüfungsfächer Wirtschaft Englisch / e.A. Fächer

    static $PFGESDE = array($_SUBJ['Ma'], "Lang" => $LANGUAGES);//Pflichtfächer Gesundheit Deutsch
    static $PFGESEN = array($_SUBJ['Ma'], $_SUBJ['De']);//Pflichtfächer Gesundheit Englisch
    static $PFTE = array($_SUBJ['De'], "Lang" => $LANGUAGES);//Pflichtfächer Technik
    static $PFER = array($_SUBJ['Ma'], "Lang" => $LANGUAGES);//Pflichtfächer Ernährung
    static $PFWLDE = array($_SUBJ['Ma'], "Lang" => $LANGUAGES);//Pflichtfächer Wirtschaft Deutsch
    static $PFELEN = array($_SUBJ['Ma'], "Lang" => $_SUBJ['De']);//Pflichtfächer Wirtschaft Englisch

    static $NAGES = array($_SUBJ['Bio']);//Naturwissenschaften Gesundheit
    static $NATE = array($_SUBJ['Che'], $_SUBJ['Phy']);//Naturwissenschaften Technik
    static $NAER = array($_SUBJ['Che'], $_SUBJ['Bio']);//Naturwissenschaften Ernährung
    static $NAWL = array($_SUBJ['Phy']);//Naturwissenschaften Wirtschaft
?>