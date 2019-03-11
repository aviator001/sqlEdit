<? 
	include "base_php.php";
	ini_set('display_errors',0);
	parse_str(http_build_query($_GET));
	parse_str(http_build_query($_GET),$arr);
	include "class/utils.class.php";
	$c=new utils;
	$c->connect(DB_SERVER,DB_USER,DB_PASS,$_COOKIE['db_name']);
	echo $c->queryEDIT($qry,$wideView);
?>