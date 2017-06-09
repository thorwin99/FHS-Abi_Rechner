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

    $_LANGUAGES = array($_SUBJ['Fr'], $_SUBJ['Eng'], $_SUBJ['Spa'])

    $_EAFGEDE = array($_SUBJ['Ge'], $_SUBJ['De']);//Prüfungsfächer Gesundheit Deutsch / e.A. Fächer
    $_EAFGEEN = array($_SUBJ['Ge'], $_SUBJ['En']);//Prüfungsfächer Gesundheit Englisch / e.A. Fächer
    $_EAFTE = array($_SUBJ['MT/ET'], $_SUBJ['Ma']);//Prüfungsfächer Technik / e.A. Fächer
    $_EAFER = array($_SUBJ['Er'], $_SUBJ['De']);//Prüfungsfächer Ernährung / e.A. Fächer
    $_EAFWLDE = array($_SUBJ['Wl'], $_SUBJ['De']);//Prüfungsfächer Wirtschaft Deutsch / e.A. Fächer
    $_EAFWLEN = array($_SUBJ['Wl'], $_SUBJ['En']);//Prüfungsfächer Wirtschaft Englisch / e.A. Fächer

    $_PFGESDE = array($_SUBJ['Ma'], "Lang" => $_LANGUAGES);//Pflichtfächer Gesundheit Deutsch
    $_PFGESEN = array($_SUBJ['Ma'], $_SUBJ['De']);//Pflichtfächer Gesundheit Englisch
    $_PFTE = array($_SUBJ['De'], "Lang" => $_LANGUAGES);//Pflichtfächer Technik
    $_PFER = array($_SUBJ['Ma'], "Lang" => $_LANGUAGES);//Pflichtfächer Ernährung
    $_PFWLDE = array($_SUBJ['Ma'], "Lang" => $_LANGUAGES);//Pflichtfächer Wirtschaft Deutsch
    $_PFELEN = array($_SUBJ['Ma'], "Lang" => $_SUBJ['De']);//Pflichtfächer Wirtschaft Englisch

    $_NAGES = array($_SUBJ['Bio']);//Naturwissenschaften Gesundheit
    $_NATE = array($_SUBJ['Che'], $_SUBJ['Phy']);//Naturwissenschaften Technik
    $_NAER = array($_SUBJ['CHe'], $_SUBJ['Bio']);//Naturwissenschaften Ernährung
    $_NAWL = array($_SUBJ['Phy']);//Naturwissenschaften Wirtschaft
?>