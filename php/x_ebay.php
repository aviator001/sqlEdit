<?php
	include "class/utils.class.php";
	$c=new utils;
	$vars=http_build_query(array_merge($_COOKIE,$_GET));
	parse_str($vars);	

	$keyword=$_GET[q];
	$v=file_get_contents("https://svcs.ebay.com/services/search/FindingService/v1?SECURITY-APPNAME=GautamSh-8747-4434-9413-ecec57e3bc53&OPERATION-NAME=findItemsByKeywords&SERVICE-VERSION=1.0.0&RESPONSE-DATA-FORMAT=JSON&callback=_cb_findItemsByKeywords&REST-PAYLOAD&keywords=$keyword&paginationInput.entriesPerPage=6&GLOBAL-ID=EBAY-US&siteid=0");
	$v=json_decode($v);
	$c->show($v);
?>