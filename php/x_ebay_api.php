<?php
include "class/utils.class.php";
$c=new utils;
	$vars=http_build_query(array_merge($_COOKIE,$_GET));
	parse_str($vars);	
	$q=urlencode($_COOKIE[sub] . " " . $term);
	$url="http://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsByKeywords&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=GautamSh-8747-4434-9413-ecec57e3bc53&GLOBAL-ID=EBAY-US&keywords=$q&paginationInput.entriesPerPage=20";
	$resp = simplexml_load_file($url);
	foreach($resp->searchResult->item as $item) {
		$pic   = $item->galleryURL;
		$link  = $item->viewItemURL;
		$title = $item->title[0];
		$t=$title."";
		$id	   = $item->itemId;
			$id=$id*1;
			$r[]=array("label"=>"$t", "image"=>"$pic", "id" => $id);			
	}
		echo $r=json_encode(($r));
?>