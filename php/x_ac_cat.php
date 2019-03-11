<?php
	include "../class/utils.class.php";
	$c=new utils;
	$c->connect("199.91.65.82","rentus");
	$t=$c->query("select main from categories where main like '%".$_GET[term]."%' group by main");
	for ($i=0;$i<count($t);$i++) {
		$str[] = array("label"=>$t[$i][main],"value"=>$t[$i][main]);
	}
	echo json_encode($str);
?>