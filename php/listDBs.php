<?
ini_set('display_errors',1);
include "../class/utils.class.php";
$c=new utils;
$c->connect();
echo $dbList=$c->DBList();