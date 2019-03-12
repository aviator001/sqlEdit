<?
	ini_set('display_errors',0);
	parse_str(http_build_query($_GET));
	include "class/utils.class.php";
	$c=new utils;
	$c->connect($server,$user,$pswd,$dbx);
	//echo "select * from $table where ($d='$i') and $d<>(select $d from $table  order by id DESC limit 1)";
	$q=$c->query("select * from $table where ($d='$i')");
	echo (count($q));
?> 
