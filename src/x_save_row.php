<?
	ini_set('display_errors',0);
	parse_str(http_build_query($_GET));
	parse_str(http_build_query($_GET),$arr);
	include "class/utils.class.php";
	$c=new utils;
	$c->connect($server,$user,$pswd,$dbx);
	foreach($arr as $key => $value)	{
		$fields .= "`" . $key . "`,";
		$values .= "'" . $value . "',";
	}
	$fields=substr($fields,0,strlen($fields)-1);
	$values=substr($values,0,strlen($values)-1);
	$sql="INSERT INTO `$table` ($fields) values ($values)";