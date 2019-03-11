<?
	ini_set('display_errors',0);
	parse_str(http_build_query($_GET));
	include "class/utils.class.php";
	$c=new utils;
	$c->connect($server,$user,$pswd,$dbx);
	echo $c->insert("UPDATE $table set `$field`='$value' WHERE $id=$index");
?> 