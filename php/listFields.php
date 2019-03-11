<?
	ini_set('display_errors',0);
	parse_str(http_build_query($_GET));
	include "class/utils.class.php";
	$c=new utils;
	$c->connect($server,$dbx,$user,$pswd);
	$fieldList=$c->fieldList($_GET['dbx'],$_GET['table']);
	echo $fieldList;
?>