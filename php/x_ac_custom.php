<?php
	error_reporting(0);
	include "../class/utils.class.php";
	$c=new utils;
	$c->connect($_COOKIE['db_server'],$_COOKIE['db_user'],$_COOKIE['db_password'],$_COOKIE['db_name']);
	$t=$c->query("select " . $_COOKIE['ac_custom_field'] . " as `custom` from " . $_COOKIE['ac_custom_table'] . " where " . $_COOKIE['ac_custom_field'] . " like '%".$_GET[term]."%' group by " . $_COOKIE['ac_custom_field'] . " LIMIT 20");
	for ($i=0;$i<count($t);$i++) {
		$str[] = array("label"=>$t[$i]['custom'],"value"=>$t[$i]['custom']);
	}
	echo json_encode($str);
?>