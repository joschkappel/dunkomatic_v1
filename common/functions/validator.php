<?php

// JK  contains form field validation functions

define ("reURL","/^\w[\w\-]+(\.\w[\w\-]+)+([\/\%\?\&\+\#\.\w\-]+)*$/" );
define ("reEMail", "/^\w[\w\-\.]+\@\w[\w\-]+(\.\w[\w\-]+)+$/");

/*
 * isGoodClubShort test for exactly 4 characters, all uppercase
 */

function isGoodClubShort ($fToTest, &$valMsg) {

	// test length for min=max=4

	if ( strlen($fToTest) != 4 ) {
		$valMsg ='Bitte 4 Stellen eingeben';

		return false;
	}
	else {return true;};
}

function isGoodLeagueShort ($fToTest, &$valMsg) {

	// test length for max=10

	if ( strlen($fToTest) > 10 ) {
		$valMsg ='Bitte 10 Stellen eingeben';

		return false;
	}
	else {return true;};
}

function isGoodURL ($fToTest, &$valMsg) {

	// test length for url

	if ( ! preg_match( reURL ,$fToTest) ) {
		$valMsg ='Bitte korrekte URL eingeben';
		return false;
	}
	else {return true;};
}

function isGoodEmail ($fToTest, &$valMsg) {

	// test length for email address

	if (! preg_match( reEMail ,$fToTest) ) {
		$valMsg ='Bitte korrekte eMail Adresse eingeben';
		return false;
	}
	else {return true;};
}

function isGoodGameTime ($fToTest, &$valMsg) {

	// test if minutes are in 00, 15, 30, 45
	// test if hours are in 09...22

	$colon = substr($fToTest,2,1);
	if ($colon != ":") {
		$valMsg = 'Zeit im Format hh:mm eingeben';
		return false;
	}

	$hrs='';
	$mins='';

	$hrs = substr($fToTest,0,2);
	$mins = substr($fToTest,3,2);


	if (( $hrs < 9 ) OR ( $hrs > 22 )) {
		$valMsg = 'Bitte nur Spiele von 9 bis 22 Uhr ansetzen';
		return false;
	}

	if ( !(($mins == '00') OR ($mins == '15') OR ($mins == '30') OR ($mins == '45')  ) ){
		$valMsg = 'Spiele nur um  :00,  :15, :30 oder :45 ansetzen ';
		return false;
	}

	return true;
}


function isGoodRePassword ($fToTest, &$valMsg) {

	// test if password == repassword

	return true;
}
