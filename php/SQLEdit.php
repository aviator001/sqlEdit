<?
	include "class/utils.class.php";
	parse_str(http_build_query($_GET));
	parse_str(http_build_query($_GET),$arr);
	$c=new utils;
	$c->connect(DB_SERVER,DB_USER,DB_PASS,$_COOKIE['db_name']);
	if (!$table) echo "Error: SQL Query or Table Name required";
		else echo $c->SQLEdit($table);
	include "paginate.php";