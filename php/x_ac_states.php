<?php
	include "class/utils.class.php";
	$c=new utils;
	$c->connect($_COOKIE['db_server'],$_COOKIE['db_user'],$_COOKIE['db_password'],"terra");
	$t=$c->query("select name, state from dt_states where name like '%".$_GET[term]."%'");
	for ($i=0;$i<count($t);$i++) {
		$str[] = array("label"=>$t[$i]['name'],"value"=>$t[$i]['state']);
	}
	echo json_encode($str);
?>