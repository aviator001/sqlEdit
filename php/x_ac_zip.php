<?php
	include "class/utils.class.php";
	$c=new utils;
	$c->connect($_COOKIE['db_server'],$_COOKIE['db_user'],$_COOKIE['db_password'],"terra");
	$t=$c->query("select zipcode from dt_zips where zipcode like '%".$_GET[term]."%' LIMIT 20");
	for ($i=0;$i<count($t);$i++) {
		$str[] = array("label"=>$t[$i]['zipcode'],"value"=>$t[$i]['zipcode']);
	}
	echo json_encode($str);
