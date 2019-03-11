<?
	ini_set('display_errors',0);
	parse_str(http_build_query($_GET));
	include "class/utils.class.php";
	$c=new utils;
	$c->connect($db_server,$db_user,$db_password,$db_name);
	echo $c->insert($sql);
?>