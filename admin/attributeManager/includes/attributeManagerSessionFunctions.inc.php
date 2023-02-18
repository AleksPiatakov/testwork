<?php
/*
  $Id: attributeManagerSessionFunctions.inc.php,v 1.0 21/02/06 Sam West$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
  
  Copyright © 2006 Kangaroo Partners
  http://kangaroopartners.com
  osc@kangaroopartners.com
*/

function amSessionUnregister($strSessionVar) {
	if(amSessionIsRegistered($strSessionVar)){
		tep_session_unregister($strSessionVar);
	}
	unset($_SESSION[$strSessionVar]);
}

function amSessionRegister($strSessionVar,$value = '') {
	if(!amSessionIsRegistered($strSessionVar)) {
		tep_session_register($strSessionVar);
		$_SESSION[$strSessionVar] = $value;
	}
}

function amSessionIsRegistered($strSessionVar) {
	return tep_session_is_registered($strSessionVar);
}

function &amGetSesssionVariable($strSessionVar) {
	if(isset($_SESSION[$strSessionVar]))
		return $_SESSION[$strSessionVar];
	return false;
}

function amSetSessionVariable($key, $value) {
	$_SESSION[$key] = $value;
}
?>