<?php
	$conn = oci_connect("inv", "inv", "192.168.100.157:1522/erp");
	if(!$conn){
	    $e = oci_error();
	    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>





