<?
	ini_set('display_errors',0);
	parse_str(http_build_query($_GET));
	include "class/utils.class.php";
	$c=new utils;
	$arr=$c->getImage($q);
	for ($i=0;$i<count($arr);$i++) {
		$str .="<img style='height:50px;width:px;border:2px solid #f0f0f0' src='{$arr[$i]}'>";
	}
	echo $str;
?>