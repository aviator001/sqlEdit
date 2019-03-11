<?
	ini_set('display_errors',0);
	parse_str(http_build_query($_GET));
	include "class/utils.class.php";
	$c=new utils;
	$c->connect(DB_SERVER,DB_USER,DB_PASS,$db_name);
	$data=$c->insert("DELETE FROM `$table` WHERE $index=$id LIMIT 1");
?>