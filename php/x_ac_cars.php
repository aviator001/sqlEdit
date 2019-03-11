<?php
	include "class/utils.class.php";
	$c=new utils;
	$c->connect($_COOKIE['db_server'],$_COOKIE['db_user'],$_COOKIE['db_password'],"terra");
	$term=$_GET['term'];
	$terms=explode(" ",$term);
	if (!is_array($terms)) {
		if (!is_numeric($terms)) {
			$t=$c->query("select * from vehicles where make like '%".$_GET[term]."%' or model like '%".$_GET[term]."%' LIMIT 20");
		} else {
			$t=$c->query("select * from vehicles where year like '%".$_GET[term]."%' LIMIT 20");
		}
	} else {
		if (count($terms)==2) {
			if (is_numeric($term[0])) {
				$t=$c->query("select * from vehicles where (year like '%" . $terms[0] . "%') AND (make like '%" . $terms[1] . "%' OR model like '%" . $terms[1] . "%') LIMIT 20");	
			} else if (is_numeric($term[1])) {
				$t=$c->query("select * from vehicles where (year like '%" . $terms[1] . "%') AND (make like '%" . $terms[0] . "%' OR model like '%" . $terms[0] . "%') LIMIT 20");	
			} else {
				$t=$c->query("select * from vehicles where (make like '%" . $terms[0] . "%' or model like '%" . $terms[0] . "%') AND (make like '%" . $terms[1] . "%' or model like '%" . $terms[1] . "%') LIMIT 20");	
			}
		} else if (count($terms)==3) {
			if (is_numeric($term[0])) {
				$t=$c->query("select * from vehicles where (year like '%" . $terms[0] . "%') AND ((make like '%" . $terms[1] . "%' or model like '%" . $terms[1] . "%') AND (make like '%" . $terms[2] . "%' or model like '%" . $terms[2] . "%')) LIMIT 20");	
			} else if (is_numeric($term[1])) {
				$t=$c->query("select * from vehicles where (year like '%" . $terms[1] . "%') AND ((make like '%" . $terms[0] . "%' or model like '%" . $terms[0] . "%') AND (make like '%" . $terms[2] . "%' or model like '%" . $terms[2] . "%')) LIMIT 20");	
			} else if (is_numeric($term[2])) {
				$t=$c->query("select * from vehicles where (year like '%" . $terms[2] . "%') AND ((make like '%" . $terms[0] . "%' or model like '%" . $terms[0] . "%') AND (make like '%" . $terms[1] . "%' or model like '%" . $terms[1] . "%')) LIMIT 20");	
			} else {
				//Drop 3rd term, since all 3 are not numeric, and searchable non numeric fields are just 2 - make and model
				$t=$c->query("select * from vehicles where (make like '%" . $terms[0] . "%' or model like '%" . $terms[0] . "%') AND (make like '%" . $terms[1] . "%' or model like '%" . $terms[1] . "%') LIMIT 20");	
			}
		} else {
			//Max search terms are limited to 3, and hence all search phrases with terms greater than 3 wii be truncated to 3 terms.
			if (is_numeric($term[0])) {
				$t=$c->query("select * from vehicles where (year like '%" . $terms[0] . "%') AND ((make like '%" . $terms[1] . "%' or model like '%" . $terms[1] . "%') AND (make like '%" . $terms[2] . "%' or model like '%" . $terms[2] . "%')) LIMIT 20");	
			} else if (is_numeric($term[1])) {
				$t=$c->query("select * from vehicles where (year like '%" . $terms[1] . "%') AND ((make like '%" . $terms[0] . "%' or model like '%" . $terms[0] . "%') AND (make like '%" . $terms[2] . "%' or model like '%" . $terms[2] . "%')) LIMIT 20");	
			} else if (is_numeric($term[2])) {
				$t=$c->query("select * from vehicles where (year like '%" . $terms[2] . "%') AND ((make like '%" . $terms[0] . "%' or model like '%" . $terms[0] . "%') AND (make like '%" . $terms[1] . "%' or model like '%" . $terms[1] . "%')) LIMIT 20");	
			} else {
				//Drop 3rd term, since all 3 are not numeric, and searchable non numeric fields are just 2 - make and model
				$t=$c->query("select * from vehicles where (make like '%" . $terms[0] . "%' or model like '%" . $terms[0] . "%') AND (make like '%" . $terms[1] . "%' or model like '%" . $terms[1] . "%') LIMIT 20");	
			}
		}
	}
	for ($i=0;$i<count($t);$i++) {
		$str[] = array("label"=>$t[$i]['year'] . " " . $t[$i]['make'] . " " . $t[$i]['model'],"value"=>$t[$i]['year'] . " " . $t[$i]['make'] . " " . $t[$i]['model']);
	}
	echo json_encode($str);
