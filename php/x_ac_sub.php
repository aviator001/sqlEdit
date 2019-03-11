<?php
	include "../class/utils.class.php";
	$c=new utils;
	$c->connect("199.91.65.82","rentus");
	$t=$c->query("select sub from categories where sub like '%".$_GET[term]."%' and main like '".$_COOKIE[cat]."'");
	for ($i=0;$i<count($t);$i++) {
		$str[] = array("label"=>$t[$i][sub],"value"=>$t[$i][sub]);
	}
	echo json_encode($str);
?>