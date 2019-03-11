<?php
	include "class/utils.class.php";
	$c=new utils;
	$c->connect($_COOKIE['db_server'],$_COOKIE['db_user'],$_COOKIE['db_password'],"terra");
	$t=$c->query("select city, city_state from dt_city_state where city like '%".$_GET[term]."%' LIMIT 20");
	for ($i=0;$i<count($t);$i++) {
		$str[] = array("label"=>$t[$i]['city_state'],"value"=>$t[$i]['city']);
	}
	echo json_encode($str);
