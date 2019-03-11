<?
	ini_set('display_errors',0);
	parse_str(http_build_query($_GET));
	include "class/utils.class.php";
	$c=new utils;
	$c->connect(DB_SERVER,DB_USER,DB_PASS,$db_name);
	$fieldNames=$c->getAllFields($db_name,$table);
	$c->title='EDITINGT TABLE ' . strToUpper($table);
	$c->user_file_name	=	"php_edit_" . $table . ".php";
	$c->user_js_files	=	$user_js_files;
	$c->user_css_files	=	$user_css_files;
	$c->user_page_css	=	$user_page_css;
	$c->user_page_js	=	$user_page_js;
	$c->table			=	$table;
	$c->field_names		=	$fieldNames;
	echo $c->createPHPEditTable("select * from $table");
?>