<?php
	include "class/utils.class.php";
	$c=new utils;
	$c->connect($_COOKIE['db_server'],$_COOKIE['db_user'],$_COOKIE['db_password'],"terra");
//	$t=$c->query("select * from rx_master where active_ingredient like '%".$_GET[term]."%' OR brand_name like '%".$_GET[term]."%' OR generic_name like '%".$_GET[term]."%' OR substance_name like '%".$_GET[term]."%' LIMIT 50");
	$t=$c->query("select * from rxnorm_mappings where RXSTRING like '%".$_GET[term]."%' LIMIT 50");
	for ($i=0;$i<count($t);$i++) {
		$str[] = array("label"=>$t[$i]['RXSTRING'],"value"=>$t[$i]['RXSTRING']);
	}
	echo json_encode($str);

?>