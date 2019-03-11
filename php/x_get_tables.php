<?
	ini_set('display_errors',0);
	parse_str(http_build_query($_GET));
	include "class/utils.class.php";
	$c=new utils;
	$c->connect($_COOKIE['db_server'],$_COOKIE['db_user'],$_COOKIE['db_password'],$_COOKIE['db_name']);
	$tableList=$c->tableList($_COOKIE['db_name']);
	echo $tableList;
?>