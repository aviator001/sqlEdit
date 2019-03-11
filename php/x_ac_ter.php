<?php
	include "../class/utils.class.php";
	$c=new utils;
	$c->connect("199.91.65.82","rentus");
	$t=$c->query("select distinct cat2.category from cat cat1, cat cat2 where cat2.level=3 and cat2.category like '%".$_GET[term]."%' and cat2.parentID=cat1.categoryID and cat1.category='".$_COOKIE[sub]."'");
	for ($i=0;$i<count($t);$i++) {
		$str[] = array("label"=>$t[$i][category],"value"=>$t[$i][category]);
	}
	echo json_encode($str);
?>