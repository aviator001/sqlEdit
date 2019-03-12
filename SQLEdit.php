<?	
	/*
		Pass in 'table' and 'db_name' as querystring parameters
	*/

	include "php/class/utils.class.php";
	parse_str(http_build_query($_GET));
	$c=new utils;
	$c->connect(DB_SERVER,DB_USER,DB_PASS,$db_name);

	echo $c->SQLEdit($db_name,$table);
	include "php/paginate.php";