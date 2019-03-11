<?
	ini_set('display_errors',0);
	parse_str(http_build_query($_GET));
	include "class/u2.php";
	$c=new utils;
	$c->connect();
	echo $c->insert("INSERT INTO `CATEGORIES` (`companyId`,`categoryName`,`displayOrder`,`enabled`) VALUES (1,'$catName',$order,1)");
?>